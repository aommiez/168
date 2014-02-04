<?php
session_start();
require("../../class/Db.class.php");

$user = $_POST['user'];
$password = md5($_POST['password']);

$db = new Db();

$account = $db->query("SELECT user FROM admin where user = '".$user."' and password = '".$password."' ");

if (!empty($account)) {
    echo $account[0]['user'];
    $_SESSION['login'] = 1;
    $_SESSION['user'] = $account[0]['user'];
    header("refresh:0; url=../home.php");
} else {
    echo "login error ";
    header("refresh:2; url=../index.php");
}
