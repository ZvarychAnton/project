<?php
    class Nothing{
		public static $dblink;
		protected static $connectionErrorText = "non error!!!";
		
		protected static function setconnectionErrorText($text){
			self::$connectionErrorText = $text;
		}
		protected static function getconnectionErrorText(){
			return self::$connectionErrorText;
		}		
		public function connectionError(){
		    return self::getconnectionErrorText();
		}
		public static function connect(){
			try {
				$conn = new PDO('mysql:host=localhost;dbname=project', 'root', 'Vt#kZ0b1');
				$conn->exec("SET NAMES 'utf8'");
				$conn->exec("SET CHARACTER SET 'utf8'");
				$conn->exec("SET SESSION collation_connection = 'utf8_general_ci'");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				self::$dblink = $conn;
			} 
			catch(PDOException $e) {
				$e->getMessage();
				self::setconnectionErrorText($e);			
				return FALSE;				
			}
			return TRUE;	
		}
		public static function select($query,$array){
			try {
				$stmt = self::$dblink->prepare($query);
				$stmt->execute($array);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
			}catch(PDOException $e) {
				$e->getMessage();
				self::setconnectionErrorText($e);			
				return FALSE;	
			}	
			return $stmt;
		}
		public static function insert($query,$array){
			try {
				$stmt = self::$dblink->prepare($query);
				$stmt->execute($array);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
			}catch(PDOException $e) {
				$e->getMessage();
				self::setconnectionErrorText($e);			
				return FALSE;	
			}	
			return TRUE;
		}
		public static function update($query,$array){
			try {
				$stmt = self::$dblink->prepare($query);
				$stmt->execute($array);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
			}catch(PDOException $e) {
				$e->getMessage();
				self::setconnectionErrorText($e);			
				return FALSE;	
			}	
			return TRUE;
		}
		public static function delete($query,$array){
			try {
				$stmt = self::$dblink->prepare($query);
				$stmt->execute($array);
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
			}catch(PDOException $e) {
				$e->getMessage();
				self::setconnectionErrorText($e);			
				return FALSE;	
			}	
			return TRUE;
		}
		public static function close(){
			$conn = NULL;
		}
	}
	
	function nothingConnect(){
		if(!Nothing::connect()){echo Nothing::connectionError();};
	};
	function nothingSelect($query,$array){
		$stmt = Nothing::select($query,$array); 
		if(!$stmt){echo Nothing::connectionError();};
			return $stmt;
	};
	function nothingInsert($query,$array){
		if(!Nothing::insert($query,$array)){echo Nothing::connectionError();};
	};
	function nothingUpdate($query,$array){
		if(!Nothing::update($query,$array)){echo Nothing::connectionError();};
	};
	function nothingDelete($query,$array){
		if(!Nothing::delete($query,$array)){echo Nothing::connectionError();};
	};
	function nothingClose(){
		Nothing::close();
	};
	
	
?>