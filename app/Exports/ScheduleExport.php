<?php

namespace App\Exports;

use App\Models\Schedule;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ScheduleExport implements FromView, WithTitle, ShouldAutoSize, WithEvents
{
    public function view(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $userSchedule = Schedule::with('scheduleDays')->where('doctor_id', $user->owner_id)->first();

        return view('exports.doctors.schedules', ['userSchedule' => $userSchedule]);
    }

    public function title(): string
    {
        return 'Schedules';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
