<?php

require_once "../db/connect_sql.php";

$studentNo = $_POST['studentNo'];
$password = md5('123456');
$grade = $_POST['grade'];
$classNo = $_POST['classNo'];
$name = $_POST['name'];
$gender = $_POST['gender'];


$db = new mysql();  
$link = $db->connect2();  

$sql='SELECT * FROM students WHERE studentNo = '.$studentNo;  

$rows = $db->fetchOne($sql);	//查看该学号是否已经存在  

if($rows === false){
	$insert_result = $db->insert(array('studentNo'=>$studentNo,'password'=>$password,'grade'=>$grade,'classNo'=>$classNo,'name'=>$name,'gender'=>$gender),'students');
	if($insert_result ===false){
		echo json_encode(array('message'=>'添加学生失败','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('message'=>'添加学生成功','status'=>1),JSON_UNESCAPED_UNICODE);
	}
}else{
	echo json_encode(array('message'=>'该学号已经存在','status'=>-1),JSON_UNESCAPED_UNICODE);
}

?>