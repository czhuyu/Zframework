<?php  
/**
*
*用户操作的类
*/

require('Zbase.php');

class Z extends \Z\Zbase{
	
}


Z::$class_map = ['Z\Base\App'=>ZPATH.'/Base/App.php',
				 'Z\Base\Controller'=>ZPATH.'/Base/Controller.php',
				 'Z\Base\Model'=>ZPATH.'/Base/Model.php',
				 'Z\Base\Db'=>ZPATH.'/Base/Db.php'
				];

spl_autoload_register(['Z','autoload']);



?>