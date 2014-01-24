<?php 

class Main extends CI_Controller {

	protected $view_data = array(
		'styles' => '',
		'scripts' => ''
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('templater', $this->view_data);
		$this->templater->render_view('welcome_message');
	}
}