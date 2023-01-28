<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('layout')){
     function layout($vista,$data){
		    $this->load->view('head');
		    $this->load->view($vista,$data);
		    $this->load->view('footer');
	 }
}