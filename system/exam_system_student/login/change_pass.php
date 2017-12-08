<?php

require_once "../db/connect_sql.php";
 

session_start();
 $studentNo =  $_SESSION['studentNo'];
 if(isset($studentNo)){
 	$password = md5($_POST['password']);

	$db = new mysql();  
	$link = $db->connect2();  
	$checkResult = $db->update(array('password'=>$password),'students',' studentNo= '.$studentNo);
	
if($checkResult === false){
	echo json_encode(array('message'=>'更改密码失败','status'=>-1),JSON_UNESCAPED_UNICODE);
}else{
	echo json_encode(array('message'=>'更改密码成功','status'=>1),JSON_UNESCAPED_UNICODE);
}
 }else{
 	echo json_encode(array('message'=>'更改密码失败,请先登录','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>
