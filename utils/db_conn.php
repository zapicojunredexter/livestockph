<?php
	function connect(){
		global $dbconn;
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "livestockph";
		try{
			$dbconn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		}catch(PDOException $e){
			echo 'Connection Error :'.$e->getMessage();
		}
	}
	
	function getRecords($sql){
		global $dbconn;
		connect();
		try{
			$stmt=$dbconn->prepare($sql);
			$stmt->execute();
			$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$dbconn=null;
			
		}catch(PDOException $e){ 
			echo 'SQL Error : '.$e->getMessage();
		}
		return $rows;
	}

	function getRecord($sql){
		global $dbconn;
		connect();
		try{
			$stmt=$dbconn->prepare($sql);
			$stmt->execute();
			$rows=$stmt->fetch(PDO::FETCH_ASSOC);
			$dbconn=null;
			
		}catch(PDOException $e){ 
			echo 'SQL Error : '.$e->getMessage();
		}
		return $rows;
	}
	
	function setRecord($sql){
		global $dbconn;
		connect();
		try{
			$stmt=$dbconn->prepare($sql);
			$stmt->execute();
			$id = $dbconn->lastInsertId();
			$dbconn=null;
			return $id;
		}
		catch(PDOException $e){
			echo 'Update Error :'.$e->getMessage();

		}
	}
	
?>