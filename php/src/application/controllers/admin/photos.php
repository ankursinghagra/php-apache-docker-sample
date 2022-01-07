<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('admin_helper');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_photos');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/photos',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_photo(){
		if($this->input->post()){

			$data_db['photo_title'] = $this->input->post('photo_title');
			$data_db['photo_description'] = $this->input->post('photo_description');
			$data_db['photo_filename'] = $this->adminmodel->upload_photo_make_thumb('photos/');
			$data_db['out_link'] = $this->input->post('out_link');

			if($this->db->insert('photos',$data_db)){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Photo Uploaded!</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/photos','refresh');
		}
		$this->data['jqv_slug']='add_photo';
		$this->data['cropping_ratio']='4/3';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/photos_add_photo',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_photos()
	{
		$sql=$this->db->get('photos');
		$this->data['all_photos']=$sql->result();
		$this->data['jqv_slug']='all_photos';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/photos_all_photos',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_photo($id){

		$sql=$this->db->query("SELECT * FROM photos WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Photo Dont Exists!</div>');
			redirect('admin/photos','refresh');
		}
		if($this->input->post()){
			$data_db['photo_title'] = $this->input->post('photo_title');
			$data_db['photo_description'] = $this->input->post('photo_description');
			$data_db['out_link'] = $this->input->post('out_link');
			if($this->db->update('photos',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/photos','refresh');
		}
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/photos_edit_photo',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function delete_photos(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
}
