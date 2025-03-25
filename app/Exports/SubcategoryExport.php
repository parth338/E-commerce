<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class SubcategoryExport implements FromQuery, WithHeadings, WithMapping, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return SubCategory::all();

    // }
    /**
     * Query for the export.
     */
    public function query()
    {
        return SubCategory::query()->with('category');
    }


    // Define headings
    public function headings(): array
    {

        return [
            'ID',
            'Name',
            'Slug',
            'Category',
            'Status'
        ];
    }

    //mapped data for each row//
    public function map($subCategory): array
    {
        return [
            $subCategory->id,
            $subCategory->name,
            $subCategory->slug,
            $subCategory->category->name, // Assuming the category relation is loaded
            $subCategory->status == 1 ? 'Active' : 'Inactive', // Format status
        ];
    }

    public function startCell(): string
    {
        return 'A2'; // Start heading at A2 
    }
}
