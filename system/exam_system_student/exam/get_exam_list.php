<?php

require_once "../db/connect_sql.php";
 

session_start();
 $studentNo =  $_SESSION['studentNo'];
 if(isset($studentNo)){
 	
	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT studentNo,name,grade,classNo,gender from students WHERE studentNo = '.$studentNo;
	$students = $db->fetchOne($sql);
if($students === false){
	echo json_encode(array('message'=>'获取考试列表失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	$exam_sql = 'SELECT id,grade,classNo,subject,startTime,endTime,examDay from exam_arrange WHERE grade ="'.$students['grade'].'" AND classNo ='.$students['classNo'];
	$exams = $db->fetchAll($exam_sql);
	if($exams===false){
		echo json_encode(array('message'=>'获取考试列表失败','status'=>-1),JSON_UNESCAPED_UNICODE);	
	}else{
		echo json_encode(array('message'=>'获取考试列表成功','status'=>1,'data'=>$exams),JSON_UNESCAPED_UNICODE);
	}
}
 }else{
 	echo json_encode(array('message'=>'获取考试列表失败,请登录','status'=>-1),JSON_UNESCAPED_UNICODE);
 }




?>
