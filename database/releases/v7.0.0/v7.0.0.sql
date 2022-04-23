create table `front_settings` (`id` bigint unsigned not null auto_increment primary key, `key` varchar(191) not null, `value` text not null, `type` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

