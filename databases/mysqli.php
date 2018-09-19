<?php
	$mysql_link = '';

	// Устанавливает соединение с базой. В случае ошибки выводится уведомление.
	function db_connect($db_host, $db_login, $db_password) {
		global $mysql_link;

		$mysql_link = mysqli_connect($db_host, $db_login, $db_password);

		if (!$mysql_link) {
			echo "<br>
					<center style='font-family: Verdana; font-size: 12px;'>
						Error in connecting to database server.<br>
						Auto reload in&nbsp;<span id='reloadTime'></span>&nbsp;seconds<br>
						<a href='' onClick='window.location.reload(); return false;' style='color: black;'>Reload Now</a><br>
						
					</center>
					<script language='JavaScript'>
						var secondsRemain = 60;
						function deferedReload() {
							if (secondsRemain == 0)
								window.location.reload();
							else {
								window.document.all['reloadTime'].innerText = secondsRemain;
								secondsRemain--;
							}
						}
						deferedReload();
						window.setInterval('deferedReload()', 1000);
					</script>
				<br>";
			exit();
			// echo "<br><b>Error #: </b>" . db_errno() . "<br>";
			// echo "<br><b>Error message: </b>" . db_error() . "<br>";
		} else {
			$query = 'SET NAMES utf8';
			db_query($query);
			date_default_timezone_set("Asia/Almaty");
			db_query("SET SESSION time_zone = '+3:00'");
		}
	}

	function db_select_db($db_name) {
		global $mysql_link;

		if (!mysqli_select_db($mysql_link, $db_name)) {
			echo "<br><b>Error in selecting database</b><br>";
			echo "<br><b>Error #: </b>" . db_errno() . "<br>";
			echo "<br><b>Error message: </b>" . db_error() . "<br>";
			exit;
		}
	}

	function db_query($query, $hide_errors = true) {
		//echo "<hr>".$query.";<br>";
		global $_debug, $mysql_link;
		
		if (!$result = mysqli_query($mysql_link, $query)) {
			if (!$hide_errors) {
				echo '<small><br><b>'.$query.'</b><br>';
				echo '<br><b>Error in executing query</b><br>';
				echo '<br><b>Error #: </b>'.db_errno().'<br>';
				echo '<br><b>Error message: </b>'.db_error().'<br></small>';
			}
			
			return false;
		} else {
			if (isset($_debug)) $_debug->sql_log($query);
			return $result;
		}
	}

	function db_table_count($table, $where) {
		global $mysql_link;

		if (!empty($where)) $sql = "SELECT COUNT(*) FROM ".$table." WHERE ".$where; 
			else $sql = "SELECT COUNT(*) FROM ".$table;
		 
		if (!$result = mysqli_query($mysql_link, $sql)) {  
			return -1;
		} else {
			$count = mysqli_fetch_array($result);
			return $count[0];
		}
	}

	function db_errno() {
		global $mysql_link;

		return mysqli_errno($mysql_link);
	}

	function db_error() {
		global $mysql_link;

		return mysqli_error($mysql_link);
	}

	function db_num_rows($result) {  
		if ($result) {
			return mysqli_num_rows($result);
		}
	}

	function db_num_fields($result) {
		return mysqli_num_fields($result);
	}

	function db_fetch_object($result) {
		return mysqli_fetch_object($result);
	}

	function db_fetch_array($result) {
		return mysqli_fetch_array($result);
	}

	function db_insert_id() {
		global $mysql_link;
		
		return mysqli_insert_id($mysql_link);
	}

	function db_list_tables() {
		$tableList = array();
  		$res = db_query("SHOW TABLES");
  		
  		while ($cRow = db_fetch_array($res)) {
    		$tableList[] = $cRow[0];
  		}
  		
  		return $tableList;
		//return mysqli_list_tables(DB_NAME);
	}

	function db_list_fields($tableName) {
		return mysqli_list_fields(DB_NAME, $tableName);
	}

	function db_field_name($result, $i) {
		$field = mysqli_fetch_field_direct($result, $i);
		return $field->name;
	}

	function db_field_type($result, $i) {
		return mysqli_field_type($result, $i);
	}

	function db_tablename($result, $i) {
		return mysqli_tablename($result, $i);
	}

	function db_affected_rows() {
		global $mysql_link;
		
		return mysqli_affected_rows($mysql_link);
	}

	function db_free_result($result){
		return mysqli_free_result($result);
	}

	function db_table_exists($tablename) {
		$result = db_query("SHOW TABLES");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				if ($row[0] == $tablename) {
					return true;
				}
			}
			
		}
		
		return false;
	}

	function db_field_exists($tableName, $fieldName) {
		$result = mysqli_query("DESCRIBE ".$tableName." ".$fieldName);
		if (mysqli_num_rows($result) > 0) 
			return 1;
		 else 
		 	return 0;
	}

	function db_get_data($sql, $field = '') {
		$result = db_query($sql);
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			db_free_result($result);
			if ($field == '') return $row; else	return $row[$field];
		}
		return false;
	}

	function db_get_array($sql, $field1, $field2 = '') {
		$records = array();
		$result = db_query($sql);
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				if ($field1 && $field2 && isset($row[$field1]) && isset($row[$field2])) $records[$row[$field1]] = $row[$field2];
					else $records[] = $row[$field1];
			}
			
			db_free_result($result);
		}
		return $records;
	}

	function db_sql_where($param_array, $operand) {
		$condition_array = array();
		foreach ($param_array as $param) {
			if ($param != '') $condition_array[] = $param;
		}
		
		$sql = implode(" ".$operand." ", $condition_array);
		// if ($sql != '') $sql = ' WHERE '.$sql;
		
		return $sql;
	}

	function db_check_connection($db_host, $db_login, $db_password, $db_name) {
		if (!$result = mysqli_connect($db_host, $db_login, $db_password)) {
			return -1;
		} else {
			if (!mysqli_select_db($db_name)) return -2;
			mysqli_close($result);
		}
		
		return 0;
	}
	
	function db_query_ex($query) {
		global $SQL_LOG;
		
		if (!$result = mysqli_query($query)) {
			return false;
		} else {
			if (CONFIG_SQL_LOGGING) {
				$SQL_LOG[] = array("time" => date("H:i:s"), "query" => $query);
			}
			
			return $result;
		}
	}

	function db_real_escape_string($str) {
		global $mysql_link;

		return mysqli_real_escape_string($mysql_link, $str);
	}
?>