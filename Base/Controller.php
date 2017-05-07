<?php  

/**
*所有Controller的父类
*/
namespace Z\Base;
class Controller{
	private $data = [];


	/**
	*这里先将后台的数据放进数组_data里面
	*@param $k 赋值的键 ; $v 赋值的值
	*/
	public function assign($k,$v){
		$this->data[$k] = $v; 
	}


	/**
	*输出到模板
	*@param $view 需要输出到的模板位置
	*/
	public function display($view){
		extract($this->data,EXTR_OVERWRITE
);//因为传过来的值已经被封成一个数组,所以先把数组拆成变量名=变量值
		include (APP_PATH.'/View/Index/'.$view.'.html');
	}
}



?>