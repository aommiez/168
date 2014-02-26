<?php
/**
 * Created by JetBrains PhpStorm.
 * User: P2DC
 * Date: 22/2/2557
 * Time: 14:00 น.
 * To change this template use File | Settings | File Templates.
 */

session_start();
include_once("class/Db.class.php");
include_once("class/INI.class.php");
include_once("class/Comment.php");

if(empty($_SESSION["login"])){
    return;
}

$commentCTL = new Comment($_GET["type"]);
$commentCTL->deleteComment($_GET["id"]);

echo json_encode(array("success"=> true));