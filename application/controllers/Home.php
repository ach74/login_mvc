<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user');
	}

	public function index(){
		$this->login_checker();
		$home_url = base_url();

		$data['home_url'] = base_url();
		$data['page_title'] = "Login";
		$data['require_login'] = false;
		$data['access_denied'] = false;
		// if the login form was submitted
		if($_POST){

		// check if email and password are in the database
			$this->user->email=$_POST['email'];

		// check if email exists, also get user details using this emailExists() method
			$email_exists = $this->user->emailExists();

		// validate login
			if ($email_exists && password_verify($_POST['password'], $this->user->password) && $this->user->status==1){
				
				// if it is, set the session value to true
				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $this->user->id;
				$_SESSION['access_level'] = $this->user->access_level;
				$_SESSION['firstname'] = htmlspecialchars($this->user->firstname, ENT_QUOTES, 'UTF-8') ;
				$_SESSION['lastname'] = $this->user->lastname;

			// if access level is 'Admin', redirect to admin section
				if($this->user->access_level=='Admin'){
					header("Location: {$home_url}index.php/admin/index.php?action=login_success");
				}else{
					header("Location: {$home_url}index.php?action=login_success");
				}
			}

	// if username does not exist or password is wrong
			else{
				$data['access_denied']=true;
			}
		}


		$this->load->view('layout_head', $data);

		$this->load->view('login', $data);

		$this->load->view('layout_foot', $data);

	}

	public function login_checker(){
		$home_url = base_url();
		// login checker for 'customer' access level

		// if access level was not 'Admin', redirect him to login page
		if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Admin"){
			header("Location: {$home_url}admin/index.php?action=logged_in_as_admin");
		}

		else if(isset($require_login) && $require_login==true){
			if(!isset($_SESSION['access_level'])){
				header("Location: {$home_url}index.php?action=please_login");
			}
		}

		// if it was the 'login' or 'register' or 'sign up' page but the customer was already logged in
		else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
			// if user not yet logged in, redirect to login page
			if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Customer"){
				header("Location: {$home_url}index.php?action=already_logged_in");
			}
		}

		else{
		// no problem, stay on current page
		}
	}

	/*public function home(){

		$data['home_url'] = base_url();
		// set page title
		$data['page_title'] = "Home";

		// include login checker
		$data['require_login'] = true;
		

		$this->load->view('layout_head', $data);
		$this->load->view('index', $data);
		$this->load->view('layout_foot', $data);

	}*/

	public function logOut(){
		$home_url = base_url();

		session_destroy();

		header("Location: {$home_url}index.php");
	}
}
