CREATE TABLE users(
id serial NOT NULL PRIMARY KEY,
email VARCHAR (512) NOT NULL default '',
username VARCHAR(32) not null default '',
password VARCHAR (512) NOT NULL default '',
last_login integer not null default 0
);

CREATE TABLE user_tokens (
	id serial NOT NULL primary key,
	user_id INTEGER NOT NULL default 0,
	user_agent varchar(40) NOT NULL default '',
	token varchar(40) NOT NULL default '',
	type varchar(40) NOT NULL default '',
	created integer NOT NULL default 0,
	expires integer NOT NULL default 0,
   	FOREIGN KEY (user_id) REFERENCES users (id)
);

create table tags (
	id serial NOT NULL PRIMARY KEY,
	tag TEXT NOT NULL DEFAULT ''
);

create table rubrics (
	id serial NOT NULL PRIMARY KEY,
	lft INT NOT NULL DEFAULT 0,
	rgt INT NOT NULL DEFAULT 0,
	level INT NOT NULL DEFAULT 0,
	title VARCHAR(255) NOT NULL DEFAULT '',
	metadesc TEXT NOT NULL DEFAULT '',
	metakeyw TEXT NOT NULL DEFAULT ''
);

create table rubrics (
	id serial NOT NULL PRIMARY KEY,
	lft INT NOT NULL DEFAULT 0,
	rgt INT NOT NULL DEFAULT 0,
	level INT NOT NULL DEFAULT 0,
	title VARCHAR(255) NOT NULL DEFAULT '',
	metadesc TEXT NOT NULL DEFAULT '',
	metakeyw TEXT NOT NULL DEFAULT ''
);

create table posts (
	id serial NOT NULL primary key,
	title TEXT NOT NULL default '',
	post TEXT NOT NULL default '',
	metadesc TEXT NOT NULL default '',
	metakeyw TEXT NOT NULL default ''
);

CREATE TABLE config (
	id serial NOT NULL PRIMARY KEY ,
	config_key TEXT not null default '',
	config_value TEXT not null default '',
	group_name varchar(255) not null default ''
);

CREATE TABLE roles (
    id serial NOT NULL PRIMARY KEY,
    name VARCHAR(128) not null default '',
);

CREATE TABLE privileges (
    id serial NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL DEFAULT '',
    code VARCHAR(128) NOT NULL DEFAULT ''
);

CREATE TABLE roles_privileges (
    role_id INTEGER NOT NULL,
    privilege_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles (id),
	FOREIGN KEY (privilege_id) REFERENCES privileges (id)
);

CREATE TABLE roles_users (
	user_id INTEGER NOT NULL ,
	role_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (role_id) REFERENCES roles (id)
);

create table posts_tags (
	posts_id INT NOT NULL,
	tags_id INT NOT NULL,
	FOREIGN KEY (posts_id) REFERENCES posts (id),
	FOREIGN KEY (posts_id) REFERENCES tags (id)
);

create table post_rubrics (
	posts_id INT NOT NULL,
	rubrics_id INT NOT NULL,
	FOREIGN KEY (posts_id) REFERENCES  posts(id),
	FOREIGN KEY (rubrics_id) REFERENCES  rubrics(id)
);
