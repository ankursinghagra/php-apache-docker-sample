<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
        
        if($this->adminmodel->login_checker()){redirect('admin/login','refresh');}
        $this->data['current_user']=$this->session->all_userdata();
        $this->data['current_permissions']=$current_permissions=$this->adminmodel->all_permissions_of_current_group();
        //$this->adminmodel->enforce_permissions('edit_users');
        $this->data['user_data']=$this->adminmodel->user_data();
    }
	public function index()
	{
        $this->data['jqv_slug']='dashboard';
		$this->data['message']=$this->session->flashdata('message');
		$this->load->view('admin/parts/head',$this->data);
		$this->load->view('admin/dashboard',$this->data);
		$this->load->view('admin/parts/foot',$this->data);
	}
    function upload_froala(){

        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png", "blob");

        // Get filename.
        $temp = explode(".", $_FILES["file"]["name"]);

        // Get extension.
        $extension = end($temp);

        // An image check is being done in the editor but it is best to
        // check that again on the server side.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

        if ((($mime == "image/gif")
        || ($mime == "image/jpeg")
        || ($mime == "image/pjpeg")
        || ($mime == "image/x-png")
        || ($mime == "image/png"))
        && in_array(strtolower($extension), $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploads/photos/" . $name);

            // Generate response.
            $response = new StdClass;
            $response->link = base_url()."uploads/photos/" . $name;
            echo stripslashes(json_encode($response));
        }
    }
    function upload_tinymce(){

        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png", "blob");

        // Get filename.
        $temp = explode(".", $_FILES["file"]["name"]);

        // Get extension.
        $extension = end($temp);

        // An image check is being done in the editor but it is best to
        // check that again on the server side.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

        if ((($mime == "image/gif")
        || ($mime == "image/jpeg")
        || ($mime == "image/pjpeg")
        || ($mime == "image/x-png")
        || ($mime == "image/png"))
        && in_array(strtolower($extension), $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploads/photos/" . $name);

            // Generate response.
            $response = new StdClass;
            $response->location = base_url()."uploads/photos/" . $name;
            echo stripslashes(json_encode($response));
        }
    }
    function ajax_img_save()
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
