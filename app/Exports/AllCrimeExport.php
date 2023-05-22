<?php

namespace App\Exports;

use App\Models\Crime;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllCrimeExport implements FromQuery,ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        return Crime::query()
        ->join('crime_categories as cat', 'crimes.category_id', 'cat.id')
        ->select('crimes.id', 'crime_no', 'cat.category_name', 'crimes.description', 'crime_location', 'device_type', 'mac_address', 'status');
    }
}
