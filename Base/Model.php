<?php  
namespace Z\Base;

/**
*所有model的父类
*
**/

class Model{
	protected $db;//获取数据库连接的pdo对象
	protected $table_name = '';
	protected $field = [];
	protected $pk;

	public function getTableName(){
		$this->table_name = strtolower(substr(strrchr(get_called_class(), '\\'), 1, -5));
	}

	public function resolveTable(){
		$this->getTableName();
		$db = new \Z\Base\Db();
		$desc = $db->getAll('desc '.$this->table_name,[]);
		foreach ($desc as $v) {
			if($v['Key']=='PRI'){
				$this->pk = $v['Field'];
			}
			$this->field[] = $v['Field'];
		}
	}

	/**
	*查询一条数据
	*
	*/
	public function find($pk){
		return 
	}

	/**
	*查询多条数据
	*
	*/
	public function select(){

	}



	/**
	*更新数据
	*
	*/
	public function save(){

	}

	/**
	*删除数据
	*
	*/
	public function delete(){

	}

	/**
	*增加数据
	*
	*/
	public function add(){

	}

}



?>