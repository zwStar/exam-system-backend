<?php

require_once "../db/connect_sql.php";
 

session_start();

if(isset($_SESSION['teacherNo'])){
 	 $teacherNo =  $_SESSION['teacherNo'];
	$db = new mysql();  
	$link = $db->connect2();  

	$exam_sql = 'SELECT id,grade,classNo,subject,startTime,endTime,examDay from exam_arrange WHERE 1';
	$exams = $db->fetchAll($exam_sql);
	if($exams===false){
		echo json_encode(array('message'=>'获取考试列表失败','status'=>-1),JSON_UNESCAPED_UNICODE);	
	}else{
		echo json_encode(array('message'=>'获取考试列表成功','status'=>1,'data'=>$exams),JSON_UNESCAPED_UNICODE);
	}
 }else{
 	echo json_encode(array('message'=>'获取考试列表失败,请登录','status'=>-1),JSON_UNESCAPED_UNICODE);
 }




?>
