<?php  
/**
*初始化环境
*/
namespace Z\Base;
class App{
	/**
	*分析PATH_INFO里面的参数
	*@return [Controller,function]
	*/
	public function resolve(){
		$path = $_SERVER['PATH_INFO'];
		$path = trim($path,'/');
		
		$cf = explode('/', $path);
		return $cf;
	}
	/**
	*运行Controller
	*/
	public function runController(){
		list($c,$f) = $this->resolve();
		$controller = $this->createController($c);
		var_dump($controller);
	}

	/**
	*创建Controller
	*@param $class_name 需要创建的Controller名称
	*@return 创建好的Controller实例
	*/
	public function createController($class_name){
		$class_file = APP_PATH.'/Controller/'.$class_name.'Controller.class.php';

		$class_name = 'App\Controller\\'.$class_name.'Controller';
		\Z::$class_map[$class_name] = $class_file;

		if(is_subclass_of($class_name, 'Z\Base\Controller')){
			return new $class_name;
		}else{
			echo '自写的Controller必须继承自Z\Base\Controller';
		}

		
	}
}

?>