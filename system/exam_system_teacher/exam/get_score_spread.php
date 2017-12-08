<?php
// 根据某次考试获取考生成绩分布

require_once "../db/connect_sql.php";
 

session_start();

if(isset($_SESSION['teacherNo'])){
    $teacherNo =  $_SESSION['teacherNo'];
 	$exam_id = $_GET['exam_id'];
	$db = new mysql();  
	$link = $db->connect2();  

	$exam_sql = 'SELECT score,studentNo from exams WHERE exam_id='.$exam_id .' AND checked = 1';
	$exams = $db->fetchAll($exam_sql);
	if($exams===false){
		echo json_encode(array('message'=>'获取成绩列表失败','status'=>-1),JSON_UNESCAPED_UNICODE);	
	}else{
		echo json_encode(array('message'=>'获取成绩列表成功','status'=>1,'data'=>$exams),JSON_UNESCAPED_UNICODE);
	}
 }else{
 	echo json_encode(array('message'=>'获取成绩列表失败,请登录','status'=>-2),JSON_UNESCAPED_UNICODE);
 }




?>
