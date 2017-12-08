
<?php  


$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';   

$allow_origin = array(    
    'http://127.0.0.1:8888',    
    'http://127.0.0.1:8080'   
);    
     
if(in_array($origin, $allow_origin)){    
    header('Access-Control-Allow-Origin:'.$origin);    
	header("Content-type: text/html; charset=utf-8");  
	header("Access-Control-Allow-Headers:Content-Type, Authorization, X-Requested-With");
	header("Access-Control-Allow-Credentials:true"); //可以带cookies 
	header("Access-Control-Request-Method:GET,POST"); 
	if(strtoupper($_SERVER['REQUEST_METHOD'])== 'OPTIONS'){ 
		exit; 
	}
} 

class mysql{  
    /** 
     * 连接MYSQL函数 
     * 连接MYSQL函数,通过常量的形式来连接数据库 
     * 自定义配置文件，配置文件中自定义常量，包含需要使用的信息 
     * @return resource 
     */  
    function connect2 (){   
        //连接mysql  
        $link=@mysql_connect('127.0.0.1','root','') or die ('数据库连接失败<br/>ERROR '.mysql_errno().':'.mysql_error());  
        //设置字符集  
        mysql_set_charset('UTF8');
        //打开指定的数据库  
        mysql_select_db('exam_system') or die('指定的数据库打开失败');  
        return $link;  
    } 
      
      
      
    /* array( 
    'username'=>'cy', 
    'password'=>'123456', 
    'email'=>'cy@qq.com' 
    ) */  
      
    /** 
     * 插入记录的操作 
     * @param array $array 
     * @param string $table 
     * @return boolean 
     */  
    function insert($array,$table){  

        $keys=join(',',array_keys($array));  
        $values="'".join("','", array_values($array))."'";  
        $sql="insert {$table}({$keys}) VALUES ({$values})";
        $res=mysql_query($sql);  
        if($res){  
            return mysql_insert_id();  
        }else{  
            return false;  
        }  
    }  
      
      
    /** 
     * MYSQL更新操作 
     * @param array $array 
     * @param string $table 
     * @param string $where 
     * @return number|boolean 
     */  
    function update($array,$table,$where=null){
    	$sets = '';
        foreach ($array as $key=>$val){  
            $sets.=$key."='".$val."',";  
        }  
        $sets=rtrim($sets,','); //去掉SQL里的最后一个逗号  
        $where=$where==null?'':' WHERE '.$where;  
        $sql="UPDATE {$table} SET {$sets} {$where}"; 
        $res=mysql_query($sql);  
        if ($res){  
            return mysql_affected_rows();  
        }else {  
            return false;  
        }  
    }  
      
      
    /** 
     * 删除记录的操作 
     * @param string $table 
     * @param string $where 
     * @return number|boolean 
     */  
    function delete($table,$where=null){  
        $where=$where==null?'':' WHERE '.$where;  
        $sql="DELETE FROM {$table}{$where}";  
        $res=mysql_query($sql);  
        if ($res){  
            return mysql_affected_rows();  
        }else {  
            return false;  
        }  
    }  
      
      
      
    /** 
     * 查询一条记录 
     * @param string $sql 
     * @param string $result_type 
     * @return boolean 
     */  
    function fetchOne($sql,$result_type=MYSQL_ASSOC){  
        $result=mysql_query($sql);  
        if ($result && mysql_num_rows($result)>0){  
            return mysql_fetch_array($result,$result_type);  
        }else {  
            return false;  
        }  
    }  
      
      
      
      
      
    /** 
     * 得到表中的所有记录 
     * @param string $sql 
     * @param string $result_type 
     * @return boolean 
     */  
    function fetchAll($sql,$result_type=MYSQL_ASSOC){  
        $result=mysql_query($sql);  
        if ($result && mysql_num_rows($result)>0){  
            while ($row=mysql_fetch_array($result,$result_type)){  
                $rows[]=$row;  
            }  
            return $rows;  
        }else {  
            return false;  
        }  
    }  
      
      
    /**取得结果集中的记录的条数 
     * @param string $sql 
     * @return number|boolean 
     */  
    function getTotalRows($sql){  
        $result=mysql_query($sql);  
        if($result){  
            return mysql_num_rows($result);  
        }else {  
            return false;  
        }  
          
    }  
      
    /**释放结果集 
     * @param resource $result 
     * @return boolean 
     */  
    function  freeResult($result){  
        return  mysql_free_result($result);  
    }  
      
      
      
    /**断开MYSQL 
     * @param resource $link 
     * @return boolean 
     */  
    function close($link=null){  
        return mysql_close($link);  
    }  
      
      
    /**得到客户端的信息 
     * @return string 
     */  
    function getClintInfo(){  
        return mysql_get_client_info();  
    }  
      
      
    /**得到MYSQL服务器端的信息 
     * @return string 
     */  
    function getServerInfo($link=null){  
        return mysql_get_server_info($link);  
    }  
      
      
      
    /**得到主机的信息 
     * @return string 
     */  
    function getHostInfo($link=null){  
        return mysql_get_host_info($link);  
    }  
      
    /**得到协议信息 
     * @return string 
    */  
    function getProtoInfo($link=null){  
        return mysql_get_proto_info($link);  
    }  
}  
?>  