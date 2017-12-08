<?php

require_once "../db/connect_sql.php";
 
session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	$db = new mysql();  
	$link = $db->connect2();  
	$sql = 'SELECT teacherNo,name,gender,subject,phone FROM teachers';
	$teacher = $db->fetchAll($sql);
	if($teacher === false){
		echo json_encode(array('message'=>'获取教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'获取教师成功','status'=>1,'data'=>$teacher),JSON_UNESCAPED_UNICODE);
	}
 }else{
 	echo json_encode(array('message'=>'获取教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>

