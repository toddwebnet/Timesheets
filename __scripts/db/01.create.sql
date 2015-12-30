


create table company
(
  company_id int AUTO_INCREMENT not null,
  company_name varchar(32),
  address1 varchar(64),
  address2 varchar(64),
  city varchar(32),
  state varchar(2),
  zip varchar(16),
  active_ind tinyint default 1 not null,
  primary key (company_id)
);

create table contact
(
  contact_id int AUTO_INCREMENT not null,
  company_id int not null,
  first_name varchar(32),
  last_name varchar(32),
  active_ind tinyint default 1 not null,
  primary key (contact_id)
);

ALTER TABLE contact
ADD CONSTRAINT fk_contact_company
FOREIGN KEY (company_id)
REFERENCES company(company_id);

########################################################################
########################################################################
########################################################################




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
  contact_id int not null,
  username varchar(64) not null,
  salt varchar (16),
  password varchar(128),
  active_ind tinyint default 1 not null,
  primary key (user_id)
);

ALTER TABLE security_user
ADD CONSTRAINT fk_security_user_contact
FOREIGN KEY (contact_id)
REFERENCES contact(contact_id);

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


########################################################################
########################################################################
########################################################################
