<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_menu');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['menu_array_linear']=$this->adminmodel->menu_array_linear();
		$this->data['menu_array_dynamic']=$this->adminmodel->display_children(0,0);
		$this->data['jqv_slug']='add_menu';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/menu',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_menu($id){

		$sql=$this->db->query("SELECT * FROM menu WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Menu Dont Exists!</div>');
			redirect('admin/menu','refresh');
		}

		if($this->input->post()){
			$data_db['label'] = $this->input->post('label');
			$data_db['link'] = $this->input->post('link');
			$data_db['parent'] = $this->input->post('parent');
			$data_db['sort'] = $this->input->post('sort');
			if($this->db->update('menu',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Menu Item Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/menu','refresh');
		}
		$this->data['jqv_slug']='edit_menu';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/menu_edit_menu',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_menu(){
		if($this->input->post()){
			$data_db['label'] = $this->input->post('label');
			$data_db['link'] = $this->input->post('link');
			$data_db['parent'] = $this->input->post('parent');
			$data_db['sort'] = $this->input->post('sort');
			if($this->db->insert('menu',$data_db)){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Menu Item Created !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/menu','refresh');
		}else{
			redirect('admin/menu','refresh');
		}
	}
	public function delete_menu(){
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
