create table `live_consultations` (`id` bigint unsigned not null auto_increment primary key, `doctor_id` bigint unsigned not null, `patient_id` int unsigned not null, `consultation_title` varchar(191) not null, `consultation_date` datetime not null, `host_video` tinyint(1) not null, `participant_video` tinyint(1) not null, `consultation_duration_minutes` varchar(191) not null
, `type` varchar(191) not null, `type_number` varchar(191) not null, `created_by` varchar(191) not null, `status` int not null, `description` text null, `meeting_id` varchar(191) not null, `meta` text null, `time_zone` varchar(191) not null, `password` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `live_consultations` add constraint `live_consultations_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;

alter table `live_consultations` add constraint `live_consultations_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;

create table `live_meetings` (`id` bigint unsigned not null auto_increment primary key, `consultation_title` varchar(191) not null, `consultation_date` datetime not null, `consultation_duration_minutes` varchar(191) not null, `host_video` tinyint(1) not null, `participant_video` tinyint(1) not null, `description` text null, `created_by` varchar(191) not null, `meta` text null, `time_zone` varchar(191) not null, `password` varchar(191) not null, `status` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `live_meetings_candidates` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `live_meeting_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `user_zoom_credential` (`id` bigint unsigned not null auto_increment primary key, `user_id` bigint unsigned not null, `zoom_api_key` varchar(191) not null, `zoom_api_secret` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `user_zoom_credential` add constraint `user_zoom_credential_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `live_meetings` add `meeting_id` varchar(191) not null after `meta`;
