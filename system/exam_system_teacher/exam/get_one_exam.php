
<?php

require_once "../db/connect_sql.php";
 
session_start();

if(isset($_SESSION['teacherNo'])){
	$teacherNo =  $_SESSION['teacherNo'];
	$studentNo = $_GET['studentNo'];
	$id = $_GET['id'];		//得到该试卷id

	$db =  new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT * FROM exams WHERE exam_id='.$id .' AND studentNo='.$studentNo;	
	$exam_result = $db->fetchOne($sql);

	$arr_answer = array();
	$arr_answer['real_judge_answer'] = array();
	$arr_answer['real_select_answer'] = array();
	$arr_answer['real_insert_answer'] = array();
	if($exam_result!==false){
		$judge_list = explode(',',$exam_result['judge_list']);
		$select_list = explode(',', $exam_result['select_list']);
		$insert_list = explode(',', $exam_result['insert_list']);


		foreach ($judge_list as $key => $value) {	//找答案
		
			$judge_answer_sql = 'SELECT answer FROM question_bank WHERE id='.$value;
			$judge_result = $db->fetchOne($judge_answer_sql);
			
			if($judge_result!==false){
				array_push($arr_answer['real_judge_answer'], $judge_result['answer']);
			}else{
				echo json_encode(array('message'=>'批阅试卷失败(获取选择题答案失败)','status'=>-1),JSON_UNESCAPED_UNICODE);			
			}
		}
		foreach ($select_list as $key => $value) {
			$select_answer_sql = 'SELECT answer FROM question_bank WHERE id='.$value;
			$select_result = $db->fetchOne($select_answer_sql);
			if($select_result!==false){
				array_push($arr_answer['real_select_answer'], $select_result['answer']);
			}else{
				echo json_encode(array('message'=>'批阅试卷失败(获取选择题答案失败)','status'=>-1),JSON_UNESCAPED_UNICODE);			
			}
		}
		foreach ($insert_list as $key => $value) {
			$insert_answer_sql = 'SELECT answer FROM question_bank WHERE id='.$value;
			$insert_result = $db->fetchOne($insert_answer_sql);
			if($insert_result!==false){
				array_push($arr_answer['real_insert_answer'], $insert_result['answer']);
			}else{
				echo json_encode(array('message'=>'批阅试卷失败(获取填空题答案失败)','status'=>-1),JSON_UNESCAPED_UNICODE);			
			}
		}


		//获取各题分值
		$sql = 'SELECT judge_question_num,select_question_num,insert_question_num,judge_question_score,select_question_score,insert_question_score FROM exam_arrange WHERE id='.$id;
		$arrange_result = $db->fetchOne($sql);
		if($arrange_result !== false){
			$arr_answer = array_merge($arr_answer,$exam_result);
			$arr_answer = array_merge($arr_answer,$arrange_result);
			echo json_encode(array('message'=>'获取批阅试卷成功','status'=>1,'data'=>$arr_answer),JSON_UNESCAPED_UNICODE);		
		}else{
			echo json_encode(array('message'=>'批阅试卷失败(arrange_result)','status'=>-1),JSON_UNESCAPED_UNICODE);	
		}
		
	}else{
		echo json_encode(array('message'=>'批阅试卷失败','status'=>-1),JSON_UNESCAPED_UNICODE);	
	}
}else{
	echo json_encode(array('message'=>'批阅试卷失败,请登录','status'=>-2),JSON_UNESCAPED_UNICODE);
}

?>

