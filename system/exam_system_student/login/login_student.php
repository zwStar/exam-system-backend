<?php

require_once "../db/connect_sql.php";

$studentNo = $_POST['studentNo'];
$password = md5($_POST['password']);

$db = new mysql();  
$link = $db->connect2(); 


/*
必须加 ""变成字符串
$sql = 'SELECT teacherNo,name,subject,password,phone FROM teachers WHERE password="'.$password.'"';	
*/
 $sql = 'SELECT studentNo,name FROM students WHERE studentNo="'.$studentNo.'" AND password="'.$password.'"';

$resultList = $db->fetchOne($sql);  

if($resultList === false){
		echo json_encode(array('message'=>'登录失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	session_start();
	$_SESSION['studentNo']=$studentNo;
	$data = array('data' => $resultList,'status'=>1,'message'=>'登录成功');
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
}


?>