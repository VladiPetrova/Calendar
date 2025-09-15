CREATE TABLE `users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(20) NOT NULL,
    `first_name` VARCHAR(20) NOT NULL,
    `last_name` VARCHAR(20) NOT NULL,
    `is_admin` ENUM('1', '0') NOT NULL DEFAULT '0'
);
CREATE TABLE `holidays`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `status` ENUM('pending', 'approved') NOT NULL DEFAULT 'pending',
    `user_id` BIGINT UNSIGNED NOT NULL
);
ALTER TABLE
    `holidays` ADD CONSTRAINT `holidays_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);

ALTER TABLE users ADD COLUMN password VARCHAR(255);

ALTER TABLE holidays MODIFY COLUMN status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending';