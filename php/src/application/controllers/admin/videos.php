<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
		if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_videos');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/videos',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function all_videos($page_no=1){
		$sql=$this->db->select('id')->get('videos');
		if($sql->num_rows()>0){
			$itemsPerPage = 10;
			$offset = ($page_no - 1) * $itemsPerPage;
			$totalitems = $sql->num_rows();
			$end = $totalitems;
			if($itemsPerPage<$totalitems){$end=$itemsPerPage*$page_no;if($end>$totalitems){$end=$totalitems;}}
			$this->data['page_str'] = 'Showing '.($offset+1).'-'.$end.' of '.$totalitems.' Videos';
			$total_pages = ceil($totalitems / $itemsPerPage); 
			$base_path=base_url().'admin/videos/all_videos/';
			$this->data['pagination']=$this->adminmodel->custom_pagination($base_path,$total_pages,$page_no);
			$sql=$this->db->query("SELECT * FROM videos ORDER BY id DESC LIMIT ".$offset.",".$itemsPerPage." ");
			$this->data['videos_array']=$sql->result();
		}else{
			$this->data['videos_array']=false;
			$this->data['page_str'] = '';
			$this->data['pagination'] = '';
		}

		$this->data['message']=$this->session->flashdata('message');
		$this->data['jqv_slug']='all_videos';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/videos_all_videos',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function edit_video($id){

		$sql=$this->db->query("SELECT * FROM videos WHERE id='".$id."' LIMIT 1");
		if( ($sql->num_rows()>0) && is_numeric($id)){
			$this->data['page_data']=$sql->row_array();
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Video Dont Exists!</div>');
			redirect('admin/videos','refresh');
		}

		if($this->input->post()){
			$data_db['video_title'] = $this->input->post('video_title');
			$data_db['video_description'] = $this->input->post('video_description');
			$data_db['video_link'] = $this->input->post('video_link');
			$data_db['video_hash'] = $this->input->post('video_hash');
			if($this->db->update('videos',$data_db,array('id'=>$id))){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Video Updated !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/videos','refresh');
		}
		$this->data['jqv_slug']='edit_video';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/videos_edit_video',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function add_video(){
		if($this->input->post()){

			$video_title = $this->security->xss_clean($this->input->post('video_title'));
			$video_description = $this->security->xss_clean($this->input->post('video_description'));
			$video_link = $this->security->xss_clean($this->input->post('video_link'));
			$video_hash = $this->security->xss_clean($this->input->post('video_hash'));

			$data_db=array(
				'video_title' => $video_title,
				'video_description' => $video_description,
				'video_link' => $video_link,
				'video_hash' => $video_hash,
			);
			if($this->db->insert('videos',$data_db)){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Video Created !</div>');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error Occured !</div>');
			}
			redirect('admin/videos','refresh');
		}
		$this->data['jqv_slug']='add_video';
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/videos_add_video',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
	public function delete_videos(){
		$table = $this->security->xss_clean($_POST['table']);
		$id = $this->security->xss_clean($_POST['id']);
		$sql=$this->db->query("DELETE FROM ".$table." WHERE id=".$id." LIMIT 1 ");
		if ($sql){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	function parse_yturl($url) 
	{
	    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	    preg_match($pattern, $url, $matches);
	    return (isset($matches[1])) ? $matches[1] : false;
	}
}
