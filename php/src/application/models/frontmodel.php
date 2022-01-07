<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Frontmodel extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	function site_options(){
		$sql=$this->db->query("SELECT * FROM site_options WHERE id=1 LIMIT 1");
		return $sql->row_array();
	}
	function important_info()
	{
		$sql=$this->db->query("SELECT * FROM important_info WHERE id=1 LIMIT 1");
		return $sql->row_array();
	}
	function opengraph_tags($row)
	{
		$important_info=$this->important_info();
		$HTML ='';
		if(isset($important_info['og_status'])&&($important_info['og_status']=='ON')){
			//Opengraph
				$HTML.= '
	<!-- Opengraph -->';
			if( !empty($this->data['important_info']['seo_og_appid']) ){
				$HTML.= '
	<meta property="fb:app_id" content="'.$important_info['seo_og_appid'].'" />';
			}
			$HTML.= '
	<meta property="og:title" content="'.$row['og_title'].'" />';
			$HTML.= '
	<meta property="og:type" content="'.$row['og_type'].'" />';
			if(empty($row['og_image'])){
				$HTML.= '
	<meta property="og:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '
	<meta property="og:image" content="'.base_url().'uploads/pages/'.$row['og_image'].'" />';
			}
			$HTML.= '
	<meta property="og:url" content="'.base_url().$row['page_slug'].'" />';
			$HTML.= '
	<meta property="og:description" content="'.$row['og_description'].'" />';
			$HTML.= '
	<meta property="og:site_name" content="'.$important_info['seo_sitename'].'" />';
			$HTML.= '
	<!-- Opengraph -->';
		}
		if(isset($important_info['tc_status'])&&($important_info['tc_status']=='ON')){
			//Twitter Card
			$HTML.= '
	<!-- TwitterCard -->';
			$HTML.= '
	<meta name="twitter:title" content="'.$row['tw_title'].'" />';
			$HTML.= '
	<meta name="twitter:card" content="'.$row['tw_card'].'" />';
			if(empty($row['og_image'])){
				$HTML.= '
	<meta name="twitter:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '
	<meta name="twitter:image" content="'.base_url().'uploads/pages/'.$row['og_image'].'" />';
			}
			$HTML.= '
	<meta name="twitter:url" content="'.base_url().$row['page_slug'].'" />';
			$HTML.= '
	<meta name="twitter:description" content="'.$row['tw_description'].'" />';
			$HTML.= '
	<!-- TwitterCard -->';
		}
		return $HTML;
	}
	function opengraph_tags_projects($row,$photo)
	{
		$important_info=$this->important_info();
		$HTML ='';
		if(isset($important_info['og_status'])&&($important_info['og_status']=='ON')){
			//Opengraph
				$HTML.= '
	<!-- Opengraph -->';
			if( !empty($this->data['important_info']['seo_og_appid']) ){
				$HTML.= '<meta property="fb:app_id" content="'.$important_info['seo_og_appid'].'" />';
			}
			$HTML.= '<meta property="og:title" content="'.$row['project_seo_title'].'" />';
			$HTML.= '<meta property="og:type" content="website" />';
			if(empty($photo['photo_filename'])){
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/photos/'.$photo['photo_filename'].'" />';
			}
			$HTML.= '<meta property="og:url" content="'.base_url().'our-work/'.$row['project_slug'].'" />';
			$HTML.= '<meta property="og:description" content="'.$row['project_seo_description'].'" />';
			$HTML.= '<meta property="og:site_name" content="'.$important_info['seo_sitename'].'" />';
			$HTML.= '
	<!-- Opengraph -->';
		}
		if(isset($important_info['tc_status'])&&($important_info['tc_status']=='ON')){
			//Twitter Card
			$HTML.= '
	<!-- TwitterCard -->';
			$HTML.= '<meta name="twitter:title" content="'.$row['project_seo_title'].'" />';
			$HTML.= '<meta name="twitter:card" content="summary" />';
			if(empty($photo['photo_filename'])){
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/photos/'.$photo['photo_filename'].'" />';
			}
			$HTML.= '<meta name="twitter:url" content="'.base_url().'our-work/'.$row['project_slug'].'" />';
			$HTML.= '<meta name="twitter:description" content="'.$row['project_seo_description'].'" />';
			$HTML.= '
	<!-- TwitterCard -->';
		}
		return $HTML;
	}
	function opengraph_tags_blog_post($row,$second_aug)
	{
		$important_info=$this->important_info();
		$HTML ='';
		if(isset($important_info['og_status'])&&($important_info['og_status']=='ON')){
			//Opengraph
				$HTML.= '
	<!-- Opengraph -->';
			if( !empty($this->data['important_info']['seo_og_appid']) ){
				$HTML.= '<meta property="fb:app_id" content="'.$important_info['seo_og_appid'].'" />';
			}
			$HTML.= '<meta property="og:title" content="'.$row['blog_seo_title'].'" />';
			$HTML.= '<meta property="og:type" content="article" />';
			if(empty($row['blog_photo'])){
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/blog/'.$row['blog_photo'].'" />';
			}
			$HTML.= '<meta property="og:url" content="'.base_url().'blog/'.$second_aug.'/'.$row['blog_slug'].'" />';
			$HTML.= '<meta property="og:description" content="'.$row['blog_seo_description'].'" />';
			$HTML.= '<meta property="og:site_name" content="'.$important_info['seo_sitename'].'" />';
			$HTML.= '
	<!-- Opengraph -->';
		}
		if(isset($important_info['tc_status'])&&($important_info['tc_status']=='ON')){
			//Twitter Card
			$HTML.= '
	<!-- TwitterCard -->';
			$HTML.= '<meta name="twitter:title" content="'.$row['blog_seo_title'].'" />';
			$HTML.= '<meta name="twitter:card" content="summary" />';
			if(empty($row['blog_photo'])){
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/blog/'.$row['blog_photo'].'" />';
			}
			$HTML.= '<meta name="twitter:url" content="'.base_url().'blog/'.$second_aug.'/'.$row['blog_slug'].'" />';
			$HTML.= '<meta name="twitter:description" content="'.$row['blog_seo_description'].'" />';
			$HTML.= '
	<!-- TwitterCard -->';
		}
		return $HTML;
	}
	function opengraph_tags_blog_category($row)
	{
		$important_info=$this->important_info();
		$HTML ='';
		if(isset($important_info['og_status'])&&($important_info['og_status']=='ON')){
			//Opengraph
				$HTML.= '
	<!-- Opengraph -->';
			if( !empty($this->data['important_info']['seo_og_appid']) ){
				$HTML.= '<meta property="fb:app_id" content="'.$important_info['seo_og_appid'].'" />';
			}
			$HTML.= '<meta property="og:title" content="'.$row['blog_category_seo_title'].'" />';
			$HTML.= '<meta property="og:type" content="website" />';
			if(empty($row['blog_category_image'])){
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta property="og:image" content="'.base_url().'uploads/blog/'.$row['blog_category_image'].'" />';
			}
			$HTML.= '<meta property="og:url" content="'.base_url().'blog/'.$row['blog_category_slug'].'" />';
			$HTML.= '<meta property="og:description" content="'.$row['blog_category_seo_description'].'" />';
			$HTML.= '<meta property="og:site_name" content="'.$important_info['seo_sitename'].'" />';
			$HTML.= '
	<!-- Opengraph -->';
		}
		if(isset($important_info['tc_status'])&&($important_info['tc_status']=='ON')){
			//Twitter Card
			$HTML.= '
	<!-- TwitterCard -->';
			$HTML.= '<meta name="twitter:title" content="'.$row['blog_category_seo_title'].'" />';
			$HTML.= '<meta name="twitter:card" content="summary" />';
			if(empty($row['og_image'])){
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/pages/'.$important_info['seo_image'].'" />';
			}else{
				$HTML.= '<meta name="twitter:image" content="'.base_url().'uploads/blog/'.$row['blog_category_image'].'" />';
			}
			$HTML.= '<meta name="twitter:url" content="'.base_url().'blog/'.$row['blog_category_slug'].'" />';
			$HTML.= '<meta name="twitter:description" content="'.$row['blog_category_seo_description'].'" />';
			$HTML.= '
	<!-- TwitterCard -->';
		}
		return $HTML;
	}
	function display_children($parent, $level,$HTML='') {
		$site_options=$this->site_options();
	    $result = $this->db->query("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent." ORDER BY sort ASC");
	    if($site_options['theme']=='material'){
		    if($level==0){
		    	$HTML.='<ul class="nav navbar-nav navbar-right">';
		    }else{
		    	$HTML.='<ul class="dropdown-menu" aria-labelledby="download">';
		    }
		    foreach ($result->result_array() as $row) {
		        if ($row['Count'] > 0) {
		        	if($level==0){
		        		$HTML.= '<li class="dropdown">
		        					<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void();">' . ucwords($row['label']) . ' <span class="caret"></span></a>
		        					';
		        	}else{
		        		$HTML.= '<li>
		        					<a href="#">' . ucwords($row['label']) . ' </a>';
		        	}
		            $HTML.=$this->frontmodel->display_children($row['id'], $level + 1);
		            $HTML.= '</li>';
		        } elseif ($row['Count']==0) {
		            $HTML.= '<li><a href="' . base_url() . $row['link'] . '">' . ucwords($row['label']) . '</a></li>';
		        } else;
		    }
		    $HTML.= '</ul>';
	    }else{
	    	if($level==0){
		    	$HTML.='<ul class="nav navbar-nav navbar-right">';
		    }else{
		    	$HTML.='<ul class="dropdown-menu" role="menu">';
		    }
		    foreach ($result->result_array() as $row) {
		        if ($row['Count'] > 0) {
		        	if($level==0){
		        		$HTML.= '<li class="dropdown">
		        					<a class="dropdown-toggle" data-toggle="dropdown" href="#"  role="button" aria-expanded="false">' . ucwords($row['label']) . ' <span class="caret"></span></a>
		        					';
		        	}else{
		        		$HTML.= '<li>
		        					<a href="#">' . ucwords($row['label']) . ' </a>';
		        	}
		            $HTML.=$this->frontmodel->display_children($row['id'], $level + 1);
		            $HTML.= '</li>';
		        } elseif ($row['Count']==0) {
		            $HTML.= '<li><a href="' . base_url() . $row['link'] . '">' . ucwords($row['label']) . '</a></li>';
		        } else;
		    }
		    $HTML.= '</ul>';
		}
	    return $HTML;
	}
	function custom_pagination($base_path,$total_pages,$page_no)
    {
        $HTML='';
        if ($total_pages>1) {
            $HTML.= '<div class="styled-pagination text-center margin-bott-40">
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
    function footer_blocks(){
    	$sql = $this->db->query("SELECT * FROM custom_block WHERE part_id='footer' ");
    	return $sql->result_array();
    }
    function visitor_submit()
    {
    	date_default_timezone_set('Asia/Calcutta');
    	$this->load->library('user_agent');
    	//$src = $this->agent->is_referral()?explode('/',$this->agent->referrer()):NULL;
        $device = ($this->agent->is_robot())? 'BOT' : ( $this->agent->is_mobile() ? 'MOBILE' : 'PC' ); 
        //$cur_link = uri_string() == NULL ? 'home' : end(explode('/',uri_string()));
        $cur_link = uri_string();

        $data = array(
            'ip' => $this->input->ip_address(),
            'page_link' => $cur_link,
            'browser' => $this->agent->browser().'-'.$this->agent->version(),
            'os' => $this->agent->platform(),
            'device'=>$device,
            'device_str' => $this->agent->agent_string(),
            'time_stamp' => date('Y-m-d G:i:s D'),
        );

        /*if(!isset($_COOKIE['visitor_data'])){
			setcookie('visitor_data', implode(', ', $data));
        }*/

        if($device=='BOT'){
        	$this->db->insert('visitor_log_bot',$data);
        }else{
        	$this->db->insert('visitor_log',$data);
        }
    }
    function email($to_email,$to_name,$from,$subject,$html_array,$cc=null){
    	$sql=$this->db->query("SELECT `email_for_sendmail`,`site_name`,`email1` FROM site_options WHERE id=1 LIMIT 1");
		$row=$sql->row_array();
		$site_name=$row['site_name'];
		$email_for_sendmail=$row['email_for_sendmail'];

		$data_email = array(
			'to_name' => $to_name,
			'site_name' => $site_name,
			'html_array' => $html_array,
			);
		$HTML = $this->load->view('email/template_1',$data_email,TRUE);

        if($this->email_smtp($to_email,'',$email_for_sendmail,$site_name,$subject,$HTML,'',$from,'')) {
            return true;
        }else{
            return false;
        }

    }
    function email_smtp($to_email,$to_name,$from_email,$from_name,$subject,$HTML,$cc=null,$reply_email=null,$reply_name=null){

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