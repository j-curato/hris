<?php

class Main_controller extends CI_Controller{

	public $data;
	
	public function __construct(){

		session_start();
		parent::__construct();

		$this->load->helper( array('url','form','language','file') );
		$this->load->library( array('session', 'excel') );
		$this->load->helper('string');
		$this->load->model( array( "parms_model","cat_model","user_model","theme_model","applicant_model" ) );
		
		
	}

	function index(){
		
		$this->load->view('hris/view_front_menu');
		
	}

	function parms_login(){

		$data['boolean_login_form'] = TRUE;
		$user_account = $this->uri->segment(3);
		$data['invalid_user_account'] = (isset($user_account) ? $user_account : false);
		$this->load->view("hris/view_front_menu", $data);
	}

	function validate_user(){
		
		$user_account = (isset($_POST["user"]) ? $_POST["user"] : false);
		$query_password = $this->user_model->get_user_compare_password( $user_account['email_add'] );
		$query_user = $this->user_model->validate_users( $user_account, $query_password["password"] );

		if( $query_user ){ 

			$online_user = array( 
								  'user_id' => $query_user[0]->ID, 'username' => $query_user[0]->username, 'password' => $query_user[0]->password, 
								  'user_status' => $query_user[0]->status, 'user_level' => $query_user[0]->privilege, 'fname' => $query_user[0]->fname
								);

			$this->session->set_userdata( $online_user );
			
			redirect('main_controller/main_menu');

		} else{	
			
			redirect('main_controller/parms_login/'.$user_account['email_add']);
		}

	}


	function main_menu(){

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
			   	 
			   	 }

			}

	        $query = $this->applicant_model->getapplicantList();
	        $queryPosition = $this->applicant_model->getListPosition();
			$data['applicantList']  = $query['applicantList'];
			$data['applicantExp']  = $query['applicantExperience'];
			$data['applicantSem']  = $query['applicantSeminar'];
			$data['positionsList']  = $queryPosition['positionsList'];
			$data['totalApplicant']  = $query['totalApplicant'];
			
			$this->load->view('hris/view_crud_menu', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}
		
	}


	function parms_form(){
		
		$data['welcome_username'] = $this->session->userdata("username");
		$this->load->view("hris/view_parms_form",$data);
	}


	public function save_par_form_data(){

      
    	$file_id = "userfile";
        $config = array(

        		'upload_path' => "./scanned_docs",
        		'allowed_types' => "gif|jpg|jpeg|png|pdf|doc|docx|ppt|pptx|xml|xls|xlsx",
        		'encrypt_name' => FALSE,
        		'max_size' => "1000000KB"
        	);

		$this->load->library('upload', $config);
		//$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($file_id) ){

           return false;

		} else{

			$data =  $this->upload->data();
			
            $title = $this->input->post('title');
            $date = $this->input->post('date');
            $venue = $this->input->post('venue');
            $sponsor = $this->input->post('sponsor');
            $category = $this->input->post('category');
            $file_name = $data['file_name'];

            $query = $this->parms_model->insert_par_content($title,$date,$venue,$sponsor,$category,$file_name);
            $query_latest_row = $this->parms_model->get_latest_par_data();
            $query_count = $this->parms_model->count_par_list();

              if($query){
                 $notify = "Success";
               }
               else{
                 $notify = "Failed";
               }
		}


  	 	echo json_encode(array( 'notify' => $notify, 
  	 						 	'latest_content' => $query_latest_row, 
  	 						 	'parCount' => $query_count["total_par"] 
  	 					   	  ));

	}

	// Categoty save function

	function save_position_form_data(){

		$position_data = $this->input->post("arrayPos");
        $query = $this->cat_model->insert_position_content($position_data);
        $query_latest_row = $this->cat_model->get_latest_position_data();
        $query_count = $this->cat_model->count_position_list();

          if($query){

              $notify = "Success";

           }else{

                 $notify = "Failed";

            }

  	 	echo json_encode(array( 'notify' => $notify, 
  	 						 	'latest_content' => $query_latest_row, 
  	 						 	'positionCounter' => $query_count["total_position_record"] 
  	 					   	  ));

	}

	// Save item number

	function insert_item_number(){

	    $item_data = $this->input->post("item");
        $query = $this->cat_model->insert_item_content( $item_data );
       // $query_latest_row = $this->cat_model->get_latest_position_data();
        //$query_count = $this->cat_model->count_position_list();

        if($query){

            $notify = "Success";

        } else{

           $notify = "Failed";

        }

  	 	echo json_encode(array( 'notify' => $notify ));

	}


	function view_par(){
		
		$par_id = $this->uri->segment(3);
		$data['par_details'] = $this->parms_model->get_specific_par($par_id);
		$this->load->view('hris/view_specific_par',$data);

	}

	function edit_par(){

		$par_id = $this->uri->segment(3);
		$data['par_details'] = $this->parms_model->get_to_edit_par_detail($par_id);
		$this->load->view('hris/view_crud_menu',$data);
		//$this->load->view('parms/view_parms_form',$data);
	}

	function save_edited_par(){

		date_default_timezone_set("Asia/Manila");
		$date_updated = date("Y-m-d H:i:s");
		$hidden_file = $this->input->post('hidden_file');

		if(empty($hidden_file)){

			 					
			 $par_id = $this->input->post('par_id');

	         $array_edited_par = array(

		         						'title_of_activity'	=>	$this->input->post('title'), 
			 							'date'				=>	$this->input->post('date'),
			 							'venue'				=>	$this->input->post('venue'),
			 							'sponsors'			=>	$this->input->post('sponsor'),
			 							'category'			=>	$this->input->post('category'),
			 							'date_updated'		=>	$date_updated
	
		 							  );

	         $query = $this->parms_model->edit_par_content_Xfilename($par_id, $array_edited_par);

	         if($query){
	         	$notification = "Success";
	         } else{
	         	$notification = "Failed";
	         }

	         echo json_encode(array('notify' => $notification, 'data_edited' => $array_edited_par, 'data_id' => $par_id));

		} else{

			$file_id = "userfile-edit";
            $config = array(

        		'upload_path' => "./scanned_docs",
        		'allowed_types' => "gif|jpg|jpeg|png|pdf|doc|docx|ppt|pptx|xml|xls|xlsx",
        		'encrypt_name' => FALSE,
        		'max_size' => "1000000KB"
        	);

			$this->load->library('upload', $config);
			//$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload($file_id)){
	           return false;
			} else {
				$data =  $this->upload->data();
				
	            $par_id = $this->input->post('par_id');
	           
	            $par_edited_array = array(
				 							'title_of_activity'		=>	$this->input->post('title'), 
				 							'date'					=>	$this->input->post('date'),
				 							'venue'					=>	$this->input->post('venue'),
				 							'sponsors'				=>	$this->input->post('sponsor'),
				 							'category'				=>	$this->input->post('category'),
				 							'scanned_file'			=>	$data['file_name'],
				 							'date_updated'			=>	$date_updated
		 						          );

	            $query = $this->parms_model->edit_par_content($par_id,$par_edited_array);

	              if($query){

	                 $notification = "Success";

	               } else{

	                 $notification = "Failed";

	               }
			}


  	  		echo json_encode( array( 'notify' => $notification ) );
  	  		//echo json_encode(array('notify' => $notification, 'data_edited' => $par_edited_array, 'data_id' => $par_id));
		}

		
	}

	//Save edited PAR Category

	function save_edited_cat(){

	    $catData = $this->input->post("arrayCat");
	    $query = $this->cat_model->edit_cat_content($catData);

	    if( $query ){

	    	$notification = "Success";
	    
	    } else{

	    	$notification = "Failed";

	    }

	    echo json_encode( array( 'notify' => $notification ) );

	}


	function test_serial(){

		$file_name = "\\"."bu.png";

		echo base_url("scanned_docs/". $file_name);

		unlink("C:\wamp\www\dti_infosys\scanned_docs".$file_name);
	}

	
	//Delete PAR

	function delete_par(){
		
		$par_ids = $this->input->post('par_IDs');
		$file_name = $this->input->post("file_names");
		//$file_name = "BRICS.jpg";
		$query = $this->parms_model->delete_specific_par($par_ids);

		if( $query ){

			for( $i=0; $i < sizeof($file_name); $i++){

				$slash_file_name[$i] = "\\".$file_name[$i];
	    		unlink("C:\wamp\www\dti_infosys\scanned_docs".$slash_file_name[$i]);
    	     }


    		$notification = "Success";
			$queryCount = $this->parms_model->count_par_list();
			echo json_encode( array( 'notify' => $notification, 'parCount' => $queryCount["total_par"] ) );

		} else{

			$notification = "Failed";
			echo json_encode( array( 'notify' => $notification ) );
		}

		
		
	}


	//Delete PAR Category

	function delete_cat(){
		
		$cat_ids = $this->input->post('cat_IDs');
		$query = $this->cat_model->delete_specific_cat($cat_ids);

		if( $query ){

			$notification = "Success";
			$queryCount = $this->cat_model->count_position_list();
			echo json_encode( array( 'notify' => $notification, 'catCount' => $queryCount["total_position_record"] ) );

		} else{

			$notification = "Failed";
			echo json_encode( array( 'notify' => $notification ) );

		}

		//echo json_encode( array( 'notify' => $notification, 'catCount' => $queryCount["total_cat"] ) );
		
	}


	//Delete User Function

	function delete_user(){

		$user_ids = $this->input->post('user_IDs');
		$query = $this->user_model->delete_specific_user($user_ids);

		if( $query ){

			$notification = "Success";
			$queryCount = $this->user_model->count_user_list();
			echo json_encode( array( 'notify' => $notification, 'userCount' => $queryCount["total_user"] ) );

		} else{

			$notification = "Failed";
			echo json_encode( array( 'notify' => $notification ) );

		}

	}


	function test_session(){
		var_dump($this->session->userdata("user_status"));
	}

	function logout(){

		 $this->session->sess_destroy();
		 redirect('main_controller/parms_login');
	}


	function sample_load(){
		$this->load->model("sample_model");
		$data['node_list'] = $this->sample_model->get_content_sample_data();
		$this->load->view("hris/sample_ajax_load", $data);
	}


	function insert_sample_data(){

		$this->load->model("sample_model");

		$array_movie = $this->input->post('movie');


		  if(isset($array_movie)){
			   //$content = $_POST['contents'];
			   $query = $this->sample_model->insert_sample_data($array_movie);
			   $query_get = $this->sample_model->get_latest_data();
			   //echo "<b>" . $query_get[0]->contents . "</b></br>";
			   $output_str = array('content' => $query_get);
			   echo json_encode($output_str);
		   }
 
		//$this->load->view("parms/sample_ajax_load");
	}

	function get_par_data(){

		$this->load->model("sample_model");
		$query_get = $this->sample_model->get_content_sample_data();
		//echo "<b>" . $query_get[0]->contents . "</b></br>";
		$output_str = array('content' => $query_get);
		echo json_encode($output_str);
	}

	function get_parms_data(){

		$query_par_list = $this->parms_model->get_par_list();
		echo json_encode(array('par' => $query_par_list));

	}

	function get_autosearch_par_data(){

		$searchFilterText = $_GET['searchFilterText'];

	    if (isset($_GET['term'])){
	      $search_key = strtolower($_GET['term']);
	      $this->parms_model->auto_search_par( $searchFilterText, $search_key );
	    }
    }

    function get_autosearch_position_data(){

    	if (isset($_GET['term'])){
	      $search_key = strtolower($_GET['term']);
	      $this->cat_model->auto_search_position($search_key);
	    }

    }

    function get_autosearch_user_data(){

    	if (isset($_GET['term'])){
	      $search_key = strtolower($_GET['term']);
	      $this->user_model->auto_search_user($search_key);
	    }

    }

    function search_par_control(){

    	$searchTextFilter = $this->input->post("searchTextFilter");
    	$search_key = $this->input->post("search_val");
    	$query = $this->parms_model->search_par_model( $searchTextFilter, $search_key );

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'search_par' => $query["search_result"], 'parCount' => $query["total_par"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }


     function search_position_control(){

    	$search_key = $this->input->post("search_val");
    	$query = $this->cat_model->search_position_model($search_key);

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'search_position' => $query["search_result"], 'positionCounter' => $query["total_position_record"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }


    function search_position_id(){

    	$search_key = $this->input->post( "search_val" );
    	$query = $this->cat_model->search_position_id( $search_key );

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'posID' => $query["search_result"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }

    // Get Qualified Candidates details

    function get_qualifiedCandidates_details(){

    	$search_key = $this->input->post( "posID" );
    	$query = $this->cat_model->search_qualified_candidates( $search_key );

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'qualifiedCandidates' => $query["search_result"], 'numQualifiedCandidates' => $query["numQualifiedCandidates"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }

    //Search for candidates

     function search_candidates_control(){

    	$search_key = $this->input->post("search_val");
    	$query = $this->cat_model->search_position_model($search_key);

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'search_position' => $query["search_result"], 'positionCounter' => $query["total_position_record"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }


    //Print Qualified Candidates

    function print_qualified_candidates(){

    	$appIDsArray = [];
    	$posID = $this->uri->segment(3);
    	$query = $this->cat_model->print_qualified_candidates( $posID );

    	$data['qualified_applicants'] = $query['search_result_applicants'];
    	$data['positionDetails'] = $query['search_result_position'];
    	$data['item_results'] = $query['search_result_item'];

    	$output = array_map(function ($object) { return $object->id; }, $query['search_result_IDs']);
        //echo implode(', ', $output);

    	$queryExp = $this->cat_model->get_work_training_details( $output );


    	$data['appExp'] = $queryExp['search_result_experience'];
    	$data['appTraining'] = $queryExp['search_result_training'];
	
		$this->load->view('hris/view_qualified_candidates', $data);    

    }


    //Search user on keypress

    function search_user_control(){

    	$search_key = $this->input->post("search_val");
    	$query = $this->user_model->search_user_model($search_key);

    	if( $query ){

    		$notification = "Success";

    	} else{

    		$notification = "Failed";

    	}

    	$output_search = array( 'search_user' => $query["search_result"], 'userCount' => $query["total_user"], 'notify' => $notification );
    	echo json_encode( $output_search );

    }


    function add_position(){

    	if($this->session->userdata('username')){

			$this->load->library('pagination');
			$config["base_url"] = base_url() . "main_controller/add_position/";
	        $result = $this->cat_model->count_position_list();
	        $config["total_rows"] = $result['total_position_record'];
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        $query = $this->cat_model->get_position_list($config["per_page"],$page);
          	$data['position_list'] = $query['position_rows'];
          	$data['position_total'] = $result['total_position_record'];
	        $data["links"] = $this->pagination->create_links();
			$this->load->view('hris/view_position_crud', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}

    }


    function add_item_number(){

    	if($this->session->userdata('username')){

			$this->load->library('pagination');
			$config["base_url"] = base_url() . "main_controller/add_item_number/";
	        $result = $this->cat_model->count_item_list();
	        $config["total_rows"] = $result['total_item_record'];
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        $query = $this->cat_model->get_item_list($config["per_page"],$page);
	        $querypos = $this->cat_model->get_position_list( $config["per_page"],$page );
          	$data['position_list'] = $querypos['position_rows'];
          	$data['item_list'] = $query['item_rows'];
          	$data['item_total'] = $result['total_item_record'];
	        $data["links"] = $this->pagination->create_links();
			$this->load->view('hris/view_item_numbers', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}

    }


    function view_users(){

	 if($this->session->userdata('username')){

		$this->load->library('pagination');
		$this->load->model("user_model");
		$config["base_url"] = base_url() . "main_controller/view_users/";
		$result = $this->user_model->count_user_list();
		$config["total_rows"] = $result['total_user'];
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$query = $this->user_model->get_user_list($config["per_page"],$page);
		$data['user_list'] = $query['user_rows'];
		$data['user_total'] = $result['total_user'];
		$data["links"] = $this->pagination->create_links();

		$this->load->view('hris/view_user_crud', $data);

		} else{

		$session_expired = "session_expired";
		redirect('main_controller/parms_login/'.$session_expired);

		}

    }

    function add_user(){

    	$hash_password = password_hash( $_POST["password"], PASSWORD_DEFAULT );
    	$user_data = array( "fname" => $_POST["fname"], 
    					    "lname" => $_POST["lname"],
    					    "username" => $_POST["username"],
    					    "position" => $_POST["position"],
    					    "password" => $hash_password,
    					    "privilege" => $_POST["privilege"],
    					    "status" => $_POST["status"],
    					    "theme_name" => $_POST["theme_name"]
    					   );
    	$query = $this->user_model->add_user($user_data);
        $query_latest_row = $this->user_model->get_latest_user_data();
        $query_count = $this->user_model->count_user_list();

        if($query){
             $notify = "Success";
         } else{
             $notify = "Failed";
         }
		

  	 	echo json_encode(array( 'notify' => $notify, 
  	 						 	'latest_content' => $query_latest_row, 
  	 						 	'userCount' => $query_count["total_user"] 
  	 					   	  ));

    }

    function save_edited_user(){

    	$user_id = $this->input->post("user_id");
    	$user_password = $_POST["new_password"];

    	if(empty($user_password)){

    	   $user_edited_array = array( "fname"     => $_POST["fname"], 
						    		   "lname"     => $_POST["lname"], 
						    		   "username"  => $_POST["username"], 
						    		   "position"  => $_POST["position"],
						    		   "privilege" => $_POST["privilege"]
						    	     );
    	} else{

    		$user_edited_array = array( "fname"    => $_POST["fname"], 
						    			"lname"    => $_POST["lname"], 
						    			"username" => $_POST["username"], 
						    			"position" => $_POST["position"],
						    			"privilege" => $_POST["privilege"],
						    			"password" => password_hash( $user_password, PASSWORD_DEFAULT )
						    	      );
    	}
    	

    	$query = $this->user_model->save_edited_user( $user_id, $user_edited_array );

    	if( $query ){
 			$notification = "Success";   		
    	 } else{
    		$notification = "Failed";
    	 }

    	echo json_encode(array( 'notify' => $notification ));
    }

    function check_current_password(){

    	$user_id = $this->input->post("user_id");
    	$entered_password = $this->input->post("entered_password");

    	$query = $this->user_model->check_current_password( $user_id, $entered_password );

    	if( $query ){
    		$notification = "Success";
    	} else{
    		$notification = "Failed";
    	}

    	echo json_encode(array( "notify" => $notification ));

    }

    function show_monthly_analytics(){

    	$current_date = getdate();

    	if( $this->session->userdata('username') ){

    		$query = $this->parms_model->count_uploads_perMonth( $current_date['year'] );
    		$data["data_uploads"] = $query["uploads_result"];
    		$data["upload_year"] = $this->parms_model->get_year();
    		$this->load->view('hris/view_monthly_analytics', $data);

    	} else{

    		$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

    	}

    }

    function show_monthly_analytics_ajax(){

    	$year_val = $_POST["year_val"];
    	$query = $this->parms_model->count_uploads_perMonth( $year_val );

    	if( $query ){

    		echo json_encode(array('notify' => 'Success','upload_data' => $query["uploads_result"]));

    	} else{
    		echo json_encode(array('notify' => 'Failed'));
    	}
    }

    // Check for PAR Title duplicates

   function check_title_exist(){

	   	$title_to_check = $_POST["check_title"];

	   	$query = $this->parms_model->check_title_duplicate( $title_to_check );

	   	if( $query ){
	   		$notification = "Success";
	   	} else{
	   		$notification = "Failed";
	   	}

	   	echo json_encode(array('notify' => $notification));

   }

   //Applicant function

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

	function update_applicant(){

		//$applicantID = $this->input->post('appID');
		$applicantDetails = $this->input->post("applicant");
		$query = $this->applicant_model->update_applicant( $applicantDetails );

		if( $query ){

	    	$notification = "Success";
	    
	    } else{

	    	$notification = "Failed";

	    }

	    echo json_encode( array( 'notify' => $notification ) );

	}

	function update_app_work(){

		$appWorkDetails = $this->input->post("applicant");
		$query = $this->applicant_model->update_applicant_work( $appWorkDetails );

		if( $query ){

			$notification = "Success";

		}else{

			$notification = "Failed";
		}

		echo json_encode( array( 'notify' => $notification ) );
	}


	function update_app_seminar(){

		$appSeminarDetails = $this->input->post("applicant");
		$query = $this->applicant_model->update_applicant_seminar( $appSeminarDetails );

		if( $query ){

			$notification = "Success";

		}else{

			$notification = "Failed";
		}

		echo json_encode( array( 'notify' => $notification ) );
	}


	function update_position_details(){

		$appPosDetails = $this->input->post('arrPos');
		$query = $this->applicant_model->update_position_details( $appPosDetails );

		if( $query ){

			$notification = "Success";

		}else{

			$notification = "Failed";

		}

		echo json_encode( array( 'notify' => $notification ) );

	}



	function save_workExperience(){
	   
	   $workExperience = $this->input->post('applicant');
	   $query = $this->applicant_model->saveWorkExperience( $workExperience );

	   if( $query ){
	   	  $notification = "Success";
	   }else{
	   	  $notification = "Failed";
	   }

	   echo json_encode(array( 'notify' => $notification, 'workDetails' => $query ));

	}

	function saveSeminarTraining(){

	   $seminarDetails = $this->input->post('applicant');
	   $query = $this->applicant_model->saveSeminarTraining( $seminarDetails );

	   if( $query ){
	   	  $notification = "Success";
	   }else{
	   	  $notification = "Failed";
	   }

	   echo json_encode(array( 'notify' => $notification ));

	}


	function delete_applicantRecord(){

		$applicantIDS = $this->input->post('applicantIDs');
		$query = $this->applicant_model->delete_applicant( $applicantIDS );

		if( $query ){

			/*for( $i=0; $i < sizeof($file_name); $i++){

				$slash_file_name[$i] = "\\".$file_name[$i];
	    		unlink("C:\wamp\www\dti_infosys\scanned_docs".$slash_file_name[$i]);
    	     }*/

    		$notification = "Success";
			
		} else{

			$notification = "Failed";

		}

		echo json_encode( array( 'notify' => $notification ) );

	}


	function delete_applicantWorkRecord(){

		$applicantWorkIds = $this->input->post('applicantIDs');
		$query = $this->applicant_model->delete_applicant_workExperience( $applicantWorkIds );

		if( $query ){
			$notification = "Success";
		} else{
			$notification = "Failed";
		}

		echo json_encode( array( 'notify' => $notification ) );


	}


	function delete_applicantSeminarDetails(){

		$applicantSeminarIDs = $this->input->post('applicantIDs');
		$query = $this->applicant_model->delete_applicant_seminarDetails( $applicantSeminarIDs );

		if( $query ){
			$notification = "Success";
		} else{
			$notification = "Failed";
		}

		echo json_encode( array( 'notify' => $notification ) );


	}


	function showWorkExperience(){

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
			   	 
			   	 }

			}

			$query = $this->applicant_model->getAppWorkExp( $this->uri->segment(3) );
			$data['appList'] = $query["applicantList"];
			$data['appWorkExp'] = $query["applicantExperience"];
			$data['appProfilePic'] = $query['applicantProfilePic'];
			$data['applicantID'] = $this->uri->segment(3);
			$this->load->view('hris/view_applicant_workExp', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}
		
	}

	function showSeminarTrainings(){

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
			   	 
			   	 }

			}

			//$data['appID'] = $this->uri->segment(3);
			$query = $this->applicant_model->getAppSeminar( $this->uri->segment(3) );
			$data['appList'] = $query["applicantList"];
			$data['appSeminar'] = $query["applicantSeminar"];
			$data['applicantID'] = $this->uri->segment(3);
			$this->load->view('hris/view_applicant_seminar', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}

	}


	function saveApplicantPhoto(){

		$file_id = "userfile";

        $config = array(

        		'upload_path' => "./scanned_docs",
        		'allowed_types' => "gif|jpg|jpeg|png|pdf",
        		'encrypt_name' => FALSE,
        		'max_size' => "1000000KB"
        	);

		$this->load->library('upload', $config);
		//$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($file_id) ){

           return false;

		} else{

			$data =  $this->upload->data();
            $appID = $this->input->post('applicantID');
            $file_name = $data['file_name'];

            $query = $this->applicant_model->saveApplicantPhoto( $appID, $file_name );

            if($query){
               $notify = "Success";
             }
             else{
               $notify = "Failed";
             }
		}


  	 	echo json_encode( array( 'notify' => $notify ) );

	}


	function exportToExcel(){

        /*
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Users list');

        //Apply styling to header cells
        $this->excel->getActiveSheet()->getStyle("A1:V1")->applyFromArray(array("font" => array("bold" => true)));

        // Trying to set a column name
        $this->excel->getActiveSheet()->SetCellValue('A1', 'ID');
        $this->excel->getActiveSheet()->SetCellValue('B1', 'DATE RECEIVED');
        $this->excel->getActiveSheet()->SetCellValue('C1', 'LAST NAME');
        $this->excel->getActiveSheet()->SetCellValue('D1', 'FIRST NAME');
        $this->excel->getActiveSheet()->SetCellValue('E1', 'MIDDLE NAME');
        $this->excel->getActiveSheet()->SetCellValue('F1', 'AGE');
        $this->excel->getActiveSheet()->SetCellValue('G1', 'STATUS');
        $this->excel->getActiveSheet()->SetCellValue('H1', 'SEX');
        $this->excel->getActiveSheet()->SetCellValue('I1', 'ADDRESS');
        $this->excel->getActiveSheet()->SetCellValue('J1', 'MUNICIPALITY');
        $this->excel->getActiveSheet()->SetCellValue('K1', 'PROVINCE');
        $this->excel->getActiveSheet()->SetCellValue('L1', 'CONTACT NUMBER');
        $this->excel->getActiveSheet()->SetCellValue('M1', 'DESIRED POSITION');
        $this->excel->getActiveSheet()->SetCellValue('N1', 'POSITION QUALIFIED');
        $this->excel->getActiveSheet()->SetCellValue('O1', 'SCHOOL ATTENDED');
        $this->excel->getActiveSheet()->SetCellValue('P1', 'EDUCATION UNDERGRAD');
        $this->excel->getActiveSheet()->SetCellValue('Q1', 'YEAR GRADUATED');
        $this->excel->getActiveSheet()->SetCellValue('R1', 'EDUCATION POSTGRAD');
        $this->excel->getActiveSheet()->SetCellValue('S1', 'SCHOOL ATTENDED POSTGRAD');
        $this->excel->getActiveSheet()->SetCellValue('T1', 'ELIGIBILITY');
        $this->excel->getActiveSheet()->SetCellValue('U1', 'CREATED AT');
        $this->excel->getActiveSheet()->SetCellValue('V1', 'UPDATED AT');
 
 		//get all applicants
        $applicants = $this->applicant_model->getApplicantsAllList();
 
        // read data to active sheet
        $this->excel->getActiveSheet()->fromArray( $applicants, null, 'A2' );
 
        $filename='applicants.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');*/

            $query = $this->applicant_model->getapplicantList();
	        $queryPosition = $this->applicant_model->getListPosition();
			$data['applicantList']  = $query['applicantList'];
			$data['positionsList']  = $queryPosition['positionsList'];
			
			$this->load->view('hris/view_export_allApplicants', $data);


	}


	function list_of_candidates(){

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
			   	 
			   	 }

			}

			$this->load->view('hris/view_filter_applicants_per_position', $data);

		} else{

			$session_expired = "session_expired";
			redirect('main_controller/parms_login/'.$session_expired);

		}

		
	}


}//end controller