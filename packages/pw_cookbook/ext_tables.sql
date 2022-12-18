CREATE TABLE tx_pwcookbook_domain_model_recipe (
	title varchar(255) NOT NULL DEFAULT '',
	short_description text NOT NULL DEFAULT '',
	description text,
	image int(11) unsigned NOT NULL DEFAULT '0',
	time time DEFAULT NULL,
	ingredients int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_pwcookbook_domain_model_review (
	text varchar(255) NOT NULL DEFAULT '',
	score int(11) NOT NULL DEFAULT '0',
	date datetime DEFAULT NULL,
	recipe int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_pwcookbook_domain_model_ingredient (
	recipe int(11) unsigned DEFAULT '0' NOT NULL,
	name varchar(255) NOT NULL DEFAULT '',
	volume double(11,2) NOT NULL DEFAULT '0.00',
	unit int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE fe_users (
	favorite_recipes int(11) unsigned NOT NULL DEFAULT '0',
	reviews int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_pwcookbook_domain_model_recipe (
	categories int(11) unsigned DEFAULT '0' NOT NULL
);
