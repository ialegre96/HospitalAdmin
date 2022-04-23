<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.patient_diagnosis_test.patient') }}</th>
        <th>{{ __('messages.patient_diagnosis_test.doctor') }}</th>
        <th>{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</th>
        <th>{{ __('messages.patient_diagnosis_test.report_number') }}</th>
        <th>Age</th>
        <th>Height</th>
        <th>Weight</th>
        <th>Average Glucose</th>
        <th>Fasting Blood Sugar</th>
        <th>Urine Sugar</th>
        <th>Blood Pressure</th>
        <th>Diabetes</th>
        <th>Cholesterol</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patientDiagnosisTests as $patientDiagnosisTest)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $patientDiagnosisTest->patient->user->full_name }}</td>
            <td>{{ $patientDiagnosisTest->doctor->user->full_name }}</td>
            <td>{{ $patientDiagnosisTest->category->name }}</td>
            <td>{{ $patientDiagnosisTest->report_number }}</td>
            @foreach($patientDiagnosisTest->patientDiagnosisProperties as $patientDiagnosisProperty)
                <td>{{!empty($patientDiagnosisProperty->property_value) ? $patientDiagnosisProperty->property_value : __('messages.common.n/a') }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
