<?php

	class Router{
		
        public static function route(Request $request)
        {
			$controller = $request->getController();
			$method = $request->getMethod();
			$args = $request->getArgs();
				
			$method = (is_callable(array($controller, $method))) ? $method : 'index';	
            $controller->setPost($args);

			call_user_func(array($controller,$method));
			return;
		}
	}
