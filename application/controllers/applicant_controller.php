<?php

class Applicant_controller extends CI_Controller{

	public $data;
	
	public function __construct(){

		session_start();
		parent::__construct();

		$this->load->helper(array('url','form','language','file'));
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->model( array( "parms_model","cat_model","user_model","theme_model","applicant_model" ) );
		
	}

	function index(){


		if( $this->session->userdata('username') ){

			$user_id_session = $this->session->userdata('user_id');
			$theme = $this->uri->segment(3);

			if( is_numeric( $theme ) || empty( $theme )){

				$query = $this->theme_model->user_activated_theme( $user_id_session );

				$theme_session = array( 'theme_name' => $query );
				$this->session->set_userdata( $theme_session );
				$theme_permanent = $this->session->userdata( "theme_name" );

				$data['theme_name'] = $theme_permanent;
			  

			} else{		

				$query = $this->theme_model->activate_user_theme( $user_id_session, $theme );

				if( $query ){	
	
			   	 	$theme_session = array( 'theme_name' => $query );
				    $this->session->set_userdata( $theme_session );
				    $theme_permanent = $this->session->userdata( "theme_name" );

			   	 	$data['theme_name'] = $theme_permanent;
			   	 
			   	 } } }
	
		$query = $this->applicant_model->getapplicantList();
		$data['applicantList']  = $query['applicantList'];
		$data['totalApplicant']  = $query['totalApplicant'];
		$this->load->view('hris/view_crud_menu', $data);
		
	}

	function saveapplicant(){

		$applicantDetails = $this->input->post("applicant");
		$query = $this->applicant_model->save_applicant( $applicantDetails );

		if( $query ){

	    	$notification = "Success";
	    
	    } else{

	    	$notification = "Failed";

	    }

	    echo json_encode( array( 'notify' => $notification ) );

	}

	

}