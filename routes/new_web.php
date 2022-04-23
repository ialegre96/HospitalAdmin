<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('switch-workspace/{tenant_id}',[\App\Http\Controllers\TenantController::class, 'switchWorkspace']);
Route::post('assign-workspace', [\App\Http\Controllers\TenantController::class, 'assignNewWorkspace']);

Route::get('/users/creates', function (){
    return view('users.new_create');
});


// Routes for Landing Page starts
Route::group(['middleware' => ['setLanguage']], function () {
    Route::get('/', 'Web\WebController@index')->name('front');
    // Routes for Enquiry Form
    Route::post('send-enquiry', 'EnquiryController@store')->name('send.enquiry');
    Route::get('/contact-us', 'EnquiryController@contactUs')->name('contact');
    Route::get('/about-us', 'Web\WebController@aboutUs')->name('aboutUs');
    Route::get('/appointment', 'Web\WebController@appointment')->name('appointment');
    Route::get('/our-services', 'Web\WebController@services')->name('our-services');
    Route::get('/our-doctors', 'Web\WebController@doctors')->name('our-doctors');
    Route::get('/terms-of-service', 'Web\WebController@termsOfService')->name('terms-of-service');
    Route::get('/privacy-policy', 'Web\WebController@privacyPolicy')->name('privacy-policy');
});

//Change language
Route::post('/change-language', 'Web\WebController@changeLanguage');
Route::get('/demo', 'Web\WebController@demo')->name('demo');
Route::get('/modules-of-hms', 'Web\WebController@modulesOfHms')->name('modules-of-hms');
// Routes for Landing Page ends

// Routes for Appointment
Route::get('appointments/{email}/patient-detail',
    'Web\AppointmentController@getPatientDetails')->name('appointment.patient.details');
Route::get('appointment-doctors-list', 'Web\AppointmentController@getDoctors')->name('appointment.doctor.list');
Route::get('appointment-booking-slot',
    'Web\AppointmentController@getBookingSlot')->name('appointment.get.booking.slot');
Route::get('appointment-doctor-schedule-list', 'ScheduleController@doctorScheduleList')->name('doctor-schedule-list');
Route::post('appointment-store', 'Web\AppointmentController@store')->name('web.appointments.store');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::group(['middleware' => ['auth', 'verified', 'xss', 'multi_tenant', 'checkUserStatus']], function () {
    Route::get('profile', 'UserController@editProfile');
    Route::post('change-password', 'UserController@changePassword');
    Route::post('profile-update', 'UserController@profileUpdate');
    Route::post('update-language', 'UserController@updateLanguage');

    // stripe payment
    Route::post('/stripe-charge', 'StripeController@createSession');
    Route::get('payment-success', 'StripeController@paymentSuccess')->name('payment-success');
    Route::get('failed-payment', 'StripeController@handleFailedPayment')->name('failed-payment');

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager']],
        function () {
            Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
                Route::get('notice-board', 'NoticeBoardController@index')->name('noticeboard')->middleware('modules');
                Route::get('notice-board/{id}', 'NoticeBoardController@show')->name('noticeboard.show');
                Route::get('export-my-payrolls', 'PayrollController@userPayrollExport')->name('my.payrolls.excel');
            });
        });

    Route::group(['middleware' => ['role:Admin|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager']],
        function () {
            Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
                Route::get('payroll', 'PayrollController@index')->name('payroll')->middleware('modules');
            });
        });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor']], function () {
        Route::resource('documents', 'DocumentController');
        Route::get('documents', 'DocumentController@index')->name('documents.index')->middleware('modules');
        Route::post('documents/{document}/update', 'DocumentController@update');
    });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist']], function () {
        // Routes for Patients Cases listing
        Route::group(['prefix' => 'patient', 'namespace' => 'Patient'], function () {
            Route::get('my-cases', 'PatientCaseController@index')->name('patients.cases')->middleware('modules');
            Route::get('my-cases/{id}', 'PatientCaseController@show')->name('patient.cases.show');

            // Routes for Prescription Listing
            Route::get('my-prescriptions', 'PrescriptionController@index')->name('prescriptions.list');
            Route::get('my-prescriptions/{id}', 'PrescriptionController@show')->name('prescriptions.show');
        });
    });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist']], function () {
        // Listing common routes to be accessible by Admin, Doctor, Receptionist and Patient for IPD Patient modules.
        Route::get('ipd-diagnosis', 'IpdDiagnosisController@index')->name('ipd.diagnosis.index');
        Route::get('ipd-consultant-register',
            'IpdConsultantRegisterController@index')->name('ipd.consultant.index');
        Route::get('ipd-charges', 'IpdChargeController@index')->name('ipd.charge.index');
        Route::get('ipd-prescription', 'IpdPrescriptionController@index')->name('ipd.prescription.index');
        Route::get('ipd-prescription/{ipdPrescription}',
            'IpdPrescriptionController@show')->name('ipd.prescription.show');
        Route::get('ipd-timelines', 'IpdTimelineController@index')->name('ipd.timelines.index');
        Route::get('ipd-payments', 'IpdPaymentController@index')->name('ipd.payments.index');
        Route::get('ipd-bills/{ipdPatientDepartment}/pdf', 'IpdBillController@ipdBillConvertToPdf')
            ->where('ipdPatientDepartment', '[0-9]+');

        Route::get('ipd-diagnosis-download/{ipdDiagnosis}', 'IpdDiagnosisController@downloadMedia');
        Route::get('ipd-payment-download/{ipdPayment}', 'IpdPaymentController@downloadMedia');
        Route::get('ipd-timeline-download/{ipdTimeline}', 'IpdTimelineController@downloadMedia');

        // Listing common routes to be accessible by Admin, Doctor, Receptionist and Patient for OPD Patient modules.
        Route::get('opd-diagnosis', 'OpdDiagnosisController@index')->name('opd.diagnosis.index');
        Route::get('opd-diagnosis-download/{opdDiagnosis}', 'OpdDiagnosisController@downloadMedia');
        Route::get('opd-timelines', 'OpdTimelineController@index')->name('opd.timelines.index');
        Route::get('opd-timelines-download/{opdTimeline}', 'OpdTimelineController@downloadMedia');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Patient']], function () {
        Route::group(['prefix' => 'patient'], function () {
            Route::get('export-prescription',
                'Patient\PrescriptionController@prescriptionExport')->name('prescription.excel');

            Route::get('my-ipds', 'Patient\IpdPatientDepartmentController@index')->name('patient.ipd');
            Route::get('my-ipds/{ipdPatientDepartment}',
                'Patient\IpdPatientDepartmentController@show')->name('patient.ipd.show');

            Route::get('my-opds', 'Patient\OpdPatientDepartmentController@index')->name('patient.opd');
            Route::get('my-opds/{opdPatientDepartment}',
                'Patient\OpdPatientDepartmentController@show')->name('patient.opd.show');

            Route::get('my-vaccinated', 'Patient\VaccinatedController@index')->name('patient.vaccinated');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Patient|Doctor|Receptionist']], function () {
        Route::get('export-appointments', 'AppointmentController@appointmentExport')->name('appointments.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Doctor']], function () {
        Route::group(['prefix' => 'doctor'], function () {
            Route::get('export-schedules', 'ScheduleController@schedulesExport')->name('schedules.excel');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Nurse|Doctor']], function () {
        Route::get('export-bed-assign', 'BedAssignController@bedAssignExport')->name('bed.assigns.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Admin|Doctor|Case Manager|Receptionist']], function () {
        Route::get('export-patient-admissions',
            'PatientAdmissionController@patientAdmissionExport')->name('patient.admissions.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Nurse']], function () {
        Route::group(['prefix' => 'nurse'], function () {
            Route::get('export-beds', 'BedController@bedExport')->name('beds.excel');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Receptionist|Case Manager']], function () {
        Route::get('export-patient-cases', 'PatientCaseController@patientCaseExport')->name('patient.cases.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Receptionist|Lab Technician']], function () {
        Route::get('export-patient-diagnosis-test',
            'PatientDiagnosisTestController@patientDiagnosisTestExport')->name('patient.diagnosis.test.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Receptionist']], function () {
        Route::group(['prefix' => 'receptionist'], function () {
            Route::get('export-insurances', 'InsuranceController@insuranceExport')->name('insurances.excel');
            Route::get('export-packages', 'PackageController@packageExport')->name('packages.excel');
            Route::get('export-charges', 'ChargeController@chargeExport')->name('charges.excel');
            Route::get('export-doctor-opd-charges',
                'DoctorOPDChargeController@doctorOPDChargeExport')->name('doctor.opd.charges.excel');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Pharmacist']], function () {
        Route::group(['prefix' => 'pharmacist'], function () {
            Route::get('export-brands', 'BrandController@brandExport')->name('brands.excel');
            Route::get('export-medicines', 'MedicineController@medicineExport')->name('medicines.excel');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Accountant']], function () {
        Route::group(['prefix' => 'accountant'], function () {
            Route::get('export-employee-payrolls',
                'EmployeePayrollController@employeePayrollExport')->name('employee.payrolls.excel');
            Route::get('export-services', 'ServiceController@serviceExport')->name('services.excel');
        });
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Case Manager']], function () {
        Route::get('export-ambulance-calls',
            'AmbulanceCallController@ambulanceCallExport')->name('ambulance.calls.excel');
    });

    // excel export routes.
    Route::group(['middleware' => ['role:Lab Technician']], function () {
        Route::get('export-blood-banks', 'BloodBankController@bloodBankExport')->name('blood.banks.excel');
        Route::get('export-blood-donors', 'BloodDonorController@bloodDonorExport')->name('blood.donors.excel');
        Route::get('export-blood-donations',
            'BloodDonationController@bloodDonationExport')->name('blood.donations.excel');
        Route::get('export-blood-issues', 'BloodIssueController@export')->name('blood.issues.excel');
        Route::get('export-radiology-tests',
            'RadiologyTestController@radiologyTestExport')->name('radiology.tests.excel');
        Route::get('export-pathology-tests',
            'PathologyTestController@pathologyTestExport')->name('pathology.tests.excel');
    });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist|Nurse|Case Manager|Accountant']],
        function () {
            Route::get('patients/{patient}', 'PatientController@show')->where('patient',
                '[0-9]+')->name('patients.show');
        });

    Route::group(['middleware' => ['role:Admin|Doctor|Receptionist|Accountant']], function () {
        Route::get('doctors/{doctor}', 'DoctorController@show')->where('doctor', '[0-9]+');
    });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist|Nurse']], function () {
        Route::resource('appointments', 'AppointmentController');
        Route::get('appointments', 'AppointmentController@index')->name('appointments.index')->middleware('modules');
        Route::post('appointments/{appointment}', 'AppointmentController@update');
        Route::get('doctors-list', 'AppointmentController@getDoctors');
        Route::get('appointment-calendars', 'AppointmentCalendarController@index')->name('appointment-calendars.index');
        Route::get('calendar-list', 'AppointmentCalendarController@calendarList');
        Route::get('appointment-detail/{appointment}',
            'AppointmentCalendarController@getAppointmentDetails')->name('appointment.details');
        Route::post('appointments/{appointment}/status', 'AppointmentController@status')
            ->name('appointment.status');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Patient']], function () {
        Route::get('booking-slot', 'AppointmentController@getBookingSlot')->name('get.booking.slot');
        Route::get('doctor-schedule-list', 'ScheduleController@doctorScheduleList')->name('doctor-schedule-list');
    });

    Route::group(['middleware' => ['role:Admin|Doctor|Nurse']], function () {
        Route::resource('bed-assigns', 'BedAssignController');
        Route::get('bed-assigns', 'BedAssignController@index')->name('bed-assigns.index')->middleware('modules');
        Route::post('bed-assigns/{bed_assign}/active-deactive', 'BedAssignController@activeDeactiveStatus');
        Route::get('bed-status', 'BedAssignController@bedStatus')->name('bed-status');
        Route::get('ipd-patients-list', 'BedAssignController@getIpdPatientsList')->name('ipd.patient.list');

    });

    Route::group(['middleware' => ['role:Admin|Doctor|Nurse|Receptionist']], function () {
        Route::get('beds/{bed}', 'BedController@show')->where('bed', '[0-9]+');
    });

    Route::group(['middleware' => ['role:Admin|Doctor|Receptionist|Patient']], function () {
        Route::get('doctor-departments/{doctorDepartment}', 'DoctorDepartmentController@show')
            ->where('doctorDepartment', '[0-9]+');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Case Manager']], function () {
        Route::get('patient-cases', 'PatientCaseController@index')->name('patient-cases.index')->middleware('modules');
        Route::post('patient-cases', 'PatientCaseController@store')->name('patient-cases.store');
        Route::get('patient-cases/create', 'PatientCaseController@create')->name('patient-cases.create');
        Route::delete('patient-cases/{patient_case}', 'PatientCaseController@destroy')
            ->name('patient-cases.destroy');
        Route::patch('patient-cases/{patient_case}', 'PatientCaseController@update')
            ->name('patient-cases.update');
        Route::get('patient-cases/{patient_case}/edit', 'PatientCaseController@edit')
            ->name('patient-cases.edit');
        Route::post('patient-cases/{case_id}/active-deactive', 'PatientCaseController@activeDeActiveStatus');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist']], function () {
        Route::resource('charge-categories', 'ChargeCategoryController');
        Route::get('charge-categories',
            'ChargeCategoryController@index')->name('charge-categories.index')->middleware('modules');

        Route::resource('charges', 'ChargeController');
        Route::get('charges', 'ChargeController@index')->name('charges.index')->middleware('modules');
        Route::get('get-charge-categories', 'ChargeController@getChargeCategory');

        //Doctor OPD Charge Routes
        Route::get('doctor-opd-charges',
            'DoctorOPDChargeController@index')->name('doctor-opd-charges.index')->middleware('modules');
        Route::post('doctor-opd-charges', 'DoctorOPDChargeController@store')->name('doctor-opd-charges.store');
        Route::get('doctor-opd-charges/create', 'DoctorOPDChargeController@create')->name('doctor-opd-charges.create');
        Route::delete('doctor-opd-charges/{doctorOPDCharge}',
            'DoctorOPDChargeController@destroy')->name('doctor-opd-charges.destroy');
        Route::patch('doctor-opd-charges/{doctorOPDCharge}',
            'DoctorOPDChargeController@update')->name('doctor-opd-charges.update');
        Route::get('doctor-opd-charges/{doctorOPDCharge}/edit',
            'DoctorOPDChargeController@edit')->name('doctor-opd-charges.edit');

        Route::get('doctors', 'DoctorController@index')->name('doctors.index')->middleware('modules');
        Route::post('doctors', 'DoctorController@store')->name('doctors.store');
        Route::get('doctors/create', 'DoctorController@create')->name('doctors.create');
        Route::delete('doctors/{doctor}', 'DoctorController@destroy')
            ->name('doctors.destroy');
        Route::patch('doctors/{doctor}', 'DoctorController@update')
            ->name('doctors.update');
        Route::get('doctors/{doctor}/edit', 'DoctorController@edit')
            ->name('doctors.edit');
        Route::post('doctors/{doctor}/active-deactive', 'DoctorController@activeDeactiveStatus');
        Route::get('export-doctors', 'DoctorController@doctorExport')->name('doctors.excel');

        // Listing route for the Enquiry Form details
        Route::get('enquiries', 'EnquiryController@index')->name('enquiries')->middleware('modules');
        Route::post('enquiries/{id}/active-deactive', 'EnquiryController@activeDeactiveStatus');
        Route::get('enquiry/{enquiry}', 'EnquiryController@show')->name('enquiry.show');

        // Radiology Categories routes
        Route::get('radiology-categories',
            'RadiologyCategoryController@index')->name('radiology.category.index')->middleware('modules');
        Route::post('radiology-categories', 'RadiologyCategoryController@store')->name('radiology.category.store');
        Route::get('radiology-categories/{radiologyCategory}/edit',
            'RadiologyCategoryController@edit')->name('radiology.category.edit');
        Route::patch('radiology-categories/{radiologyCategory}',
            'RadiologyCategoryController@update')->name('radiology.category.update');
        Route::delete('radiology-categories/{radiologyCategory}',
            'RadiologyCategoryController@destroy')->name('radiology.category.destroy');

        // Pathology Categories routes
        Route::get('pathology-categories',
            'PathologyCategoryController@index')->name('pathology.category.index')->middleware('modules');
        Route::post('pathology-categories', 'PathologyCategoryController@store')->name('pathology.category.store');
        Route::get('pathology-categories/{pathologyCategory}/edit',
            'PathologyCategoryController@edit')->name('pathology.category.edit');
        Route::patch('pathology-categories/{pathologyCategory}',
            'PathologyCategoryController@update')->name('pathology.category.update');
        Route::delete('pathology-categories/{pathologyCategory}',
            'PathologyCategoryController@destroy')->name('pathology.category.destroy');

        Route::get('doctor-opd-charges',
            'DoctorOPDChargeController@index')->name('doctor-opd-charges.index')->middleware('modules');
        Route::post('doctor-opd-charges', 'DoctorOPDChargeController@store')->name('doctor-opd-charges.store');
        Route::get('doctor-opd-charges/create', 'DoctorOPDChargeController@create')->name('doctor-opd-charges.create');
        Route::delete('doctor-opd-charges/{doctorOPDCharge}',
            'DoctorOPDChargeController@destroy')->name('doctor-opd-charges.destroy');
        Route::patch('doctor-opd-charges/{doctorOPDCharge}',
            'DoctorOPDChargeController@update')->name('doctor-opd-charges.update');
        Route::get('doctor-opd-charges/{doctorOPDCharge}/edit',
            'DoctorOPDChargeController@edit')->name('doctor-opd-charges.edit');

        Route::get('patients', 'PatientController@index')->name('patients.index')->middleware('modules');
        Route::post('patients', 'PatientController@store')->name('patients.store');
        Route::get('patients/create', 'PatientController@create')->name('patients.create');
        Route::delete('patients/{patient}', 'PatientController@destroy')
            ->name('patients.destroy');
        Route::patch('patients/{patient}', 'PatientController@update')
            ->name('patients.update');
        Route::get('patients/{patient}/edit', 'PatientController@edit')
            ->name('patients.edit');
        Route::post('patients/{patient}/active-deactive', 'PatientController@activeDeactiveStatus');
        Route::get('export-patients', 'PatientController@patientExport')->name('patient.excel');

        Route::resource('case-handlers', 'CaseHandlerController')->parameters(['case-handlers' => 'caseHandler']);
        Route::get('case-handlers', 'CaseHandlerController@index')->name('case-handlers.index')->middleware('modules');
        Route::post('case-handlers/{case_id}/active-deactive', 'CaseHandlerController@activeDeactiveStatus');
        Route::get('export-case-handlers', 'CaseHandlerController@caseHandlerExport')->name('case.handler.excel');
    });

    Route::group(['middleware' => ['role:Admin|Doctor|Lab Technician|Pharmacist|Case Manager|Accountant']],
        function () {
            Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
                Route::get('doctor', 'DoctorController@index')->name('doctor');
                Route::get('doctor/{id}', 'DoctorController@show')->name('doctor.show');
            });
        });

    Route::group(['middleware' => ['role:Admin|Lab Technician|Pharmacist']], function () {
        Route::resource('medicines', 'MedicineController')->parameters(['medicines' => 'medicine']);
        Route::get('medicines', 'MedicineController@index')->name('medicines.index')->middleware('modules');
        Route::get('medicines-show-modal/{medicine}', 'MedicineController@showModal')->name('medicines.show.modal');

        Route::resource('categories', 'CategoryController')->parameters(['categories' => 'category']);
        Route::get('categories', 'CategoryController@index')->name('categories.index')->middleware('modules');
        Route::post('categories/{category_id}/active-deactive',
            'CategoryController@activeDeActiveCategory')->name('active.deactive');

        Route::get('brands', 'BrandController@index')->name('brands.index')->middleware('modules');
        Route::post('brands', 'BrandController@store')->name('brands.store');
        Route::get('brands/create', 'BrandController@create')->name('brands.create');
        Route::delete('brands/{brand}', 'BrandController@destroy')->name('brands.destroy');
        Route::patch('brands/{brand}', 'BrandController@update')->name('brands.update');
        Route::get('brands/{brand}/edit', 'BrandController@edit')->name('brands.edit');
        Route::get('brands/{brand}', 'BrandController@show')->name('brands.show');
    });
    Route::group(['middleware' => ['role:Admin|Doctor|Case Manager|Patient|Receptionist']], function () {
        Route::get('patient-admissions',
            'PatientAdmissionController@index')->name('patient-admissions.index')->middleware('modules');
        Route::get('insurances/{insurance}', 'InsuranceController@show')->where('insurance', '[0-9]+');
        Route::get('packages/{package}', 'PackageController@show')->where('package', '[0-9]+');
    });
    Route::group(['middleware' => ['role:Admin|Patient']], function () {
        Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
            Route::get('patient-admissions', 'PatientAdmissionController@index')->name('patient-admissions');
            Route::get('patient-admissions/{patient_admission}', 'PatientAdmissionController@show')
                ->name('patient-admissions.show')->where('patient_admission', '[0-9]+');
            Route::get('invoices', 'InvoiceController@index')->name('invoices');
            Route::get('invoices/{invoice}', 'InvoiceController@show')
                ->name('invoices.show')->where('invoice', '[0-9]+');
            Route::get('invoices/{invoice}/pdf', 'InvoiceController@convertToPdf')
                ->where('invoice', '[0-9]+');
            Route::get('bills', 'BillController@index')->name('bills.index')->middleware('modules');
            Route::get('bills/{bill}', 'BillController@show')
                ->name('bills.show')->where('bill', '[0-9]+');
            Route::get('bills/{bill}/pdf', 'BillController@convertToPdf')
                ->where('bill', '[0-9]+');
        });
    });
    Route::group(['middleware' => ['role:Admin|Doctor|Case Manager|Receptionist']], function () {
        Route::get('patient-admissions/{patient_admission}', 'PatientAdmissionController@show')
            ->name('patient-admissions.show')->where('patient_admission', '[0-9]+');
        Route::get('patient-admissions-show/{patient_admission}', 'PatientAdmissionController@showModal')
            ->name('patient-admissions.show.modal')->where('patient_admission', '[0-9]+');
        Route::post('patient-admissions', 'PatientAdmissionController@store')->name('patient-admissions.store');
        Route::get('patient-admissions/create', 'PatientAdmissionController@create')->name('patient-admissions.create');
        Route::delete('patient-admissions/{patient_admission}', 'PatientAdmissionController@destroy')
            ->name('patient-admissions.destroy');
        Route::patch('patient-admissions/{patient_admission}', 'PatientAdmissionController@update')
            ->name('patient-admissions.update');
        Route::get('patient-admissions/{patient_admission}/edit', 'PatientAdmissionController@edit')
            ->name('patient-admissions.edit');
        Route::post('patient-admissions/{id}/active-deactive', 'PatientAdmissionController@activeDeactiveStatus');
    });

    Route::group(['middleware' => ['role:Admin|Doctor']], function () {
        Route::resource('document-types', 'DocumentTypeController')->parameters(['document-types' => 'documentType']);
        Route::get('document-types',
            'DocumentTypeController@index')->name('document-types.index')->middleware('modules');

        Route::resource('schedules', 'ScheduleController')->parameters(['schedules' => 'schedule']);
        Route::get('schedules', 'ScheduleController@index')->name('schedules.index')->middleware('modules');

        Route::resource('death-reports', 'DeathReportController')->parameters(['death-reports' => 'deathReport']);
        Route::get('death-reports', 'DeathReportController@index')->name('death-reports.index')->middleware('modules');

        Route::resource('birth-reports', 'BirthReportController')->parameters(['birth-reports' => 'birthReport']);
        Route::get('birth-reports', 'BirthReportController@index')->name('birth-reports.index')->middleware('modules');

        Route::resource('operation-reports',
            'OperationReportController')->parameters(['operation-reports' => 'operationReport']);
        Route::get('operation-reports',
            'OperationReportController@index')->name('operation-reports.index')->middleware('modules');

        Route::resource('investigation-reports',
            'InvestigationReportController')->parameters(['investigation-reports' => 'investigationReport']);
        Route::get('investigation-reports',
            'InvestigationReportController@index')->name('investigation-reports.index')->middleware('modules');

        // Route for Prescription
        Route::resource('prescriptions', 'PrescriptionController');
        Route::get('prescriptions-show-modal/{id}', 'PrescriptionController@showModal')->name('prescriptions.show.modal');
        Route::get('prescriptions', 'PrescriptionController@index')->name('prescriptions.index')->middleware('modules');
        Route::post('prescriptions/{prescription}/active-deactive', 'PrescriptionController@activeDeactiveStatus');

        //Route for Vaccinations
        Route::resource('vaccinations', 'VaccinationController')->middleware('modules');

        //Route for Vaccinated Patients
        Route::get('vaccinations', 'VaccinationController@index')->name('vaccinations.index')->middleware('modules');
        Route::post('vaccinations', 'VaccinationController@store')->name('vaccinations.store');
        Route::get('vaccinations/create', 'VaccinationController@create')->name('vaccinations.create');
        Route::get('vaccinations/{vaccination}', 'VaccinationController@show')->name('vaccinations.show');
        Route::delete('vaccinations/{vaccination}', 'VaccinationController@destroy')->name('vaccinations.destroy');
        Route::post('vaccinations/{vaccination}/update', 'VaccinationController@update')->name('vaccinations.update');
        Route::get('vaccinations/{vaccination}/edit', 'VaccinationController@edit')->name('vaccinations.edit');

        //Route for Vaccinated Patients
        Route::get('vaccinated-patients',
            'VaccinatedPatientController@index')->name('vaccinated-patients.index')->middleware('modules');
        Route::post('vaccinated-patients', 'VaccinatedPatientController@store')->name('vaccinated-patients.store');
        Route::get('vaccinated-patients/create',
            'VaccinatedPatientController@create')->name('vaccinated-patients.create');
        Route::get('vaccinated-patients/{vaccinatedPatient}',
            'VaccinatedPatientController@show')->name('vaccinated-patients.show');
        Route::delete('vaccinated-patients/{vaccinatedPatient}',
            'VaccinatedPatientController@destroy')->name('vaccinated-patients.destroy');
        Route::post('vaccinated-patients/{vaccinatedPatient}/update',
            'VaccinatedPatientController@update')->name('vaccinated-patients.update');
        Route::get('vaccinated-patients/{vaccinatedPatient}/edit',
            'VaccinatedPatientController@edit')->name('vaccinated-patients.edit');
    });

    Route::group(['middleware' => ['role:Admin|Accountant|Doctor|Nurse|Receptionist|Lab Technician|Pharmacist|Case Manager']],
        function () {
            Route::get('employee-payrolls/{employeePayroll}',
                'EmployeePayrollController@show')->where('employeePayroll', '[0-9]+');
            Route::get('employee-payrolls-show/{employeePayroll}',
                'EmployeePayrollController@showModal')->where('employeePayroll', '[0-9]+')->name('employee-payrolls.show.modal');
        });

    Route::group(['middleware' => ['role:Admin|Accountant|Receptionist']], function () {

        //services routes
        Route::resource('services', 'ServiceController')->parameters(['services' => 'service']);
        Route::get('services', 'ServiceController@index')->name('services.index')->middleware('modules');
        Route::post('services/{service_id}/active-deactive', 'ServiceController@activeDeActiveService');
    });
    Route::group(['middleware' => ['role:Admin|Accountant']], function () {
        Route::resource('accounts', 'AccountController')->parameters(['accounts' => 'account']);
        Route::get('accounts', 'AccountController@index')->name('accounts.index')->middleware('modules');
        Route::post('accounts/{account}/active-deactive', 'AccountController@activeDeactiveAccount');

        Route::get('employee-payrolls',
            'EmployeePayrollController@index')->name('employee-payrolls.index')->middleware('modules');
        Route::post('employee-payrolls', 'EmployeePayrollController@store')->name('employee-payrolls.store');
        Route::get('employee-payrolls/create', 'EmployeePayrollController@create')->name('employee-payrolls.create');
        Route::delete('employee-payrolls/{employeePayroll}', 'EmployeePayrollController@destroy')
            ->name('employee-payrolls.destroy');
        Route::patch('employee-payrolls/{employeePayroll}', 'EmployeePayrollController@update')
            ->name('employee-payrolls.update');
        Route::get('employee-payrolls/{employeePayroll}/edit', 'EmployeePayrollController@edit')
            ->name('employee-payrolls.edit');

        Route::resource('invoices', 'InvoiceController')->parameters(['invoices' => 'invoice']);
        Route::get('invoices', 'InvoiceController@index')->name('invoices.index')->middleware('modules');
        Route::post('invoices/{invoice}', 'InvoiceController@update');
        Route::get('invoices/{invoice}/pdf', 'InvoiceController@convertToPdf')->name('invoices.pdf');

        Route::resource('payments', 'PaymentController');
        Route::get('payments-show-modal/{payment}', 'PaymentController@showModal')->name('payments.show.modal');
        Route::get('payments', 'PaymentController@index')->name('payments.index')->middleware('modules');
        Route::get('export-payments', 'PaymentController@paymentExport')->name('payments.excel');

        // Route for Payment Reports
        Route::get('payment-reports', 'PaymentReportController@index')->name('payment.reports')->middleware('modules');

        Route::resource('bills', 'BillController');
        Route::get('bills', 'BillController@index')->name('bills.index')->middleware('modules');
        Route::post('bills/{bill}', 'BillController@update');
        Route::get('bills/{bill}/pdf', 'BillController@convertToPdf')->name('bills.pdf');
        Route::get('patient-admission-details',
            'BillController@getPatientAdmissionDetails')->name('patient.admission.details');

        //Expense Rout
        Route::get('expenses', 'ExpenseController@index')->name('expenses.index')->middleware('modules');
        Route::post('expenses', 'ExpenseController@store')->name('expenses.store');
        Route::get('expenses/create', 'ExpenseController@create')->name('expenses.create');
        Route::get('expenses/{expense}', 'ExpenseController@show')->name('expenses.show');
        Route::delete('expenses/{expense}', 'ExpenseController@destroy')->name('expenses.destroy');
        Route::post('expenses/{expense}/update', 'ExpenseController@update')->name('expenses.update');
        Route::get('expenses/{expense}/edit', 'ExpenseController@edit')->name('expenses.edit');

        //incomes Rout
        Route::get('incomes', 'IncomeController@index')->name('incomes.index')->middleware('modules');
        Route::post('incomes', 'IncomeController@store')->name('incomes.store');
        Route::get('incomes/create', 'IncomeController@create')->name('incomes.create');
        Route::get('incomes/{income}', 'IncomeController@show')->name('incomes.show');
        Route::delete('incomes/{income}', 'IncomeController@destroy')->name('incomes.destroy');
        Route::post('incomes/{income}/update', 'IncomeController@update')->name('incomes.update');
        Route::get('incomes/{income}/edit', 'IncomeController@edit')->name('incomes.edit');
    });

    Route::group(['middleware' => ['role:Admin|Nurse']], function () {
        Route::get('beds', 'BedController@index')->name('beds.index')->middleware('modules');
        Route::post('beds', 'BedController@store')->name('beds.store');
        Route::get('beds/create', 'BedController@create')->name('beds.create');
        Route::delete('beds/{bed}', 'BedController@destroy')
            ->name('beds.destroy');
        Route::patch('beds/{bed}', 'BedController@update')
            ->name('beds.update');
        Route::get('beds/{bed}/edit', 'BedController@edit')
            ->name('beds.edit');
        Route::post('beds/{bed_id}/active-deactive', 'BedController@activeDeActiveStatus');
        Route::get('/bulk-beds', 'BedController@createBulkBeds')->name('create.bulk.beds');
        Route::post('/bulk-beds-store', 'BedController@storeBulkBeds')->name('store.bulk.beds');

        Route::resource('bed-types', 'BedTypeController')->parameters(['bed-types' => 'bedType']);
        Route::get('bed-types', 'BedTypeController@index')->name('bed-types.index')->middleware('modules');
    });

    Route::group(['middleware' => ['role:Admin|Nurse|Receptionist|Doctor|Case Manager']], function () {
        Route::get('patient-cases/{patient_case}', 'PatientCaseController@show')->where('patient_case', '[0-9]+');
        Route::get('patient-cases-show-modal/{patient_case}', 'PatientCaseController@showModal')->where('patient_case', '[0-9]+')->name('patient_case.show.modal');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Case Manager']], function () {
        Route::resource('notice-boards', 'NoticeBoardController')->parameters(['notice-boards' => 'noticeBoard']);
        Route::get('notice-boards', 'NoticeBoardController@index')->name('noticeboard')->middleware('modules');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Case Manager']], function () {
        Route::resource('ambulances', 'AmbulanceController')->parameters(['ambulances' => 'ambulance']);
        Route::get('ambulances', 'AmbulanceController@index')->name('ambulances.index')->middleware('modules');
        Route::post('ambulances/{ambulance_id}/active-deactive', 'AmbulanceController@isAvailableAmbulance');

        // Routes for Mail
        Route::get('mail', 'MailController@index')->name('mail')->middleware('modules');
        Route::post('send-mail', 'MailController@store')->name('mail.send');

        Route::resource('ambulance-calls', 'AmbulanceCallController');
        Route::get('ambulance-calls',
            'AmbulanceCallController@index')->name('ambulance-calls.index')->middleware('modules');
        Route::get('driver-name', 'AmbulanceCallController@getDriverName')->name('driver.name');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Case Manager|Doctor|Accountant|Pharmacist']], function () {
        //Sms Rout
        Route::get('sms', 'SmsController@index')->name('sms.index')->middleware('modules');
        Route::post('sms', 'SmsController@store')->name('sms.store');
        Route::get('sms/{sms}', 'SmsController@show')->name('sms.show');
        Route::get('sms-show-modal/{sms}', 'SmsController@showModal')->name('sms.show.modal');
        Route::delete('sms/{sms}', 'SmsController@destroy')->name('sms.destroy');
        Route::get('sms-users-lists', 'SmsController@getUsersList')->name('sms.users.lists');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist|Lab Technician|Pharmacist']], function () {
        // radiology test routes
        Route::get('radiology-tests',
            'RadiologyTestController@index')->name('radiology.test.index')->middleware('modules');
        Route::get('radiology-tests/create', 'RadiologyTestController@create')->name('radiology.test.create');
        Route::post('radiology-tests', 'RadiologyTestController@store')->name('radiology.test.store');
        Route::get('radiology-tests/{radiologyTest}', 'RadiologyTestController@show')->name('radiology.test.show');
        Route::get('radiology-tests-show-modal/{radiologyTest}', 'RadiologyTestController@showModal')->name('radiology.test.show.modal');
        Route::get('radiology-tests/{radiologyTest}/edit',
            'RadiologyTestController@edit')->name('radiology.test.edit');
        Route::patch('radiology-tests/{radiologyTest}',
            'RadiologyTestController@update')->name('radiology.test.update');
        Route::delete('radiology-tests/{radiologyTest}',
            'RadiologyTestController@destroy')->name('radiology.test.destroy');
        Route::get('radiology-tests/get-standard-charge/{id}',
            'RadiologyTestController@getStandardCharge')->name('radiology.test.standard.charge');

        // pathology test routes
        Route::get('pathology-tests',
            'PathologyTestController@index')->name('pathology.test.index')->middleware('modules');
        Route::get('pathology-tests/create', 'PathologyTestController@create')->name('pathology.test.create');
        Route::post('pathology-tests', 'PathologyTestController@store')->name('pathology.test.store');
        Route::get('pathology-tests/{pathologyTest}', 'PathologyTestController@show')->name('pathology.test.show');
        Route::get('pathology-tests-show-modal/{pathologyTest}', 'PathologyTestController@showModal')->name('pathology.test.show.modal');
        Route::get('pathology-tests/{pathologyTest}/edit',
            'PathologyTestController@edit')->name('pathology.test.edit');
        Route::patch('pathology-tests/{pathologyTest}',
            'PathologyTestController@update')->name('pathology.test.update');
        Route::delete('pathology-tests/{pathologyTest}',
            'PathologyTestController@destroy')->name('pathology.test.destroy');
        Route::get('pathology-tests/get-standard-charge/{id}',
            'PathologyTestController@getStandardCharge')->name('pathology.test.standard.charge');
    });

    Route::group(['middleware' => ['role:Admin|Receptionist']], function () {

        //insurance routes
        Route::get('insurances', 'InsuranceController@index')->name('insurances.index')->middleware('modules');
        Route::post('insurances', 'InsuranceController@store')->name('insurances.store');
        Route::get('insurances/create', 'InsuranceController@create')->name('insurances.create');
        Route::delete('insurances/{insurance}', 'InsuranceController@destroy')
            ->name('insurances.destroy');
        Route::get('insurances/{insurance}/edit', 'InsuranceController@edit')
            ->name('insurances.edit');
        Route::post('insurances/{insurance}', 'InsuranceController@update')->name('insurances.update');
        Route::post('insurances/{insurance_id}/active-deactive', 'InsuranceController@activeDeActiveInsurance');

        //packages routes
        Route::get('packages', 'PackageController@index')->name('packages.index')->middleware('modules');
        Route::post('packages', 'PackageController@store')->name('packages.store');
        Route::get('packages/create', 'PackageController@create')->name('packages.create');
        Route::delete('packages/{package}', 'PackageController@destroy')
            ->name('packages.destroy');
        Route::get('packages/{package}/edit', 'PackageController@edit')
            ->name('packages.edit');
        Route::post('packages/{package}', 'PackageController@update')->name('packages.update');
    });

    Route::group(['middleware' => ['role:Admin|Lab Technician']], function () {

        //blood-bank routes
        Route::resource('blood-banks', 'BloodBankController')->parameters(['blood-banks' => 'bloodBank']);
        Route::get('blood-banks', 'BloodBankController@index')->name('blood-banks.index')->middleware('modules');

        //blood-donor routes
        Route::resource('blood-donors', 'BloodDonorController')->parameters(['blood-donors' => 'bloodDonor']);
        Route::get('blood-donors', 'BloodDonorController@index')->name('blood-donors.index')->middleware('modules');

        //blood Donations route
        Route::get('blood-donations',
            'BloodDonationController@index')->name('blood-donations.index')->middleware('modules');
        Route::post('blood-donations', 'BloodDonationController@store')->name('blood-donations.store');
        Route::get('blood-donations/{bloodDonation}/edit',
            'BloodDonationController@edit')->name('blood-donations.edit');
        Route::post('blood-donations/{bloodDonation}',
            'BloodDonationController@update')->name('blood-donations.update');
        Route::delete('blood-donations/{bloodDonation}',
            'BloodDonationController@destroy')->name('blood-donations.destroy');

        //blood-issue routes
        Route::get('blood-issues', 'BloodIssueController@index')->name('blood-issues.index')->middleware('modules');
        Route::post('blood-issues', 'BloodIssueController@store')->name('blood-issues.store');
        Route::get('blood-issues/{bloodIssue}/edit', 'BloodIssueController@edit')->name('blood-issues.edit');
        Route::post('blood-issues/{bloodIssue}', 'BloodIssueController@update')->name('blood-issues.update');
        Route::delete('blood-issues/{bloodIssue}', 'BloodIssueController@destroy')->name('blood-issues.destroy');
        Route::get('blood-group-list', 'BloodIssueController@getBloodGroup')->name('blood-issues.list');
    });

    Route::group(['middleware' => ['role:Admin|Accountant']], function () {
        Route::get('employees-list', 'EmployeePayrollController@getEmployeesList')->name('employees.list');
    });

    Route::group(['middleware' => ['role:Admin']], function () {
//        Route::resource('departments', 'DepartmentController');
//        Route::post('departments/{department}/active-deactive', 'DepartmentController@activeDeactiveDepartment');

        Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::get('users', 'UserController@index')->name('users.index');
        Route::get('users-details/{user?}', 'UserController@show')->name('users.show');
        Route::get('users-details-modal/{user?}', 'UserController@showModal')->name('users.show.modal');
        Route::get('users/create', 'UserController@create')->name('users.create');
        Route::post('users', 'UserController@store')->name('users.store');
        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::patch('users/{user}', 'UserController@update')->name('users.update');
        Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
        Route::post('users/{user}/active-deactive', 'UserController@activeDeactiveStatus')->name('users.status');
        Route::post('users/{user}/is-verified', 'UserController@isVerified')->name('users.verified');

        Route::get('income-expense-report', 'HomeController@incomeExpenseReport')->name('income-expense-report');

        Route::resource('accountants', 'AccountantController');
        Route::get('accountants', 'AccountantController@index')->name('accountants.index')->middleware('modules');
        Route::post('accountants/{accountant}/active-deactive', 'AccountantController@activeDeactiveStatus');

        Route::get('settings', 'SettingController@edit')->name('settings.edit');
        Route::post('settings', 'SettingController@update')->name('settings.update');
        Route::get('modules', 'SettingController@getModule')->name('module.index');
        Route::post('modules/{module}/active-deactive', 'SettingController@activeDeactiveStatus')
            ->name('module.activeDeactiveStatus');

        Route::get('front-settings', 'FrontSettingController@index')->name('front.settings.index');
        Route::post('front-settings', 'FrontSettingController@update')->name('front.settings.update');

        Route::get('doctor-departments',
            'DoctorDepartmentController@index')->name('doctor-departments.index')->middleware('modules');
        Route::post('doctor-departments', 'DoctorDepartmentController@store')->name('doctor-departments.store');
        Route::get('doctor-departments/create', 'DoctorDepartmentController@create')->name('doctor-departments.create');
        Route::delete('doctor-departments/{doctorDepartment}', 'DoctorDepartmentController@destroy')
            ->name('doctor-departments.destroy');
        Route::patch('doctor-departments/{doctorDepartment}', 'DoctorDepartmentController@update')
            ->name('doctor-departments.update');
        Route::get('doctor-departments/{doctorDepartment}/edit', 'DoctorDepartmentController@edit')
            ->name('doctor-departments.edit');

        Route::resource('pharmacists', 'PharmacistController');
        Route::get('pharmacists', 'PharmacistController@index')->name('pharmacists.index')->middleware('modules');
        Route::post('pharmacists/{pharmacist}/active-deactive', 'PharmacistController@activeDeactiveStatus');
        Route::get('export-pharmacists', 'PharmacistController@pharmacistExport')->name('pharmacists.excel');

        Route::resource('nurses', 'NurseController');
        Route::get('nurses', 'NurseController@index')->name('nurses.index')->middleware('modules');
        Route::post('nurses/{nurse}/active-deactive', 'NurseController@activeDeactiveStatus');
        Route::get('export-nurses', 'NurseController@nurseExport')->name('nurses.excel');

        Route::resource('lab-technicians', 'LabTechnicianController');
        Route::get('lab-technicians',
            'LabTechnicianController@index')->name('lab-technicians.index')->middleware('modules');
        Route::post('lab-technicians/{labTechnician}/active-deactive', 'LabTechnicianController@activeDeactiveStatus');
        Route::get('export-lab-technicians',
            'LabTechnicianController@labTechnicianExport')->name('lab.technicians.excel');

        Route::resource('receptionists', 'ReceptionistController');
        Route::get('receptionists', 'ReceptionistController@index')->name('receptionists.index')->middleware('modules');
        Route::post('receptionists/{receptionist}/active-deactive', 'ReceptionistController@activeDeactiveStatus');
        Route::get('export-receptionists', 'ReceptionistController@receptionistExport')->name('receptionists.excel');

        Route::get('export-ambulances', 'AmbulanceController@ambulanceExport')->name('ambulance.excel');
        Route::get('export-incomes', 'IncomeController@incomeExport')->name('incomes.excel');
        Route::get('export-expenses', 'ExpenseController@expenseExport')->name('expenses.excel');
        Route::get('export-payment-reports',
            'PaymentReportController@paymentReportExport')->name('payment.report.excel');

        Route::resource(
            'advanced-payments',
            'AdvancedPaymentController'
        )->parameters(['advanced-payments' => 'advancedPayment']);
        Route::get(
            'advanced-payments',
            'AdvancedPaymentController@index'
        )->name('advanced-payments.index')->middleware('modules');

        // Inventory Management routes.
        Route::resource('item-categories', 'ItemCategoryController')->parameters(['item-categories' => 'itemCategory']);
        Route::get('item-categories',
            'ItemCategoryController@index')->name('item-categories.index')->middleware('modules');
        Route::get('items-list', 'ItemCategoryController@getItemsList')->name('items.list');

        Route::get('items', 'ItemController@index')->name('items.index')->middleware('modules');
        Route::post('items', 'ItemController@store')->name('items.store');
        Route::get('items/create', 'ItemController@create')->name('items.create');
        Route::delete('items/{item}', 'ItemController@destroy')->name('items.destroy');
        Route::patch('items/{item}', 'ItemController@update')->name('items.update');
        Route::get('items/{item}/edit', 'ItemController@edit')->name('items.edit');
        Route::get('items/{item}', 'ItemController@show')->name('items.show');
        Route::get('item-available-qty', 'ItemController@getAvailableQuantity')->name('item.available.qty');

        Route::get('item-stocks', 'ItemStockController@index')->name('item.stock.index')->middleware('modules');
        Route::post('item-stocks', 'ItemStockController@store')->name('item.stock.store');
        Route::get('item-stocks/create', 'ItemStockController@create')->name('item.stock.create');
        Route::delete('item-stocks/{itemStock}', 'ItemStockController@destroy')->name('item.stock.destroy');
        Route::patch('item-stocks/{itemStock}', 'ItemStockController@update')->name('item.stock.update');
        Route::get('item-stocks/{itemStock}/edit', 'ItemStockController@edit')->name('item.stock.edit');
        Route::get('item-stocks/{itemStock}', 'ItemStockController@show')->name('item.stock.show');
        Route::get('item-stocks-download/{itemStock}',
            'ItemStockController@downloadMedia')->name('item.stock.download');

        Route::get('issued-items', 'IssuedItemController@index')->name('issued.item.index')->middleware('modules');
        Route::post('issued-items', 'IssuedItemController@store')->name('issued.item.store');
        Route::get('issued-items/create', 'IssuedItemController@create')->name('issued.item.create');
        Route::delete('issued-items/{issuedItem}', 'IssuedItemController@destroy')->name('issued.item.destroy');
        Route::get('issued-items/{issuedItem}', 'IssuedItemController@show')->name('issued.item.show');
        Route::get('users-list', 'DepartmentController@getUsersList')->name('users.list');
        Route::get('return-issued-item', 'IssuedItemController@returnIssuedItem')->name('return.issued.item');
    });

    Route::group(['middleware' => ['role:Admin|Patient']], function () {
        Route::group(['prefix' => 'employee', 'namespace' => 'Employee'], function () {
            Route::get('patient-diagnosis-test',
                'PatientDiagnosisTestController@index')->name('patient-diagnosis-test');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
                'PatientDiagnosisTestController@show')->name('patient-diagnosis-test.show');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
                'PatientDiagnosisTestController@convertToPdf')->name('patient.diagnosis.test.pdf');
        });
    });

    Route::group(['middleware' => ['role:Admin|Doctor|Receptionist|Lab Technician']], function () {
        //Patient Diagnosis Test
        Route::get('patient-diagnosis-test',
            'PatientDiagnosisTestController@index')->name('patient.diagnosis.test.index')->middleware('modules');
        Route::post('patient-diagnosis-test',
            'PatientDiagnosisTestController@store')->name('patient.diagnosis.test.store');
        Route::get('patient-diagnosis-test/create',
            'PatientDiagnosisTestController@create')->name('patient.diagnosis.test.create');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
            'PatientDiagnosisTestController@show')->name('patient.diagnosis.test.show');
        Route::delete('patient-diagnosis-test/{patientDiagnosisTest}',
            'PatientDiagnosisTestController@destroy')->name('patient.diagnosis.test.destroy');
        Route::post('patient-diagnosis-test/{patientDiagnosisTest}/update',
            'PatientDiagnosisTestController@update')->name('patient.diagnosis.test.update');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/edit',
            'PatientDiagnosisTestController@edit')->name('patient.diagnosis.test.edit');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
            'PatientDiagnosisTestController@convertToPdf')->name('patient.diagnosis.test.pdf');

        //Diagnosis test Category
        Route::get('diagnosis-categories',
            'DiagnosisCategoryController@index')->name('diagnosis.category.index')->middleware('modules');
        Route::post('diagnosis-categories',
            'DiagnosisCategoryController@store')->name('diagnosis.category.store');
        Route::get('diagnosis-categories/{diagnosisCategory}',
            'DiagnosisCategoryController@show')->name('diagnosis.category.show');
        Route::delete('diagnosis-categories/{diagnosisCategory}',
            'DiagnosisCategoryController@destroy')->name('diagnosis.category.destroy');
        Route::patch('diagnosis-categories/{diagnosisCategory}',
            'DiagnosisCategoryController@update')->name('diagnosis.category.update');
        Route::get('diagnosis-categories/{diagnosisCategory}/edit',
            'DiagnosisCategoryController@edit')->name('diagnosis.category.edit');
    });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist|Accountant|Case Manager|Nurse']],
        function () {
            Route::get('document-download/{document}', 'DocumentController@downloadMedia');
        });

    Route::group(['middleware' => ['role:Admin|Accountant']], function () {
        Route::get('expense-download/{expense}', 'ExpenseController@downloadMedia');
        Route::get('income-download/{income}', 'IncomeController@downloadMedia');
        Route::get('export-incomes', 'IncomeController@incomeExport')->name('incomes.excel');
        Route::get('export-expenses', 'ExpenseController@expenseExport')->name('expenses.excel');
    });

    Route::group(['middleware' => ['role:Admin|Doctor']], function () {
        Route::get('investigation-download/{investigationReport}', 'InvestigationReportController@downloadMedia');
    });

    Route::group(['middleware' => ['role:Admin|Doctor|Receptionist']],
        function () {
            // IPD Patient routes
            Route::get('ipds',
                'IpdPatientDepartmentController@index')->name('ipd.patient.index')->middleware('modules');
            Route::get('ipds/create', 'IpdPatientDepartmentController@create')->name('ipd.patient.create');
            Route::post('ipds', 'IpdPatientDepartmentController@store')->name('ipd.patient.store');
            Route::get('ipds/{ipdPatientDepartment}',
                'IpdPatientDepartmentController@show')->name('ipd.patient.show');
            Route::get('ipds/{ipdPatientDepartment}/edit',
                'IpdPatientDepartmentController@edit')->name('ipd.patient.edit');
            Route::patch('ipds/{ipdPatientDepartment}',
                'IpdPatientDepartmentController@update')->name('ipd.patient.update');
            Route::delete('ipds/{ipdPatientDepartment}',
                'IpdPatientDepartmentController@destroy')->name('ipd.patient.destroy');
            Route::get('patient-cases-list',
                'IpdPatientDepartmentController@getPatientCasesList')->name('patient.cases.list');
            Route::get('patient-beds-list',
                'IpdPatientDepartmentController@getPatientBedsList')->name('patient.beds.list');

            // IPD Diagnosis routes
            Route::post('ipd-diagnosis', 'IpdDiagnosisController@store')->name('ipd.diagnosis.store');
            Route::get('ipd-diagnosis/{ipdDiagnosis}/edit', 'IpdDiagnosisController@edit')->name('ipd.diagnosis.edit');
            Route::post('ipd-diagnosis/{ipdDiagnosis}', 'IpdDiagnosisController@update')->name('ipd.diagnosis.update');
            Route::delete('ipd-diagnosis/{ipdDiagnosis}',
                'IpdDiagnosisController@destroy')->name('ipd.diagnosis.destroy');

            // IPD Consultant Register routes.
            Route::post('ipd-consultant-register',
                'IpdConsultantRegisterController@store')->name('ipd.consultant.store');
            Route::get('ipd-consultant-register/{ipdConsultantRegister}/edit',
                'IpdConsultantRegisterController@edit')->name('ipd.consultant.edit');
            Route::post('ipd-consultant-register/{ipdConsultantRegister}',
                'IpdConsultantRegisterController@update')->name('ipd.consultant.update');
            Route::delete('ipd-consultant-register/{ipdConsultantRegister}',
                'IpdConsultantRegisterController@destroy')->name('ipd.consultant.destroy');

            // IPD Charges routes.
            Route::post('ipd-charges', 'IpdChargeController@store')->name('ipd.charge.store');
            Route::get('ipd-charges/{ipdCharge}/edit', 'IpdChargeController@edit')->name('ipd.charge.edit');
            Route::post('ipd-charges/{ipdCharge}', 'IpdChargeController@update')->name('ipd.charge.update');
            Route::delete('ipd-charges/{ipdCharge}', 'IpdChargeController@destroy')->name('ipd.charge.destroy');
            Route::get('charge-category-list',
                'IpdChargeController@getChargeCategoryList')->name('charge.category.list');
            Route::get('charge', 'IpdChargeController@getChargeList')->name('charge.list');
            Route::get('charge-standard-rate',
                'IpdChargeController@getChargeStandardRate')->name('charge.standard.rate');

            // IPD Prescription routes
            Route::post('ipd-prescription', 'IpdPrescriptionController@store')->name('ipd.prescription.store');
            Route::get('ipd-prescription/{ipdPrescription}/edit',
                'IpdPrescriptionController@edit')->name('ipd.prescription.edit');
            Route::post('ipd-prescription/{ipdPrescription}',
                'IpdPrescriptionController@update')->name('ipd.prescription.update');
            Route::delete('ipd-prescription/{ipdPrescription}',
                'IpdPrescriptionController@destroy')->name('ipd.prescription.destroy');
            Route::get('medicine-list', 'IpdPrescriptionController@getMedicineList')->name('medicine.list');

            // IPD Timelines routes
            Route::post('ipd-timelines', 'IpdTimelineController@store')->name('ipd.timelines.store');
            Route::get('ipd-timelines/{ipdTimeline}/edit', 'IpdTimelineController@edit')->name('ipd.timelines.edit');
            Route::post('ipd-timelines/{ipdTimeline}', 'IpdTimelineController@update')->name('ipd.timelines.update');
            Route::delete('ipd-timelines/{ipdTimeline}',
                'IpdTimelineController@destroy')->name('ipd.timelines.destroy');

            // IPD Payment routes
            Route::post('ipd-payments', 'IpdPaymentController@store')->name('ipd.payments.store');
            Route::get('ipd-payments/{ipdPayment}/edit', 'IpdPaymentController@edit')->name('ipd.payments.edit');
            Route::post('ipd-payments/{ipdPayment}', 'IpdPaymentController@update')->name('ipd.payments.update');
            Route::delete('ipd-payments/{ipdPayment}',
                'IpdPaymentController@destroy')->name('ipd.payments.destroy');

            // IPD Bill
            Route::post('ipd-bills', 'IpdBillController@store')->name('ipd.bills.store');

            // OPD Patient routes
            Route::get('opds',
                'OpdPatientDepartmentController@index')->name('opd.patient.index')->middleware('modules');
            Route::get('opds/create', 'OpdPatientDepartmentController@create')->name('opd.patient.create');
            Route::post('opds', 'OpdPatientDepartmentController@store')->name('opd.patient.store');
            Route::get('opds/{opdPatientDepartment}',
                'OpdPatientDepartmentController@show')->name('opd.patient.show');
            Route::get('opds/{opdPatientDepartment}/edit',
                'OpdPatientDepartmentController@edit')->name('opd.patient.edit');
            Route::patch('opds/{opdPatientDepartment}',
                'OpdPatientDepartmentController@update')->name('opd.patient.update');
            Route::delete('opds/{opdPatientDepartment}',
                'OpdPatientDepartmentController@destroy')->name('opd.patient.destroy');
            Route::get('get-doctor-opd-charge',
                'OpdPatientDepartmentController@getDoctorOPDCharge')->name('getDoctor.OPDcharge');

            // OPD Diagnosis routes
            Route::post('opd-diagnosis', 'OpdDiagnosisController@store')->name('opd.diagnosis.store');
            Route::get('opd-diagnosis/{opdDiagnosis}/edit', 'OpdDiagnosisController@edit')->name('opd.diagnosis.edit');
            Route::post('opd-diagnosis/{opdDiagnosis}', 'OpdDiagnosisController@update')->name('opd.diagnosis.update');
            Route::delete('opd-diagnosis/{opdDiagnosis}',
                'OpdDiagnosisController@destroy')->name('opd.diagnosis.destroy');

            // OPD Timelines routes
            Route::post('opd-timelines', 'OpdTimelineController@store')->name('opd.timelines.store');
            Route::get('opd-timelines/{opdTimeline}/edit', 'OpdTimelineController@edit')->name('opd.timelines.edit');
            Route::post('opd-timelines/{opdTimeline}', 'OpdTimelineController@update')->name('opd.timelines.update');
            Route::delete('opd-timelines/{opdTimeline}',
                'OpdTimelineController@destroy')->name('opd.timelines.destroy');
        });
    Route::group(['middleware' => ['role:Admin|Receptionist']], function () {
        //Call-log routes
        Route::get('call-logs', 'CallLogController@index')->name('call_logs.index')->middleware('modules');
        Route::get('call-logs/create', 'CallLogController@create')->name('call_logs.create');
        Route::post('call-logs', 'CallLogController@store')->name('call_logs.store');
        Route::get('call-logs/{call_log}/edit', 'CallLogController@edit')->name('call_logs.edit');
        Route::patch('call-logs/{call_log}', 'CallLogController@update')->name('call_logs.update');
        Route::delete('call-logs/{call_log}', 'CallLogController@destroy')->name('call_logs.destroy');
        Route::get('export-call-logs', 'CallLogController@export')->name('call_logs.excel');

        //ambulance export
        Route::get('export-ambulances', 'AmbulanceController@ambulanceExport')->name('ambulance.excel');

        //Visitors routes
        Route::get('visitors', 'VisitorController@index')->name('visitors.index')->middleware('modules');
        Route::get('visitors/create', 'VisitorController@create')->name('visitors.create');
        Route::post('visitors', 'VisitorController@store')->name('visitors.store');
        Route::get('visitors/{visitor}/edit', 'VisitorController@edit')->name('visitors.edit');
        Route::patch('visitors/{visitor}', 'VisitorController@update')->name('visitors.update');
        Route::delete('visitors/{visitor}', 'VisitorController@destroy')->name('visitors.destroy');
        Route::get('visitors-download/{visitor}', 'VisitorController@downloadMedia');
        Route::get('export-visitor', 'VisitorController@export')->name('visitors.excel');

        //Postal receive routes
        Route::get('receives', 'PostalController@index')->name('receives.index')->middleware('modules');
        Route::post('receives', 'PostalController@store')->name('receives.store');
        Route::get('receives/{postal}/edit', 'PostalController@edit')->name('receives.edit');
        Route::post('receives/{postal}', 'PostalController@update')->name('receives.update');
        Route::delete('receives/{postal}', 'PostalController@destroy')->name('receives.destroy');
        Route::get('receives/{postal}', 'PostalController@downloadMedia')->name('receives.download');
        Route::get('receives-download/{postal}', 'PostalController@downloadMedia');
        Route::get('export-receive', 'PostalController@export')->name('receives.excel');

        //Postal dispatch routes
        Route::get('dispatches', 'PostalController@index')->name('dispatches.index')->middleware('modules');
        Route::post('dispatches', 'PostalController@store')->name('dispatches.store');
        Route::get('dispatches/{postal}/edit', 'PostalController@edit')->name('dispatches.edit');
        Route::post('dispatches/{postal}', 'PostalController@update')->name('dispatches.update');
        Route::delete('dispatches/{postal}', 'PostalController@destroy')->name('dispatches.destroy');
        Route::get('dispatches/{postal}', 'PostalController@downloadMedia')->name('dispatches.download');
        Route::get('dispatches-download/{postal}', 'PostalController@downloadMedia')->name('dispatches.download');
        Route::get('export-dispatch', 'PostalController@export')->name('dispatches.excel');

        //Testimonial routes
        Route::get('testimonials', 'TestimonialController@index')->name('testimonials.index')->middleware('modules');
        Route::post('testimonials', 'TestimonialController@store')->name('testimonials.store');
        Route::get('testimonials/{testimonial}/edit', 'TestimonialController@edit')->name('testimonials.edit');
        Route::post('testimonials/{testimonial}', 'TestimonialController@update')->name('testimonials.update');
        Route::delete('testimonials/{testimonial}', 'TestimonialController@destroy')->name('testimonials.destroy');
    });
    Route::group(['middleware' => ['role:Admin|Patient|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager']],
        function () {

            //Notification routes
            Route::get('/notification/{notification}/read',
                'NotificationController@readNotification')->name('read.notification');
            Route::post('/read-all-notification',
                'NotificationController@readAllNotification')->name('read.all.notification');
            // Live Meeting
            Route::get('live-meeting',
                'LiveMeetingController@index')->name('live.meeting.index')->middleware('modules');
            Route::post('live-meeting', 'LiveMeetingController@liveMeetingStore')->name('live.meeting.store');
            Route::get('live-meeting/change-status',
                'LiveMeetingController@getChangeStatus')->name('live.meeting.change.status');
            Route::get('live-meeting/{liveMeeting}/start',
                'LiveMeetingController@getLiveStatus')->name('live.meeting.get.live.status');
            Route::get('live-meeting/{liveMeeting}', 'LiveMeetingController@show')->name('live.meeting.show');

            Route::get('live-meeting/{liveMeeting}/edit',
                'LiveMeetingController@edit')->name('live.meeting.edit');
            Route::post('live-meeting/{liveMeeting}',
                'LiveMeetingController@update')->name('live.meeting.update');
            Route::delete('live-meeting/{liveMeeting}',
                'LiveMeetingController@destroy')->name('live.meeting.destroy');
        });

    Route::group(['middleware' => ['role:Admin|Patient|Doctor']],
        function () {
            //  Live Consultation
            Route::get('live-consultation',
                'LiveConsultationController@index')->name('live.consultation.index')->middleware('modules');
            Route::post('live-consultation', 'LiveConsultationController@store')->name('live.consultation.store');
            Route::get('live-consultation/{liveConsultation}/edit',
                'LiveConsultationController@edit')->name('live.consultation.edit');
            Route::post('live-consultation/{liveConsultation}',
                'LiveConsultationController@update')->name('live.consultation.update');
            Route::delete('live-consultation/{liveConsultation}',
                'LiveConsultationController@destroy')->name('live.consultation.destroy');
            Route::get('live-consultation-list',
                'LiveConsultationController@getTypeNumber')->name('live.consultation.list');
            Route::get('live-consultation/change-status',
                'LiveConsultationController@getChangeStatus')->name('live.consultation.change.status');
            Route::get('live-consultation/{liveConsultation}/start',
                'LiveConsultationController@getLiveStatus')->name('live.consultation.get.live.status');
            Route::get('live-consultation/{liveConsultation}',
                'LiveConsultationController@show')->name('live.consultation.show');
            Route::get('user-zoom-credential/{userZoomCredential}/fetch',
                'LiveConsultationController@zoomCredential')->name('zoom.credential');
            Route::post('user-zoom-credential',
                'LiveConsultationController@zoomCredentialCreate')->name('zoom.credential.create');
        });
});

// upgrade to v7.0.0
Route::get('/upgrade-to-v7-0-0', function () {
    Artisan::call('db:seed', ['--class' => 'FrontSettingTableSeeder']);
});

// new appointment migration
Route::get('/upgrade-to-v8-0-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_06_07_104022_change_patient_foreign_key_type_in_appointments_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_06_08_073918_change_department_foreign_key_in_appointments_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_06_21_082754_update_amount_datatype_in_bills_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_06_21_082845_update_amount_datatype_in_bill_items_table.php',
        ]);
});

Route::get('/upgrade-to-v8-1-0', function () {
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_05_10_000000_add_uuid_to_failed_jobs_table.php',
        ]);
    Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_05_29_103036_add_conversions_disk_column_in_media_table.php',
        ]);
});

Route::get('hms-logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('qr-scan', function () {
    return view('qr');
});
