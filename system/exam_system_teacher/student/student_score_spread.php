<?php
require_once "../db/connect_sql.php";

$db = new mysql();  
$link = $db->connect2(); 


session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
	$subject = $_GET['subject'];
	$studentNo = $_GET['studentNo'];					//exam_id

	$sql = 'SELECT grade,classNo FROM students WHERE studentNo = '.$studentNo;
	$find_student_result = $db->fetchOne($sql);
	if($find_student_result !== false){
		$sql = 'SELECT id FROM exam_arrange WHERE grade="'.$find_student_result['grade'].'" AND classNo = "'.$find_student_result['classNo'].'" AND subject = "'.$subject.'"';
		$find_exam_id = $db->fetchAll($sql);
		if($find_exam_id !==false){
			$score_arr = array();
			$i = 0;
			foreach ($find_exam_id as $key => $value) {
				$sql = 'SELECT score FROM submit WHERE exam_id='.$value['id'].' AND checked=1';
				$score_result = $db->fetchOne($sql);
				if($score_result == false){
				}else{
					array_push($score_arr, $score_result['score']);
				}
			}
			echo json_encode(array('message'=>'查询成功','status'=>1,'data'=>$score_arr),JSON_UNESCAPED_UNICODE);
			
		}else{
			echo json_encode(array('message'=>'查询失败，请重试','status'=>1,'data'=>$find_exam_id),JSON_UNESCAPED_UNICODE);	
		}
	}else{
		echo json_encode(array('message'=>'查询失败(找不到该学生)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
	}

 }else{
	echo json_encode(array('message'=>'暂存失败(未登录)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
 }

?>