<?php

require_once "../db/connect_sql.php";
 
session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	
	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT teacherNo from teachers WHERE teacherNo = '.$teacherNo;
	$teachers = $db->fetchOne($sql);
	if($teachers === false){
		echo json_encode(array('message'=>'删除教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		$delete_result =  $db->delete('teachers',' teacherNo = '.$teacherNo);
		if($delete_result === false){
			echo json_encode(array('message'=>'删除教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
		}else{
			echo json_encode(array('message'=>'删除教师成功','status'=>1),JSON_UNESCAPED_UNICODE);
			
		}
	}
 }else{
 	echo json_encode(array('message'=>'删除教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>
