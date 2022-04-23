create table `opd_patient_departments` (`id` int unsigned not null auto_increment primary key, `patient_id` int unsigned not null, `opd_number` varchar(191) not null, `height` varchar(191) null, `weight` varchar(191) null, `bp` varchar(191) null, `symptoms` text null, `notes` text null, `appointment_date` datetime not null, `case_id` int unsigned null, `is_old_patient` tinyint(1) null default '0', `doctor_id` bigint unsigned null, `standard_charge` double not null, `payment_mode` tinyint not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `opd_patient_departments` add constraint `opd_patient_departments_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;

alter table `opd_patient_departments` add constraint `opd_patient_departments_case_id_foreign` foreign key (`case_id`) references `patient_cases` (`id`) on delete cascade on update cascade;

alter table `opd_patient_departments` add constraint `opd_patient_departments_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

alter table `opd_patient_departments` add unique `opd_patient_departments_opd_number_unique`(`opd_number`);

create table `opd_diagnoses` (`id` int unsigned not null auto_increment primary key, `opd_patient_department_id` int unsigned not null, `report_type` varchar(191) not null, `report_date` datetime not null, `description` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `opd_diagnoses` add constraint `opd_diagnoses_opd_patient_department_id_foreign` foreign key (`opd_patient_department_id`) references `opd_patient_departments` (`id`) on delete cascade on update cascade;

create table `opd_timelines` (`id` int unsigned not null auto_increment primary key, `opd_patient_department_id` int unsigned not null, `title` varchar(191) not null, `date` date not null, `description` text null, `visible_to_person` tinyint(1) not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `opd_timelines` add constraint `opd_timelines_opd_patient_department_id_foreign` foreign key (`opd_patient_department_id`) references `opd_patient_departments` (`id`) on delete cascade on update cascade
