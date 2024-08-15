<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db_name='mysql:host=localhost;dbname=ecommerce';
$db_user='dckap';
$db_password='Dckap2023Ecommerce';

$conn=new PDO($db_name,$db_user,$db_password);

function unique_id(){
    $chars='0123456789abcdefghijklmnopqrstuvwxyz';
    $charLength=strlen($chars);
    $randomString='';
    for($i=0;$i < 20 ;$i++){
        $randomString .= $chars[mt_rand(0,$charLength-1)];
    }
    return $randomString;
}

