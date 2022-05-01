-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema vs20211029
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema vs20211029
-- -----------------------------------------------------
USE `vouchers_challenge` ;

-- -----------------------------------------------------
-- Table `companies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `companies` ;

CREATE TABLE IF NOT EXISTS `companies` (
                                                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                        `name` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
    `display_order` INT NOT NULL,
    `active` TINYINT NOT NULL,
    `logo` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `icon` VARCHAR(200) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 4
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `organizations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `organizations` ;

CREATE TABLE IF NOT EXISTS `organizations` (
                                                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                            `organization_type_id` INT UNSIGNED NOT NULL,
                                                            `organization_parent_id` INT UNSIGNED NULL DEFAULT NULL,
                                                            `name` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
    `country_id` INT UNSIGNED NULL DEFAULT NULL,
    `state` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `city` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `zipcode` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `address` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `email` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `phone_code` VARCHAR(10) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `email_booking` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `phone` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `email_voucher` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `booking_allowed` TINYINT(1) NOT NULL DEFAULT '1',
    `voucher_allowed` TINYINT(1) NOT NULL DEFAULT '1',
    `net_rates` TINYINT(1) NOT NULL DEFAULT '0',
    `active` TINYINT NOT NULL DEFAULT '0',
    `promos_active` TINYINT NOT NULL DEFAULT '0',
    `notify_past_due` TINYINT NOT NULL DEFAULT '1',
    `latitude` DECIMAL(10,7) NULL DEFAULT NULL,
    `longitude` DECIMAL(10,7) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 43
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Table `bookings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bookings` ;

CREATE TABLE IF NOT EXISTS `bookings` (
                                                       `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                       `source_id` INT UNSIGNED NULL DEFAULT NULL,
                                                       `user_id` INT UNSIGNED NULL DEFAULT NULL,
                                                       `organization_id` INT UNSIGNED NULL DEFAULT NULL,
                                                       `name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `guid` CHAR(36) NULL DEFAULT NULL,
    `age` VARCHAR(100) NOT NULL,
    `residence_country_id` INT UNSIGNED NOT NULL,
    `email` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
    `phone` VARCHAR(100) NULL DEFAULT NULL,
    `number` VARCHAR(100) NOT NULL,
    `booking_status_id` INT UNSIGNED NOT NULL,
    `pickup_office_id` INT UNSIGNED NOT NULL,
    `dropoff_office_id` INT UNSIGNED NOT NULL,
    `pickup_country_id` INT UNSIGNED NOT NULL,
    `dropoff_country_id` INT UNSIGNED NOT NULL,
    `company_id` INT UNSIGNED NOT NULL,
    `data_serialized` TEXT NULL DEFAULT NULL,
    `params_serialized` TEXT NULL DEFAULT NULL,
    `response_serialized` TEXT NULL DEFAULT NULL,
    `wizard_number` VARCHAR(100) NULL DEFAULT NULL,
    `discount_number` VARCHAR(100) NULL DEFAULT NULL,
    `coupon` VARCHAR(100) NULL DEFAULT NULL,
    `air_company` VARCHAR(100) NULL DEFAULT NULL,
    `flight_number` VARCHAR(100) NULL DEFAULT NULL,
    `frequent_flyer_program` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `frequent_flyer_membership` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
    `travel_agency` VARCHAR(100) NULL DEFAULT NULL,
    `travel_agency_email` VARCHAR(100) NULL DEFAULT NULL,
    `travel_agency_reward` VARCHAR(100) NULL DEFAULT NULL,
    `car_specs` TEXT NULL DEFAULT NULL,
    `car_code` VARCHAR(100) NULL DEFAULT NULL,
    `car_group` VARCHAR(100) NULL DEFAULT NULL,
    `car_image` TEXT NULL DEFAULT NULL,
    `car_name` VARCHAR(100) NULL DEFAULT NULL,
    `car_type` VARCHAR(100) NULL DEFAULT NULL,
    `iata` VARCHAR(100) NULL DEFAULT NULL,
    `id_landing` INT UNSIGNED NULL DEFAULT NULL,
    `name_landing` VARCHAR(100) NULL DEFAULT NULL,
    `vip_type` INT UNSIGNED NULL DEFAULT NULL,
    `pickup_date` DATE NULL DEFAULT NULL,
    `dropoff_date` DATE NULL DEFAULT NULL,
    `pickup_time` TIME NULL DEFAULT NULL,
    `dropoff_time` TIME NULL DEFAULT NULL,
    `rate` VARCHAR(100) NULL DEFAULT NULL,
    `base_rate` DECIMAL(15,2) NULL DEFAULT NULL,
    `base_rate_with_taxes` DECIMAL(15,2) NULL DEFAULT NULL,
    `taxes_total` DECIMAL(15,2) NULL DEFAULT NULL,
    `equipment_total` DECIMAL(15,2) NULL DEFAULT NULL,
    `estimated_total_amount` DECIMAL(15,2) NULL DEFAULT NULL,
    `taxes` TEXT NULL DEFAULT NULL,
    `manual_voucher` TINYINT(1) NOT NULL DEFAULT '0',
    `issue_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 4014
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `payment_file_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payment_file_status` ;

CREATE TABLE IF NOT EXISTS `payment_file_status` (
                                                                  `id` INT NOT NULL AUTO_INCREMENT,
                                                                  `name` VARCHAR(50) NOT NULL,
    `display_order` INT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 5
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `payment_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `payment_files` ;

CREATE TABLE IF NOT EXISTS `payment_files` (
                                                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                            `user_id` INT UNSIGNED NOT NULL,
                                                            `organization_id` INT UNSIGNED NOT NULL,
                                                            `payment_file_status_id` INT NOT NULL,
                                                            `company_id` INT UNSIGNED NOT NULL,
                                                            `cycle_start` DATE NOT NULL,
                                                            `cycle_end` DATE NOT NULL,
                                                            `account` VARCHAR(50) NOT NULL,
    `iata` VARCHAR(50) NULL DEFAULT NULL,
    `vouchers_count` INT NULL DEFAULT NULL,
    `gross_amount` DECIMAL(15,2) NULL DEFAULT NULL,
    `commission_amount` DECIMAL(15,2) NULL DEFAULT NULL,
    `net_amount` DECIMAL(15,2) NULL DEFAULT NULL,
    `abg_user_id` INT UNSIGNED NULL DEFAULT NULL,
    `comments` VARCHAR(1000) NULL DEFAULT NULL,
    `batch_file_id` INT UNSIGNED NULL DEFAULT NULL,
    `extract_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 142
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `voucher_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `voucher_status` ;

CREATE TABLE IF NOT EXISTS `voucher_status` (
                                                             `id` INT NOT NULL AUTO_INCREMENT,
                                                             `name` VARCHAR(50) NULL DEFAULT NULL,
    `display_order` INT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 5
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `vouchers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vouchers` ;

CREATE TABLE IF NOT EXISTS `vouchers` (
                                                       `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                                       `booking_id` INT UNSIGNED NOT NULL,
                                                       `gsa_organization_id` INT UNSIGNED NOT NULL,
                                                       `organization_id` INT UNSIGNED NOT NULL,
                                                       `user_id` INT UNSIGNED NOT NULL,
                                                       `company_id` INT UNSIGNED NOT NULL,
                                                       `iata_code` VARCHAR(50) NOT NULL,
    `number` VARCHAR(50) NULL DEFAULT NULL,
    `voucher_status_id` INT NOT NULL,
    `voucher_sub_status_id` INT UNSIGNED NULL DEFAULT NULL,
    `payment_file_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Esta columna identifica el lote en el que es incluido este voucher.\\nSi el lote se rechaza, este campo se blanquea. (queda la información en payment_file_vouchers)\\n',
    `past_due` TINYINT UNSIGNED NOT NULL DEFAULT '1',
    `account` VARCHAR(50) NOT NULL,
    `booking_base_rate` DECIMAL(15,2) NOT NULL,
    `booking_taxes` DECIMAL(15,2) NOT NULL,
    `booking_total` DECIMAL(15,2) NOT NULL,
    `gross_amount` DECIMAL(15,2) NOT NULL COMMENT 'El monto por el cual se generó el Voucher.\\ndebe corresponder con el booking_base_rate o booking_total.\\n',
    `gsa_comission_rate` DECIMAL(10,2) NOT NULL,
    `gsa_taxes_included` TINYINT(1) NOT NULL COMMENT 'Indica si comisiona sobre los impuestos\\n',
    `gsa_comission_amount` DECIMAL(15,2) NOT NULL COMMENT 'Importe calculado de la comisión GSA.',
    `agency_comission_rate` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'Comisión de la Agencia.',
    `agency_taxes_included` TINYINT(1) NULL DEFAULT NULL COMMENT 'Si comisiona sobre los impuestos.',
    `agency_comission_amount` DECIMAL(10,2) NULL DEFAULT NULL,
    `abg_net_amount` DECIMAL(15,2) NOT NULL COMMENT 'Importe correspondiente a ABG. (gross_amount - gsa_comission_amount)\\n',
    `issue_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `agency_file_number` VARCHAR(100) NULL DEFAULT NULL,
    `net_rate` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Las tarifas netas tienen valor 1',
    `manual_voucher` TINYINT(1) NOT NULL DEFAULT '0',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 1757
    DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
