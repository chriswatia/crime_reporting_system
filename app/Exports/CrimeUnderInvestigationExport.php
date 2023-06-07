<?php

namespace App\Exports;

use App\Models\Crime;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class CrimeUnderInvestigationExport implements FromQuery,ShouldAutoSize,WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
           ['ID', 'Crime Number', 'Assignee','Category', 'Description', 'Date Reported', 'Location', 'Device', 'Ip Address', 'Status']
        ];
    }

    public function query()
    {
        return Crime::query()
        ->join('crime_categories as cat', 'crimes.category_id', 'cat.id')
        ->join('crime_assignment as ca', 'crimes.id', 'ca.crime_id')
        ->join('users as u', 'ca.officer_id', 'u.id')
        ->where('crimes.status', 'In Progress')
        ->select('crimes.id', 'crime_no',DB::raw('CONCAT(u.firstname," ",u.lastname) AS name'), 'cat.category_name', 'crimes.description', 'crimes.created_at', 'crime_location', 'device_type', 'mac_address', 'crimes.status');
    }
}
