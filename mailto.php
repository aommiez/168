<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nuiz
 * Date: 23/3/2557
 * Time: 12:40 น.
 * To change this template use File | Settings | File Templates.
 */

$emailto='a@a.com'; //อีเมล์ผู้รับ
$subject='จากระบบอีเมลล์ติดต่อ 168 travel'; //หัวข้อ
$header = "Content-type: text/html; charset=windows-620\n";
$header.="from: ".$_POST["name"]."E-mail :".$_POST["email"]; //ชื่อและอีเมลผู้ส่ง
$messages = $_POST["message"]."</br>"; //ข้อความ
$send_mail = mail($emailto,$subject,$messages,$header);

if(!$send_mail)
{
    $res = array("success"=> false, "message"=> "ผิดพลาด ไม่สามารถส่งข้อความได้");
}
else
{
    $res = array("success"=> true, "message"=> "ส่งข้อความเรียบร้อยแล้ว");
}
echo json_encode($res);