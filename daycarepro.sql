#groups
INSERT INTO daycarepro.groups (name, description) VALUES ('admin', 'Super admins');
INSERT INTO daycarepro.groups (name, description) VALUES ('manager', 'Managers');
INSERT INTO daycarepro.groups (name, description) VALUES ('staff', 'Staff members');
INSERT INTO daycarepro.groups (name, description) VALUES ('parent', 'Parents');

#users
INSERT INTO daycarepro.users (username, first_name, last_name, email, password, active, forgotten_password_code, forgotten_password_time, activation_code, remember_code, salt, created_on, last_login, ip_address) VALUES ('admin', 'Demo', 'Admin', 'admin@app.com', '$2y$10$sS/uW/4uJpIZdg9LipqoYO4mR//.wFjLWTTmLNvp1hduEChruF3ke', 1, null, null, null, null, null, 1417992678, 1513835690, '::1');
INSERT INTO daycarepro.users (username, first_name, last_name, email, password, active, forgotten_password_code, forgotten_password_time, activation_code, remember_code, salt, created_on, last_login, ip_address) VALUES ('manager', 'Demo', 'Manager', 'manager@app.com', '$2y$08$KbjOBTx9U10UPcxq8Eiuv.g6VI7BHVQK14Lw.b3BT7MvK3FVtL/2u', 1, null, null, null, null, null, 1418000273, 1418575357, '::1');
INSERT INTO daycarepro.users (username, first_name, last_name, email, password, active, forgotten_password_code, forgotten_password_time, activation_code, remember_code, salt, created_on, last_login, ip_address) VALUES ('staff', 'Demo', 'Staff', 'staff@app.com', '$2y$08$mF52MtIXXrWzJNZTwqbJmemp0BT0XRFiTWCU.KhK8N//9dXOvcaBu', 1, null, null, null, null, null, 1418006359, 1418580454, '::1');
INSERT INTO daycarepro.users (username, first_name, last_name, email, password, active, forgotten_password_code, forgotten_password_time, activation_code, remember_code, salt, created_on, last_login, ip_address) VALUES ('parent', 'Demo', 'Parent', 'parent@app.com', '$2y$08$XAtGTjW1W5/IQrM/.stsTeToijg.i/Egzu7Ev90NVHfOpsS9a4qNu', 1, null, null, null, null, null, 1418083168, 1418083195, '::1');