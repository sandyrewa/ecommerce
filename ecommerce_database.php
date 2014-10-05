<?php
// category table
CREATE TABLE `categories`(
	`cat_id` int(11) NOT NULL AUTO_INCREMENT,
	`category_name` varchar(500) NOT NULL,
	`parent_cat_id` int(11) not null default 0,
	`category_url` varchar(1000) NOT NULL,
	`category_description` varchar(500),
	`created_time` timestamp default current_timestamp,
	`cat_status` int(11) default 1 comment "0=inactive and 1=active",
	PRIMARY KEY (`cat_id`)
)ENGINE=InnoDB

// create product table
create table if not exists `products`(
	`product_id` int(11) not null auto_increment,
	`product_sku` varchar(100),
	`product_barcode` varchar(100),
	`product_name` varchar(255),
	`product_short_desc` varchar(500),
	`product_long_desc` text,
	`product_cat_id` int(11) not null,
	`product_price` float,
	`product_stock` float,
	`cretae_time` timestamp default current_timestamp,
	`updated_time` timestamp,
	PRIMARY KEY (product_id)
)ENGINE=InnoDB

// create product image table 
create table if not exists `product_images`(
	`image_id` int(11) not null auto_increment,
	`product_id` int(11),
	`image` varchar(255),
	PRIMARY KEY (image_id)
)ENGINE=InnoDB
?>