create table `front_services`
(
    `id`                int unsigned not null auto_increment primary key,
    `name`              varchar(191) not null,
    `short_description` text null,
    `created_at`        timestamp null,
    `updated_at`        timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `users`
    add `facebook_url` varchar(191) null after `remember_token`;
alter table `users`
    add `twitter_url` varchar(191) null after `facebook_url`;
alter table `users`
    add `instagram_url` varchar(191) null after `twitter_url`;
alter table `users`
    add `linkedIn_url` varchar(191) null after `instagram_url`;

create table `hospital_schedules`
(
    `id`          int unsigned not null auto_increment primary key,
    `day_of_week` varchar(191) not null,
    `start_time`  varchar(191) not null,
    `end_time`    varchar(191) not null,
    `created_at`  timestamp null,
    `updated_at`  timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
