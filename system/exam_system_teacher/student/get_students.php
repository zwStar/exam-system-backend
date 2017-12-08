<?php

require_once "../db/connect_sql.php";

session_start();

 if(isset($_SESSION['teacherNo'])){
 	$teacherNo =  $_SESSION['teacherNo'];
	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT studentNo,name,grade,classNo,gender from students';
	$students = $db->fetchAll($sql);
if($students === false){
	echo json_encode(array('message'=>'获取学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('message'=>'获取学生成功','status'=>1,'data'=>$students),JSON_UNESCAPED_UNICODE);
}

 }else{
 	echo json_encode(array('message'=>'获取学生失败','status'=>-2),JSON_UNESCAPED_UNICODE);
 }




?>
