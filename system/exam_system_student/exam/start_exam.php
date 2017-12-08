<?php
//开始考试界面
require_once "../db/connect_sql.php";

$newArr =  array();
$i = 0;
function array_remove($data, $key){  
    if(!array_key_exists($key, $data)){  
        return $data;  
    }  
    $keys = array_keys($data);  
    $index = array_search($key, $keys);  
    if($index !== FALSE){  
        $GLOBALS['newArr'][$GLOBALS['i']++]=array_splice($data, $index, 1);  
    }  
    return $data;  
  
} 

session_start();

 if(isset( $_SESSION['studentNo'])){
 	$studentNo =  $_SESSION['studentNo'];	//学号
 	$id = $_GET['id'];		//获取id
 	$db = new mysql();  
	$link = $db->connect2();  
	$sql='SELECT * FROM exam_arrange WHERE id ='.$id;	
	$exam_arrange = $db->fetchOne($sql);	//获取该考试安排
	if($exam_arrange === false){	//考试不存在
		echo json_encode(array('message'=>'考试失败(该考试不存在)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		if(time() >= $exam_arrange['startTime'] && time() <= $exam_arrange['endTime']){			//判断当前是否考试时间
			$is_temp_sql = 'SELECT * FROM exam_temp WHERE studentNo ='.$studentNo.' AND exam_id='.$exam_arrange['id'];	//判断是否已经开始考试过
			$temp_result = $db->fetchOne($is_temp_sql);
			if($temp_result === false){			//第一次考试
				$judge_question_num = (int)$exam_arrange['judge_question_num'];			//判断题数量
				$select_question_num = (int)$exam_arrange['select_question_num'];		//选择题数量
				$insert_question_num = (int)$exam_arrange['insert_question_num'];		//填空题数量

				$question_array =  array();
				if($judge_question_num){		//获取判断题
					$sql = 'SELECT id,question FROM question_bank WHERE type=1 AND grade="'.$exam_arrange['grade'].'" AND subject = "'.$exam_arrange['subject'].'"  ORDER BY rand() LIMIT '.$judge_question_num;
					$judgeList = $db->fetchAll($sql);
					if($judgeList===false){
						echo json_encode(array('message'=>'考试失败(获取判断题题)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
					}else{
						$question_array['judgeList'] =  $judgeList;
					}
				}

				if($select_question_num){
					//获取选择题
					 $sql = 'SELECT id,question,options FROM question_bank WHERE type=2 AND grade="'.$exam_arrange['grade'].'" AND subject = "'.$exam_arrange['subject'].'"  ORDER BY rand() LIMIT '.$select_question_num;
					 $selectList = $db->fetchAll($sql);

					if($selectList===false){
						echo json_encode(array('message'=>'考试失败(获取选择题)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
					}else{
						$question_array['selectList'] =  $selectList;
					}
				}
				if($insert_question_num){
					//获取填空题
					$sql = 'SELECT id,question FROM question_bank WHERE type=3 AND grade="'.$exam_arrange['grade'].'" AND subject = "'.$exam_arrange['subject'].'"  ORDER BY rand() LIMIT '.$insert_question_num;
					$insertList = $db->fetchAll($sql);

					if($insertList===false){
						echo json_encode(array('message'=>'考试失败(获取选择题)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
					}else{
						$question_array['insertList'] =  $insertList;
					}
				}
				// echo json_encode(array('message'=>'考试开始成功','status'=>1,'data'=>$question_array),JSON_UNESCAPED_UNICODE);
				$judge_list = array();
				foreach ($judgeList as $key => $value) {
					array_push($judge_list, $value['id']);
				}

				$select_list = array();
				foreach ($selectList as $key => $value) {
					array_push($select_list, $value['id']);
				}

				$insert_list = array();
				foreach ($insertList as $key => $value) {
					array_push($insert_list, $value['id']);
				}
				$judge_str =  implode(',', $judge_list);
				$select_str =  implode(',', $select_list);
				$insert_str =  implode(',', $insert_list);

				// echo  json_encode($judge_list,JSON_UNESCAPED_UNICODE). '    ';
				//echo $judge_list;
			

				$insert_temp_result =$db->insert(array('exam_id'=>$exam_arrange['id'],'studentNo'=>$studentNo,'judge_answer'=>'','select_answer'=>'','insert_answer'=>'','question_list'=> json_encode($question_array,JSON_UNESCAPED_UNICODE),'judge_list'=>$judge_str,'select_list'=>$select_str,'insert_list'=>$insert_str),'exam_temp');
				if($insert_temp_result == false){
					echo json_encode(array('message'=>'考试失败(保存题目)，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
				}else{
					$question_array['exam_id'] =  $exam_arrange['id'];
					echo json_encode(array('message'=>'考试开始成功','status'=>1,'data'=>$question_array),JSON_UNESCAPED_UNICODE);
				}
			}else{
				$temp_result['exam_id'] =  $exam_arrange['id'];
				echo json_encode(array('message'=>'重新加载成功','status'=>2,'data'=>$temp_result),JSON_UNESCAPED_UNICODE);
			}

			
		}else{
			echo json_encode(array('message'=>'考试失败，请重试','status'=>-1),JSON_UNESCAPED_UNICODE);
		}
	}
 }else{
	echo json_encode(array('message'=>'考试失败(请重新登录)，请重试','status'=>-2),JSON_UNESCAPED_UNICODE);
 }





/*

$answer = json_encode(array('answer' => $newArr),JSON_UNESCAPED_UNICODE);

*/

?>	

