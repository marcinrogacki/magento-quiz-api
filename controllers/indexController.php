<?php
	class indexController extends baseController{
		
		public function __construct(){
			parent::__construct();
		}
		public function index(){

				$this->model('posts');

				$vars['title'] = 'Dynamic title';
				$vars['posts'] = $this->posts->getEntries();
				$vars['robak'] = 'ROBAK';
				$this->view('index', $vars);	
		}

	}
