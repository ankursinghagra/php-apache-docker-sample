<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

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
        $this->adminmodel->enforce_permissions('edit_blog');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_blog()
	{	
		$sql_cat=$this->db->query("SELECT * FROM blog_category");
		if($sql_cat->num_rows()>0){
			$this->data['blog_all_category']=$sql_cat->result_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Blog Category Dont Exists! Please Create 1 first.</div>');
			redirect('admin/blog','refresh');
		}
		$this->form_validation->set_rules('blog_title', 'Blog Title', 'required');
		$this->form_validation->set_rules('blog_slug', 'Blog Slug', 'required|is_unique[blog.blog_slug]|alpha_dash');
		$this->form_validation->set_rules('blog_seo_title', 'Blog Meta Title', 'required');
		$this->form_validation->set_rules('blog_seo_keywords', 'Blog SEO Keywords', 'required');
		$this->form_validation->set_rules('blog_seo_description', 'Blog Meta Description', 'required');
		$this->form_validation->set_rules('blog_category_slug', 'Blog Category', 'required');
		$this->form_validation->set_rules('blog_content', 'Blog Content', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('tags', 'Tags', 'required');
		$this->form_validation->set_rules('active', 'Status', 'required');

		if($this->input->post('file_name')){
			$blog_photo=$this->adminmodel->upload_photo_make_thumb('blog/');
			$this->data['blog_photo_uploaded']=$blog_photo;
		}elseif($this->input->post('blog_photo_uploaded')){
			$this->data['blog_photo_uploaded'] = $this->input->post('blog_photo_uploaded');
		}

		if($this->form_validation->run()){
			$data_db=array(
				'blog_title' => $this->input->post('blog_title'),
				'blog_slug' => $this->input->post('blog_slug'),
				'blog_seo_title' => $this->input->post('blog_seo_title'),
				'blog_seo_keywords' => $this->input->post('blog_seo_keywords'),
				'blog_seo_description' => $this->input->post('blog_seo_description'),
				'blog_category_slug' => $this->input->post('blog_category_slug'),
				'blog_author_email' => $this->session->userdata('admin_email'),
				'blog_content' => $this->input->post('blog_content'),
				'date' => $this->input->post('date'),
				'tags' => $this->input->post('tags'),
				'active' => $this->input->post('active'),
 				);
			if(isset($this->data['blog_photo_uploaded'])){
				$data_db['blog_photo'] = $this->data['blog_photo_uploaded'];
			}else{
				$data_db['blog_photo'] = 'default.jpg';
			}
		}
		if($this->form_validation->run()&&($this->db->insert('blog',$data_db))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Blog Created !</div>');
			$redirect_path = 'admin/blog/edit_blog/'.$this->db->insert_id();
			redirect($redirect_path,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}		
		$this->data['jqv_slug']='add_blog';
		$this->data['cropping_ratio']='4/3';
		$this->data['froala_editor']=true;
		$this->data['datepicker']=true;
		$this->data['tag_editor']=true;
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_add_blog',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_blog($id)
	{	
		$sql=$this->db->query("SELECT * FROM blog WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Blog Dont Exists!</div>');
			redirect('admin/blog','refresh');
		}
		$sql_cat=$this->db->query("SELECT * FROM blog_category");
		if($sql_cat->num_rows()>0){
			$this->data['blog_all_category']=$sql_cat->result_array();
		}
		$this->form_validation->set_rules('blog_title', 'Blog Title', 'required');
		//$this->form_validation->set_rules('blog_slug', 'Blog Slug', 'required|is_unique[blog.blog_slug]|alpha_dash');
		$this->form_validation->set_rules('blog_seo_title', 'Blog Meta Title', 'required');
		$this->form_validation->set_rules('blog_seo_keywords', 'Blog SEO Keywords', 'required');
		$this->form_validation->set_rules('blog_seo_description', 'Blog Meta Description', 'required');
		$this->form_validation->set_rules('blog_category_slug', 'Blog Category', 'required');
		$this->form_validation->set_rules('blog_content', 'Blog Content', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('tags', 'Tags', 'required');
		$this->form_validation->set_rules('active', 'Status', 'required');
		if($this->input->post('file_name')){
			$blog_photo=$this->adminmodel->upload_photo_make_thumb('blog/');
			$this->data['blog_photo_uploaded']=$blog_photo;
		}elseif($this->input->post('blog_photo_uploaded')){
			$this->data['blog_photo_uploaded'] = $this->input->post('blog_photo_uploaded');
		}

		if($this->form_validation->run()){
			$data_db=array(
				'blog_title' => $this->input->post('blog_title'),
				'blog_slug' => $this->input->post('blog_slug'),
				'blog_seo_title' => $this->input->post('blog_seo_title'),
				'blog_seo_keywords' => $this->input->post('blog_seo_keywords'),
				'blog_seo_description' => $this->input->post('blog_seo_description'),
				'blog_category_slug' => $this->input->post('blog_category_slug'),
				//'blog_author_email' => $this->session->userdata('admin_email'),
				'blog_content' => $this->input->post('blog_content'),
				'date' => $this->input->post('date'),
				'tags' => $this->input->post('tags'),
				'active' => $this->input->post('active'),
 				);
			if(isset($this->data['blog_photo_uploaded'])){
				$data_db['blog_photo'] = $this->data['blog_photo_uploaded'];
			}
		}
		if($this->form_validation->run()&&($this->db->update('blog',$data_db,array('id'=>$id)))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Blog Edited !</div>');
			$redirect_path = 'admin/blog/edit_blog/'.$id;
			redirect($redirect_path,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}
		$this->data['jqv_slug']='edit_blog';
		$this->data['cropping_ratio']='4/3';
		$this->data['froala_editor']=true;
		$this->data['datepicker']=true;
		$this->data['tag_editor']=true;
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_edit_blog',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_blogs($page_no=1)
	{	
		$sql=$this->db->select('id')->get('blog');
		if($sql->num_rows()>0){
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}
			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Posts';
			$total_pages = ceil($totalitems / $itemsPerPage); 
			$base_path=base_url().'admin/blog/all_blogs/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT B.*,A.author_name FROM blog AS B JOIN admins AS A ON B.blog_author_email=A.email ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['all_blogs']=$sql->result();
		}else{
			$this->data['all_blogs']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}

		$this->data['jqv_slug']='all_blog';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_all_blogs',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function blog_category()
	{
		$sql=$this->db->get('blog_category');
		$this->data['all_blogs']=$sql->result();
		$this->data['jqv_slug']='all_blog_category';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_all_category',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_blog_category()
	{	
		$this->form_validation->set_rules('blog_category_title', 'Blog category title', 'required');
		$this->form_validation->set_rules('blog_category_slug', 'Blog category slug', 'required');
		$this->form_validation->set_rules('blog_category_description', 'Blog category description', 'required');
		$this->form_validation->set_rules('blog_category_seo_title', 'Blog category seo title', 'required');
		$this->form_validation->set_rules('blog_category_seo_keywords', 'Blog category seo Keywords', 'required');
		$this->form_validation->set_rules('blog_category_seo_description', 'Blog category seo description', 'required');
		if($this->input->post('file_name')){
			$blog_category_image=$this->adminmodel->upload_photo_make_thumb('blog/');
			$this->data['blog_photo_uploaded']=$blog_category_image;
		}elseif($this->input->post('blog_photo_uploaded')){
			$this->data['blog_photo_uploaded'] = $this->input->post('blog_photo_uploaded');
		}
		if($this->form_validation->run()){
			$data_db=array(
				'blog_category_title' => $this->input->post('blog_category_title'),
				'blog_category_slug' => $this->input->post('blog_category_slug'),
				'blog_category_description' => $this->input->post('blog_category_description'),
				'blog_category_seo_title' => $this->input->post('blog_category_seo_title'),
				'blog_category_seo_keywords' => $this->input->post('blog_category_seo_keywords'),
				'blog_category_seo_description' => $this->input->post('blog_category_seo_description'),
 				);
			if(isset($this->data['blog_photo_uploaded'])){
				$data_db['blog_category_image'] = $this->data['blog_photo_uploaded'];
			}else{
				$data_db['blog_category_image'] = 'default.jpg';
			}
		}
		if($this->form_validation->run()&&($this->db->insert('blog_category',$data_db))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Blog Category Created !</div>');
			$redirect_path = 'admin/blog/edit_blog_category/'.$this->db->insert_id();
			redirect($redirect_path,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}
		
		$this->data['jqv_slug']='add_blog_category';
		$this->data['cropping_ratio']='5/3';
		$this->data['froala_editor']=true;
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_add_category',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_blog_category($id)
	{	
		$sql=$this->db->query("SELECT * FROM blog_category WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Blog Category Dont Exists!</div>');
			redirect('admin/blog/blog_category','refresh');
		}

		$this->form_validation->set_rules('blog_category_title', 'Blog category title', 'required');
		//$this->form_validation->set_rules('blog_category_slug', 'Blog category slug', 'required');
		$this->form_validation->set_rules('blog_category_description', 'Blog category description', 'required');
		$this->form_validation->set_rules('blog_category_seo_title', 'Blog category seo title', 'required');
		$this->form_validation->set_rules('blog_category_seo_keywords', 'Blog category seo Keywords', 'required');
		$this->form_validation->set_rules('blog_category_seo_description', 'Blog category seo description', 'required');
		if($this->input->post('file_name')){
			$blog_category_image=$this->adminmodel->upload_photo('blog/');
			$this->data['blog_photo_uploaded']=$blog_category_image;
		}elseif($this->input->post('blog_photo_uploaded')){
			$this->data['blog_photo_uploaded'] = $this->input->post('blog_photo_uploaded');
		}
		if($this->form_validation->run()){
			$data_db=array(
				'blog_category_title' => $this->input->post('blog_category_title'),
				//'blog_category_slug' => $this->input->post('blog_category_slug'),
				'blog_category_description' => $this->input->post('blog_category_description'),
				'blog_category_seo_title' => $this->input->post('blog_category_seo_title'),
				'blog_category_seo_keywords' => $this->input->post('blog_category_seo_keywords'),
				'blog_category_seo_description' => $this->input->post('blog_category_seo_description'),
 				);
			if(isset($this->data['blog_photo_uploaded'])){
				$data_db['blog_category_image'] = $this->data['blog_photo_uploaded'];
			}
		}
		if($this->form_validation->run()&&($this->db->update('blog_category',$data_db,array('id'=>$id)))){
			$this->session->set_flashdata('message', '<div class="alert alert-success">Blog Category Created !</div>');
			$redirect_path = 'admin/blog/edit_blog_category/'.$id;
			redirect($redirect_path,'refresh');
		}else{
			$this->data['message'] = validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message') ;
		}


		$this->data['jqv_slug']='edit_blog_category';
		$this->data['cropping_ratio']='5/3';
		$this->data['froala_editor']=true;
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/blog_edit_category',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}

	public function delete_blog(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function delete_blog_catgeory(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	public function validate_slug_blog(){
		if(isset($_POST['blog_slug'])) {
			$sql=$this->db->get_where('blog',array('blog_slug'=>$_POST['blog_slug']));
			if($sql->num_rows()>0){
				if(isset($_POST['blog_slug_initial']) && ($_POST['blog_slug_initial']==$_POST['blog_slug'])){
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
	public function validate_slug_blog_category(){
		if(isset($_POST['blog_category_slug'])) {
			$sql=$this->db->get_where('blog_category',array('blog_category_slug'=>$_POST['blog_category_slug']));
			if($sql->num_rows()>0){
				if(isset($_POST['blog_category_slug_initial']) && ($_POST['blog_category_slug_initial']==$_POST['blog_category_slug'])){
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
	public function ajax_img_save()
    {
    	$data = array();
		if( isset( $_POST['image_upload'] ) && !empty( $_FILES['images'] )){
			
			$image = $_FILES['images'];
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			
			
			$image_name = $image['name'];
			//get image extension
			$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
			//assign unique name to image
			$name = time().'.'.$ext;
			//$name = $image_name;
			//image size calcuation in KB
			$image_size = $image["size"] / 1024;
			$image_flag = true;
			//max image size
			$max_size = 512;
			if( in_array($ext, $allowedExts) && $image_size < $max_size ){
				$image_flag = true;
			} else {
				$image_flag = false;
				$data['error'] = 'Maybe '.$image_name. ' exceeds max '.$max_size.' KB size or incorrect file extension';
			} 
			
			if( $image["error"] > 0 ){
				$image_flag = false;
				$data['error'] = '';
				$data['error'].= '<br/> '.$image_name.' Image contains error - Error Code : '.$image["error"];
			}
			
			if($image_flag){
				move_uploaded_file($image["tmp_name"], "uploads/cache/".$name);
				$src = "uploads/cache/".$name;
				$data['success'] = $name;
				
				//mysql save here
			}
			
			
			echo json_encode($data);
			
		} else {
			$data[] = 'No Image Selected..';
		}
    }
}
