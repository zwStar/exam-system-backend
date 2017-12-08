<?php

require_once "../db/connect_sql.php";
 
 

session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	$answer = $_POST['answer'];
 	$grade = $_POST['grade'];
 	$options = $_POST['options'];
 	$question = $_POST['question'];
	$subject = $_POST['subject'];
	$type = $_POST['type'];

	$db = new mysql();  
	$link = $db->connect2();  

	$insert_result = $db->insert(array('teacherNo'=>$teacherNo,'subject'=>$subject,'grade'=>$grade,'question'=>$question,'type'=>$type,'answer'=>$answer,'options'=>$options),'question_bank');
if($insert_result === false){
	echo json_encode(array('message'=>'添加题目失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('message'=>'添加题目成功','status'=>1),JSON_UNESCAPED_UNICODE);
}

 }else{
 	echo json_encode(array('message'=>'添加题库失败','status'=>-1),JSON_UNESCAPED_UNICODE);
 }




?>
