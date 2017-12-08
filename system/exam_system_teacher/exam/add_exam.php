<?php

require_once "../db/connect_sql.php";
 
session_start();


if(isset($_SESSION['teacherNo'])){
	 $teacherNo =  $_SESSION['teacherNo'];
	$academic_year = $_POST['academic_year'];	//学年
	$grade = $_POST['grade'];	//年级
	$subject = $_POST['subject'];	//科目
	$classNo = $_POST['classNo'];		//班级
	$examDay = $_POST['examDay'];		//考试时间
	$startTime = $_POST['startTime'];	//考试开始时间
	$endTime = $_POST['endTime'];		//考试结束时间
	$judge_question_num  =  $_POST['judge_question_num'];	//判断题数量
	$select_question_num  = $_POST['select_question_num'];	//选择题数量
	$insert_question_num  = $_POST['insert_question_num'];	//填空题数量
	$judge_question_score = $_POST['judge_question_score']; //判断题分值
	$select_question_score= $_POST['select_question_score'];//选择题分值
	$insert_question_score= $_POST['insert_question_score'];//填空题分值*/

	$db =  new mysql();  
	$link = $db->connect2();  

	$insert_result = $db->insert(array('academic_year'=>$academic_year,'grade'=>$grade,'subject'=>$subject,'classNo'=>$classNo,'examDay'=>$examDay,'teacherNo'=>$teacherNo,'startTime'=>$startTime,'endTime'=>$endTime,'judge_question_num'=>$judge_question_num,'select_question_num'=>$select_question_num,'insert_question_num'=>$insert_question_num,'judge_question_score'=>$judge_question_score,'select_question_score'=>$select_question_score,'insert_question_score'=>$insert_question_score),'exam_arrange');
	if($insert_result ===false){
		echo json_encode(array('message'=>'安排考试失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'安排考试成功','status'=>1),JSON_UNESCAPED_UNICODE);
	}
}else{
	echo json_encode(array('message'=>'安排考试失败,请登录','status'=>-1),JSON_UNESCAPED_UNICODE);
}

?>

