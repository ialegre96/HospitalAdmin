create table `testimonials` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(191) not null, `description` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE sms CHANGE send_to send_to BIGINT UNSIGNED DEFAULT NULL;

alter table `sms` add `region_code` varchar(191) null after `send_to`;
SET FOREIGN_KEY_CHECKS=1;

create table `blood_donations` (`id` int unsigned not null auto_increment primary key, `blood_donor_id` int unsigned not null, `bags` int not null default '1', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

 alter table `blood_donations` add constraint `blood_donations_blood_donor_id_foreign` foreign key (`blood_donor_id`) references `blood_donors` (`id`) on delete cascade on update cascade;

create table `blood_issues` (`id` bigint unsigned not null auto_increment primary key, `issue_date` datetime not null, `doctor_id` bigint unsigned not null, `donor_id` int unsigned not null, `patient_id` int unsigned not null, `amount` varchar(191) null, `remarks` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `blood_issues` add constraint `blood_issues_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

alter table `blood_issues` add constraint `blood_issues_donor_id_foreign` foreign key (`donor_id`) references `blood_donors` (`id`) on delete cascade on update cascade;

alter table `blood_issues` add constraint `blood_issues_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;

insert into `modules` (`name`, `is_active`, `route`, `updated_at`, `created_at`) values ('Testimonial', 1, 'testimonials.index','2020-11-26 00:00:00', '2020-11-26 00:00:00');
insert into `modules` (`name`, `is_active`, `route`, `updated_at`, `created_at`) values ('Blood Donations', 1, 'blood-donations.index','2020-11-26 00:00:00', '2020-11-26 00:00:00');
insert into `modules` (`name`, `is_active`, `route`, `updated_at`, `created_at`) values ('Blood Issues', 1, 'blood-issues.index','2020-11-26 00:00:00', '2020-11-26 00:00:00');

alter table `appointments` add `is_completed` tinyint(1) not null default '0' after `problem`;
