CREATE TABLE IF NOT EXISTS `login`.`user_connections` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) unsigned NOT NULL,
 `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
 `user_last_visit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `user_last_visit_agent` text COLLATE utf8_unicode_ci,
 `user_login_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
 `user_login_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `user_login_agent` text COLLATE utf8_unicode_ci,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='authenticated user data';
