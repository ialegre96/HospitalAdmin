 create table `item_categories` (`id` int unsigned not null auto_increment primary key, `name` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
 
alter table `item_categories` add unique `item_categories_name_unique`(`name`);

create table `items` (`id` int unsigned not null auto_increment primary key, `name` varchar(255) not null, `item_category_id` int unsigned not null, `unit` varchar(255) not null, `description` text null, `available_quantity` int not null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `items` add constraint `items_item_category_id_foreign` foreign key (`item_category_id`) references `item_categories` (`id`) on delete cascade on update cascade;

create table `item_stocks` (`id` int unsigned not null auto_increment primary key, `item_category_id` int unsigned not null, `item_id` int unsigned not null, `supplier_name` varchar(255) null, `store_name` varchar(255) null, `quantity` int not null, `purchase_price` double not null, `description` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


alter table `item_stocks` add constraint `item_stocks_item_category_id_foreign` foreign key (`item_category_id`) references `item_categories` (`id`) on delete cascade on update cascade;

alter table `item_stocks` add constraint `item_stocks_item_id_foreign` foreign key (`item_id`) references `items` (`id`) on delete cascade on update cascade;

create table `issued_items` (`id` int unsigned not null auto_increment primary key, `department_id` bigint unsigned not null, `user_id` bigint unsigned not null, `issued_by` varchar(255) not null, `issued_date` date not null, `return_date` date null, `item_category_id` int unsigned not null, `item_id` int unsigned not null, `quantity` int not null, `description` text null, `status` tinyint(1) null default '0', `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `issued_items` add constraint `issued_items_department_id_foreign` foreign key (`department_id`) references `departments` (`id`) on delete cascade on update cascade;

alter table `issued_items` add constraint `issued_items_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `issued_items` add constraint `issued_items_item_category_id_foreign` foreign key (`item_category_id`) references `item_categories` (`id`) on delete cascade on update cascade;

alter table `issued_items` add constraint `issued_items_item_id_foreign` foreign key (`item_id`) references `items` (`id`) on delete cascade on update cascade;
