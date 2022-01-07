<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sioen2 {
   
   public function __construct()
    {
        require_once APPPATH.'third_party/WouterSioen/SirTrevorBlock.php';
        require_once APPPATH.'third_party/WouterSioen/HtmlToJson.php';
        require_once APPPATH.'third_party/WouterSioen/JsonToHtml.php';
    }
  
}
