<?php

include "../db/connect_sql.php";

session_start();
session_destroy();
$data = array('status'=>1,'message'=>'退出登录成功');
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>