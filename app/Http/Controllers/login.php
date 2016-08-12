<?php 
session_start();

$_SESSION['user']=1;
$_SESSION['flash_message']='You are now logged in';
 echo $_SESSION['user'];
 
use Session;

Session::put('user',1);



?>