<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Models\Faqs;
use App\Models\AdminTestimonial;
use App\Models\LandingAboutUs;
use App\Models\SectionFive;
use App\Models\SectionFour;
use App\Models\SectionOne;
use App\Models\SectionThree;
use App\Models\SectionTwo;
use App\Models\ServiceSlider;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;


class LandingScreenController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $data['sectionOne'] = SectionOne::first();
        $data['sectionTwo'] = SectionTwo::first();
        $data['sectionThree'] = SectionThree::first();
        $data['sectionFour'] = SectionFour::first();
        $data['sectionFive'] = SectionFive::first();
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with(['plan', 'plans', 'planFeatures.feature'])
            ->where('frequency', '=', SubscriptionPlan::MONTH)
            ->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with(['plan', 'plans', 'planFeatures.feature'])
            ->where('frequency', '=', SubscriptionPlan::YEAR)
            ->get();
        $data['hospitals'] = User::with(['department', 'media'])
            ->where('id', '!=', getLoggedInUserId())
            ->where('department_id', '=', User::USER_ADMIN)
            ->whereNotNull('hospital_name')->paginate(9, '*', 'hospitals');

        return view('landing.home.index')->with($data);
    }

    /**
     * @return Factory|View
     */
    public function aboutUs()
    {
        $data['sectionFour'] = SectionFour::first();
        $data['sectionFive'] = SectionFive::first();
        $data['landingAboutUs'] = LandingAboutUs::first();
        $data['faqs'] = Faqs::take(3)->orderByDesc('created_at')->get();
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::MONTH)
            ->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::YEAR)
            ->get();
        
        return view('landing.home.about_us')->with($data);
    }

    /**
     * @return Factory|View
     */
    public function services()
    {
        $data['sectionFour'] = SectionFour::first();
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::MONTH)
            ->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::YEAR)
            ->get();
        $data['serviceSlider'] = ServiceSlider::get();
        $data['testimonials'] = AdminTestimonial::get();
        
        return view('landing.home.services')->with($data);
    }

    /**
     * @return Factory|View
     */
    public function pricing()
    {
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::MONTH)
            ->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with(['plan', 'plans'])
            ->where('frequency', '=', SubscriptionPlan::YEAR)
            ->get();
        
        return view('landing.home.pricing')->with($data);
    }

    /**
     * @return Factory|View
     */
    public function contactUs()
    {
        return view('landing.home.contact_us');
    }

    /**
     * @return Factory|View
     */
    public function faq()
    {
        $faqs = Faqs::take(6)->orderByDesc('created_at')->get();

        return view('landing.home.faq', compact('faqs'));
    }

    /**
     * @return Factory|View
     */
    public function login()
    {
        return view('landing.home.login');
    }

    /**
     * @return Factory|View
     */
    public function register()
    {
        return view('landing.home.register');
    }

}
