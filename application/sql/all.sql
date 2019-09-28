CREATE TABLE role (
    id serial NOT NULL PRIMARY KEY,
    name VARCHAR(128) not null default ''
);

CREATE TABLE privilege (
    id serial NOT NULL PRIMARY KEY,
    name VARCHAR(128) NOT NULL DEFAULT '',
    code VARCHAR(128) NOT NULL DEFAULT ''
);

CREATE TABLE role_privilege (
	role_id INTEGER NOT NULL,
    privilege_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES role (id),
	FOREIGN KEY (privilege_id) REFERENCES privilege (id)
);

CREATE TABLE users (
	id serial NOT NULL PRIMARY KEY,
	username VARCHAR(32) not null default '',
	email VARCHAR (512) NOT NULL default '',
	password VARCHAR (40) NOT NULL default '',
	salt varchar (32) not null default '',
	token varchar (40) not null default '',
	sub_token varchar (40) not null default '',
	role_id integer not null default 0,
	status integer not null default 0,
	is_admin boolean not null default '0',
	reg_date timestamp not null default NOW(),
	last_login timestamp not null default NOW(),
	FOREIGN KEY (role_id) REFERENCES role (id)
);

CREATE TABLE blog (
	id serial NOT NULL PRIMARY KEY,
	name VARCHAR(128) not null default '',
	create_time timestamp not null default NOW(),
	annonce VARCHAR (256) NOT NULL default ''
);

CREATE TABLE avatar (
	id serial NOT NULL PRIMARY KEY,
	data bytea NOT NULL default '',
	create_time timestamp not null default NOW(),
	blog_id integer not null default 0,
	FOREIGN KEY (blog_id) REFERENCES blog (id)
);

CREATE TABLE post (
	id serial NOT NULL PRIMARY KEY,
	title VARCHAR(256) not null default '',
	text VARCHAR(512) not null default '',
	likes integer not null default 0,
	create_time timestamp not null default NOW(),
	blog_id integer not null default 0,
	FOREIGN KEY (blog_id) REFERENCES blog (id)
);

CREATE TABLE comment (
	id serial NOT NULL PRIMARY KEY,
	data VARCHAR (512) not null default '',
	create_time timestamp not null default NOW(),
	blog_id integer not null default 0,
	post_id integer not null default 0,
	FOREIGN KEY (blog_id) REFERENCES blog (id),
	FOREIGN KEY (post_id) REFERENCES post (id)
);

CREATE TABLE tag (
	id serial NOT NULL PRIMARY KEY,
	name VARCHAR(128) not null default ''
);

CREATE TABLE tag_post (
	post_id integer not null default 0,
	tag_id integer not null default 0,
	FOREIGN KEY (tag_id) REFERENCES tag (id),
	FOREIGN KEY (post_id) REFERENCES post (id)
);

CREATE TABLE blog_users (
	blog_id integer not null default 0,
	user_id integer not null default 0,
	is_owner boolean not null default '0',
	is_follower boolean not null default '0',
	FOREIGN KEY (blog_id) REFERENCES blog (id),
	FOREIGN KEY (user_id) REFERENCES users (id)
);