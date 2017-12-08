<?php

include "../db/connect_sql.php";

$teacherNo = $_POST['teacherNo'];
$password = md5($_POST['password']);

$db = new mysql();  
$link = $db->connect2(); 


/*
必须加 ""变成字符串
$sql = 'SELECT teacherNo,name,subject,password,phone FROM teachers WHERE password="'.$password.'"';	
*/
 $sql = 'SELECT teacherNo,name FROM teachers WHERE teacherNo="'.$teacherNo.'" AND password="'.$password.'"';

$resultList = $db->fetchOne($sql);  

if($resultList === false){
		echo json_encode(array('message'=>'登录失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	session_start();
	$_SESSION['teacherNo']=$teacherNo;
	$data = array('data' => $resultList,'status'=>1,'message'=>'登录成功');
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
}


?>