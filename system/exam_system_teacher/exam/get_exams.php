<?php
// 获取所以试卷
require_once "../db/connect_sql.php";
 
session_start();
 
 if(isset($_SESSION['teacherNo'])){
 	$teacherNo =  $_SESSION['teacherNo'];
	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT studentNo,exam_id,score,checked FROM exams WHERE 1';	//获取试卷
	$fetch_result = $db->fetchAll($sql);
	if($fetch_result === false){
		echo json_encode(array('message'=>'获取成绩失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		foreach ($fetch_result as $key => $value) {	//获取年级和科目和考试时间
			$sql = 'SELECT grade,subject,examDay FROM exam_arrange WHERE id='.$value['exam_id'];
			$exam_info_result = $db->fetchOne($sql);
			if($exam_info_result !==false){
				$fetch_result[$key] = array_merge($fetch_result[$key],$exam_info_result);
			}else{
				echo json_encode(array('message'=>'获取成绩失败','status'=>-1),JSON_UNESCAPED_UNICODE);
			}
		}
		echo json_encode(array('message'=>'获取成绩成功','status'=>1,'data'=>$fetch_result),JSON_UNESCAPED_UNICODE);
		//echo json_encode(array('message'=>'添加题目成功','status'=>1),JSON_UNESCAPED_UNICODE);
	}
 }else{
 	echo json_encode(array('message'=>'获取成绩失败(session)','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>
