<?php

	class sample_model extends CI_Model{


		function insert_player($details){
			$this->db->insert("nba_players_tbl", $details);
			return true;
		}

		function get_team(){
			/*$this->db->select('*');
			$this->db->from('nba_players_tbl');
			$query = $this->db->get();*/

			$query = $this->db->select('*')
							  ->from('nba_players_tbl')
							  ->get();
							 

			if( $query->num_rows() > 0 ){

        		$dropdown = array('0'=>'Select a Team');
		        foreach($query->result_array() as $value){
		          $dropdown[$value['ID']] = $value['team'];
		        }

		        return $dropdown;

			} else{
				return false;
			}
		}

		function get_player_position_list($team_id){

			 $query = $this->db->select('ID,position')
                        ->from('nba_players_tbl')
                        ->where('ID',$team_id)
                        ->order_by('position','asc')
                        ->get()
                        ->result_array();
		      //$dropdown = array('0'=>'Select Barangay');
		      $dropdown = array();
		      $dropdown[] = array('id' => 0, 'label' => 'Select Position');
		      foreach($query as $value){
		        //$dropdown[$value['ID']] = $value['brgy_name'];
		        $dropdown[] = array('id' => $value['ID'], 'label' => $value['position']);
		      }
		      
		      return $dropdown;
		}

		function insert_sample_data($data_array){

			$query = $this->db->insert("tbl_sample", $data_array);
			return true;
		}

		function get_content_sample_data(){
			$query = $this->db->select("*")
							  ->from("tbl_sample")
							  ->order_by("ID","DESC")
							  ->get();

			return $query->result();				  	
		}

		function get_latest_data(){
			
			$last_id = $this->db->insert_id();
			$query = $this->db->select('*')
						      ->from("tbl_sample")
						      ->where("ID", $last_id)
						      ->get();

			return $query->result();
		}


	
	}