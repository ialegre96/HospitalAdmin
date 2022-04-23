create table `notifications` (`id` int unsigned not null auto_increment primary key, `type` int not null, `notification_for` int not null, `user_id` bigint unsigned not null, `title` varchar(191) not null, `text` text null, `meta` text null, `read_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `notifications` add constraint `notifications_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;
