<?php

namespace Database\Seeders;

use Database\Seeders\AccountantTableSeeder;
use Database\Seeders\AccountTableSeeder;
use Database\Seeders\AddLabTechnicianPermissionSeeder;
use Database\Seeders\AddVaccinationModuleTableSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\AdvancedPaymentTableSeeder;
use Database\Seeders\AssignDefaultRoleToUserSeeder;
use Database\Seeders\BedAssignTableSeeder;
use Database\Seeders\BedTableSeeder;
use Database\Seeders\BedTypeTableSeeder;
use Database\Seeders\BloodBankSeeder;
use Database\Seeders\BloodDonorTableSeeder;
use Database\Seeders\CaseHandlerTableSeeder;
use Database\Seeders\CaseTableSeeder;
use Database\Seeders\ChargeCategoryTableSeeder;
use Database\Seeders\ChargeTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsSeeder::class);
        $this->call(AdminUserSeeder::class);
//        $this->call(BloodBankSeeder::class);
//        $this->call(DocumentTypesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(AssignDefaultRoleToUserSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(SuperAdminSettingsTableSeeder::class);
//        $this->call(MedicineCategoryTableSeeder::class);
//        $this->call(MedicineBrandTableSeeder::class);
//        $this->call(MedicineTableSeeder::class);
//        $this->call(AccountTableSeeder::class);
//        $this->call(AccountantTableSeeder::class);
//        $this->call(DoctorDepartmentTableSeeder::class);
//        $this->call(DoctorTableSeeder::class);
//        $this->call(NurseTableSeeder::class);
//        $this->call(PatientTableSeeder::class);
//        $this->call(ReceptionistTableSeeder::class);
//        $this->call(PharmacistTableSeeder::class);
//        $this->call(LabTechnicianTableSeeder::class);
//        $this->call(CaseHandlerTableSeeder::class);
//        $this->call(EmployeePayrollTableSeeder::class);
//        $this->call(InvoiceTableSeeder::class);
//        $this->call(InsuranceTableSeeder::class);
//        $this->call(PaymentTableSeeder::class);
//        $this->call(AdvancedPaymentTableSeeder::class);
//        $this->call(BedTypeTableSeeder::class);
//        $this->call(BedTableSeeder::class);
//        $this->call(CaseTableSeeder::class);
//        $this->call(BedAssignTableSeeder::class);
//        $this->call(BloodDonorTableSeeder::class);
//        $this->call(ServiceTableSeeder::class);
//        $this->call(PackageTableSeeder::class);
//        $this->call(PatientAdmissionTableSeeder::class);
//        $this->call(ChargeCategoryTableSeeder::class);
//        $this->call(ChargeTableSeeder::class);
//        $this->call(RadiologyCategoryTableSeeder::class);
//        $this->call(PathologyCategoryTableSeeder::class);
//        $this->call(RadiologyTestTableSeeder::class);
//        $this->call(PathologyTestTableSeeder::class);
        $this->call(AddLabTechnicianPermissionSeeder::class);
//        $this->call(DiagnosisCategorySeeder::class);
//        $this->call(IncomeTableSeeder::class);
//        $this->call(ExpenseTableSeeder::class);
        $this->call(DefaultModuleSeeder::class);
        $this->call(AddVaccinationModuleTableSeeder::class);
        $this->call(FrontSettingTableSeeder::class);
        $this->call(FrontSettingHomeTableSeeder::class);
        $this->call(FrontServiceSeeder::class);
        $this->call(AddDoctorFrontSettingTableSeeder::class);
        $this->call(AddSocialSettingTableSeeder::class);
        $this->call(AddHomePageBoxContentSeeder::class);
        $this->call(AddAppointmentFrontSettingTableSeeder::class);
        $this->call(LandingSectionOneTableSeeder::class);
        $this->call(LandingSectionTwoTableSeeder::class);
        $this->call(LandingSectionThreeTableSeeder::class);
        $this->call(LandingSectionFourTableSeeder::class);
        $this->call(LandingSectionFiveTableSeeder::class);
        $this->call(SuperAdminFooterSettingsSeeder::class);
        $this->call(LandingAboutUsTableSeeder::class);
        $this->call(SuperAdminServiceSliderTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(AdminTestimonialSeeder::class);
        $this->call(AddDaysIntoSuperAdminTableSeeder::class);
        $this->call(SubscriptionPlanFeaturesTableSeeder::class);
        $this->call(DefaultSubscriptionPlanTableSeeder::class);
        $this->call(GoogleRecaptchaSettingSeeder::class);
        $this->call(AddFieldSubscriptionPlanFeaturesTableSeeder::class);
    }
}
