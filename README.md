# simple _todo
> A simple todo php/mysql powered todo app.
> This is the simplest todo app you will ever write. :)

## Install
Download the source code or clone it if you speak git
``` bash
git clone https://github.com/pozymasika/simple_todo.git
```
Install the sql tables:
1. You can use this 2 liner
``` bash
cd simple_todo
mysql --user=<yourusername> --password=<yourpassword> yourdatabasename < table.sql
```
2. Or copy the contents of tables.sql into your sql query box in the phpmyadmin tab.

Enter your database details in the config.php file:
``` php
define('DB_DSN','mysql:host=<yourhostname>;dname=<yourdbname>'');
define('DB_USER','<yourusername>');
define('DB_PASS','<yourpassword>');
```
##Run
Copy the downloaded folder to your server directory and open the index.php file in your browser.
Or you an use the inbuilt php server -
``` bash
cd simple_todo
php --server localhost:8000
```
The open this page in your browser [localhost]: http://localhost:8000/
Play with the source code :)
