## ez-Print (PHP Spaghetti)

Requirement
```
- PHP: Minimum PHP 7.1 and above 
```

##Installation
- Download or clone this repo
- Open phpAdmin/HeidiSQL and import file **database.sql**.
- Download all required package by using below command:
```
composer install
```
- Change your database connection on file config/db_config.php
```
 $GLOBALS['db'] = $db = new mysqli("localhost", "root", "", "ezprint");
```

##Login
- There are 3 roles
   1. Manager : Full Access
   2. Staff: For Internal and have limited access 
   3. Customer : For client
 
**Manager Account**
```
Email :admin@ezprint.my
Password : secret
```

**Customer Account**
```
email :customer@test.my
Password : secret
```

## Authors

* **Sir Hannan.**
-For study purpose

