<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
        $this->load->helper('cookie');
		//if(!$this->adminmodel->login_checker()){redirect('admin/dashboard','refresh');}
    }
	public function index()
	{
		if($this->input->post()){
			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$sql=$this->db->get_where('admins',array('email'=>$email,'password'=>md5($password)));
			
			if($sql->num_rows()>0){
				//set session
				$newdata = array(
				        'admin_name'  	  => $sql->row('name'),
				        'admin_email'     => $sql->row('email'),
				        'admin_group'     => $sql->row('group'),
				        'admin_logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);
				//set cookie
				if($this->input->post('remember_me')){
					$remember_me_token = sha1(microtime().$email);					
					$cookie = array(
					    'name'   => '87cde208678e9456996bda7927471c54895062a8',
					    'value'  => $remember_me_token,
					    'expire' => 86500,
					    'domain' => parse_url(base_url(),PHP_URL_HOST),
					    'path'   => '/',
					    'prefix' => '',
					    'secure' => false
					);
					$this->input->set_cookie($cookie);
					$this->db->query("UPDATE admins SET remember_me_token='".$remember_me_token."' WHERE email='".$email."' ");
				}
				//set message
				$this->session->set_flashdata('message', '<div class="alert alert-info">Login Successful</div>');
				//redirect to dashboard
				redirect('admin/dashboard','refresh');
			}else{
				//Invalid Credentials
				$this->session->set_flashdata('message', 'Invalid Login');
				redirect('admin/login','refresh');
			}
		}
		
		$this->data['jqv_slug']='login';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/login',$this->data);
	}
	public function logout(){
		$this->session->sess_destroy();
		delete_cookie("87cde208678e9456996bda7927471c54895062a8");
		redirect('admin/login','refresh');
	}
}
