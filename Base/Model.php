<?php  
namespace Z\Base;

/**
*所有model的父类
*
**/

class Model{
	protected $db;//获取数据库连接的pdo对象
	protected $table_name;
	protected $field;
	protected $pk;

	public function getTableName(){
		$this->table_name = strtolower(substr(strrchr(get_called_class(), '\\'), 1, -5));
		echo $this->table_name;
	}

}



?>