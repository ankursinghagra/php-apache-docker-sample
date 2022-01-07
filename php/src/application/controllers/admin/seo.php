<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends CI_Controller {

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
        $this->adminmodel->enforce_permissions('edit_seo');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/seo',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	function settings()
	{
		//save values if posted
		if($this->input->post()){
			$data_db=array(
				'og_status' => $this->input->post('og_status'), 
				'seo_og_appid' => $this->input->post('seo_og_appid'), 
				'tc_status' => $this->input->post('tc_status'), 
			);
			if($this->db->update('important_info',$data_db,array('id'=>'1'))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry Some error Occured !</div>');
			}
			redirect('admin/seo/settings/','refresh');
		}

		//retrive values
		$sql = $this->db->query("SELECT * FROM important_info WHERE id=1 ");
		$this->data['important_info'] = $sql->row_array();
		
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/seo_settings',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	function seo_image()
	{
		if($this->input->post('file_name')){

			$data_db['seo_image']=$this->adminmodel->upload_photo('pages/');

			if($this->db->update('important_info',$data_db,array('id'=>1))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Photo Updated!</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/seo/seo_image/','refresh');
		}

		//retrive values
		$sql = $this->db->query("SELECT * FROM important_info WHERE id=1 ");
		$this->data['important_info'] = $sql->row_array();

		$this->data['cropping_ratio']='5/3';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/seo_image',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
}
