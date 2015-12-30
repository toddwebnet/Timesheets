create table security_role
(
  role_id int auto_increment not null,
  role_name varchar(32) not null,
  role_code varchar(8) not null,
  primary key (role_id)
);

create table security_user
(
  user_id int AUTO_INCREMENT not null,
  username varchar(64) not null,
  password varchar(64),
  active_ind tinyint default 1 not null,
  primary key (user_id)
);

create table security_user_role
(
  user_id int not null,
  role_id int not null,
  primary key (user_id, role_id)
);


ALTER TABLE security_user_role
ADD CONSTRAINT fk_security_user_role_security_user
FOREIGN KEY (user_id)
REFERENCES security_user(user_id);

ALTER TABLE security_user_role
ADD CONSTRAINT fk_security_user_role_security_role
FOREIGN KEY (role_id)
REFERENCES security_role(role_id);

