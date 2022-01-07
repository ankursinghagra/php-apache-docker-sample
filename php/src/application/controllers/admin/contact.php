<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('see_visitors_msgs');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index($page_no=1)
	{	
		$sql=$this->db->select('id')->get('contact');
		if($sql->num_rows()>0){
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}
			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Messages';
			$total_pages = ceil($totalitems / $itemsPerPage); 
			$base_path=base_url().'admin/contact/index/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT * FROM contact ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['contacts_array']=$sql->result();
		}else{
			$this->data['contacts_array']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}

		$this->data['message']=$this->session->flashdata('message');
		$this->data['jqv_slug']='all_contacts';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/contacts',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function delete_contact(){
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
