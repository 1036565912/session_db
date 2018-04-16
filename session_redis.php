<?php
//phpinfo();

/*使用redis作为session的驱动*/
ini_set('session.save_handler','redis');
ini_set('session.save_path','tcp://localhost:6379');

session_start();
//$_SESSION['key'] = 'value';

$_SESSION['chen'] = "lin";
var_dump($_SESSION);
echo "success";
