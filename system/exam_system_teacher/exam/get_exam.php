<?php
require_once "../db/connect_sql.php";

$db = new mysql();  
$link = $db->connect2();  

$sql='SELECT * FROM test_arrange';  
$arrangeList = $db->fetchAll($sql);
echo json_encode($arrangeList);
?>

