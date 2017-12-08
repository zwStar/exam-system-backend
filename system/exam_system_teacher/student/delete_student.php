<?php

require_once "../db/connect_sql.php";
 
session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	$studentNo = $_POST['studentNo'];

	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT studentNo from students WHERE studentNo = '.$studentNo;
	$students = $db->fetchOne($sql);
if($students === false){
	echo json_encode(array('message'=>'删除学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	$delete_result =  $db->delete('students',' studentNo = '.$studentNo);
	if($delete_result === false){
		echo json_encode(array('message'=>'删除学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'删除学生成功','status'=>1),JSON_UNESCAPED_UNICODE);
		
	}
}

 }else{
 	echo json_encode(array('message'=>'删除学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>
