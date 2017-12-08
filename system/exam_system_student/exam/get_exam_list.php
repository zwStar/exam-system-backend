<?php

require_once "../db/connect_sql.php";
 

session_start();

 if(isset( $_SESSION['studentNo'])){
	$studentNo =  $_SESSION['studentNo'];
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
		$result_data  = array();
		$i = 0;
		foreach ($exams as $key => $value) {
		
			$sql = 'SELECT checked FROM exams WHERE studentNo='.$studentNo.' AND  exam_id ='.$value['id'];
			$is_submit =  $db->fetchOne($sql);
			if($is_submit !==false){
				$submit = array('submit'=>true);
				$value = array_merge($value,$submit);
				$result_data[$i++] = $value;
			}else{
				$submit = array('submit'=>false);
				$value = array_merge($value,$submit);
				$result_data[$i++] = $value;
			}
		}
		echo json_encode(array('message'=>'获取考试列表成功','status'=>1,'data'=>$result_data),JSON_UNESCAPED_UNICODE);
	}
}
 }else{
 	echo json_encode(array('message'=>'获取考试列表失败,请登录','status'=>-2),JSON_UNESCAPED_UNICODE);
 }




?>
