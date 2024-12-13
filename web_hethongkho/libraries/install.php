<?php

	class install{

		public function install(){

			if(file_exists(_root.'/install/credential.inc')){

				include _root.'/install/credential.inc';

				try{

					$lang=$_SESSION['lang']=(!isset($_SESSION['lang']) || $_SESSION['lang']=='') ? 'vi' : $_SESSION['lang'];

					// include_once _lib.'firewall.php';

    				include_once _source."langWeb/lang_$lang.php";

    				$injection = new AntiSQLInjection();

				    $db = new PDODb($config['database']);

				    $func = new functions($db);

				    $detect = new MobileDetect;

				    $router = new AltoRouter();

				    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

				    $breadcrumbs = new breadCrumbs($db,$func);

				    $json_schema = new jsonSchema($db,$func);

				    $cache = new FileCache($db);

				    $statistic = new statitis($db,$cache);  

				    $seo = new seos($db);

				    $cart=new cartFrontEnd($db);

				    $apiPlace=new place($db);

				    $css = new CssMinify($config['website']['debug-css'], $func);

				    $js = new JsMinify($config['website']['debug-js'], $func);


					if($db->if_table_exists()){

						include_once _lib.'controller.php';
    
    					include_once _template."desktop.php";

					}else{

						$db->createTable();
						
						include_once _lib.'controller.php';
    
    					include_once _template."desktop.php";

					}

				}catch(PDOException $e){

					header('location:'._root.'/install/setup.php');

				}

			}else{

				header('location:'._install.'install/setup.php');

				// $dir_array = explode("/", dirname($_SERVER['PHP_SELF']));

				// if(end($dir_array) == 'i-web')
				// {

				// 	header('location:'._root.'/../install/setup.php');

				// }else{

				// 	header('location:'._root.'/install/setup.php');

				// }

			}

		}

	}
?>