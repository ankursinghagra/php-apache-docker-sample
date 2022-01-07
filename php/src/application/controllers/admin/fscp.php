<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fscp extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('adminmodel');
    }
    public function checkcode($code){
        //check if code is valid and the is a user without password in DB with that code
        $sql = $this->db->get_where('admins', array('hash_for_email' => $code ));
        if($sql->num_rows()>0){
            $this->data['user_row']=$sql->row_array();
            //ask to create password
            if( ($this->input->post()) ){
                $code = $this->input->post('code');
                $new_password = $this->input->post('new_password');
                $new_password_r = $this->input->post('new_password_r');
                if (!empty($this->input->post('new_password'))){
                    if($new_password==$new_password_r){
                        //save to db
                        $sql_1=$this->db->update("admins",array('password'=>md5($new_password)),array('email'=>$this->data['user_row']['email']));
                        if($sql_1){
                            //create session
                            $newdata = array(
                                'admin_name'      => $this->data['user_row']['name'],
                                'admin_email'     => $this->data['user_row']['email'],
                                'admin_group'     => $this->data['user_row']['group'],
                                'admin_logged_in' => TRUE
                            );
                            $this->session->set_userdata($newdata);
                            $this->adminmodel->user_signup_final_email($this->data['user_row'],$new_password);
                            $this->session->set_flashdata('message', '<div class="alert alert-info">Thank You for Signing Up.</div>');
                            redirect('admin/dashboard','refresh');
                        }else{
                            $this->session->set_flashdata('message', '<div class="alert alert-danger">Database Error!</div>');
                            redirect('admin/fscp/checkcode/'.$code,'refresh');
                        }
                        
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-danger">Both Passwords Should Be Same!</div>');
                        redirect('admin/fscp/checkcode/'.$code,'refresh');
                    }
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Please Fill The Fields!</div>');
                    redirect('admin/fscp/checkcode/'.$code,'refresh');
                }
            }else{
                $this->data['code']=$code;
                $this->data['message']=$this->session->flashdata('message');
                $this->load->view('admin/fscp/check_code',$this->data);
            }
        }else{
            //404
            show_404();
        }
    }
    public function forgot_password(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        if ($this->form_validation->run() == true){
            $email_address=$this->input->post("email_address");
            $sql = $this->db->query("SELECT id,name FROM admins WHERE email='".$email_address."' LIMIT 1");

            if ( ($sql->num_rows()>0) ){
                $row=$sql->row_array();
                $name = $row['name'];
                $code = $this->adminmodel->hash_for_email_signup();
                $this->db->update('admins',array('hash_for_email'=>$code),array('email'=>$email_address));
                $this->adminmodel->email_for_password_reset($email_address,$code);

                $this->session->set_flashdata('message', '<div class="alert alert-success">We have send you email with a link to reset your password.</div>');
                redirect('admin/fscp/forgot_password','refresh');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Email doesn\'t exists in our database.</div>');
                redirect('admin/fscp/forgot_password','refresh');
            }
        }

        $this->data['message']= ( validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message'));
        $this->load->view('admin/fscp/forgot_password_1',$this->data);
    }
    public function change_password($code){
        //check if code is valid
        $sql = $this->db->get_where('admins', array('hash_for_email' => $code));
        if($sql->num_rows() >0){

            $row=$sql->row_array();

            $this->load->library('form_validation');
            $this->form_validation->set_rules('password1', 'Password Field 1', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Password Field 2', 'required');
            if($this->form_validation->run() == true){
                $data_db=array(
                    'password' => md5($this->input->post('password1')),
                );
            }
            if( ($this->form_validation->run() == true)&&($this->db->update('admins',$data_db,array('hash_for_email' => $code))) ){
                //send new password by email
                $this->adminmodel->admins_password_changed($code,$this->input->post('password1'));
                //set success message
                $this->session->set_flashdata('message', '<div class="alert alert-success">Password Changed</div>');
                //set session & redirect
                $newdata = array(
                        'admin_name'      => $row['name'],
                        'admin_email'     => $row['email'],
                        'admin_group'     => $row['group'],
                        'admin_logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                redirect('admin/dashboard','refresh');
            }else{
                //set error message
                $this->data['message']= (validation_errors())? '<div class="alert alert-danger">'.validation_errors().'</div>' : $this->session->flashdata('message');
            }

            //$this->data['message']=$this->session->flashdata('message');
            $this->load->view('admin/fscp/change_password',$this->data);
        }else{
            //404
            show_404();
        }
    }
}