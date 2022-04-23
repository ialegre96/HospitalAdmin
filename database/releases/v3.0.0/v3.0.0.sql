create table `ipd_patient_departments` (`id` int unsigned not null auto_increment primary key, `patient_id` int unsigned not null, `ipd_number` varchar(191) not null, `height` varchar(191) null, `weight` varchar(191) null, `bp` varchar(191) null, `symptoms` text null, `notes` text null, `admission_date` datetime not null, `case_id` int unsigned not null, `is_old_patient` tinyint(1) null default '0', `doctor_id` bigint unsigned null, `bed_type_id` int unsigned null, `bed_id` int unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


alter table `ipd_patient_departments` add constraint `ipd_patient_departments_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;

alter table `ipd_patient_departments` add constraint `ipd_patient_departments_case_id_foreign` foreign key (`case_id`) references `patient_cases` (`id`) on delete cascade on update cascade;


alter table `ipd_patient_departments` add constraint `ipd_patient_departments_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

alter table `ipd_patient_departments` add constraint `ipd_patient_departments_bed_type_id_foreign` foreign key (`bed_type_id`) references `bed_types` (`id`) on delete cascade on update cascade;


alter table `ipd_patient_departments` add constraint `ipd_patient_departments_bed_id_foreign` foreign key (`bed_id`) references `beds` (`id`) on delete cascade on update cascade;

alter table `ipd_patient_departments` add unique `ipd_patient_departments_ipd_number_unique`(`ipd_number`);

create table `ipd_diagnoses` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `report_type` varchar(191) not null, `report_date` datetime not null, `description` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `ipd_diagnoses` add constraint `ipd_diagnoses_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;
 
create table `ipd_consultant_registers` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `applied_date` datetime not null, `doctor_id` bigint unsigned not null, `instruction` text not null, `instruction_date` date not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


alter table `ipd_consultant_registers` add constraint `ipd_consultant_registers_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

alter table `ipd_consultant_registers` add constraint `ipd_consultant_registers_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

create table `ipd_charges` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `date` date not null, `charge_type_id` int not null, `charge_category_id` int unsigned not null, `charge_id` int unsigned not null, `standard_charge` int null, `applied_charge` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `ipd_charges` add constraint `ipd_charges_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;


alter table `ipd_charges` add constraint `ipd_charges_charge_category_id_foreign` foreign key (`charge_category_id`) references `charge_categories` (`id`) on delete cascade on update cascade;

alter table `ipd_charges` add constraint `ipd_charges_charge_id_foreign` foreign key (`charge_id`) references `charges` (`id`) on delete cascade on update cascade;

create table `ipd_prescriptions` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `header_note` text null, `footer_note` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


alter table `ipd_prescriptions` add constraint `ipd_prescriptions_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

create table `ipd_prescription_items` (`id` int unsigned not null auto_increment primary key, `ipd_prescription_id` int unsigned not null, `category_id` int unsigned not null, `medicine_id` int unsigned not null, `dosage` varchar(191) not null, `instruction` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `ipd_prescription_items` add constraint `ipd_prescription_items_ipd_prescription_id_foreign` foreign key (`ipd_prescription_id`) references `ipd_prescriptions` (`id`) on delete cascade on update cascade;

alter table `ipd_prescription_items` add constraint `ipd_prescription_items_category_id_foreign` foreign key (`category_id`) references `categories` (`id`) on delete cascade on update cascade;

alter table `ipd_prescription_items` add constraint `ipd_prescription_items_medicine_id_foreign` foreign key (`medicine_id`) references `medicines` (`id`) on delete cascade on update cascade;

create table `ipd_payments` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `amount` int not null, `date` date not null, `payment_mode` tinyint not null, `notes` text null, `transaction_id` int null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `ipd_payments` add constraint `ipd_payments_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

create table `ipd_timelines` (`id` int unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `title` varchar(191) not null, `date` date not null, `description` text null, `visible_to_person` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `ipd_timelines` add constraint `ipd_timelines_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

create table `ipd_bills` (`id` bigint unsigned not null auto_increment primary key, `ipd_patient_department_id` int unsigned not null, `total_charges` int not null, `total_payments` int
 not null, `gross_total` int not null, `discount_in_percentage` int not null, `tax_in_percentage` int not null, `other_charges` int not null, `net_payable_amount` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
 
 
alter table `ipd_bills` add constraint `ipd_bills_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

alter table `bed_assigns` add `ipd_patient_department_id` int unsigned null after `bed_id`;
alter table `bed_assigns` add constraint `bed_assigns_ipd_patient_department_id_foreign` foreign key (`ipd_patient_department_id`) references `ipd_patient_departments` (`id`) on delete cascade on update cascade;

create table `transactions` (`id` bigint unsigned not null auto_increment primary key, `stripe_transaction_id` varchar(191) not null, `amount` int not null, `user_id` int not null,
`status` varchar(191) not null, `meta` json null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

ALTER TABLE patient_diagnosis_properties CHANGE property_name property_name VARCHAR(191) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE property_value property_value VARCHAR(191) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`;


alter table `ipd_patient_departments` add `bill_status` tinyint(1) not null default '0';
