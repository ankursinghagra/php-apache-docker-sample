<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data=array();
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_pages');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['pages_array_fixed']	=	$this->adminmodel->pages_array_fixed();
		$this->data['pages_array_nonfixed']	=	$this->adminmodel->pages_array_nonfixed();
		$this->data['jqv_slug']='all_pages';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/pages',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_page(){
		$this->form_validation->set_rules('page_title', 'Page Title', 'required');
		$this->form_validation->set_rules('page_subtitle', 'Page Subtitle', 'required');
		$this->form_validation->set_rules('page_slug', 'Page Slug', 'required');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
		$this->form_validation->set_rules('active', 'Active', 'required');

		if($this->form_validation->run()){
			$data_db=array(
				'page_title' => $this->input->post('page_title'),
				'page_subtitle' => $this->input->post('page_subtitle'),
				'page_slug' => $this->input->post('page_slug'),
				'meta_title' => $this->input->post('meta_title'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'meta_description' => $this->input->post('meta_description'),
				'page_content' => '',
				'page_content_HTML' => '',
				'custom_function' => '0',
				'active' => $this->input->post('active'),
				'fixed' => '0',
				'editable' => '1',
				'og_title' => $this->input->post('page_title'),
				'og_type' => 'website',
				'og_image' => '',
				'og_description' => $this->input->post('meta_description'),
				'og_site_name' => '',
				'tw_title' => $this->input->post('page_title'),
				'tw_card' => 'summary',
				'tw_image' => '',
				'tw_description' => $this->input->post('meta_description'),
 				);
		}
		if($this->form_validation->run()&&($this->db->insert('pages',$data_db))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Page Created !</div>');
			$redirect_path = 'admin/pages/edit_page/'.$this->db->insert_id();
			redirect($redirect_path,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}

		$this->data['jqv_slug']='add_page';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/pages_add_page',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_page($id){

		$sql=$this->db->query("SELECT * FROM pages WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Page Dont Exists!</div>');
			redirect('admin/pages','refresh');
		}

		if($this->input->post()){
			$data_db=array(
				'page_title' => $this->input->post('page_title'),
				'page_subtitle' => $this->input->post('page_subtitle'),
				'meta_title' => $this->input->post('meta_title'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'meta_description' => $this->input->post('meta_description'),
				//'page_content' => '',
				//'page_content_HTML' => '',
				//'custom_function' => '0',
				'active' => $this->input->post('active'),
				//'fixed' => '0',
				//'editable' => '1',
 				);
			if($this->data['page_data']['fixed']=='0'){
				$data_db['page_slug'] = $this->input->post('page_slug');
			}
			$this->db->update('pages',$data_db,array('id'=>$id));
			$this->session->set_flashdata('message', '<div class="alert alert-success">Page Edited !</div>');
			$redirect_path = 'admin/pages/edit_page/'.$id;
			redirect($redirect_path,'refresh');
		}

		$this->data['jqv_slug']='edit_page';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/pages_edit_page',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_opengraph($id){

		$sql=$this->db->query("SELECT * FROM pages WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Page Dont Exists!</div>');
			redirect('admin/pages','refresh');
		}
		if($this->input->post('file_name')){
			$blog_photo=$this->adminmodel->upload_photo_make_thumb('pages/');
			$this->data['photo_uploaded']=$blog_photo;
		}elseif($this->input->post('photo_uploaded')){
			$this->data['photo_uploaded'] = $this->input->post('photo_uploaded');
		}
		if($this->input->post('remove_photo')){
			$this->data['remove_photo'] = 'on';
		}
		if($this->input->post()){
			$data_db=array(
				'og_title' => $this->input->post('og_title'),
				'og_type' => $this->input->post('og_type'),
				//'og_image' => $this->input->post('og_image'),
				//'og_url' => $this->input->post('og_url'),
				'og_description' => $this->input->post('og_description'),
				'tw_title' => $this->input->post('tw_title'),
				'tw_card' => $this->input->post('tw_card'),
				//'tw_image' => $this->input->post('tw_image'),
				//'tw_url' => $this->input->post('tw_url'),
				'tw_description' => $this->input->post('tw_description'),
 				);
			if(isset($this->data['remove_photo'])){
				$data_db['og_image'] = '';
				$data_db['tw_image'] = '';
			}elseif(isset($this->data['photo_uploaded'])){
				$data_db['og_image'] = $this->data['photo_uploaded'];
				$data_db['tw_image'] = $this->data['photo_uploaded'];
			}
			$this->db->update('pages',$data_db,array('id'=>$id));
			$this->session->set_flashdata('message', '<div class="alert alert-success">Page Edited !</div>');
			$redirect_path = 'admin/pages/edit_opengraph/'.$id;
			redirect($redirect_path,'refresh');
		}

		$this->data['jqv_slug']='edit_opengraph';
		$this->data['cropping_ratio']='4/3';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/pages_edit_opengraph',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_page_content($id){
        $this->load->library('Sioen');
		$sql=$this->db->query("SELECT * FROM pages WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Page Dont Exists!</div>');
			redirect('admin/pages','refresh');
		}

		if($this->input->post()){

			$data_db=array(
				'page_content' =>($this->input->post('page_content')),
				);

			$converter = new Converter();
        	$HTMLContent = $converter->toHtml($this->input->post('page_content'));
        	$data_db['page_content_HTML'] =$HTMLContent;

			if($this->db->update('pages',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Page Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/pages/edit_page_content/'.$id,'refresh');
		}
		$this->data['editor']=true;
		//$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/pages_edit_page_content',$this->data);
		//$this->load->view('admin/parts/foot',$this->data);
	}
	public function delete_page(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function validate_slug(){
		if(isset($_POST['page_slug'])) {
			$sql=$this->db->get_where('pages',array('page_slug'=>$_POST['page_slug']));
			if($sql->num_rows()>0){
				if(isset($_POST['initial']) && ($_POST['initial']==$_POST['page_slug'])){
					echo "true";
				}else{
					echo "false";
				}
			}else{
				echo "true";
			}
		}else{
			echo "false";
		}
	}
}
