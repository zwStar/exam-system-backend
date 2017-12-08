
<?php

require_once "../db/connect_sql.php";
 
session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	$score = $_POST['score'];
 	$id = $_POST['id'];
	$db = new mysql();  
	$link = $db->connect2();  

	$checkResult = $db->update(array('score'=>$score,'checked'=>1),'exams',' id= '.$id);
	if($checkResult !==false){
		echo json_encode(array('message'=>'批阅成绩成功','status'=>1),JSON_UNESCAPED_UNICODE);		
	}else{
		echo json_encode(array('message'=>'批阅成绩失败','status'=>-1),JSON_UNESCAPED_UNICODE);	
	}
 }else{
 	echo json_encode(array('message'=>'批阅成绩失败，请登陆','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>
