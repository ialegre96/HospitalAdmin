<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.pathology_test.test_name') }}</th>
        <th>{{ __('messages.pathology_test.short_name') }}</th>
        <th>{{ __('messages.pathology_test.test_type') }}</th>
        <th>{{ __('messages.pathology_test.category_name') }}</th>
        <th>{{ __('messages.pathology_test.unit') }}</th>
        <th>{{ __('messages.pathology_test.subcategory') }}</th>
        <th>{{ __('messages.pathology_test.method') }}</th>
        <th>{{ __('messages.pathology_test.report_days') }}</th>
        <th>{{ __('messages.pathology_test.charge_category') }}</th>
        <th>{{ __('messages.pathology_test.standard_charge') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pathologyTests as $pathologyTest)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pathologyTest->test_name }}</td>
            <td>{{ $pathologyTest->short_name }}</td>
            <td>{{ $pathologyTest->test_type }}</td>
            <td>{{ $pathologyTest->pathologycategory->name }}</td>
            <td>{{ (!empty($pathologyTest->unit)) ? $pathologyTest->unit : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($pathologyTest->subcategory)) ? $pathologyTest->subcategory : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($pathologyTest->method)) ? $pathologyTest->method : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($pathologyTest->report_days)) ? nl2br(e($pathologyTest->report_days)) : __('messages.common.n/a') }}</td>
            <td>{{ $pathologyTest->chargecategory->name }}</td>
            <td>{{ number_format($pathologyTest->standard_charge) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
