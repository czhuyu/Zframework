<?php  
/**
*数据库操作类
*利用PDO
*本类负责直接跟数据库打交道，sql+param增删改查操作
*/
namespace Z\Base;
class Db extends \PDO{
	public function __construct(){
		//$dsn = 'mysql:host=localhost;port=3307;dbname=testdb';
		$cfg = include(APP_PATH.'/Conf/config.php');
		$dsn = $cfg['dbtype'].':host='.$cfg['host'].';port='.$cfg['port'].';dbname='.$cfg['db'];
		$options = array(
    		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);

		parent::__construct($dsn,$cfg['user'],$cfg['passwd'],$options);
	}
	
	//获取一条数据
	public function getOne($sql,$param){
		return $this->ex($sql,$param)->fetch(\PDO::FETCH_ASSOC);
	}

	//获取一条数据
	public function getAll($sql,$param){
		return $this->ex($sql,$param)->fetchAll(\PDO::FETCH_ASSOC);
	}

	//新增一条数据
	public function insert($sql,$param){
		return $this->ex($sql,$param)->lastInsertId();
	}

	//删除一条数据
	public function update($sql,$param){
		return $this->ex($sql,$param)->rowCount();
	}

	//删除数据
	public function delete($sql,$param){
		return $this->ex($sql,$param)->rowCount();
	}

	//相同操作交给ex处理，顺便在此进行错误抛出
	public function ex($sql,$param){
		$sth = $this->prepare($sql);
		if($sth->execute($param)){
			return $sth;
		}else{
			list(,$D_errorcode,$D_errormsg) = $sth->errorInfo();
			throw new \Exception($D_errormsg,$D_errorcode);
		}
	}
}




?>