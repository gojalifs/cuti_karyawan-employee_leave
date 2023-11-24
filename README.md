# Aplikasi Cuti Karyawan
This is an application to apply for leave in the company. This application is built using laravel 8, and is currently migrating to laravel 10. 
This app is include 3 role of employee, that is **Super Admin**, **HR Staff**, and **Employee/Staff**.

Please, enjoy.

<img src="https://github.com/gojalifs/cuti_karyawan-employee_leave/assets/60059041/a24cbf9e-1df0-48fd-b6e1-c15b606e685b" width="640" height="360">


<img src="https://github.com/gojalifs/cuti_karyawan-employee_leave/assets/60059041/29d0c339-ab29-4968-9c87-c19c523f4f68" width="640" height="360">


# Installation

```
# clone the repo
$ git clone https://github.com/gojalifs/cuti_karyawan-employee_leave.git

# go into app's directory
$ cd cuti_karyawan-employee_leave

# Install Depedency
$ composer install

# Setup Environment Variable
$ cp .env.example .env
$ php artisan key:generate

# create database
1. go to phpmyadmin
2. create a database with the name cuti_karyawan_app

# Migrate & Seed
$ php artisan migrate --seed

```

# Basic usage

```
# Access the website with the url in a web browser
  http://localhost/cuti_karyawan-employee_leave/public
	
```

# User Account

```
# Account Karyawan
  username : putri@example.com
  password : putri

# Account Super Admin
  username : nindi@example.com
  password : nindi  

# Account Staf HR
  username : octa@example.com
  password : octa
	
```

# Email
If you want to send email confirmation to the user, make sure to add your email configuration in .env file

