<?php 
$this->load->view($this->module.'nav'); 

if(isset($_GET['p'])){
	$this_page = $_GET['p'];
	if($this_page=='child'
		|| $this_page=='nav'
		|| strpos($this_page,'inc')
		|| strpos($this_page,'/')
		|| strpos($this_page,'footer')
		|| strpos($this_page,'sidebar')
		|| strpos($this_page,'header')
		|| strpos($this_page,'home')
	){
		$this->load->view('errors/404_in.php');
	}elseif(file_exists(APPPATH.'views/'.$this->module.''.$this_page.'.php')){
		$this->load->view($this->module.''.$this_page);
	}else{
		$this->load->view('errors/404_in.php');
	}
}else{
	$this->load->view($this->module.'index');
}