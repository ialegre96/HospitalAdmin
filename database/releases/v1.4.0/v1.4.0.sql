create table `diagnosis_categories` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `description` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `diagnosis_categories` add index `diagnosis_categories_name_index`(`name`);

create table `patient_diagnosis_tests` (`id` bigint unsigned not null auto_increment primary key, `patient_id` int unsigned not null, `doctor_id` bigint unsigned not null, `category_id` bigint unsigned not null, `report_number` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `patient_diagnosis_tests` add index `patient_diagnosis_tests_created_at_index`(`created_at`);

alter table `patient_diagnosis_tests` add constraint `patient_diagnosis_tests_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;
 
alter table `patient_diagnosis_tests` add constraint `patient_diagnosis_tests_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

alter table `patient_diagnosis_tests` add constraint `patient_diagnosis_tests_category_id_foreign` foreign key (`category_id`) references `diagnosis_categories` (`id`) on delete cascade on update cascade;

create table `patient_diagnosis_properties` (`id` int unsigned not null auto_increment primary key, `patient_diagnosis_id` bigint unsigned not null, `property_name` varchar(255) not null, `property_value` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `patient_diagnosis_properties` add index `patient_diagnosis_properties_created_at_index`(`created_at`);

alter table `patient_diagnosis_properties` add constraint `patient_diagnosis_properties_patient_diagnosis_id_foreign` foreign key (`patient_diagnosis_id`) references `patient_diagnosis_tests` (`id`) on delete cascade on update cascade;
