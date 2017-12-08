<?php
require_once "../db/connect_sql.php";

// $studentNo = $_POST['studentNo'];

// $studentNo = '2015414239';
$db = new mysql();  
$link = $db->connect2(); 

$sql='SELECT * FROM submit WHERE studentNo = '.$studentNo;

$resultList = $db->fetchAll($sql);  

if($resultList == false){
	echo "查看成绩失败";
}else{
	$data = array('data' => $resultList);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
}

?>