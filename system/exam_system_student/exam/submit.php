<?php
require_once "../db/connect_sql.php";

$db = new mysql();  
$link = $db->connect2(); 


session_start();

 if(isset( $_SESSION['studentNo'])){
 	$studentNo =  $_SESSION['studentNo'];
 	$judge_answer = $_POST['judge_answer'];			//判断题答案
	$select_answer = $_POST['select_answer'];		//选择题答案
	$insert_answer = $_POST['insert_answer'];		//填空题答案
	$exam_id = $_POST['exam_id'];					//exam_id

	$temp_sql = 'SELECT judge_list,select_list,insert_list,question_list,exam_id FROM exam_temp WHERE exam_id='.$exam_id.' AND studentNo='.$studentNo;
	$temp_result =  $db->fetchOne($temp_sql);
	if($temp_result === false){
		echo json_encode(array('message'=>'提交失败,请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		$save_exam = $db->insert(array('studentNo'=>$studentNo,'question_list'=>$temp_result['question_list'],'judge_answer'=>$judge_answer,'select_answer'=>$select_answer,'insert_answer'=>$insert_answer,'score'=>0,'exam_id'=>$exam_id,'judge_list'=>$temp_result['judge_list'],'select_list'=>$temp_result['select_list'],'insert_list'=>$temp_result['insert_list'],'checked'=>0),'exams',1);
		if($save_exam === false){
			echo json_encode(array('message'=>'提交失败（写入数据库失败）,请重试','status'=>-1),JSON_UNESCAPED_UNICODE);	
		}else{
			echo json_encode(array('message'=>'提交成功','status'=>1),JSON_UNESCAPED_UNICODE);			
		}
	}
 }else{
	echo json_encode(array('message'=>'暂存失败(未登录)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>