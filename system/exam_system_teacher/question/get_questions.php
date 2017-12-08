<?php
require_once "../db/connect_sql.php";
 
session_start();

if(isset($_SESSION['teacherNo'])){
 	$teacherNo =  $_SESSION['teacherNo'];
	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT grade,subject,answer,type,question,teacherNo,options from question_bank';
	$questions = $db->fetchAll($sql);
if($questions === false){
	echo json_encode(array('message'=>'获取题库失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('message'=>'获取题库成功','status'=>1,'data'=>$questions),JSON_UNESCAPED_UNICODE);
}

 }else{
 	echo json_encode(array('message'=>'获取题库失败','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>
