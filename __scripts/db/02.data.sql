insert into company (company_id, company_name, address1, address2, city, state, zip, active_ind) values (1, 'Start Up Company', '1313 Mockingbird Ln', '', 'Katy', 'TX', '90210', 1);

insert into contact (contact_id, company_id, first_name, last_name, active_ind) values (1, 1, 'Admin', 'User', 1);

insert into security_role (role_id, role_name, role_code)
values (1, 'Administrator', 'ADMIN');
insert into security_role (role_id, role_name, role_code)
values (2, 'Generic User', 'USER');

insert into security_user (user_id, contact_id, username, salt, password) values (1, 1, 'admin',
'K/eZ/d2UmkGIheEuhuNfls',
'$2y$12$K/eZ/d2UmkGIheEuhuNfleeYWrvkzRj1TDMJNuxeKMgyjaN1MTwNS');

insert into security_user_role(user_id, role_id)
values (1, 1);
insert into security_user_role(user_id, role_id)
values (1, 2);