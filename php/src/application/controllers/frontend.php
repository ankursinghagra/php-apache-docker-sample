<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('admin');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('frontmodel');
        $this->data['site_options']=$this->frontmodel->site_options();
        $this->data['important_info']=$this->frontmodel->important_info();
        $this->data['MENU']=$this->frontmodel->display_children(0,0);
        $this->data['footer_blocks']=$this->frontmodel->footer_blocks();
        //$this->frontmodel->visitor_submit(); 
	}
    public function index()
	{
		$sql=$this->db->get('slider');
		$this->data['all_slider']=$sql->result_array();
		$sql=$this->db->get_where('pages',array('page_slug'=>''));
		$row=$sql->row_array();
		//meta data
		$this->data['page_slug']='home';
		$this->data['page_content']=$row['page_content_HTML'];
		$this->data['page_title']=$row['page_title'];
		$this->data['page_seo_title']=$row['meta_title'];
		$this->data['meta_keywords']=$row['meta_keywords'];
		$this->data['page_description']=$row['meta_description'];

		$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);
		//rendering
		$this->render('home',$this->data);
	}

	public function pages($uri_segment_1)
	{
		$sql=$this->db->get_where('pages',array('page_slug'=>$uri_segment_1,'active'=>'1'));
		if($sql->num_rows()>0){

			$row=$sql->row_array();
			$this->data['page_slug']=$uri_segment_1;
			$this->data['page_content']=$row['page_content_HTML'];
			$this->data['page_title']=$row['page_title'];
			$this->data['page_subtitle']=$row['page_subtitle'];
			$this->data['page_seo_title']=$row['meta_title'];
			$this->data['meta_keywords']=$row['meta_keywords'];
			$this->data['page_description']=$row['meta_description'];

			$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

			//team members
			if($uri_segment_1=='our-team'){
				$sql = $this->db->query("SELECT * FROM team_member order by id ASC");
				if($sql->num_rows()>0){
					$this->data['team_members']=$sql->result_array();
				}else{
					$this->data['team_member']=false;
				}
			}

			if(file_exists(APPPATH.'/views/frontend/'.$this->data['site_options']['theme'].'/'.$uri_segment_1.'.php'))
			{
				$this->render($uri_segment_1,$this->data);
			}else{
		        $this->render('pages',$this->data);
	        }
		}else{
			$this->data['page_slug']='404';
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}
	public function pages_2($uri_segment_1,$uri_segment_2)
	{
        $sql=$this->db->get_where('pages',array('page_slug'=>$uri_segment_1.'/'.$uri_segment_2,'active'=>'1'));
		if($sql->num_rows()>0){

			$row=$sql->row_array();
			$this->data['page_content']=$row['page_content_HTML'];
			$this->data['page_title']=$row['page_title'];
			$this->data['page_subtitle']=$row['page_subtitle'];
			$this->data['page_seo_title']=$row['meta_title'];
			$this->data['meta_keywords']=$row['meta_keywords'];
			$this->data['page_description']=$row['meta_description'];

			$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

		    $this->render('pages',$this->data);
		}else{
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}

	public function projects($second_aug=null){

		$sql=$this->db->get_where('pages',array('page_slug'=>'our-work','active'=>'1'));
		if($sql->num_rows()>0){

			if(isset($second_aug) && !is_numeric($second_aug)){
				// SINGLE PROJECTS
				$sql=$this->db->get_where('projects',array('project_slug'=>$second_aug));
				if($sql->num_rows()>0){
					$row=$sql->row_array();

					$this->data['page_slug']='projects';
					$this->data['page_title']=$row['project_title'];
					$this->data['page_seo_title']=$row['project_seo_title'];
					$this->data['meta_keywords']=$row['project_title'];
					$this->data['page_description']=$row['project_seo_description'];
					$this->data['page_content']=$row['project_html'];

					$sql_image= $this->db->get_where('project_photos',array('project_id' => $row['id'] ));
					if($sql_image->num_rows()>0){
						$this->data['all_project_images']=$sql_image->result_array();
					}else{
						$this->data['all_project_images']=false;
					}

					$this->data['opengraph'] = $this->frontmodel->opengraph_tags_projects($row,$this->data['all_project_images'][0]);

					$this->render('projects_single',$this->data);
				}else{
					$this->data['page_title']='404';
					$this->data['page_seo_title']='404';
					$this->data['page_description']='404';
					$this->data['meta_keywords']='404';
					$this->render('404',$this->data,404);
				}

			}else{
				// PROJECTS LIST
				$row=$sql->row_array();
				$this->data['page_slug']='projects';
				$this->data['page_content']=$row['page_content_HTML'];
				$this->data['page_title']=$row['page_title'];
				$this->data['page_subtitle']=$row['page_subtitle'];
				$this->data['page_seo_title']=$row['meta_title'];
				$this->data['meta_keywords']=$row['meta_keywords'];
				$this->data['page_description']=$row['meta_description'];

				$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

				$sql=$this->db->select('id')->get("projects");
				if($sql->num_rows()>0){

					$page_no = ($this->uri->segment(2))?$this->uri->segment(2):1;
					$itemsPerPage = 6;
					$offset = ($page_no - 1) * $itemsPerPage;
					$totalitems = $sql->num_rows();
					$end = $totalitems;
					if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

					$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Projects';
					$total_pages = ceil($totalitems / $itemsPerPage);
					$base_path=base_url().'our-work/';
					$this->data['pagination']=$this->frontmodel->custom_pagination($base_path,$total_pages,$page_no);
					$sql = $this->db->query("SELECT * FROM projects ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage."");
					$result_array = $sql->result_array();
					foreach ($result_array as $key => $row) {
						$sql_img=$this->db->query("SELECT photo_filename FROM project_photos WHERE project_id='".$row['id']."' LIMIT 1");
						if($sql_img->num_rows()>0){
							$ar=$sql_img->row_array();
							$result_array[$key]['photo_filename'] = $ar['photo_filename'] ;
						}else{
							$result_array[$key]['photo_filename'] = 'default_800.jpg';
						}
					}
					$this->data['all_projects']=$result_array;
				}else{
					$this->data['all_projects']=false;
					$this->data['page_str'] = '';
					$this->data['pagination'] = '';
				}

				$this->render('projects',$this->data);
			}

		}else{
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}
	public function photos(){

		$sql=$this->db->get_where('pages',array('page_slug'=>'photos','active'=>'1'));
		if($sql->num_rows()>0){
			$row=$sql->row_array();
			$this->data['page_slug']='photos';
			$this->data['page_content']=$row['page_content_HTML'];
			$this->data['page_title']=$row['page_title'];
			$this->data['page_subtitle']=$row['page_subtitle'];
			$this->data['page_seo_title']=$row['meta_title'];
			$this->data['meta_keywords']=$row['meta_keywords'];
			$this->data['page_description']=$row['meta_description'];

			$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);
			$sql=$this->db->select('id')->get("photos");
			if($sql->num_rows()>0){

				$page_no = ($this->uri->segment(2))?$this->uri->segment(2):1;
				$itemsPerPage = 9;
				$offset = ($page_no - 1) * $itemsPerPage;
				$totalitems = $sql->num_rows();
				$end = $totalitems;
				if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

				$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Photos';
				$total_pages = ceil($totalitems / $itemsPerPage);
				$base_path=base_url().'photos/';
				$this->data['pagination']=$this->frontmodel->custom_pagination($base_path,$total_pages,$page_no);
				$sql=$this->db->query("SELECT * FROM photos ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
				$this->data['all_photos']=$sql->result_array();
			}else{
				$this->data['all_photos']=false;
				$this->data['page_str'] = '';
				$this->data['pagination'] = '';
			}

			$this->render('photos',$this->data);
		}else{
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}

	public function videos(){

		$sql=$this->db->get_where('pages',array('page_slug'=>'videos','active'=>'1'));
		if($sql->num_rows()>0){
			$row=$sql->row_array();
			$this->data['page_slug']='videos';
			$this->data['page_content']=$row['page_content_HTML'];
			$this->data['page_title']=$row['page_title'];
			$this->data['page_subtitle']=$row['page_subtitle'];
			$this->data['page_seo_title']=$row['meta_title'];
			$this->data['meta_keywords']=$row['meta_keywords'];
			$this->data['page_description']=$row['meta_description'];

			$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

			$sql=$this->db->select('id')->get("videos");
			if($sql->num_rows()>0){

				$page_no = ($this->uri->segment(2))?$this->uri->segment(2):1;
				$itemsPerPage = 12;
				$offset = ($page_no - 1) * $itemsPerPage;
				$totalitems = $sql->num_rows();
				$end = $totalitems;
				if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

				$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Videos';
				$total_pages = ceil($totalitems / $itemsPerPage);
				$base_path=base_url().'videos/';
				$this->data['pagination']=$this->frontmodel->custom_pagination($base_path,$total_pages,$page_no);
				$sql=$this->db->query("SELECT * FROM videos ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
				$this->data['all_videos']=$sql->result_array();
			}else{
				$this->data['all_videos']=false;
				$this->data['page_str'] = '';
				$this->data['pagination'] = '';
			}

			$this->render('videos',$this->data);
		}else{
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}
	public function blog($second_aug=null,$third_aug=null){

		$sql_recent_blog=$this->db->query("SELECT * FROM blog ORDER BY id DESC LIMIT 6");
		$this->data['recent_blogs']=$sql_recent_blog->result_array();

		$sql_cat_list = $this->db->get('blog_category');
		if($sql_cat_list->num_rows()>0){
			$this->data['all_blog_category'] = $sql_cat_list->result_array();
		}else{
			$this->data['all_blog_category'] = false;
		}

		$sql=$this->db->get_where('pages',array('page_slug'=>'blog','active'=>'1'));
		if($sql->num_rows()>0){

			if(isset($second_aug) && !is_numeric($second_aug)){
				//blog category 
				$sql_cat=$this->db->get_where('blog_category',array('blog_category_slug'=>$second_aug));
				if($sql_cat->num_rows()>0){
					if( empty($third_aug) || is_numeric($third_aug) ){
						//BLOG LIST BY CATEGORY
						if($sql_cat->num_rows()>0){
							$row=$sql_cat->row_array();
							$this->data['page_slug']='blog_catgeory';
							$this->data['page_content']=$row['blog_category_description'];
							$this->data['page_title']=$row['blog_category_title'];
							$this->data['blog_category_slug']=$row['blog_category_slug'];
							$this->data['page_seo_title']=$row['blog_category_seo_title'];
							$this->data['meta_keywords']=$row['blog_category_seo_keywords'];
							$this->data['page_description']=$row['blog_category_seo_description'];

							$this->data['opengraph'] = $this->frontmodel->opengraph_tags_blog_category($row);
							
							$sql=$this->db->select('id')->get_where("blog",array('blog_category_slug'=>$second_aug));
							if($sql->num_rows()>0){

								$page_no = ($this->uri->segment(3))?$this->uri->segment(3):1;
								$itemsPerPage = 6;
								$offset = ($page_no - 1) * $itemsPerPage;
								$totalitems = $sql->num_rows();
								$end = $totalitems;
								if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

								$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Posts';
								$total_pages = ceil($totalitems / $itemsPerPage);
								$base_path=base_url().'blog/';
								$this->data['pagination']=$this->frontmodel->custom_pagination($base_path,$total_pages,$page_no);
								$sql=$this->db->query("SELECT * FROM blog WHERE blog_category_slug='".$second_aug."' ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
								$this->data['all_blogs']=$sql->result_array();
							}else{
								$this->data['all_blogs']=false;
								$this->data['page_str'] = '';
								$this->data['pagination'] = '';
							}

							$this->render('blog_category',$this->data);
						}else{
							$this->data['page_title']='404';
							$this->data['page_seo_title']='404';
							$this->data['page_description']='404';
							$this->data['meta_keywords']='404';
							$this->render('404',$this->data,404);
						}
					}else{
						//SINGLE POST 
						$sql=$this->db->get_where('blog',array('blog_slug'=>$third_aug, 'blog_category_slug'=>$second_aug));
						if($sql->num_rows()>0){
							$row=$sql->row_array();

							//BLOG AUTHOR
							$sql_author=$this->db->query("SELECT * FROM admins WHERE email='".$row['blog_author_email']."' AND (author_name!='') LIMIT 1");
							if($sql_author->num_rows()>0){
								$this->data['blog_author'] = $sql_author->row_array();
							}else{
								$this->data['blog_author'] = false;
							}

							$this->data['page_slug']='blog_post';
							$this->data['page_title']=$row['blog_title'];
							$this->data['page_seo_title']=$row['blog_seo_title'];
							$this->data['meta_keywords']=$row['blog_seo_keywords'];
							$this->data['page_description']=$row['blog_seo_description'];
							$this->data['blog']=$row;

							$this->data['opengraph'] = $this->frontmodel->opengraph_tags_blog_post($row,$second_aug);

							$this->render('blog_post',$this->data);
						}else{
							$this->data['page_title']='404';
							$this->data['page_seo_title']='404';
							$this->data['page_description']='404';
							$this->data['meta_keywords']='404';
							$this->render('404',$this->data,404);
						}
					}
				}else{
					$this->data['page_title']='404';
					$this->data['page_seo_title']='404';
					$this->data['page_description']='404';
					$this->data['meta_keywords']='404';
					$this->render('404',$this->data,404);
				}
				

			}else{
				// BLOG LIST
				$row=$sql->row_array();
				$this->data['page_slug']='blog';
				$this->data['page_content']=$row['page_content_HTML'];
				$this->data['page_title']=$row['page_title'];
				$this->data['page_subtitle']=$row['page_subtitle'];
				$this->data['page_seo_title']=$row['meta_title'];
				$this->data['meta_keywords']=$row['meta_keywords'];
				$this->data['page_description']=$row['meta_description'];
				

				$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

				$sql=$this->db->select('id')->get("blog");
				if($sql->num_rows()>0){

					$page_no = ($this->uri->segment(2))?$this->uri->segment(2):1;
					$itemsPerPage = 6;
					$offset = ($page_no - 1) * $itemsPerPage;
					$totalitems = $sql->num_rows();
					$end = $totalitems;
					if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}

					$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Posts';
					$total_pages = ceil($totalitems / $itemsPerPage);
					$base_path=base_url().'blog/';
					$this->data['pagination']=$this->frontmodel->custom_pagination($base_path,$total_pages,$page_no);
					$sql=$this->db->query("SELECT * FROM blog ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
					$this->data['all_blogs']=$sql->result_array();
				}else{
					$this->data['all_blogs']=false;
					$this->data['page_str'] = '';
					$this->data['pagination'] = '';
				}

				$this->render('blog',$this->data);
			}

		}else{
			$this->data['page_title']='404';
			$this->data['page_seo_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}
	public function contact(){

        $this->load->library('session');
		$sql=$this->db->get_where('pages',array('page_slug'=>'contact','active'=>'1'));
		if($sql->num_rows()>0){
			$row=$sql->row_array();
			$this->data['page_slug']='contact';
			$this->data['page_content']=$row['page_content_HTML'];
			$this->data['page_title']=$row['page_title'];
			$this->data['page_subtitle']=$row['page_subtitle'];
			$this->data['page_seo_title']=$row['meta_title'];
			$this->data['meta_keywords']=$row['meta_keywords'];
			$this->data['page_description']=$row['meta_description'];

			$this->data['opengraph'] = $this->frontmodel->opengraph_tags($row);

			//Form validation rules
			$this->form_validation->set_rules('name', 'Your Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Your Email', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('phone', 'Your Phone Number', 'required|xss_clean');
			$this->form_validation->set_rules('message', 'Your Message', 'required|xss_clean');

			//IP ADDRESS
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}

			if($this->form_validation->run() == true){
				$data_db=array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'message' => $this->input->post('message'),
					'ip' => $ip,
				);
			}
			if( ($this->form_validation->run() == true)&&($this->db->insert('contact',$data_db)) ){

				$to_email= $this->data['site_options']['email1'];
				$to_name= 'Site Owner';
				$from= $this->input->post('email');
				$subject= 'Sapricami: Someone tried to contact you';
				$html_array = array(
					array(
						'tag'=>'h2',
						'content'=>'You have received a message on your site'
						),
					array(
						'tag'=>'p',
						'content'=>'<br>Name 	: '.$data_db['name'].' <br>Email 	: '.$data_db['email'].' <br>Phone 	: '.$data_db['phone'].' <br>Message : '.$data_db['message'].' <br><br>'
						),
					array(
						'tag'=>'p',
						'content'=>'Thanks, have a lovely day.'
						),
				);
				$this->frontmodel->email($to_email,$to_name,$from,$subject,$html_array);
				//$this->frontmodel->send_contact_email($data_db);
				$this->session->set_flashdata('message', 'success');
				redirect('contact','refresh');
			}

			$this->data['message']= (validation_errors())? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message');
			$this->render('contact',$this->data);
		}else{
			$this->data['page_title']='404';
			$this->data['page_description']='404';
			$this->data['meta_keywords']='404';
			$this->render('404',$this->data,404);
		}
	}
	public function sitemap(){
		$this->data['sitemap_array'] 	=array();
		$this->data['sitemap_array'][] 	=array('url'=>base_url(),'priority'=>'1.0');

		$sql_1 = $this->db->query("SELECT page_slug FROM pages WHERE fixed='1' AND active='1' AND page_slug!='' ");
		if($sql_1->num_rows() >0){
			foreach ($sql_1->result_array() as $key => $row) {
				$this->data['sitemap_array'][] 	=array('url'=>base_url().$row['page_slug'],'priority'=>'0.80');
			}
		}
		$sql_2 = $this->db->query("SELECT page_slug FROM pages WHERE fixed='0' AND active='1' AND page_slug!='' ");
		if($sql_2->num_rows() >0){
			foreach ($sql_2->result_array() as $key => $row) {
				$this->data['sitemap_array'][] 	=array('url'=>base_url().$row['page_slug'],'priority'=>'0.80');
			}
		}
		$sql_3 = $this->db->query("SELECT project_slug FROM projects ");
		if($sql_3->num_rows() >0){
			foreach ($sql_3->result_array() as $key => $row) {
				$this->data['sitemap_array'][] 	=array('url'=>base_url().'our-work/'.$row['project_slug'],'priority'=>'0.40');
			}
		}
		$sql_4 = $this->db->query("SELECT blog_category_slug FROM blog_category ");
		if($sql_4->num_rows() >0){
			foreach ($sql_4->result_array() as $key => $row) {
				$this->data['sitemap_array'][] 	=array('url'=>base_url().'blog/'.$row['blog_category_slug'],'priority'=>'0.40');
			}
		}
		$sql_5 = $this->db->query("SELECT blog_category_slug,blog_slug FROM blog WHERE active='1' ");
		if($sql_5->num_rows() >0){
			foreach ($sql_5->result_array() as $key => $row) {
				$this->data['sitemap_array'][] 	=array('url'=>base_url().'blog/'.$row['blog_category_slug'].'/'.$row['blog_slug'],'priority'=>'0.40');
			}
		}
		$this->load->view('sitemap',$this->data);

	}
	public function robots(){
		$this->load->view('robots',$this->data);
	}
	public function render($page,$data){
		$this->load->view('frontend/'.$this->data['site_options']['theme'].'/parts/head',$data);
		$this->load->view('frontend/'.$this->data['site_options']['theme'].'/'.$page,$data);
		$this->load->view('frontend/'.$this->data['site_options']['theme'].'/parts/foot',$data);
	}
}
