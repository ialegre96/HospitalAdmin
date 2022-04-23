create table `vaccinations` (`id` int unsigned not null auto_increment primary key, `name` varchar(191) not null, `manufactured_by` varchar(191) not null, `brand` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `vaccinations` add index `vaccinations_id_index`(`id`);

create table `vaccinated_patients` (`id` int unsigned not null auto_increment primary key, `patient_id` int unsigned not null, `vaccination_id` int unsigned not null, `vaccination_serial_number` varchar(191) null, `dose_number` varchar(191) not null, `dose_given_date` datetime not null, `description` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `vaccinated_patients` add constraint `vaccinated_patients_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;

alter table `vaccinated_patients` add constraint `vaccinated_patients_vaccination_id_foreign` foreign key (`vaccination_id`) references `vaccinations` (`id`) on delete cascade on update cascade;

alter table `vaccinated_patients` add index `vaccinated_patients_id_index`(`id`);
alter table `vaccinated_patients` add index `vaccinated_patients_patient_id_index`(`patient_id`);
alter table `vaccinated_patients` add index `vaccinated_patients_vaccination_id_index`(`vaccination_id`);


insert into `modules` (`name`, `is_active`, `route`, `updated_at`, `created_at`) values ('Vaccinations', 1, 'vaccinations.index', '2021-02-24 10:00:00', '2021-02-24 10:00:00');
insert into `modules` (`name`, `is_active`, `route`, `updated_at`, `created_at`) values ('Vaccinated Patients', 1, 'vaccinated-patients.index', '2021-02-24 10:00:00', '2021-02-24 10:00:00');


