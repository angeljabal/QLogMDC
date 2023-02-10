<?php

namespace App\Exports;

use App\Models\AvailableId;
use App\Models\Log;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    public function collection()
    {
        return AvailableId::all();
    }

    public function map($row): array
    {
        // row will be the attendance and offers will be the relationship
        return [
            $row->user->lname . ', ' . $row->user->fname,
        ];
    }

    public function headings(): array
    {
        // Exported Excel Headers, in order, which you should match them base on
        // manipulated data in above
        return [
            'Name'
        ];
    }
}
