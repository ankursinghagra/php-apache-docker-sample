<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        //$this->adminmodel->enforce_permissions('edit_users');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$sql=$this->db->get_where('admins',array('email'=>$this->session->userdata('admin_email')));
		$this->data['user_data']=$sql->row_array();
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/profile',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function change_photo(){
		if($this->input->post()){
			if($this->input->post('file_name')){
				$data_db['photo'] = $this->adminmodel->upload_photo('admins/');
				$this->db->update('admins',$data_db,array('email'=>$this->session->userdata('admin_email')));
				$this->session->set_flashdata('message', '<div class="alert alert-success">Photo Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error!</div>');
			}
			redirect('admin/profile','refresh');
		}
		$this->data['jqv_slug']='change_photo';
		$this->data['cropping_ratio']='1/1';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/profile_change_photo',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function save_profile(){
		if($this->input->post()){

			$name =$this->security->xss_clean($this->input->post('name'));
			$email =$this->security->xss_clean($this->input->post('email'));
			$password =$this->security->xss_clean($this->input->post('password'));
			$author_name =$this->security->xss_clean($this->input->post('author_name'));
			$author_short_description =$this->security->xss_clean($this->input->post('author_short_description'));
			$author_facebook_link =$this->security->xss_clean($this->input->post('author_facebook_link'));
			$author_twitter_link =$this->security->xss_clean($this->input->post('author_twitter_link'));

			if(strlen($password) == 0){
				//doesnt require to change pass 

				$data_db= array( 
					'email'=>$email , 
					'name'=>$name ,
					'author_name' => $author_name ,
					'author_short_description' => $author_short_description ,
					'author_facebook_link' => $author_facebook_link ,
					'author_twitter_link' => $author_twitter_link ,
					);

				$this->db->where('email', $this->session->userdata('admin_email'));
				if ( $this->db->update('admins', $data_db) ){
					$newdata = array(
				        'admin_name'  => $name,
				        'admin_email'     => $email,
				        'admin_logged_in' => TRUE
						);
					$this->session->set_userdata($newdata);
					$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
				}
				redirect('admin/profile','refresh');

			}else{
				if(strlen($password)<8){
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Password must be at least 8 characters long</div>');
					redirect('admin/profile','refresh');
				}else{
					$data_db= array( 
						'email'=>$email , 
						'name'=>$name , 
						'password'=>md5($password) ,
						'author_name' => $author_name ,
						'author_short_description' => $author_short_description ,
						'author_facebook_link' => $author_facebook_link ,
						'author_twitter_link' => $author_twitter_link ,
						);
					$this->db->where('email', $this->session->userdata('admin_email'));
					if ( $this->db->update('admins', $data_db) ){
						$newdata = array(
				        'admin_name'  => $name,
				        'admin_email'     => $email,
				        'admin_logged_in' => TRUE
						);
						$this->session->set_userdata($newdata);
						$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
					}
					redirect('admin/profile','refresh');
				}
			}
		}
	}
}
