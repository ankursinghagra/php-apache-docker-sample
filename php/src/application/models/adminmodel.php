<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Adminmodel extends CI_Model {
	public function __construct()
	{}
	public function all_permissions_of_current_group(){
		$sql=$this->db->get_where('admin_groups',array('id'=>$this->session->userdata('admin_group')));
		return $sql->row_array();
	}
	public function enforce_permissions($condition){
		$sql=$this->db->get_where('admin_groups',array('id'=>$this->session->userdata('admin_group')));
		if (!$sql->row($condition)){
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry! You are not permitted to use this feature.</div>');
			redirect('admin/dashboard','refresh');
		}
	}
	public function user_data()
	{
		$sql=$this->db->get_where('admins',array('email'=>$this->session->userdata('admin_email')));
		return $sql->row_array();
	}
	public function login_checker(){
		if(!$this->session->userdata('admin_email')){
			//if cookie exists 
			$this->load->helper('cookie');
			if($this->input->cookie('87cde208678e9456996bda7927471c54895062a8')){
				$cookie = $this->input->cookie('87cde208678e9456996bda7927471c54895062a8');
				//is cookie valid
				$sql_token=$this->db->query("SELECT * FROM admins WHERE remember_me_token='".$cookie."' ");
				if($sql_token->num_rows()>0){
					//make session
					$newdata = array(
				        'admin_name'  	  => $sql_token->row('name'),
				        'admin_email'     => $sql_token->row('email'),
				        'admin_group'     => $sql_token->row('group'),
				        'admin_logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);
					//let it be
					return false;
				}else{
					//send to login
					return true;
	    		}
			}else{
				// cookie isnt set
				//send to login
				return true;
			}
        }else{
        	//session exists so 
        	//let it be
        	return false;
        }
	}
	public function menu_array_linear($id=null){
		if (isset($id) && !empty($id)) {
			$sql="SELECT * FROM menu WHERE id=".$id." LIMIT 1";
			$sql=$this->db->query($sql);
			if($sql->num_rows()>0){
				return $sql->row();
			}
			return false;
		}else{
			$sql="SELECT * FROM menu ORDER BY id";
			$sql=$this->db->query($sql);
			if($sql->num_rows()>0){
				return $sql->result_array();
			}
			return false;
		}
	}
	function display_children($parent, $level,$HTML='') {
	    $result = $this->db->query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent ." ORDER by sort ASC");
	    $HTML.= "<ul>";
	    foreach ($result->result_array() as $row) {
	        if ($row['Count'] > 0) {
	            $HTML.= "<li><a href='#'>" . $row['label'] . "</a>";
	            $HTML.=$this->adminmodel->display_children($row['id'], $level + 1);
	            $HTML.= "</li>";
	        } elseif ($row['Count']==0) {
	            $HTML.= "<li><a href='" . base_url() . $row['link'] . "' target='_blank'>" . $row['label'] . "</a></li>";
	        } else;
	    }
	    $HTML.= "</ul>";
	    return $HTML;
	}
	public function pages_array_fixed(){
		$sql="SELECT * FROM pages WHERE fixed='1' ORDER BY id";
		$sql=$this->db->query($sql);
		if($sql->num_rows()>0){
			return $sql->result();
		}
		return false;
	}
	public function pages_array_nonfixed(){
		$sql="SELECT * FROM pages WHERE fixed='0' ORDER BY id";
		$sql=$this->db->query($sql);
		if($sql->num_rows()>0){
			return $sql->result();
		}
		return false;
	}
	
	public function thumb_str($filename)
    {
    	$extension_pos = strrpos($filename, '.'); // find position of the last dot, so where the extension starts
		return substr($filename, 0, $extension_pos) . '_thumb' . substr($filename, $extension_pos);
    }
    function custom_pagination($base_path,$total_pages,$page_no)
    {
        $HTML='';
        if ($total_pages>1) {
            $HTML.= '<div class="text-center">
            			<ul class="pagination">
                        <li><a class="prev" href="'.$base_path.'1"><span class="fa fa-angle-left"></span>&ensp;Prev</a></li>';
            for($i=1; $i<=$total_pages; $i++) {
                if($i==$page_no){
                    $HTML.= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>'; 
                }else{
                    $HTML.= '<li ><a href="'.$base_path.$i.'">'.$i.'</a></li>'; 
                }
            }   
            $HTML.= '   <li><a class="next" href="'.$base_path.$total_pages.'">Next&ensp;<span class="fa fa-angle-right"></span></a></li>
                    </ul></div>';
        }
        return $HTML;
    }
	public function upload_photo($folder)
	{
		//This function Just CROP the file and save it in the $folder
			//upload image
			$x = $this->input->post('x');
			$y = $this->input->post('y');
			$h = $this->input->post('h');
			$w = $this->input->post('w');
			$orignal_path = $this->input->post('orignal_path');
			$file_name = $this->input->post('file_name');

			// pick image from cache folder
			$config['image_library'] = 'GD2';
	        $config['source_image'] = "uploads/cache/".$file_name; 
	       	$config['create_thumb'] = FALSE;
	        $config['new_image'] = 'uploads/'.$folder;
	        $config['dynamic_output'] = FALSE;
	        $config['maintain_ratio'] = FALSE;
	        $config['width']  = $w;
	        $config['height'] = $h;
	        $config['x_axis'] = $x;
	        $config['y_axis'] = $y;

	        //save the file in new folder and CROP
	        $this->load->library('image_lib',$config);
	        $this->image_lib->crop();
	        //unlink('uploads/cache/'.$filename);
	        return $file_name;

	}
	
	public function upload_photo_make_thumb($folder)
	{	
		//This function copy orignal file into $folder and create a thumb file too.
			//upload image
			$x = $this->input->post('x');
			$y = $this->input->post('y');
			$h = $this->input->post('h');
			$w = $this->input->post('w');
			$orignal_path = $this->input->post('orignal_path');
			$file_name = $this->input->post('file_name');

			$config['image_library'] = 'GD2';
	        $config['source_image'] = "uploads/cache/".$file_name; 
	       	$config['create_thumb'] = FALSE;
	        $config['new_image'] = 'uploads/'.$folder;
	        $config['dynamic_output'] = FALSE;
	        $config['maintain_ratio'] = FALSE;
	        $config['width']  = $w;
	        $config['height'] = $h;
	        $config['x_axis'] = $x;
	        $config['y_axis'] = $y;

	        // Image Saved in $folder , And CROP
	        $this->load->library('image_lib',$config);
	        $this->image_lib->crop();

	        $this->image_lib->clear();
	        unset($config);
	        $config=array();

	        $config['image_library'] = 'GD2';
			$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['new_image'] = 'uploads/'.$folder;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '_thumb';
			$config['width']	= 500;
			$config['height']	= 350;

			// Create a TINY thumb of the cropped photo
			$this->load->library('image_lib', $config); 
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->image_lib->clear();
	        unset($config);
	        $config=array();

			/*$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['wm_type'] = 'text';
			$config['wm_text'] = 'theWeddingShopee';
			$config['wm_font_path'] = 'assets/fonts/droidsans.ttf';
			$config['wm_font_size']	= '16';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_padding'] = '2';
			$config['create_thumb'] = FALSE;*/

			/*$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['wm_type'] = 'overlay';
			$config['wm_overlay_path'] = 'assets/img/logo1.png';
			$config['wm_opacity']       = 10;
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_padding'] = '2';
			$config['create_thumb'] = FALSE;

			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config); 
			$this->image_lib->watermark();*/

			// Move the Orignal Full Resolution File into $folder
            rename("uploads/cache/".$file_name,"uploads/".$folder.$file_name );

            $config=array();
	        $config['image_library'] = 'GD2';
			$config['source_image']	= 'uploads/'.$folder.$file_name;
			$config['new_image'] = 'uploads/'.$folder;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '_thumb';
			$config['width']	= 1024;
			$config['height']	= 786;

			// Create a TINY thumb of the cropped photo
			$this->load->library('image_lib', $config); 
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$this->image_lib->clear();
	        unset($config);
	        return $file_name;

	}
	
	function parse_yturl($url) 
	{
	    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	    preg_match($pattern, $url, $matches);
	    return (isset($matches[1])) ? $matches[1] : false;
	}

	/*Email Functions*/
	public function hash_for_email_signup(){
		$hash = md5(rand(100000,999999));
		$sql =$this->db->get_where('admins',array('hash_for_email'=>$hash));

		if( $sql->num_rows() >0 ){
			return $this->hash_for_email_signup();
		}else{
			return $hash;
		}
	}
	public function user_signup_email($data_db){
		$sql=$this->db->query("SELECT `site_name`,`email_for_sendmail` FROM `site_options` WHERE id=1 LIMIT 1");
		$row=$sql->row_array();
		$site_name=$row['site_name'];
		$email_for_sendmail=$row['email_for_sendmail'];
		$link = base_url()."admin/fscp/checkcode/".$data_db['hash_for_email'].'/';
		$HTML = '
			<!DOCTYPE html>
		    <html style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			    <head>
			        <meta name="viewport" content="width=device-width">
			        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			        <title></title>
			    </head>
			    <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">
					<!-- body -->
			        <table class="body-wrap" bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
			            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" bgcolor="#FFFFFF" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">

			                	<!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                      	<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                      		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Dear '.$data_db['name'].',
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			You have been registered in admin panel of '.$site_name.' at '.base_url().'
			                            		</p>

			                            		<!-- button -->
			                            		<table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: auto !important; Margin: 0 0 10px; padding: 0;">
			                            			<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                							<td style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size: 14px; line-height: 1.6em; border-radius: 25px; text-align: center; vertical-align: top; background: #348eda; margin: 0; padding: 0;" align="center" bgcolor="#348eda" valign="top">
			                                  				<a href="'.$link.'" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 2; color: #ffffff; border-radius: 25px; display: inline-block; cursor: pointer; font-weight: bold; text-decoration: none; background: #348eda; margin: 0; padding: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">
			                                  					Click Here to Accept and Create Your Password
			                                  				</a>
			                                			</td>
			                              			</tr>
			                              		</table>
			                					<!-- /button -->

			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                                		or copy and paste the link below into your browser
			                						<pre>'.$link.'</pre>
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Thanks, have a lovely day.
			                            		</p>
			                            		<!-- 
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			<a href="http://facebook.com/sapricami/" target="_blank" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #348eda; margin: 0; padding: 0;">
			                            				Like us on Facebook
			                            			</a>
			                            		</p>
			                            		-->
			                          		</td>
			                        	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->    
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			    	<!-- /body -->
			    	<!-- footer -->
			    	<table class="footer-wrap" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; width: 100%; margin: 0; padding: 0;">
			    		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			            	<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; margin: 0 auto; padding: 0;">
			                      
			                    <!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                        	<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td align="center" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                              		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6em; color: #666666; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                              			
			                              			<!-- Don\'t like these annoying emails? <a href="#" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #999999; margin: 0; padding: 0;">
			                              			<unsubscribe style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">Unsubscribe
			                              			</unsubscribe></a>. -->
			                              			Made by Sapricami.com for '.$site_name.'
			                              		</p>
			                            	</td>
			                          	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->
			                      
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			        <!-- /footer -->
			    </body>
			</html>
		';

        $subject = 'Account Created on '.$site_name.'. Create Password';
        if($this->email($data_db['email'],$data_db['name'],$email_for_sendmail,$site_name,$subject,$HTML)) {
            return true;
        }else{
            return false;
        }
	}
	public function user_signup_final_email($data,$new_password){
		$sql=$this->db->query("SELECT `site_name`,`email_for_sendmail` FROM site_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();
		$site_name=$row['site_name'];
		$email_for_sendmail=$row['email_for_sendmail'];
		$link = base_url().'admin';
		$HTML = '
			<!DOCTYPE html>
		    <html style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			    <head>
			        <meta name="viewport" content="width=device-width">
			        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			        <title></title>
			    </head>
			    <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">
					<!-- body -->
			        <table class="body-wrap" bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
			            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" bgcolor="#FFFFFF" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">

			                	<!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                      	<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                      		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Dear '.$data['name'].',
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			You have been registered in admin panel of '.$site_name.' at '.base_url().'
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Your Username : '.$data['email'].' <br>
			                            			Your Password : '.$new_password.'
			                            		</p>

			                            		<!-- button -->
			                            		<table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: auto !important; Margin: 0 0 10px; padding: 0;">
			                            			<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                							<td style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size: 14px; line-height: 1.6em; border-radius: 25px; text-align: center; vertical-align: top; background: #348eda; margin: 0; padding: 0;" align="center" bgcolor="#348eda" valign="top">
			                                  				<a href="'.$link.'" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 2; color: #ffffff; border-radius: 25px; display: inline-block; cursor: pointer; font-weight: bold; text-decoration: none; background: #348eda; margin: 0; padding: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">
			                                  					Login Here
			                                  				</a>
			                                			</td>
			                              			</tr>
			                              		</table>
			                					<!-- /button -->

			                            		
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Thanks, have a lovely day.
			                            		</p>
			                            		
			                          		</td>
			                        	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->    
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			    	<!-- /body -->
			    	<!-- footer -->
			    	<table class="footer-wrap" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; width: 100%; margin: 0; padding: 0;">
			    		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			            	<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; margin: 0 auto; padding: 0;">
			                      
			                    <!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                        	<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td align="center" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                              		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6em; color: #666666; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                              			
			                              			<!-- Don\'t like these annoying emails? <a href="#" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #999999; margin: 0; padding: 0;">
			                              			<unsubscribe style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">Unsubscribe
			                              			</unsubscribe></a>. -->
			                              			Made by Sapricami.com for '.$site_name.'
			                              		</p>
			                            	</td>
			                          	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->
			                      
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			        <!-- /footer -->
			    </body>
			</html>
		';

        $subject = 'Account Created on '.$site_name.'. Password Created';
        if($this->email($data['email'],$data['name'],$email_for_sendmail,$site_name,$subject,$HTML)) {
            return true;
        }else{
            return false;
        }
	}
	public function email_for_password_reset($email_address,$code){
		//fix this
		$sql=$this->db->query("SELECT `site_name`,`email_for_sendmail` FROM site_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();
		$site_name=$row['site_name'];
		$email_for_sendmail=$row['email_for_sendmail'];

		$sql = $this->db->query("SELECT * FROM admins WHERE email = '".$email_address."' LIMIT 1");
		$row=$sql->row_array();
		$name=$row['name'];

		$link = base_url().'admin/fscp/change_password/'.$code.'/';
		$HTML = '
			<!DOCTYPE html>
		    <html style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			    <head>
			        <meta name="viewport" content="width=device-width">
			        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			        <title></title>
			    </head>
			    <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">
					<!-- body -->
			        <table class="body-wrap" bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
			            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" bgcolor="#FFFFFF" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">

			                	<!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                      	<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                      		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Dear '.$name.',
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			You have requested to change your password of admin panel on '.$site_name.' at '.base_url().'. Click on the button below to set a password.
			                            		</p>
			                            		<h3 style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 22px; line-height: 1.7em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			NOTE: if you haven\'t requested this password reset, please ignore this email.
			                            		</h3>


			                            		<!-- button -->
			                            		<table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: auto !important; Margin: 0 0 10px; padding: 0;">
			                            			<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                							<td style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size: 14px; line-height: 1.6em; border-radius: 25px; text-align: center; vertical-align: top; background: #348eda; margin: 0; padding: 0;" align="center" bgcolor="#348eda" valign="top">
			                                  				<a href="'.$link.'" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 2; color: #ffffff; border-radius: 25px; display: inline-block; cursor: pointer; font-weight: bold; text-decoration: none; background: #348eda; margin: 0; padding: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">
			                                  					Click here to set new password
			                                  				</a>
			                                			</td>
			                              			</tr>
			                              		</table>
			                					<!-- /button -->

			                            		
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Thanks, have a lovely day.
			                            		</p>
			                            		
			                          		</td>
			                        	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->    
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			    	<!-- /body -->
			    	<!-- footer -->
			    	<table class="footer-wrap" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; width: 100%; margin: 0; padding: 0;">
			    		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			            	<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; margin: 0 auto; padding: 0;">
			                      
			                    <!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                        	<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td align="center" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                              		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6em; color: #666666; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                              			
			                              			<!-- Don\'t like these annoying emails? <a href="#" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #999999; margin: 0; padding: 0;">
			                              			<unsubscribe style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">Unsubscribe
			                              			</unsubscribe></a>. -->
			                              			Made by Sapricami.com for '.$site_name.'
			                              		</p>
			                            	</td>
			                          	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->
			                      
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			        <!-- /footer -->
			    </body>
			</html>
		';

        $subject = 'Password reset request on '.$site_name.'. ';
        if($this->email($email_address,$name,$email_for_sendmail,$site_name,$subject,$HTML)) {
            return true;
        }else{
            return false;
        }
	}
	public function admins_password_changed($code,$password){
		//fix this
		$sql=$this->db->query("SELECT `site_name`,`email_for_sendmail` FROM site_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();
		$site_name=$row['site_name'];
		$email_for_sendmail=$row['email_for_sendmail'];

		$sql = $this->db->query("SELECT * FROM admins WHERE hash_for_email = '".$code."' LIMIT 1");
		$row=$sql->row_array();
		$name=$row['name'];
		$email_address=$row['email'];

		$link = base_url().'admin/login/';
		$HTML = '
			<!DOCTYPE html>
		    <html style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			    <head>
			        <meta name="viewport" content="width=device-width">
			        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			        <title></title>
			    </head>
			    <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">
					<!-- body -->
			        <table class="body-wrap" bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
			            <tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" bgcolor="#FFFFFF" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">

			                	<!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                      	<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                      		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Dear '.$name.',
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Your passwordis changed for admin panel on '.$site_name.' at '.base_url().'.
			                            		</p>
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Your Username : '.$email_address.' <br>
			                            			Your Password : '.$password.'
			                            		</p>


			                            		<!-- button -->
			                            		<table class="btn-primary" cellpadding="0" cellspacing="0" border="0" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: auto !important; Margin: 0 0 10px; padding: 0;">
			                            			<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                							<td style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size: 14px; line-height: 1.6em; border-radius: 25px; text-align: center; vertical-align: top; background: #348eda; margin: 0; padding: 0;" align="center" bgcolor="#348eda" valign="top">
			                                  				<a href="'.$link.'" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 2; color: #ffffff; border-radius: 25px; display: inline-block; cursor: pointer; font-weight: bold; text-decoration: none; background: #348eda; margin: 0; padding: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">
			                                  					Click here to login
			                                  				</a>
			                                			</td>
			                              			</tr>
			                              		</table>
			                					<!-- /button -->

			                            		
			                            		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                            			Thanks, have a lovely day.
			                            		</p>
			                            		
			                          		</td>
			                        	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->    
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			    	<!-- /body -->
			    	<!-- footer -->
			    	<table class="footer-wrap" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; width: 100%; margin: 0; padding: 0;">
			    		<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			            	<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			                <td class="container" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; margin: 0 auto; padding: 0;">
			                      
			                    <!-- content -->
			                    <div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
			                        <table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
			                        	<tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                				<td align="center" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
			                              		<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6em; color: #666666; font-weight: normal; margin: 0 0 10px; padding: 0;">
			                              			
			                              			<!-- Don\'t like these annoying emails? <a href="#" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #999999; margin: 0; padding: 0;">
			                              			<unsubscribe style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">Unsubscribe
			                              			</unsubscribe></a>. -->
			                              			Made by Sapricami.com for '.$site_name.'
			                              		</p>
			                            	</td>
			                          	</tr>
			                        </table>
			                	</div>
			                    <!-- /content -->
			                      
			                </td>
			                <td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
			            </tr>
			        </table>
			        <!-- /footer -->
			    </body>
			</html>
		';

        $subject = 'Password Changed for your account on '.$site_name.'. ';
        if($this->email($email_address,$name,$email_for_sendmail,$site_name,$subject,$HTML)) {
            return true;
        }else{
            return false;
        }
	}
	function email($to_email,$to_name,$from_email,$from_name,$subject,$HTML,$cc=null,$reply_email=null,$reply_name=null){

		$sql=$this->db->query("SELECT `smtp_hostname`,`smtp_port`,`smtp_username`,`smtp_password` FROM site_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();


		$this->load->library('My_PHPMailer');
        $mail = new PHPMailer();

        if (isset($row['smtp_hostname'])&&!empty($row['smtp_hostname'])) {
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = $row['smtp_hostname'];//"sapricami.com";
			$mail->Port = $row['smtp_port'];//25;
			$mail->SMTPAuth = true;
			$mail->Username = $row['smtp_username'];//"wingrow";
			$mail->Password = $row['smtp_password'];//"a9897716370A";
        }

		$mail->setFrom($from_email,$from_name);
		if(!empty($reply_email)){
			if(!empty($reply_name)){
				$mail->addReplyTo($from_email, $from_name);
			}else{
				$mail->addReplyTo($from_email, '');
			}
		}
        $mail->addAddress($to_email,$to_name);
        if(!empty($cc)){
        	$mail->addCC($cc);
        }
        $mail->Subject = $subject;
        $mail->msgHTML($HTML);
        $mail->AltBody = $HTML;
        if($mail->send()) {
            return true;
        }else{
            return false;
        }

    }
}