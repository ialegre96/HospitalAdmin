<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.case.patient') }}</th>
        <th>{{ __('messages.case.doctor') }}</th>
        <th>{{ __('messages.bill.admission_id') }}</th>
        <th>{{ __('messages.patient_admission.admission_date') }}</th>
        <th>{{ __('messages.patient_admission.discharge_date') }}</th>
        <th>{{ __('messages.patient_admission.package') }}</th>
        <th>{{ __('messages.patient_admission.insurance') }}</th>
        <th>{{ __('messages.patient_admission.bed') }}</th>
        <th>{{ __('messages.patient_admission.policy_no') }}</th>
        <th>{{ __('messages.patient_admission.agent_name') }}</th>
        <th>{{ __('messages.patient_admission.guardian_name') }}</th>
        <th>{{ __('messages.patient_admission.guardian_relation') }}</th>
        <th>{{ __('messages.patient_admission.guardian_contact') }}</th>
        <th>{{ __('messages.patient_admission.guardian_address') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patientAdmissions as $patientAdmission)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $patientAdmission->patient->user->full_name }}</td>
            <td>{{ $patientAdmission->doctor->user->full_name }}</td>
            <td>{{ $patientAdmission->patient_admission_id }}</td>
            <td>{{ !empty($patientAdmission->admission_date) ? date('jS M,Y g:i A', strtotime($patientAdmission->admission_date)) : __('messages.common.n/a') }}</td>
            <td>{{ !empty($patientAdmission->discharge_date) ? date('jS M,Y g:i A', strtotime($patientAdmission->discharge_date)) : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->package_id)) ? $patientAdmission->package->name : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->insurance_id)) ? $patientAdmission->insurance->name : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->bed_id)) ? $patientAdmission->bed->name : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->policy_no)) ? $patientAdmission->policy_no : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->agent_name)) ? $patientAdmission->agent_name : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->guardian_name)) ? $patientAdmission->guardian_name : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->guardian_relation)) ? $patientAdmission->guardian_relation : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->guardian_contact)) ? $patientAdmission->guardian_contact : __('messages.common.n/a') }}</td>
            <td>{{ (!empty($patientAdmission->guardian_address)) ? $patientAdmission->guardian_address : __('messages.common.n/a') }}</td>
            <td>{{ ($patientAdmission->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
