<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Models\Income;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;

/**
 * Class DashboardRepository
 */
class DashboardRepository
{
    /**
     * @param array $input
     * @throws Exception
     * @return array
     */
    public function getIncomeExpenseReport($input)
    {
        $dates = $this->getDate($input['start_date'], $input['end_date']);

        $incomes = Income::all();
        $expenses = Expense::all();

        //Income report
        $data = [];
        foreach ($dates['dateArr'] as $cDate) {
            $incomeTotal = 0;
            foreach ($incomes as $row) {
                $chartDates = $cDate;
                $incomeDates = trim(substr($row['date'], 0, 10));
                if ($chartDates == $incomeDates) {
                    $incomeTotal += $row['amount'];
                }
            }
            $incomeTotalArray[] = $incomeTotal;
            $dateArray[] = $cDate;
        }

        //Expense report
        foreach ($dates['dateArr'] as $cDate) {
            $expenseTotal = 0;
            foreach ($expenses as $row) {
                $chartDates = $cDate;
                $expenseDates = trim(substr($row['date'], 0, 10));
                if ($chartDates == $expenseDates) {
                    $expenseTotal += $row['amount'];
                }
            }
            $expenseTotalArray[] = $expenseTotal;
        }

        $data['incomeTotal'] = $incomeTotalArray;
        $data['expenseTotal'] = $expenseTotalArray;
        $data['date'] = $dateArray;

        return $data;
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @throws Exception
     * @return array
     */
    public function getDate($startDate, $endDate)
    {
        $dateArr = [];
        $subStartDate = '';
        $subEndDate = '';
        if (!($startDate && $endDate)) {
            $data = [
                'dateArr'   => $dateArr,
                'startDate' => $subStartDate,
                'endDate'   => $subEndDate,
            ];

            return $data;
        }
        $end = trim(substr($endDate, 0, 10));
        $start = Carbon::parse($startDate)->toDateString();
        /** @var \Illuminate\Support\Carbon $startDate */
        $startDate = Carbon::createFromFormat('Y-m-d', $start);
        /** @var \Illuminate\Support\Carbon $endDate */
        $endDate = Carbon::createFromFormat('Y-m-d', $end);

        while ($startDate <= $endDate) {
            $dateArr[] = $startDate->copy()->format('Y-m-d');
            $startDate->addDay();
        }
        $start = current($dateArr);
        $endDate = end($dateArr);
        $subStartDate = Carbon::parse($start)->startOfDay()->format('Y-m-d H:i:s');
        $subEndDate = Carbon::parse($endDate)->endOfDay()->format('Y-m-d H:i:s');

        $data = [
            'dateArr'   => $dateArr,
            'startDate' => $subStartDate,
            'endDate'   => $subEndDate,
        ];

        return $data;
    }

    /**
     * @return int[]
     */
    public function getTotalActiveDeActiveHospitalPlans()
    {
        $activePlansCount = 0;
        $deActivePlansCount = 0;
        $subscriptions = Subscription::whereStatus(Subscription::ACTIVE)->get();
        foreach ($subscriptions as $sub) {
            if (!$sub->isExpired()) {   // active plans
                $activePlansCount++;
            } else {
                $deActivePlansCount++;
            }
        }

        return ['activePlansCount' => $activePlansCount, 'deActivePlansCount' => $deActivePlansCount];
    }

    /**
     * @param $formatStartDate
     * @param $formatEndDate
     * @return array
     */
    public function totalFilterDay($formatStartDate, $formatEndDate)
    {
        $period = CarbonPeriod::create($formatStartDate, $formatEndDate);

        $dateArr = [];
        foreach ($period as $date) {
            $dateArr[] = $date->format('jS M');

            $income[] = $this->totalFilterReport($date);
        }
        $data['days'] = $dateArr;
        $data['income'] = [
            'label'           => trans('messages.income', [], getLoggedInUser()->language),
            'data'            => $income,
            'fill'            => 'false',
            'borderColor'     => 'rgb(153, 102, 255)',
            'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
            'borderWidth'     => 1,
            'tension'         => 0.4,
        ];


        return $data;
    }

    /**
     * @param $date
     * @return int|mixed
     */
    public function totalFilterReport($date)
    {
        return Transaction::where('status', Transaction::APPROVED)->whereDate('created_at', $date)->sum('amount');
    }
}
