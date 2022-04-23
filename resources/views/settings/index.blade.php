@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.settings') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                @include('flash::message')
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="card-body py-0">
                    @include("settings.edit")
                </div>
            </div>
        </div>
    </section>
@endsection
