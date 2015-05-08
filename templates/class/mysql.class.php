<?php
header("Content-Type: text/html;charset=utf-8"); 
class mysql{
	var $_sql='';//定义一个用于存储SQL语句的变量
	var $_prefix='';//定义一个用于存储表名称前缀的变量
	var $_errno=0;//定义存储错误代码的变量
	var $_error='';//定义存储错误信息的变量
	var $_conn = '';//定义用于存储链接的变量
	var $_result='';//定义用于存储结果集的变量
	/**
	* 实现数据链接的方法.
	* 参数包括数据库服务器的地址、用户名、密码、使用的字符集、要操作的数据库名称、表名称前缀。
	* 参数默认值为空
	*/
	function mysql($host,$user,$pass,$db,$setchar,$prefix){
		//检查当前系统是否开启mysql运行，如果没有开启mysql运行，结束脚本运行，并显示提示信息
		if(!function_exists('mysql_connect')){
			echo "当前系统没有开启MYSQL运行，请检查相关设置!";
			//结束脚本
			exit();
		}
		//链接数据库,失败时结束脚本,并显示错误信息
		$this->_conn = mysql_connect($host,$user,$pass) or die("链接服务器的失败,请检查相关链接参数");
		//选择数据库,失败时结束脚本,并显示错误信息
		if (!mysql_select_db($db)){
			echo "设置活动数据库失败,请检查数据名称是否正确";
			//结束脚本
			exit();
		}
		//设置字符集
		if($setchar != ""){
			//设置SQL语句
			$this->setSql("SET NAMES ".$setchar);
			//运行SQL语句
			$this->query();
		}
		//设置表名称前缀
		$this->_prefix = $prefix;
		
	}	
	/**
	* 替换SQL语句中的表前缀,并返回处理好的SQL语句
	* $sql 要处理的SQL语句
	* $prefix 默认的表名称前缀替换符号
	*/
	function setSql($sql,$prefix='l' ){
		//去掉两边的空格
	    $sql = trim( $sql );
	    //把SQL语句中的符号,替换成指定的表名称前缀
	    $sql = str_replace($prefix,$this->_prefix,$sql);
	    //设置类属性$_sql的值
		$this->_sql = $sql;
	}
	/**
	* 返回设置好的SQL语句
	*/
	function getSql(){
		return "<pre>".htmlspecialchars($this->_sql). "</pre>";
	}
	/**
	* 运行SQL语句
	*/
	function query() {
		//初始化错误信息变量		
		$this->_errno = 0;
		$this->_error = '';
		//运行设置好的SQL语句,并把返回值赋于类属性$_result
		$this->_result = mysql_query($this->_sql,$this->_conn);
		//如果运行的SQL语句出错,显示错误信息
		if (!$this->_result){
			//使用mysql_errno()函数取得指定链接错误代码
			$this->_errno = mysql_errno($this->_conn);
			//使用mysql_error()函数取得指定链接错误信息
			$this->_error = mysql_error($this->_conn);
			return false;
		}
		//返回结果
		return $this->_result;
	}

	/**
	* 返回结果集中的记录数
	*/
	function getLines( $result=null ){
		//如果指定的参数不为空,返回其记录数,如果为空,返回类属性指定的结果集中的记录数
		return mysql_num_rows( $result ? $result : $this->_result);
	}
	/**
	* 以数字做为键名,返回一个数组
	*/
	function loadRow(){
		//检测运行SQL语句,如果返回结果集失败,返回一个NULL值.
		if (!($result = $this->query())) {
			return null;
		}
		$reResult = null;
		if($row = mysql_fetch_row($result)){
			$reResult = $row;
		}
		//释放资源
		mysql_free_result($result);
		//返回结果集
		return $reResult;
	}
	/**
	* 返回以数字和字段名作为键名的数组
	* 
	* 当参数$key=1时,返回的数组使用数字作为键名
	* 当参数$key=2时,返回的数组使用字段名作为键名
	* 当参数$key=3时,返回的数组使用数字和字段名作为键名
	* */
	function loadRowList($key=3) {
		//检测运行SQL语句,如果返回结果集失败,返回一个NULL值.
		if(!($result = $this->query())) {
			return null;
		}
		$array = array();
		//把从结果集中取出的数组,存入$array数组
		switch($key){
			case 1:
				$keyName = MYSQL_NUM;
			break;
			case 2:
				$keyName = MYSQL_ASSOC;
			break;
			case 3:
				$keyName = MYSQL_BOTH;
			break;
		}
		while($row = mysql_fetch_array($result,$keyName)){
			$array[] = $row;
		}
		//释放资源
		mysql_free_result($result);
		//返回数组
		return $array;
	}
	
	/**
	* 返回对象
	*/
	function loadObject( &$object ) {
		if ($object != null) {
			if (!($cur = $this->query())) {
				return false;
			}
			if ($array = mysql_fetch_assoc( $cur )) {
				mysql_free_result( $cur );
				mosBindArrayToObject( $array, $object );
				return true;
			} else {
				return false;
			}
		} else {
			if ($cur = $this->query()) {
				if ($object = mysql_fetch_object( $cur )) {
					mysql_free_result( $cur );
					return true;
				} else {
					$object = null;
					return false;
				}
			} else {
				return false;
			}
		}
	}
	/**
	* 将对象转化成记录并插入到数据库中
	*/
	function insertObject( $table, &$object, $keyName = NULL, $verbose=false ) {
		$object = (object)$object;
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') {
				continue;
			}
			$fields[] = "`$k`";
			$values[] = "'" . $this->getEscaped( $v ) . "'";
		}
		$this->setSql( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		($verbose) && print "$sql<br />\n";
		if (!$this->query()) {
			return false;
		}
		$id = mysql_insert_id();
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	* 根据对象更新数据记录
	*/
	function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$object = (object)$object;
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		foreach (get_object_vars( $object ) as $k => $v) {
			if( is_array($v) or is_object($v) or $k[0] == '_' ) {
				continue;
			}
			if( $k == $keyName ) {
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v === NULL && !$updateNulls) {
				continue;
			}
			if( $v == '' ) {
				$val = "''";
			} else {
				$val = "'" . $this->getEscaped( $v ) . "'";
			}
			$tmp[] = "`$k`=$val";
		}
		$this->setSql( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}
	
	/**
	* 返回对象数组
	*/
	function loadObjectList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* 显示错误信息,根据参数判断是否在错误信息中显示出错的SQL语句
	*/
	function getError($showSQL = false) {
		return "错误代码:{$this->_errno}<br /><font color=\"red\">错误信息:{$this->_error}</font>".($showSQL?"<br />出错的SQL语句:<pre>$this->_sql</pre>":'');
	}
	/**
	 * 返回最后一次使用INSERT语句产生的ID值
	 */
	function lastid()
	{
		return mysql_insert_id();
	}
	/**
	 * 取得mysql的版本信息
	 *
	 * @return string
	 */
	function getVersion()
	{
		return mysql_get_server_info();
	}

	/**
	* 取得创建表的SQL语句
	*/
	function getTableCreateSQL( $table ) {
		$this->setSql('SHOW CREATE table '.$table);
		$this->query();
		$result = $this->loadRowList(2);
		return $result;
	}
	/**
	* 取得表的字段列表
	*/
	function getTableFields($table) {
		$this->setSql( 'SHOW FIELDS FROM ' . $table );
		$this->query();
		$fields = $this->loadRowList(2);
		return $fields;
	}
	/**
	* 转义字符串用于SQL语句
		*/
	function getEscaped( $text ) {
		return addslashes( $text );
	}
}
?>
