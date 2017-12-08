<?php
//获取一个人的成绩
require_once "../db/connect_sql.php";

$db = new mysql();  
$link = $db->connect2(); 


session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
	$subject = $_GET['subject'];
	$studentNo = $_GET['studentNo'];

	$sql = 'SELECT exam_id,score FROM exams WHERE checked=1 AND studentNo='.$studentNo;
	$score_spread_result =  $db->fetchAll($sql);
	if($score_spread_result === false){
		echo json_encode(array('message'=>'获取分数失败,请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		$array_result = array();
		foreach ($score_spread_result as $key => $value) {
			$sql = 'SELECT * FROM exam_arrange WHERE id='.$value['exam_id'].' AND subject="'.$subject.'"';
			$result = $db->fetchOne($sql);
			if($result !==false){
				array_push($array_result, $value['exam_id']);
			}
			echo json_encode(array('message'=>'获取分数成功','status'=>1,'data'=>$array_result),JSON_UNESCAPED_UNICODE);
		}
	}
 }else{
	echo json_encode(array('message'=>'获取分数失败(未登录)，请重试','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>