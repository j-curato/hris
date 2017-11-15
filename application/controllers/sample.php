<?php

class sample extends CI_Controller{

	public $data;

	public function __construct(){

		session_start();
		parent::__construct();

		$this->load->helper(array('url','form','language'));
		$this->load->model('sample_model');

	}

	function index(){
		$data = $this->data;
		$data["var_samp"] = "This is controller testing with ci 2.2";
		$this->load->view("view_menu",$data);
	}

	function add_update_player(){
		$data = $this->data;
		$val = $this->uri->segment(3);
		$mode = (empty($val)) ? "add":"update";
		

		if( $mode == "update" ){
			$data['edit_boolean'] = TRUE;
			$data['team_dropdown'] = $this->sample_model->get_team();
		} else{
			$data["add_boolean"] = TRUE;
		}
		
		
		$this->load->view("view_menu",$data); 
	}

	function save_player(){

		$player_details = $this->input->post("nba");
		$query = $this->sample_model->insert_player($player_details);
		if($query){
			$notification = "Success";
		} else{
			$notification = "Failed";
		}

		echo json_encode(array('notify' => $notification));
	}


	function get_player_position(){

		$team_id = $_POST['team_id'];

        if(isset($team_id)){

	        $result=$this->sample_model->get_player_position_list($team_id);
	        $this->output->set_header('Content-Type: application/json',true);
	        echo json_encode($result);   
       }    

	}

	function trello_api(){

		/*$trello_key          = 'a2a93deccc7064def5f5011c2e9810d6';
		$trello_api_endpoint = 'https://api.trello.com/1';
		$trello_list_id      = '5485919efbac8086633f2e1e';
		$trello_member_token = 'd535bad4c3894e683a23aef82d333c8f35c62f3548faa1da15fc2e5b5fb936b4'; // Guard this well

		$ch = curl_init("$trello_api_endpoint/cards");

		curl_setopt_array($ch, array(
			CURLOPT_SSL_VERIFYPEER => false, // Probably won't work otherwise
			CURLOPT_RETURNTRANSFER => true, // So we can get the URL of the newly-created card
			CURLOPT_POST           => true,
			CURLOPT_POSTFIELDS => http_build_query(array( // if you use an array without being wrapped in http_build_query, the Trello API server won't recognize your POST variables
				'key'    => $trello_key,
				'token'  => $trello_member_token,
				'idList' => $trello_list_id,
				'name'   => "Cool Name for a Card",
				'desc'   => "Try using some\n\n*markdown* in your description"
			)),
		));
		$result = curl_exec($ch);
		$trello_card = json_encode($result);
		var_dump($trello_card);*/
		//$trello_card_url = $trello_card->url();


//$homepage = file_get_contents('https://api.trello.com/1/board/549227113445056bc79f8b2c?key=a2a93deccc7064def5f5011c2e9810d6&token=d535bad4c3894e683a23aef82d333c8f35c62f3548faa1da15fc2e5b5fb936b4&cards=open&lists=open');
//echo $homepage;

/* using curl GET approach*/

//  Initiate curl
	//$ch = curl_init();
// Disable SSL verification
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
	//curl_setopt($ch, CURLOPT_URL,$url);
// Execute
	//$result=curl_exec($ch);
// Closing
	//curl_close($ch);

// Will dump a beauty json :3
	//var_dump(json_decode($result, true));

/* Using php function file_get_contents */

$board_id = '549227113445056bc79f8b2c';
$card_id = '549229255a0df5686d9422e5';
$api_key = 'a2a93deccc7064def5f5011c2e9810d6';
$user_token = 'd535bad4c3894e683a23aef82d333c8f35c62f3548faa1da15fc2e5b5fb936b4';

//$url = 'https://api.trello.com/1/board/'.$board_id.'?key='.$api_key.'&token='.$user_token.'&cards=open&lists=open';
$url = 'https://api.trello.com/1/cards/'.$card_id.'/list?key='.$api_key.'&token='.$user_token;

//Using file_get_contents

$result = file_get_contents($url);
// Will dump a beauty json :3
$data['trello_json'] = $result;
$this->load->view('view_trello_json',$data);

//var_dump(json_decode($data['trello_json'], true));


}


    function web_hook_trello(){
    	$this->load->view('view_trello_webhook');
    }
} 