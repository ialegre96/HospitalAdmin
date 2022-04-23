<?php

namespace App\Http\Controllers;

use App\Models\AdvancedPayment;
use App\Models\Bed;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Enquiry;
use App\Models\Invoice;
use App\Models\Module;
use App\Models\NoticeBoard;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Subscribe;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\SuperAdminEnquiry;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeController extends AppBaseController
{
    private $dashboardRepository;

    /**
     * Create a new controller instance.
     *
     * @param  DashboardRepository  $dashboardRepository
     */
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->middleware('auth');
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return Factory|View
     */
    public function dashboard()
    {
        $data['invoiceAmount'] = totalAmount();
        $data['billAmount'] = Bill::sum('amount');
        $data['paymentAmount'] = Payment::sum('amount');
        $data['advancePaymentAmount'] = AdvancedPayment::sum('amount');
        $data['doctors'] = Doctor::count();
        $data['patients'] = Patient::count();
        $data['nurses'] = Nurse::count();
        $data['availableBeds'] = Bed::whereIsAvailable(1)->count();
        $data['noticeBoards'] = NoticeBoard::take(5)->orderBy('id', 'DESC')->get();
        $data['enquiries'] = Enquiry::where('status', 0)->latest()->take(5)->get();
        $data['currency'] = Setting::CURRENCIES;
        $modules = Module::pluck('is_active', 'name')->toArray();

        return view('dashboard.index', compact('data', 'modules'));
    }

    public function superAdminDashboard()
    {
        $query = User::where('department_id', '=', User::USER_ADMIN)->select('users.*');
        $data['users'] = $query->count();
        $data['revenue'] = Transaction::where('status', '=', Transaction::APPROVED)->sum('amount');
        $data['activeHospitalPlan'] = $this->dashboardRepository->getTotalActiveDeActiveHospitalPlans()['activePlansCount'];
        $data['deActiveHospitalPlan'] = $this->dashboardRepository->getTotalActiveDeActiveHospitalPlans()['deActivePlansCount'];

        return view('super_admin.dashboard.index', compact('data'));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function incomeExpenseReport(Request $request)
    {
        $data = $this->dashboardRepository->getIncomeExpenseReport($request->all());

        return $this->sendResponse($data, 'Income and Expense report retrieved successfully.');
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function featureAvailability()
    {
        return view('menu_feature.index');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function incomeChart(Request $request)
    {
        $input = $request->all();
        $startDate = str_replace('/', '-', $input['start_date']);
        $endDate = str_replace('/', '-', $input['end_date']);
        $formatStartDate = Carbon::parse($startDate)->format('Y-m-d');
        $formatEndDate = Carbon::parse($endDate)->format('Y-m-d');

        $data = $this->dashboardRepository->totalFilterDay($formatStartDate, $formatEndDate);

        return $this->sendResponse($data, 'Income Report Generate successfully.');
    }
}
