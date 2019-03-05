<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user');
	}

	public function index(){
		$this->login_checker();
		$data['home_url'] = base_url();
		$data['page_title'] = "Admin Index";
		$this->load->view('admin/layout_head', $data);
		$this->load->view('admin/index' , $data);
		$this->load->view('admin/layout_foot', $data);
	}
	public function login_checker(){
		$home_url = base_url();

		if(empty($_SESSION['logged_in'])){
			header("Location: {$home_url}login.php?action=not_yet_logged_in");
		}
		// if access level was not 'Admin', redirect him to login page
		else if($_SESSION['access_level']!="Admin"){
			header("Location: {$home_url}products.php?action=not_admin");
		}else{
		// no problem, stay on current page
		}
	}

	public function read_users(){
		$this->login_checker();

		$data['home_url'] = base_url();

		$data['page_title'] = "Users";

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

		$data['records_per_page'] = 5;

		$data['from_record_num'] = ($data['records_per_page'] * $data['page']) - $data['records_per_page'];

		$this->load->view('admin/layout_head', $data);
		$this->load->view('admin/read_user', $data);
		$this->load->view('admin/layout_foot', $data);
	}

	public function create_user(){

		$this->load->model('utils');

		$this->login_checker();

		$data['home_url'] = base_url();

		$data['page_title'] = "Create User";

		$this->load->view('admin/layout_head', $data);

		$data['outPut'] = "<div class='col-md-12'>";



		if($_POST){

			$this->user->firstname=$_POST['firstname'];
			$this->user->lastname=$_POST['lastname'];
			$this->user->email=$_POST['email'];
			$this->user->contact_number=$_POST['contact_number'];
			$this->user->address=$_POST['address'];
			$this->user->password=$_POST['password'];
			$this->user->status=1;
			$this->user->access_level=$_POST['access_level'];

			$access_code=$this->utils->getToken();

			$this->user->access_code=$access_code;

			if($this->user->emailExists()){
				$data['outPut'] .="<div class='alert alert-danger' role='alert'>Email already used.</div>";
			}else{
				

				if($this->user->create()){
					$data['outPut'] .= "<div class='alert alert-success' role='alert'>User was created</div>";
				}else{
					$data['outPut'] .= "<div class='alert alert-danger' role='alert'>Unable to create user.</div>";
				}
			}
		}


		$this->load->view('admin/create_user', $data);

		$this->load->view('admin/layout_foot', $data);
	}

	
	public function delete_user(){

		$this->user->id = $_GET['id'];

		if($this->user->delete()){
			
			$data['outPutDelete'] = "Object was deleted.";
		}
		else{
			$data['outPutDelete'] = "Unable to delete object.";
		}
		

		$data['home_url'] = base_url();

		$data['page_title'] = "Users";

		$data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

		$data['records_per_page'] = 5;

		$data['from_record_num'] = ($data['records_per_page'] * $data['page']) - $data['records_per_page'];

		$this->load->view('admin/layout_head', $data);
		$this->load->view('admin/read_user', $data);
		$this->load->view('admin/layout_foot', $data);
		
	}
}
