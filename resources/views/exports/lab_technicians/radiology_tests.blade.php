<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.radiology_test.test_name') }}</th>
        <th>{{ __('messages.radiology_test.short_name') }}</th>
        <th>{{ __('messages.radiology_test.test_type') }}</th>
        <th>{{ __('messages.radiology_test.category_name') }}</th>
        <th>{{ __('messages.radiology_test.subcategory') }}</th>
        <th>{{ __('messages.radiology_test.report_days') }}</th>
        <th>{{ __('messages.radiology_test.charge_category') }}</th>
        <th>{{ __('messages.radiology_test.standard_charge') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($radiologyTests as $radiologyTest)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $radiologyTest->test_name }}</td>
            <td>{{ $radiologyTest->short_name }}</td>
            <td>{{ $radiologyTest->test_type }}</td>
            <td>{{ $radiologyTest->radiologycategory->name }}</td>
            <td>{{ (!empty($radiologyTest->subcategory)) ? $radiologyTest->subcategory : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($radiologyTest->report_days)) ? $radiologyTest->report_days : __('messages.common.n/a') }}</td>
            <td>{{ $radiologyTest->chargecategory->name }}</td>
            <td>{{ number_format($radiologyTest->standard_charge) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
