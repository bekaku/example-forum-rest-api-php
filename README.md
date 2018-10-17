# example-forum-rest-api-php

This library conforms to [AndroidForum](https://github.com/bekaku/AndroidForum), Android Application Code



## Requirements

- PHP 5.6, or higher

## Configuration

Database file located at /forum/assets/db/android_forum.sql and you can use below command for restore to your db.

```
$ mysql -uroot -p your_db_name < your_backup_file_path
```

Change main api url at /forum/core.php

```php
//home page url
$_mainApiUrl = "http://SERVER_IP/forum/api/";
$_assetApiUrl = "http://SERVER_IP/forum/assets/";

```
Config your database connection at /forum/shared/Database.php

```php
    // specify your own database credentials
    private $host = "YOUR_MYSQL_SERVER_IP";//localhost
    private $dbName = "android_forum";//
    private $username = "YOUR_MYSQL_USERNAME";
    private $password = "YOUR_MYSQL_PASSWORD";
    private $charSet = "utf8";
    private $port = "3306";
```

## user_account CRUD
```
1 http://SERVER_IP/forum/api/user/create.php
Method : POST
	parameter
	'_username'
	'_pwd'
	'_picture'
	'_email'
```

```
2 http://SERVER_IP/forum/api/user/read.php?page=1
Method : GET
```

```
3 http://SERVER_IP/forum/api/user/readone.php?_user_id=[user_account_id]
Method : GET
```

```
4 http://SERVER_IP/forum/api/user/update.php
Method : POST
	parameter
	'_user_id'
	'_pwd'
	'_email'
```

```
5 http://SERVER_IP/forum/api/user/delete.php?_user_id=[user_account_id]
Method : GET
```

## thread CRUD

```
1 http://SERVER_IP/forum/api/thread/create.php
Method : POST
	parameter
	'_subject'
	'_content'
	'_user_account_id'
```

```
2 http://SERVER_IP/forum/api/thread/read.php?page=1
Method : GET
```

```
3 http://SERVER_IP/forum/api/thread/readone.php?_thread_id=[thread_id]
Method : GET
```

```
4 http://SERVER_IP/forum/api/thread/update.php
Method : POST
	parameter
	'_thread_id'
	'_subject'
	'_content'
```

```
5 http://SERVER_IP/forum/api/thread/delete.php?_thread_id=[thread_id]
Method : GET
```

## comments post CRUD

```
1 http://SERVER_IP/forum/api/post/create.php
Method : POST
	parameter
	'_threads_id'
	'_content'
	'_user_account_id'
```

```
2 http://SERVER_IP/forum/api/post/read.php?page=1
Method : GET
```

```
3 http://SERVER_IP/forum/api/post/readone.php?_post_id=[post_id]
Method : GET
```

```
4 http://SERVER_IP/forum/api/post/update.php
Method : POST
	parameter
	'_post_id'
	'_content'
```

```
5 http://SERVER_IP/forum/api/post/delete.php?_post_id=[post_id]
Method : GET
```

## voting

```
1 http://localhost/forum/api/vote/upthread.php?_thread_id=[thread_id]&_user_account_id=[user_account_id]
Method : GET
```

```
2 http://localhost/forum/api/vote/downthread.php?_thread_id=[thread_id]&_user_account_id=[user_account_id]
Method : GET
```

```
3 http://localhost/forum/api/vote/uppost.php?_post_id=[post_id]&_user_account_id=[user_account_id]
Method : GET
```

```
4 http://localhost/forum/api/vote/downpost.php?_post_id=[post_id]&_user_account_id=[user_account_id]
Method : GET
```
