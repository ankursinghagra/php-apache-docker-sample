<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/users',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_user(){

		$this->adminmodel->enforce_permissions('add_users');
		$sql=$this->db->get('admin_groups');
		$this->data['groups']=$sql->result_array();
		if($this->input->post()){

			$data_db['email'] = $this->input->post('email');
			$data_db['name'] = $this->input->post('name');
			//$data_db['password'] = md5($this->input->post('password'));
			$data_db['password'] = "";
			$data_db['group'] = $this->input->post('group');
			$data_db['hash_for_email'] = $this->adminmodel->hash_for_email_signup();
			
			if($this->db->insert('admins',$data_db)){
				//send email
				$this->adminmodel->user_signup_email($data_db);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Account Created !</div>');
			}else{

				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/users','refresh');
		}
		$this->data['jqv_slug']='add_user';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/users_add_user',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function permissions()
	{
		$this->adminmodel->enforce_permissions('edit_permissions');
		$sql=$this->db->get('admin_groups');
		$this->data['groups']=$sql->result_array();

		if($this->input->post()){

			$id=$this->input->post('id');
			$data_db['edit_site_options']=$this->input->post('edit_site_options') ? $this->input->post('edit_site_options') : '0';
			$data_db['add_users']=$this->input->post('add_users') ? $this->input->post('add_users') : '0';
			$data_db['edit_users']=$this->input->post('edit_users') ? $this->input->post('edit_users') : '0';
			$data_db['edit_permissions']=$this->input->post('edit_permissions') ? $this->input->post('edit_permissions') : '0';
			$data_db['edit_seo']=$this->input->post('edit_seo') ? $this->input->post('edit_seo') : '0';
			$data_db['edit_pages']=$this->input->post('edit_pages') ? $this->input->post('edit_pages') : '0';
			$data_db['edit_menu']=$this->input->post('edit_menu') ? $this->input->post('edit_menu') : '0';
			$data_db['edit_slider']=$this->input->post('edit_slider') ? $this->input->post('edit_slider') : '0';
			$data_db['edit_blog']=$this->input->post('edit_blog') ? $this->input->post('edit_blog') : '0';
			//$data_db['edit_assets']=$this->input->post('edit_assets') ? $this->input->post('edit_assets') : '0';
			$data_db['edit_projects']=$this->input->post('edit_projects') ? $this->input->post('edit_projects') : '0';
			$data_db['edit_footer']=$this->input->post('edit_footer') ? $this->input->post('edit_footer') : '0';
			$data_db['edit_photos']=$this->input->post('edit_photos') ? $this->input->post('edit_photos') : '0';
			$data_db['edit_videos']=$this->input->post('edit_videos') ? $this->input->post('edit_videos') : '0';
			$data_db['edit_team']=$this->input->post('edit_team') ? $this->input->post('edit_team') : '0';
			$data_db['see_visitors_msgs']=$this->input->post('see_visitors_msgs') ? $this->input->post('see_visitors_msgs') : '0';

			if($this->db->update('admin_groups',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Information Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/users/permissions','refresh');
		}

		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/users_permissions',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_users()
	{
		$this->adminmodel->enforce_permissions('edit_users');
		$sql= $this->db->query("SELECT A.id, A.name, A.email, A.group, G.group_name,G.group_color FROM admins AS A JOIN admin_groups AS G ON  A.group=G.id ");
		$this->data['users']=$sql->result_array();
		$this->data['message']=$this->session->flashdata('message');
		$this->data['jqv_slug']='all_users';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/users_all_users',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
/*	public function edit_user($id){

		$sql=$this->db->query("SELECT * FROM admins WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">User Dont Exists!</div>');
			redirect('admin/users','refresh');
		}
		if(!($this->session->userdata('admin_group') <= $this->data['page_data']['group'])) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">You are not permitted to edit your superiors!</div>');
			redirect('admin/users','refresh');
		}

		$sql=$this->db->get('admin_groups');
		$this->data['groups']=$sql->result_array();
		
		if($this->input->post()){
			$data_db['email'] = $this->input->post('email');
			$data_db['name'] = $this->input->post('name');
			if($this->input->post('password')){
				$data_db['password'] = md5($this->input->post('password'));
			}
			$data_db['group'] = $this->input->post('group');
			if($this->db->update('admins',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">User Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/users','refresh');
		}

		$this->data['jqv_slug']='edit_user';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/users_edit_user',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}*/
	public function validate_user(){
		if(isset($_POST['email'])) {
			$sql=$this->db->get_where('admins',array('email'=>$_POST['email']));
			if($sql->num_rows()>0){
				echo "false";
			}else{
				echo "true";
			}
		}else{
			echo "false";
		}
	}
	public function delete_user(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("SELECT * FROM admins WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}
		if(($this->session->userdata('admin_group') < $this->data['page_data']['group'])) {
			$sql=$this->db->query("DELETE FROM `admins` WHERE id=".$id." LIMIT 1 ");
		}else{
			$sql=false;
		}
		if ($sql){
			echo 'success';
		}else{
			echo 'You dont have permissions to delete superiors';
		}
	}
}
