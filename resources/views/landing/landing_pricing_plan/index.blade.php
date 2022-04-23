<section id="pricing">
    <div class="container">
        @include('landing.home.pricing_plan_button')
        <div class="row align-items-center">
            <div class="col-lg-12 col-md-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="monthContent" role="tabpanel"
                         aria-labelledby="month-tab">
                        <div class="row justify-content-center">
                            @forelse($subscriptionPricingMonthPlans as $subscriptionsPricingPlan)
                                @include('landing.home.pricing_plan_section', ['screenFrom' => $screenFrom])
                            @empty
                                <div class="col-lg-4 col-md-6">
                                    <div class="card text-center empty_featured_card">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <div>
                                                <div class="empty-featured-portfolio">
                                                    <i class="fas fa-question"></i>
                                                </div>
                                                <h3 class="card-title mt-3">
                                                    {{ __('messages.subscription_month_plan_not_found') }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="tab-pane fade" id="yearContent" role="tabpanel"
                         aria-labelledby="year-tab">
                        <div class="row justify-content-center">
                            @forelse($subscriptionPricingYearPlans as $subscriptionsPricingPlan)
                                @include('landing.home.pricing_plan_section', ['screenFrom' => $screenFrom])
                            @empty
                                <div class="col-lg-4 col-md-6">
                                    <div class="card text-center empty_featured_card">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <div>
                                                <div class="empty-featured-portfolio">
                                                    <i class="fas fa-question"></i>
                                                </div>
                                                <h3 class="card-title mt-3">
                                                    {{ __('messages.subscription_year_plan_not_found') }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
