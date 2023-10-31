<?php

namespace App\Core;

class Route
{
	public static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
        $action_name = 'index';
		$payload = [];
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// проверяем, указан ли контроллер
		if (str_contains($routes[1], '?')) {
			$routes[1] = strstr($routes[1], '?', true);
		}			

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}		
		
		// получаем имя экшена
		$action_name = empty($routes[2]) ? 'index' : $routes[2];
					
		// проверяем, указано ли действие и перезаписываем значение по умолчанию
		if (!empty($routes[3])) {
			$payload = array_slice($routes, 3);
		}
		
		// добавляем префиксы
		$model_name = 'Model_' . $controller_name;
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = ucfirst(strtolower($model_name)) . '.php';
		$model_path = MODELS . '/' . $model_file;

		if(file_exists($model_path))
		{
			include MODELS . '/' . $model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = ucfirst(strtolower($controller_name)) .'.php';
		$controller_path = CONTROLLERS . '/' . $controller_file;

		if(file_exists($controller_path))
		{
			include CONTROLLERS . '/' . $controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}

		// создаем контроллер
		$controller = new $controller_name;
		$method = strtok($action_name, '?') ? strtok($action_name, '?') : $action_name;

		if(method_exists($controller, $method))
		{			
			// вызываем действие контроллера
			$controller->$method($payload);
		}
		else
		{
		    Route::ErrorPage404();
		}
	}
	
	public static function ErrorPage404()	
	{	
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.APP_URL.'/404');
    }
}
