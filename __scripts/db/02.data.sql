insert into security_role (role_id, role_name, role_code)
values (1, 'Administrator', 'ADMIN');
insert into security_role (role_id, role_name, role_code)
values (2, 'Generic User', 'USER');

insert into security_user (user_id, username) values (1, 'admin');

insert into security_user_role(user_id, role_id)
values (1, 1);
insert into security_user_role(user_id, role_id)
values (1, 2);