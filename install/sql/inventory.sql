



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'modules'
-- 
-- ---

DROP TABLE IF EXISTS `modules`;
		
CREATE TABLE `modules` (
  `id` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `code` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `is_manufactured` tinyint(1) NOT NULL DEFAULT '0',
  `is_sales_ready` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` INTEGER(10) NULL DEFAULT NULL,
  `weight_value` FLOAT NULL DEFAULT NULL,
  `weight_per_units` FLOAT NULL DEFAULT NULL,
  `cost_value` FLOAT NULL DEFAULT NULL,
  `cost_per_units` FLOAT NULL DEFAULT NULL,
  `sales_price_value` FLOAT NULL DEFAULT NULL,
  `sales_prices_per_units` INTEGER(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'suppliers'
-- 
-- ---

DROP TABLE IF EXISTS `suppliers`;
		
CREATE TABLE `suppliers` (
  `id` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'module_material_required'
-- 
-- ---

DROP TABLE IF EXISTS `module_material_required`;
		
CREATE TABLE `module_material_required` (
  `module_id` INTEGER(10) NULL DEFAULT NULL,
  `required_id` INTEGER(10) NULL DEFAULT NULL,
  `amount_required` INTEGER(10) NULL DEFAULT NULL
);

-- ---
-- Table 'module_tags'
-- 
-- ---

DROP TABLE IF EXISTS `module_tags`;
		
CREATE TABLE `module_tags` (
  `id` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'module_tag_association'
-- 
-- ---

DROP TABLE IF EXISTS `module_tag_association`;
		
CREATE TABLE `module_tag_association` (
  `module_id` INTEGER(10) NULL DEFAULT NULL,
  `module_tag_id` INTEGER(10) NULL DEFAULT NULL
);

-- ---
-- Table 'products'
-- 
-- ---

DROP TABLE IF EXISTS `products`;
		
CREATE TABLE `products` (
  `id` INTEGER(10) NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `sales_price_value` FLOAT NULL DEFAULT NULL,
  `sales_price_per_units` INTEGER(10) NULL DEFAULT NULL,
  `quantity` INTEGER(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'product_modules'
-- 
-- ---

DROP TABLE IF EXISTS `product_modules`;
		
CREATE TABLE `product_modules` (
  `product_id` INTEGER(10) NULL DEFAULT NULL,
  `module_id` INTEGER(10) NULL DEFAULT NULL,
  `amount_required` INTEGER(10) NULL DEFAULT NULL
);

-- ---
-- Table 'module_supplier_association'
-- 
-- ---

DROP TABLE IF EXISTS `module_supplier_association`;
		
CREATE TABLE `module_supplier_association` (
  `module_id` INTEGER(10) NULL DEFAULT NULL,
  `supplier_id` INTEGER(10) NULL DEFAULT NULL,
  `supplier_code` VARCHAR(255) NULL DEFAULT NULL
);

-- ---
-- Foreign Keys 
-- ---


-- ALTER TABLE `module_material_required` ADD FOREIGN KEY (module_id) REFERENCES `modules` (`id`);
-- ALTER TABLE `module_tag_association` ADD FOREIGN KEY (module_id) REFERENCES `modules` (`id`);
-- ALTER TABLE `module_tag_association` ADD FOREIGN KEY (module_tag_id) REFERENCES `module_tags` (`id`);
-- ALTER TABLE `product_modules` ADD FOREIGN KEY (product_id) REFERENCES `products` (`id`);
-- ALTER TABLE `product_modules` ADD FOREIGN KEY (module_id) REFERENCES `modules` (`id`);
-- ALTER TABLE `module_supplier_association` ADD FOREIGN KEY (module_id) REFERENCES `modules` (`id`);
-- ALTER TABLE `module_supplier_association` ADD FOREIGN KEY (supplier_id) REFERENCES `suppliers` (`id`);


-- ---
-- Table Properties
-- ---

-- ALTER TABLE `modules` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `suppliers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `module_material_required` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `module_tags` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `module_tag_association` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `products` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `product_modules` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `module_supplier_association` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `modules` (`id`,`name`,`code`,`description`,`is_manufactured`,`is_sales_ready`,`quantity`,`weight_value`,`weight_per_units`,`cost_value`,`cost_per_units`,`sales_price_value`,`sales_prices_per_units`) VALUES
-- ('','','','','','','','','','','','','');
-- INSERT INTO `suppliers` (`id`,`name`,`description`) VALUES
-- ('','','');
-- INSERT INTO `module_material_required` (`module_id`,`required_id`,`amount_required`) VALUES
-- ('','','');
-- INSERT INTO `module_tags` (`id`,`name`,`description`) VALUES
-- ('','','');
-- INSERT INTO `module_tag_association` (`module_id`,`module_tag_id`) VALUES
-- ('','');
-- INSERT INTO `products` (`id`,`name`,`description`,`sales_price_value`,`sales_price_per_units`,`quantity`) VALUES
-- ('','','','','','');
-- INSERT INTO `product_modules` (`product_id`,`module_id`,`amount_required`) VALUES
-- ('','','');
-- INSERT INTO `module_supplier_association` (`module_id`,`supplier_id`,`supplier_code`) VALUES
-- ('','','');

