<?php
class Error404 extends CI_Controller
{
	public function __construct()
	{
	        parent::__construct();
	}
 
	public function index()
	{
		// $this->output->set_status_header('404');
		
		$this->load->view('errors/html/error_404');
	}

	public function error_401()
	{
		// $this->output->set_status_header('401');
		$this->load->view("errors/forbidden_access");
	}
}
?>
