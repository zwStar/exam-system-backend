<?php

require_once "../db/connect_sql.php";
 
session_start();

 if(isset($_SESSION['teacherNo'])){
 	$teacherNo =  $_SESSION['teacherNo'];
 	$studentNo = $_POST['studentNo'];
	$grade = $_POST['grade'];
	$classNo = $_POST['classNo'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];

	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT studentNo from students WHERE studentNo = '.$studentNo;
	$students = $db->fetchOne($sql);
if($students === false){
	echo json_encode(array('message'=>'修改学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	$update_result =  $db->update(array('studentNo'=>$studentNo,'grade'=>$grade,'classNo'=>$classNo,'name'=>$name,'gender'=>$gender),'students', ' studentNo = '.$studentNo);
	if($update_result === false){
		echo json_encode(array('message'=>'修改学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'修改学生成功','status'=>1),JSON_UNESCAPED_UNICODE);
		
	}
}

 }else{
 	echo json_encode(array('message'=>'修改学生失败，请重新登录','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>
