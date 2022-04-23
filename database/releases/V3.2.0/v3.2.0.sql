create table `call_logs` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(191) not null, `phone` varchar(191) null, `date` date null, `follow_up_date` date null, `note` text null, `call_type` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


 create table `visitors` (`id` bigint unsigned not null auto_increment primary key, `purpose` int not null, `name` varchar(191) not null, `phone` varchar(191) null, `id_card` varchar(191) null, `no_of_person` varchar(191) null, `date` date null, `in_time` time null, `out_time` time null, `note` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
 
 create table `postals` (`id` bigint unsigned not null auto_increment primary key, `from_title` varchar(191) null, `to_title` varchar(191) null, `reference_no` varchar(191) null, `date` date null, `address` text null, `type` int null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';;
