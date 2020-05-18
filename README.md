# BlueAlly Api

## Symfony Back End Setup

**Update Hosts File**  
ex: C:\Windows\System32\drivers\etc\hosts  
Add: 127.0.0.1 blueallyapi.test

**Update XAMPP VHosts File**  
ex: C:\xampp\apache\conf\extra\httpd-vhosts.conf  
Add:  
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/blueallyapi/public"
    ServerName blueallyapi.test<\/VirtualHost>

**Start Server**  
Local environment used XAMPP and Apache. In XAMPP Control Panel start Apache and MySql servers.  

**Run these three commands in project directory:**  
*install packages, create database, seed data from json file*  

* composer install
* php bin/console doctrine:database:create
* php bin/console doctrine:fixtures:load  

Open in browser: [http://blueallyapi.test/](http://blueallyapi.test/)

**Unit Test**  
*there's a single unit test for the api route*

php bin/phpunit