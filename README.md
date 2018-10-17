# example-forum-rest-api-php

user CRUD

1 http://localhost/grandats_project/forum/api/user/create.php
Method : POST
	parameter
	'_username'
	'_pwd'
	'_picture'
	'_email'

2 http://localhost/grandats_project/forum/api/user/read.php?page=1
Method : GET
3 http://localhost/grandats_project/forum/api/user/readone.php?_user_id=1
Method : GET
4 http://localhost/grandats_project/forum/api/user/update.php
Method : POST
	parameter
	'_user_id'
	'_pwd'
	'_email'
5 http://localhost/grandats_project/forum/api/user/delete.php?_user_id=1
Method : GET
---------------------------------------------------------------------
thread CRUD

1 http://localhost/grandats_project/forum/api/thread/create.php
Method : POST
	parameter
	'_subject'
	'_content'
	'_user_account_id'

2 http://localhost/grandats_project/forum/api/thread/read.php?page=1
Method : GET
3 http://localhost/grandats_project/forum/api/thread/readone.php?_thread_id=1
Method : GET
4 http://localhost/grandats_project/forum/api/thread/update.php
Method : POST
	parameter
	'_thread_id'
	'_subject'
	'_content'
5 http://localhost/grandats_project/forum/api/thread/delete.php?_thread_id=1
Method : GET
---------------------------------------------------------------------
comments post CRUD

1 http://localhost/grandats_project/forum/api/post/create.php
Method : POST
	parameter
	'_threads_id'
	'_content'
	'_user_account_id'

2 http://localhost/grandats_project/forum/api/post/read.php?page=1
Method : GET
3 http://localhost/grandats_project/forum/api/post/readone.php?_post_id=1

Method : GET
4 http://localhost/grandats_project/forum/api/post/update.php
Method : POST
	parameter
	'_post_id'
	'_content'
5 http://localhost/grandats_project/forum/api/post/delete.php?_post_id=1
Method : GET
---------------------------------------------------------------------
voting

1 http://localhost/grandats_project/forum/api/vote/upthread.php?_thread_id=1&_user_account_id=1
Method : GET

2 http://localhost/grandats_project/forum/api/vote/downthread.php?_thread_id=1&_user_account_id=1
Method : GET

3 http://localhost/grandats_project/forum/api/vote/upthread.php?_post_id=1&_user_account_id=1
Method : GET

4 http://localhost/grandats_project/forum/api/vote/downthread.php?_post_id=1&_user_account_id=1
Method : GET
-------------------------------------------------------------------
