ALTER TABLE bed_assigns CHANGE assign_date assign_date DATETIME NOT NULL, CHANGE discharge_date discharge_date DATETIME DEFAULT NULL;

ALTER TABLE invoice_items CHANGE description description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`;
