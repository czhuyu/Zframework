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
		$path = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'';		
		$path = trim($path,'/');

		//分析出控制器 方法
		if($path == ''){
			$path = [];
			$cf = ['Index','index'];
		}else{
			$path = explode('/', $path);
			$cf = [$path[0],$path[1]];
		}

		//分析出GET参数
		$param = array_slice($path, 2);
		$param_len = count($param);
		//echo $param_len;

		if($param_len>=2){
			for($i = 0; $i<$param_len;$i+=2){
				$_GET[$param[$i]] = $param[$i+1];
			}
		}

		return $cf;
	}
	/**
	*运行Controller
	*/
	public function runController(){
		list($c,$f) = $this->resolve();
		$controller = $this->createController($c);
		$controller->$f();
		//print_r($_GET);
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