<?php  
/**
*负责启动App
*/
namespace Z;

define('ZPATH', __DIR__);//定义框架的根目录
define('DEBUG', false);//定义是否开启debug模式fas

class Zbase{
	private static $app = null;
	public static $class_map = [];
	/**
	*@return 一个App对象
	*/
	public static function app(){
		if(self::$app == null){
			self::$app = new Base\App();
		}
		return self::$app;
	}

	/**k
	*自动include需要创建的类的php文件
	*@return 一个App对象
	*/
	public static function autoload($class_name){
		//用户写的类是不需要直接写死在Map里面的，所以先做一个判断
		if(substr($class_name , 0 , 3) === 'App') {
            self::$class_map[$class_name] = APP_PATH . substr($class_name, 3) . '.class.php';//important            
        }
		//print_r(self::$class_map);

		if(isset(self::$class_map[$class_name])){
			$class_file = self::$class_map[$class_name];
			include($class_file);
		}else{
			echo "class_map has not found the discription of ".$class_name;
		}
	}
}


?>