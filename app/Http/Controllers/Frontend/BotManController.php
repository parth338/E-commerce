<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Product;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use GuzzleHttp\Client;

class BotManController extends Controller
{
    public function handle(Request $request)
    {

        $botman = app('botman');
        $botman->hears('{message}', function (BotMan $bot, $message) {
            $response = $this->getOpenAIResponse($message);
            // $response = $this->getProductResponse($message);
            $bot->reply($response);
        });

        $botman->listen();
    }


    /**
     * Place your BotMan logic here.
     */

    private function getOpenAIResponse($message)
    {
        $apiKey = env('OPENROUTER_API_KEY'); // Store API key in .env
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'http://localhost/Multi%20vendor%20ecommerce%20source%20code/', // Required by OpenRouter
            ],
            'json' => [
                'model' => 'openai/gpt-3.5-turbo', // Choose a free model from OpenRouter
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful AI assistant for an eCommerce website.'],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'] ?? 'Sorry, I could not process that.';
    }

    public function getProductResponse($message)
    {
         $settings = GeneralSetting::first();
        //  print_r($settings);die;
        // Extract relevant keywords (like "laptops") using AI or predefined keywords
        $keywords = $this->extractKeywords($message);

        // Search for products using extracted keywords
        $products = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('short_description', 'LIKE', "%{$keyword}%")
                    ->orWhere('category_id', 'LIKE', "%{$keyword}%"); // Include category search
            }
        })
            ->take(3)
            ->get();
        //search for products in database
        // $products = Product::where('name', 'LIKE', "%{$message}%")
        //     ->orWhere('short_description', 'LIKE', "%{$message}%") // Added "%" for LIKE
        //     ->take(3)
        //     ->get();

        // print_r($products);die;
        if ($products->isEmpty()) {
            return 'Sorry, I could not find any products related to ' . $message . ' Try searching for something else.';
        }


        $productDetails = 'Here are some products <br>';
        foreach ($products as $product) {
            $producturl = route('product-detail', $product->slug);
            $productDetails .= "** {$product->name} ** - {$product->short_description}<br>";
            if(checkDiscount($product)) {
               $priceDisplay = "** {$settings->currency_icon}{$product->offer_price} ** (Discounted) {{$settings->currency_icon}}{{$product->price}} ";
               }   else{
              $priceDisplay = "** {$settings->currency_icon}{$product->price} **";
               }
              $productDetails .= "Price: {$priceDisplay}<br>";
            $productDetails .= " view: <a href= '{$producturl}' target= '_blank'>View Product</a><br>";
        }

        return $productDetails;
    }

    // Extract keywords from user message
    private function extractKeywords($message)
    {
        // Predefined list of common product categories or AI-based keyword extraction
        $commonKeywords = ['laptop', 'phone', 'shoes', 'headphones', 'watch', 'camera'];

        // Extract words from message
        $words = explode(' ', strtolower($message));

        // Filter only relevant keywords
        return array_intersect($words, $commonKeywords);
    }
}
