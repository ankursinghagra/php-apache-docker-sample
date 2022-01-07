<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('admin');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_team');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/team',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_team_member()
	{	
		if($this->input->post()){
			$data_db=array(
				'member_name' => $this->input->post('member_name'),
				'member_title' => $this->input->post('member_title'),
				'member_description' => $this->input->post('member_description'),
				'member_facebook_link' => $this->input->post('member_facebook_link'),
				'member_twitter_link' => $this->input->post('member_twitter_link'),
 				);
			if($this->input->post('file_name')){
				$data_db['member_photo']=$this->adminmodel->upload_photo('admins/');
			}
			if($this->db->insert('team_member',$data_db)){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Team Member Created !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/team','refresh');
		}
		$this->data['jqv_slug']='add_team_member';
		$this->data['cropping_ratio']='3/4';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/team_add_team_member',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_team_member($id)
	{	
		$sql=$this->db->query("SELECT * FROM team_member WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Member Dont Exists!</div>');
			redirect('admin/team','refresh');
		}

		if($this->input->post()){
			$data_db=array(
				'member_name' => $this->input->post('member_name'),
				'member_title' => $this->input->post('member_title'),
				'member_description' => $this->input->post('member_description'),
				'member_facebook_link' => $this->input->post('member_facebook_link'),
				'member_twitter_link' => $this->input->post('member_twitter_link'),
 				);
			if($this->input->post('file_name')){
				$data_db['member_photo']=$this->adminmodel->upload_photo('admins/');
			}
			if($this->db->update('team_member',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Member Edited !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/team/edit_team_member/'.$id,'refresh');
		}
		$this->data['jqv_slug']='add_team_member';
		$this->data['cropping_ratio']='3/4';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/team_edit_team_member',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_team_member($page_no=1)
	{	
		$sql=$this->db->select('id')->get('team_member');
		if($sql->num_rows()>0){
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}
			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Members';
			$total_pages = ceil($totalitems / $itemsPerPage); 
			$base_path=base_url().'admin/team/all_team_member/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT * FROM team_member LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['all_team_member']=$sql->result();
		}else{
			$this->data['all_team_member']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}

		$this->data['jqv_slug']='all_team_member';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/team_all_team_member',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function delete_team_member(){
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
