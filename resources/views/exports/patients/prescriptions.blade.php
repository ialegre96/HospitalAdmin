<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.prescription.patient') }}</th>
        <th>{{ __('messages.prescription.food_allergies') }}</th>
        <th>{{ __('messages.prescription.tendency_bleed') }}</th>
        <th>{{ __('messages.prescription.heart_disease') }}</th>
        <th>{{ __('messages.prescription.high_blood_pressure') }}</th>
        <th>{{ __('messages.prescription.diabetic') }}</th>
        <th>{{ __('messages.prescription.surgery') }}</th>
        <th>{{ __('messages.prescription.accident') }}</th>
        <th>{{ __('messages.prescription.others') }}</th>
        <th>{{ __('messages.prescription.medical_history') }}</th>
        <th>{{ __('messages.prescription.current_medication') }}</th>
        <th>{{ __('messages.prescription.female_pregnancy') }}</th>
        <th>{{ __('messages.prescription.health_insurance') }}</th>
        <th>{{ __('messages.prescription.low_income') }}</th>
        <th>{{ __('messages.prescription.reference') }}</th>
        <th>{{ __('messages.common.status') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prescriptions as $prescription)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $prescription->patient->user->full_name }}</td>
            <td>{{ ($prescription->food_allergies != null) ? $prescription->food_allergies : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->tendency_bleed != null) ? $prescription->tendency_bleed : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->heart_disease != null) ? $prescription->heart_disease : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->high_blood_pressure != null) ? $prescription->high_blood_pressure : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->diabetic != null) ? $prescription->diabetic : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->surgery != null) ? $prescription->surgery : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->accident != null) ? $prescription->accident : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->others != null) ? $prescription->others : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->medical_history != null) ? $prescription->medical_history : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->current_medication != null) ? $prescription->current_medication : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->female_pregnancy != null) ? $prescription->female_pregnancy : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->breast_feeding != null) ? $prescription->breast_feeding : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->health_insurance != null) ? $prescription->health_insurance : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->low_income != null) ? $prescription->low_income : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->reference != null) ? $prescription->reference : __('messages.common.n/a') }}</td>
            <td>{{ ($prescription->status === 1) ? __('messages.common.de_active') : __('messages.common.active') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
