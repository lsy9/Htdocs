<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','');
define('DB_NAME','shop');
define('DB_CHARSET','utf8');
$link = @mysqli_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库连接失败');
mysqli_select_db($link,DB_NAME);
mysqli_set_charset($link,DB_CHARSET);
