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
	protected $_data = [];//数据对象


	public function __construct(){
		$this->getTableName();
		$this->db = new \Z\Base\Db();
		$this->resolveTable();
	}

	public function getTableName(){
		$this->table_name = strtolower(substr(strrchr(get_called_class(), '\\'), 1, -5));
	}

	public function resolveTable(){
		$desc = $this->db->getAll('desc '.$this->table_name,[]);
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
		$sql = 'select * from '.$this->table_name.' where '.$this->pk.'=?';
		return $this->_data = $this->db->getOne($sql,[$pk]);
	}

	/**
	*更新数据
	*
	*/
	public function save($data){
		$param = [];
		$sql = 'update '.$this->table_name.' set ';
		foreach ($data as $k => $v) {
			$sql.=$k.'=?,';
			$param[] = $v;
		}
		$sql = rtrim($sql,',');
		$sql .= ' where '.$this->pk.'=?';
		$param[] = $this->_data[$this->pk];
		return $this->db->update($sql,$param);
	}

	/**
	*删除数据
	*
	*/
	public function delete($pk){
		$sql = 'delete  from '.$this->table_name.' where '.$this->pk.'=?';
		return $this->_data = $this->db->delete($sql,[$pk]);
	}

	/**
	*增加数据
	*
	*/
	public function add($data=[]){
		$sql = 'insert into '.$this->table_name.' (';
		// /print_r($data);
		$sql .= implode(array_keys($data), ',').')values(';
		$sql .= str_repeat('?,', count($data));
		$sql = rtrim($sql,',');
		$sql .= ')';
		return $this->db->insert($sql,array_keys($data));
	}

}



?>