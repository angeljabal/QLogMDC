<?php

namespace App\Exports;

use App\Models\Log;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;


class LogExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings
{
    private $facilityId, $startDate, $endDate, $query;

    // use constructor to handle dependency injection
    public function __construct($facilityId = null, $startDate = null, $endDate = null)
    {
        $this->facilityId = $facilityId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    public function query()
    {
        $this->query = Log::query();
        if (isset($this->startDate)) {
            $this->query->where('facility_id', $this->facilityId)
                ->whereDate('created_at', '>=', $this->startDate)
                ->whereDate('created_at', '<=', $this->endDate);
        }
        if (isset($facilityId) || $this->facilityId != 0) {
            if ($this->facilityId == -1) {
                $this->query->where('purpose', "Walk-in");
            }
            $this->query->where('facility_id', $this->facilityId);
        }

        return $this->query;
    }

    public function map($logs): array
    {
        return [
            $logs->purpose,
            $logs->user->name,
            isset($logs->facility->name) ? $logs->facility->name : '',
            Carbon::parse($logs->created_at)->format('g:i A'),
            Carbon::parse($logs->created_at)->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Purpose',
            'Name',
            'Facility Visited',
            'Time',
            'Date'
        ];
    }
}
