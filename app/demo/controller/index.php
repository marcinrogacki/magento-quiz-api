<?php
class demo_controller_index extends core_controller_abstract 
{
    public function index()
    {
        $vars = [
            'title' => 'API Demo',
            'js'    => [
                'public/prototype.js',
                'public/formater.js',
                'https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js'
            ],
        ];
        $this->view('demo/view/index', $vars);	
    }
}
