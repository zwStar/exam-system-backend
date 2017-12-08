<?php

require_once "../db/connect_sql.php";

$db = new mysql();  
$link = $db->connect2();  

session_start();
 $studentNo =  $_SESSION['studentNo'];
 if(isset($studentNo)){
 	$judge_answer = $_POST['judge_answer'];			//判断题答案
	$select_answer = $_POST['select_answer'];		//选择题答案
	$insert_answer = $_POST['insert_answer'];		//填空题答案
	$exam_id = $_POST['exam_id'];
	$update_result = $db->update(array('judge_answer'=>$judge_answer,'select_answer'=>$select_answer,'insert_answer'=>$insert_answer),'exam_temp','studentNo ='.$studentNo .' AND exam_id ='.$exam_id);
	if($update_result === false){
		echo json_encode(array('message'=>'暂存失败，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'暂存成功','status'=>-1),JSON_UNESCAPED_UNICODE);
	}
 }else{
	echo json_encode(array('message'=>'暂存失败(未登录)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>	

