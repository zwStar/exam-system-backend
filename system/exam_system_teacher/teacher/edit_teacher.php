<?php
// 编辑教师php
require_once "../db/connect_sql.php";
 
session_start();
 $teacherNo =  $_SESSION['teacherNo'];
 if(isset($teacherNo)){
 	$phone = $_POST['phone'];	//电话
	$subject = $_POST['subject'];	//科目
	$name = $_POST['name'];			//姓名
	$gender = $_POST['gender'];	    //性别
  	$teacherNo = $_POST['teacherNo'];	//修改教师的工号

	$db = new mysql();  
	$link = $db->connect2();  

	$sql = 'SELECT teacherNo from teachers WHERE teacherNo = '.$teacherNo;
	$teacher = $db->fetchOne($sql);
	if($teacher === false){
		echo json_encode(array('message'=>'修改教师失败，不存在该教师','status'=>-1),JSON_UNESCAPED_UNICODE);
	}else{
		$update_result =  $db->update(array('teacherNo'=>$teacherNo,'phone'=>$phone,'name'=>$name,'gender'=>$gender,'subject'=>$subject),'teachers', ' teacherNo = '.$teacherNo);
		if($update_result === false){
			echo json_encode(array('message'=>'修改教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
		}else{
			echo json_encode(array('message'=>'修改教师成功','status'=>1),JSON_UNESCAPED_UNICODE);
			
		}
	}
 }else{
 	echo json_encode(array('message'=>'修改教师失败,请登录','status'=>-2),JSON_UNESCAPED_UNICODE);
 }

?>
