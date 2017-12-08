
<?php
// 添加教师php
require_once "../db/connect_sql.php";

session_start();
$teacherNo =  $_SESSION['teacherNo'];
if(isset($teacherNo)){
	$teacherNo = $_POST['teacherNo'];	//教师工号
	$password = md5($_POST['password']);			//密码  默认123456
	$gender = $_POST['gender'];			//年级
	$phone = $_POST['phone'];			//电话
	$name = $_POST['name'];				//姓名
	$subject = $_POST['subject'];		//科目
	$db = new mysql();  
	$link = $db->connect2();  

	$sql='SELECT * FROM teachers WHERE teacherNo = '.$teacherNo;  //先看该工号是否存在
	$rows = $db->fetchOne($sql);  
	if($rows == false){		//如果没有该工号 才进行注册
		$register_result = $db->insert(array('teacherNo'=>$teacherNo,'name' =>$name,'gender'=>$gender,'subject'=>$subject,'phone'=>$phone,'password'=>$password ),'teachers');
		if($register_result === false){
			echo json_encode(array('message'=>'添加教师失败','status'=>-1),JSON_UNESCAPED_UNICODE);
		}else{
			echo json_encode(array('message'=>'添加教师成功','status'=>1),JSON_UNESCAPED_UNICODE);
		}
	}else{
		echo json_encode(array('message'=>'该工号已经存在','status'=>-1),JSON_UNESCAPED_UNICODE);
	}
}else{
	echo json_encode(array('message'=>'添加教师失败,请登录后重试','status'=>-2),JSON_UNESCAPED_UNICODE);
}
?>
