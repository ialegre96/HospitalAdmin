alter table `schedules` drop `serial_visibility`
 
ALTER TABLE ambulances CHANGE note note TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`
