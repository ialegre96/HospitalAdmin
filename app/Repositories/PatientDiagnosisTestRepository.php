<?php

namespace App\Repositories;

use App\Models\DiagnosisCategory;
use App\Models\PatientDiagnosisProperty;
use App\Models\PatientDiagnosisTest;
use App\Models\Setting;
use Arr;
use Illuminate\Support\Collection;
use Str;

/**
 * Class PatientDiagnosisTestRepository
 */
class PatientDiagnosisTestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'doctor_id',
        'category_id',
        'report_number',
    ];

    /**
     * Return searchable fields
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PatientDiagnosisTest::class;
    }

    /**
     * @return string
     */
    public static function getUniqueReportNumber()
    {
        $reportNumber = mb_strtoupper(Str::random(8));
        while (true) {
            $isExist = PatientDiagnosisTest::whereReportNumber($reportNumber)->exists();
            if ($isExist) {
                self::getUniqueReportNumber();
            }
            break;
        }

        return $reportNumber;
    }

    /**
     * @return Collection
     */
    public function getDiagnosisCategory()
    {
        $diagnosisCategories = DiagnosisCategory::all()->pluck('name', 'id')->sort();

        return $diagnosisCategories;
    }

    /**
     * @param  int  $patientDiagnosisTestId
     *
     * @return PatientDiagnosisTest
     */
    public function getPatientDiagnosisTestProperty($patientDiagnosisTestId)
    {
        /** @var PatientDiagnosisTest $diagnosisTestProperty */
        $diagnosisTestProperty = PatientDiagnosisProperty::wherePatientDiagnosisId($patientDiagnosisTestId)->get();

        return $diagnosisTestProperty;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        /** @var PatientDiagnosisTest $patientDiagnosisTest */
        $patientDiagnosisTest = PatientDiagnosisTest::create(Arr::only($input,
            ['patient_id', 'doctor_id', 'category_id', 'report_number']));

        $propertyInputArray = Arr::except($input,
            ['_token', 'patient_id', 'doctor_id', 'category_id', 'report_number', 'property_name', 'property_value']);

        foreach ($propertyInputArray as $key => $value) {
            PatientDiagnosisProperty::create([
                'patient_diagnosis_id' => $patientDiagnosisTest->id,
                'property_name'        => $key,
                'property_value'       => $value,
            ]);
        }

        if (isset($input['property_name']) && ! empty($input['property_name'])) {
            $otherProperty = Arr::only($input, ['property_name', 'property_value']);
            $patientDiagnosisTestItemInput = $this->prepareInputForPatientDiagnosisTest($otherProperty);

            foreach ($patientDiagnosisTestItemInput as $key => $data) {
                if ($data['property_name'] != null && $data['property_value'] != null) {
                    $data['patient_diagnosis_id'] = $patientDiagnosisTest->id;
                    PatientDiagnosisProperty::create($data);
                }
            }
        }

        return true;
    }

    public function updatePatientDiagnosis($input, $patientDiagnosisTest)
    {
        $patientDiagnosisTest->update(Arr::only($input,
            ['patient_id', 'doctor_id', 'category_id', 'report_number']));

        $diagnosisProperty = PatientDiagnosisProperty::wherePatientDiagnosisId($patientDiagnosisTest->id);
        $diagnosisProperty->delete();

        $propertyInputArray = Arr::except($input,
            ['_token', 'patient_id', 'doctor_id', 'category_id', 'report_number', 'property_name', 'property_value']);

        foreach ($propertyInputArray as $key => $value) {
            PatientDiagnosisProperty::create([
                'patient_diagnosis_id' => $patientDiagnosisTest->id,
                'property_name'        => $key,
                'property_value'       => $value,
            ]);
        }

        if (isset($input['property_name']) && ! empty($input['property_name'])) {
            $otherProperty = Arr::only($input, ['property_name', 'property_value']);
            $patientDiagnosisTestItemInput = $this->prepareInputForPatientDiagnosisTest($otherProperty);

            foreach ($patientDiagnosisTestItemInput as $key => $data) {
                if ($data['property_name'] != null && $data['property_value'] != null) {
                    $data['patient_diagnosis_id'] = $patientDiagnosisTest->id;
                    PatientDiagnosisProperty::create($data);
                }
            }
        }

        return true;
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public function prepareInputForPatientDiagnosisTest($input)
    {
        $item = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $item[$index][$key] = $value;
            }
        }

        return $item;
    }

    /**
     * @return mixed
     */
    public function getSettingList()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return $settings;
    }
}
