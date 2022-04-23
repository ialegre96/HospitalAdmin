alter table `appointments` drop foreign key `appointments_patient_id_foreign`;
ALTER TABLE appointments CHANGE patient_id patient_id INT UNSIGNED NOT NULL;
alter table `appointments` add constraint `appointments_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;
alter table `appointments` drop foreign key `appointments_department_id_foreign`;
ALTER TABLE appointments CHANGE department_id department_id BIGINT UNSIGNED NOT NULL;
alter table `appointments` add constraint `appointments_department_id_foreign` foreign key (`department_id`) references `doctor_departments` (`id`) on delete cascade on update cascade;
ALTER TABLE bills CHANGE amount amount NUMERIC(16, 2) DEFAULT NULL;
ALTER TABLE bill_items CHANGE amount amount NUMERIC(16, 2) NOT NULL;
