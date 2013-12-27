<?php
class core_model_router extends core_model_abstract
{
    public function dispatch(core_model_request $request)
    {
        $session = factories::get()->obj('session_model_session');
        $controller = $this->route($request);

        if (!$controller) {
            $this->site404();
            return;
        }

        if (!$controller->isAllowed()) {
            $request->clear();    
            $controller = $this->route($request);
        }

		$request = call_user_func([ $controller, $request->action() ]);

        if (!!$request) {
            $location = $request->location();
            header('Location: /' . $location);
        }
	}

    public function site404()
    {
        header('HTTP/1.0 404 Not Found');
        die('404 Not Found');
    }

    public function route(core_model_request $request)
    {
        $controller = '';

        $factory = factories::get();

        if ($request->module() && $request->controller() && $request->action()) {
            $controller = $request->module() . '_controller_' . $request->controller();
            if ($factory->found($controller)) {
                $controller = $factory->obj($controller);
                if (method_exists($controller, $request->action())) {
                    $request->initPost(3);
                    $controller->request($request);
                    return $controller;
                }
            }
        }

        if ($request->module() && $request->controller()) {
            $controller = $request->module() . '_controller_' . $request->controller();
            if ($factory->found($controller)) {
                $controller = $factory->obj($controller);
                $request->action('index');
                $request->initPost(2);
                $controller->request($request);
                return $controller;
            }
        }

        if ($request->module()) {
            $controller = $request->module() . '_controller_index';
            if ($factory->found($controller)) {
                $controller = $factory->obj($controller);
                $request->action('index');
                $request->initPost(1);
                $controller->request($request);
                return $controller;
            }
        }

        $controller = 'index_controller_index';
        if ($factory->found($controller)) {
            $controller = $factory->obj($controller);
            $request->action('index');
            $request->initPost(0);
            $controller->request($request);
            return $controller;
        }

        $controller = 'core_controller_index';
        if ($factory->found($controller)) {
            $controller = $factory->obj($controller);
            $request->action('index');
            $request->initPost(0);
            $controller->request($request);
            return $controller;
        }

        return false;
    }
}
