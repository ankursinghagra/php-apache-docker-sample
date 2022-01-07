<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirtrevorupload extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin_email')){
        	redirect('admin/login','refresh');
        }
        
    }
    public function upload(){

        $attachment = $this->input->post('attachment');
        $uploadedFile = $_FILES['attachment']['tmp_name']['file'];
        
        $path = 'uploads/trevor';
        $url = base_url().'/uploads/trevor';
        
        // create an image name
        $fileName = time().'_'.str_replace(' ', '_', $attachment['name']);
        
        // upload the image
        move_uploaded_file($uploadedFile, $path.'/'.$fileName);
        
        $this->output->set_output(json_encode(array('file' => array(
        'url' => $url . '/' . $fileName,
        'filename' => $fileName
        ))),
        200,
        array('Content-Type' => 'application/json')
        );
    }
}