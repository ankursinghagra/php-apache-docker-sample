<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
        $this->load->model('frontmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_site_options');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/site_settings',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function information(){
		if($this->input->post()){
			$site_name=$this->security->xss_clean($this->input->post('site_name'));
			$site_description = $this->security->xss_clean($this->input->post('site_description'));
			$email1 = $this->security->xss_clean($this->input->post('email1'));
			$email2 = $this->security->xss_clean($this->input->post('email2'));
			$phone1 = $this->security->xss_clean($this->input->post('phone1'));
			$phone2 = $this->security->xss_clean($this->input->post('phone2'));
			$address1 = $this->security->xss_clean($this->input->post('address1'));
			$address2 = $this->security->xss_clean($this->input->post('address2'));
			$facebook_link = $this->security->xss_clean($this->input->post('facebook_link'));
			$google_link = $this->security->xss_clean($this->input->post('google_link'));
			$twitter_link = $this->security->xss_clean($this->input->post('twitter_link'));
			$linkedin_link = $this->security->xss_clean($this->input->post('linkedin_link'));
			$data_db=array(
				'site_name' => $site_name,
				'site_description' => $site_description,
				'email1' => $email1,
				'email2' => $email2,
				'phone1' => $phone1,
				'phone2' => $phone2,
				'address1' => $address1,
				'address2' => $address2,
				'facebook_link' => $facebook_link,
				'google_link' => $google_link,
				'twitter_link' => $twitter_link,
				'linkedin_link' => $linkedin_link,
				);
			if($this->db->update('site_options',$data_db,array('id'=>'1'))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
			}
			redirect('admin/site_settings/','refresh');
		}
		$sql=$this->db->get_where('site_options',array('id'=>'1'));
		$this->data['site_data']=$sql->row_array();
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/site_settings_information',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function email_data(){
		if($this->input->post()){
			$email_for_sendmail = $this->security->xss_clean($this->input->post('email_for_sendmail'));
			$smtp_hostname = $this->security->xss_clean($this->input->post('smtp_hostname'));
			$smtp_port = $this->security->xss_clean($this->input->post('smtp_port'));
			$smtp_username = $this->security->xss_clean($this->input->post('smtp_username'));
			$smtp_password = $this->security->xss_clean($this->input->post('smtp_password'));
			$data_db=array(
				'email_for_sendmail' => $email_for_sendmail,
				'smtp_hostname' => $smtp_hostname,
				'smtp_port' => $smtp_port,
				'smtp_username' => $smtp_username,
				'smtp_password' => $smtp_password,
				);
			if($this->db->update('site_options',$data_db,array('id'=>'1'))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
			}
			redirect('admin/site_settings/email_data/','refresh');
		}
		$sql=$this->db->get_where('site_options',array('id'=>'1'));
		$this->data['site_data']=$sql->row_array();
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/site_settings_email_data',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function settings(){
		$this->load->helper('directory');
		$this->data['list_dir'] = directory_map(APPPATH.'./views/frontend/', 1);
		if($this->input->post()){
			$theme=$this->security->xss_clean($this->input->post('theme'));
			$indexing=$this->security->xss_clean($this->input->post('indexing'));
			$data_db=array(
				'theme' => $theme,
				'indexing' => $indexing,
				);
			if($this->db->update('site_options',$data_db,array('id'=>'1'))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
			}
			redirect('admin/site_settings/','refresh');
		}
		$sql=$this->db->get_where('site_options',array('id'=>'1'));
		$this->data['site_data']=$sql->row_array();
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/site_settings_settings',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function logo_upload(){
		$this->data['site_options']=$this->frontmodel->site_options();
		if($this->input->post('type')){
			$sql=$this->db->update('site_options',array('logo_or_text'=>$this->input->post('type')),array('id'=>'1'));
			$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			redirect('admin/site_settings/logo_upload','refresh');
		}
		if($this->input->post('file_name')){
			$filename=$this->adminmodel->upload_photo('logo/');
			$sql=$this->db->update('site_options',array('logo_file'=>$filename),array('id'=>'1'));
			$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			//redirect('admin/site_settings/logo_upload','refresh');
		}

		//pending
		$this->data['jqv_slug']='change_logo';
		$this->data['cropping_ratio']='5/2';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/site_settings_logo_upload',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
}
