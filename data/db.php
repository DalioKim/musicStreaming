<?php

$db = mysqli_connect("", "","","");


$db->set_charset("utf8");
/*
function mq($sql)
{
    global $db;
    return $db->query($sql);
}
*/
header('Content-Type: text/html; charset=utf-8');
session_start();

?>
