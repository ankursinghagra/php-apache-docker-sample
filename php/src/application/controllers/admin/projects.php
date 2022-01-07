<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

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
        $this->adminmodel->enforce_permissions('edit_projects');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/projects',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_project()
	{
		$this->form_validation->set_rules('project_title', 'Project Name', 'required');
		$this->form_validation->set_rules('project_slug', 'Project Slug', 'required|is_unique[projects.project_slug]|alpha_dash');
		$this->form_validation->set_rules('project_seo_title', 'Project Seo Title', 'required');
		$this->form_validation->set_rules('project_description', 'Project Description', 'required');
		$this->form_validation->set_rules('project_seo_description', 'Project Seo Description', 'required');
		$this->form_validation->set_rules('project_html', 'Project HTML', 'required');
		if ($this->form_validation->run() == true){
			$data_db= array(
				'project_title' => $this->input->post('project_title'), 
				'project_slug' => $this->input->post('project_slug'), 
				'project_seo_title' => $this->input->post('project_seo_title'), 
				'project_description' => $this->input->post('project_description'), 
				'project_seo_description' => $this->input->post('project_seo_description'), 
				'project_html' => $this->input->post('project_html'), 
			);
		}
		if (($this->form_validation->run() == true)&&($this->db->insert('projects',$data_db))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Project Created!</div>');
	        redirect('admin/projects/edit_project/'.$this->input->post('project_slug'),'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}
		$this->data['form_data']['project_title'] = array(
            	'class' => 'form-control',
                'name'  => 'project_title',
                'id'    => 'project_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_title',$this->input->post('project_title')),
            );
		$this->data['form_data']['project_slug'] = array(
            	'class' => 'form-control',
                'name'  => 'project_slug',
                'id'    => 'project_slug',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_slug',$this->input->post('project_slug')),
            );
		$this->data['form_data']['project_seo_title'] = array(
            	'class' => 'form-control',
                'name'  => 'project_seo_title',
                'id'    => 'project_seo_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_seo_title',$this->input->post('project_seo_title')),
            );
		$this->data['form_data']['project_description'] = array(
            	'class' => 'form-control',
                'name'  => 'project_description',
                'id'    => 'project_description',
                'type'  => 'text',
                'rows'  => '5',
                'value' => $this->form_validation->set_value('project_description',$this->input->post('project_description')),
            );
		$this->data['form_data']['project_seo_description'] = array(
            	'class' => 'form-control',
                'name'  => 'project_seo_description',
                'id'    => 'project_seo_description',
                'type'  => 'text',
                'rows'  => '5',
                'value' => $this->form_validation->set_value('project_seo_description',$this->input->post('project_seo_description')),
            );
		$this->data['form_data']['project_html'] = array(
            	'class' => 'form-control editor',
                'name'  => 'project_html',
                'id'    => 'project_html',
                'type'  => 'text',
                'rows'  => '20',
                'value' => $this->form_validation->set_value('project_html',$this->input->post('project_html')),
            );

		$this->data['jqv_slug']='add_project';
		$this->data['summernote_editor']=true;
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/projects_add_project',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_project($project_slug)
	{

		$sql=$this->db->get_where('projects',array('project_slug'=>$project_slug));
		if(!$sql->num_rows()>0){
			redirect('admin/projects/','refresh');
		}else{
			$this->data['form_data_sql']=$sql->row_array();
		}

		$this->form_validation->set_rules('project_title', 'Project Name', 'required');
		//$this->form_validation->set_rules('project_slug', 'Project Slug', 'required|is_unique[projects.project_slug]');
		$this->form_validation->set_rules('project_seo_title', 'Project Seo Title', 'required');
		$this->form_validation->set_rules('project_description', 'Project Description', 'required');
		$this->form_validation->set_rules('project_seo_description', 'Project Seo Description', 'required');
		$this->form_validation->set_rules('project_html', 'Project HTML', 'required');
		if ($this->form_validation->run() == true){
			$data_db= array(
				'project_title' => $this->input->post('project_title'), 
				//'project_slug' => $this->input->post('project_slug'), 
				'project_seo_title' => $this->input->post('project_seo_title'), 
				'project_description' => $this->input->post('project_description'), 
				'project_seo_description' => $this->input->post('project_seo_description'), 
				'project_html' => $this->input->post('project_html'), 
			);
		}
		if (($this->form_validation->run() == true)&&($this->db->update('projects',$data_db,array('project_slug'=>$project_slug)))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Project Updated!</div>');
	        redirect('admin/projects/edit_project/'.$project_slug,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}
		$this->data['form_data']['project_title'] = array(
            	'class' => 'form-control',
                'name'  => 'project_title',
                'id'    => 'project_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_title',$this->data['form_data_sql']['project_title']),
            );
		/*$this->data['form_data']['project_slug'] = array(
            	'class' => 'form-control',
                'name'  => 'project_slug',
                'id'    => 'project_slug',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_slug',$this->input->post('project_slug')),
            );*/
		$this->data['form_data']['project_seo_title'] = array(
            	'class' => 'form-control',
                'name'  => 'project_seo_title',
                'id'    => 'project_seo_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('project_seo_title',$this->data['form_data_sql']['project_seo_title']),
            );
		$this->data['form_data']['project_description'] = array(
            	'class' => 'form-control',
                'name'  => 'project_description',
                'id'    => 'project_description',
                'type'  => 'text',
                'rows'  => '5',
                'value' => $this->form_validation->set_value('project_description',$this->data['form_data_sql']['project_description']),
            );
		$this->data['form_data']['project_seo_description'] = array(
            	'class' => 'form-control',
                'name'  => 'project_seo_description',
                'id'    => 'project_seo_description',
                'type'  => 'text',
                'rows'  => '5',
                'value' => $this->form_validation->set_value('project_seo_description',$this->data['form_data_sql']['project_seo_description']),
            );
		$this->data['form_data']['project_html'] = array(
            	'class' => 'form-control editor',
                'name'  => 'project_html',
                'id'    => 'project_html',
                'type'  => 'text',
                'rows'  => '20',
                'value' => $this->form_validation->set_value('project_html',$this->data['form_data_sql']['project_html']),
            );

		$this->data['jqv_slug']='edit_project';
		$this->data['project_slug']=$project_slug;
		$this->data['summernote_editor']=true;
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/projects_edit_project',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_projects()
	{
		$sql=$this->db->select('id')->get("projects");
		if($sql->num_rows()>0){
			$page_no = ($this->uri->segment(4))?$this->uri->segment(4):1;
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Projects';
			$total_pages = ceil($totalitems / $itemsPerPage);
			$base_path=base_url().'admin/projects/all_projects/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT * FROM projects ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['all_projects']=$sql->result();
		}else{
			$this->data['all_projects']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}
		$this->data['jqv_slug']='all_projects';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/projects_all_projects',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function photos($project_id)
	{
		$sql=$this->db->get_where('projects',array('id'=>$project_id));
		if(!$sql->num_rows()>0){
			redirect('admin/projects/','refresh');
		}else{
			$this->data['row_sql']=$sql->row_array();
		}
		//add new photo
		if($this->input->post()){
			$data_db['photo_title'] = $this->input->post('photo_title');
			$data_db['project_id'] = $this->data['row_sql']['id'];
			$data_db['photo_description'] = $this->input->post('photo_description');
			$data_db['photo_filename'] = $this->adminmodel->upload_photo_make_thumb('photos/');

			if($this->db->insert('project_photos',$data_db)){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Photo Uploaded!</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/projects/photos/'.$project_id,'refresh');
		}
		$this->data['cropping_ratio']='4/3';

		//all photo
		$sql=$this->db->select('id')->get("project_photos");
		if($sql->num_rows()>0){
			$page_no = ($this->uri->segment(5))?$this->uri->segment(5):1;
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Photos';
			$total_pages = ceil($totalitems / $itemsPerPage);
			$base_path=base_url().'admin/projects/photos/'.$project_id.'/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT * FROM project_photos WHERE project_id=".$project_id." ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['all_photos']=$sql->result();
		}else{
			$this->data['all_photos']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}
		$this->data['jqv_slug']='all_project_photos';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/projects_all_photos',$this->data);
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
	public function delete_project(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function delete_photo(){
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
