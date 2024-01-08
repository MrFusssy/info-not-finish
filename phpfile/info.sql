create database info_puppals;

use owner_list;

CREATE TABLE `users` (
    `id` int(11) NOT NULL auto_increment,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `phone_number` int(11) NOT NULL,
    `message` text (300) NOT NULL.
    PRIMARY KEY (`id`)
);