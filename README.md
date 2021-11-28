# nosql_vuln_app
Lab for testing injection vulnerability in mongodb

## Install
Tested on:  
- Kali 2021.3
- MongoDB 4.2.17
- Apache/2.4.48

How to install:

- cd /var/www/html
- git clone https://github.com/imousek/nosql_vuln_app

- sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 4B7C549A058F8B6B
- echo "deb [arch=amd64] http://repo.mongodb.org/apt/ubuntu bionic/mongodb-org/4.2 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-4.2.list
- sudo apt update
- sudo apt install mongodb-org
- systemctl enable mongod.service 
- systemctl start mongod.service 
- cd nosql_vuln_app
- sudo apt-get install composer php-mongodb
- composer require mongodb/mongodb
- sudo service apache2 start

open 127.0.0.1/nosql_vuln_app

## Files

There are 4 files in this app...

### db.php
Used to populate and reset the db->users with 4 users.

### search.php
Simple vulnerability - can print all users at the same time instead of only one

### login.php
Authentication bypass, extract password length and full password

### where.php
Vulnerability because of where function, possible to print all users, sleep DB and DOS

## Prevention

each file has commented easy methods of preventing basic nosql injection
