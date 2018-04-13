<?php
  
    function init_session(){
    	session_set_save_handler('sessBegin', 'sessEnd', 'sessRead', 'sessWrite', 'sessDel', 'sessGc');
		//设置垃圾回收的概率
		ini_set('session.gc_divisor',3);
		ini_set('session.gc_probability',1);
		session_start();
    }

    function getMysqli(){
    	$mysqli = new mysqli('120.24.59.131:3306','test','cl123456','msg');
    	$mysqli->query("set names utf8");
    	return $mysqli;
    }

	//session开启方法
    function sessBegin(){
	    	echo "session驱动为mysqli---开始启动<br />";

	}

	//session关闭方法
    function sessEnd(){
    	   echo  '关闭';
	}

	//session读取方法
	function sessRead($sess_id){
		   //echo "开始读取";
		   $mysqli = getMysqli();
		   $sql = "select sess_content from session where sess_id = '{$sess_id}'";
		   $res = $mysqli->query($sql);
		   //var_dump($res);
		   $data = $res->fetch_assoc();
		   //var_dump($data);
		   return $data['sess_content'];
       
	}

	//session写方法
	function sessWrite($sess_id,$sess_content){
		  //echo "开始存储<br />";
		  $mysqli = getMysqli();
		  $time = time();
		  $sql = "replace into session values('{$sess_id}','{$sess_content}',{$time})";
		  $res =  $mysqli->query($sql);
		  return $res;

	}

	//session销毁方法
	function sessDel($sess_id){
		//echo "开始销毁";
		$mysqli = getMysqli();
		$sql = "delete from session where sess_id = '{$sess_id}'";
        $res = $mysqli->query($sql);
        return $res;
        $_SESSON = array();
        setcookie("PHPSESSID",'');
	}

	//session垃圾处理方法(这个是自动执行 按照你设置的垃圾回收的机制的)
	function sessGc($maxLifetime){
		$mysqli = getMysqli();
		$time = time();
		$sql = "delete from session where last_write < {$time} - {$maxLifetime}";
		$res = $mysqli->query($sql);
		return $res;
	}
