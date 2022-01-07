<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
        if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        $this->adminmodel->enforce_permissions('edit_footer');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
        $sql=$this->db->query("SELECT * FROM custom_block WHERE part_id='footer' ");
        $this->data['footer_blocks'] = $sql->result_array();

        if($this->input->post()){
            $this->db->update('custom_block',array('content_html'=>$this->input->post('footer_1')),array('field_id'=>'footer_1'));
            $this->db->update('custom_block',array('content_html'=>$this->input->post('footer_2')),array('field_id'=>'footer_2'));
            $this->db->update('custom_block',array('content_html'=>$this->input->post('footer_3')),array('field_id'=>'footer_3'));
            $this->session->set_flashdata('message', '<div class="alert alert-success">Footer Updated !</div>');
            redirect('admin/footer','refresh');
        }

        $this->data['jqv_slug']='footers';
        $this->data['summernote_editor']=true;
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/footer',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
}
