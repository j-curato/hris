<?php


class cat_model extends CI_Model{

  public $table_applicants = "tbl_applicants";
  public $table_positions = "tbl_positions";
  public $table_item_num = "tbl_item_numbers";
  public $table_experience = "tbl_work_experience";
 	public $table_training = "tbl_training_seminars";
  public $table_user = "tbl_user";
 	public $table_par = "tbl_par";


 function get_position_list( $limit, $offset ){

   		$query = $this->db->select("*")
           						  ->from($this->table_positions)
           						  ->order_by("tbl_positions.position_title","ASC")
           						  ->limit($limit, $offset)
           						  ->get();

   		if( $query->num_rows() > 0 ){

   			$ret["position_rows"] = $query->result();
   			$ret["position_total"] = $query->num_rows();

   			return $ret;

   		} else{

   			return false;
   		}			  

 	}

  function get_item_list( $limit, $offset ){

      $query = $this->db->select("*")
                        ->from( $this->table_item_num )
                        ->join($this->table_positions,$this->table_positions.'.ID ='.$this->table_item_num.'.position_id')
                        ->order_by("tbl_positions.position_title","ASC")
                        ->limit($limit, $offset)
                        ->get();

  
      if( $query->num_rows() > 0 ){

        $ret["item_rows"] = $query->result();
        $ret["item_total"] = $query->num_rows();

        return $ret;

      } else{

        return false;
      }       

  }


  function get_user_list( $limit, $offset ){

      $query = $this->db->select("*")
                        ->from($this->table_user)
                        ->order_by("tbl_user.fname", "ASC")
                        ->limit($limit, $offset)
                        ->get();


      if( $query->num_rows() > 0 ){

        $ret["user_rows"] = $query->result();
        $ret["user_total"] = $query->num_rows();

        return $ret;

      } else{

        return false;
      }

  }

 	 // Insert PAR Category function

  function insert_position_content( $position_data ){ 

  	$this->db->insert( $this->table_positions, $position_data );
  	return true;

  }

  //Insert Item Number

 function insert_item_content( $item_data ){ 

    $this->db->insert( $this->table_item_num, $item_data );
    return true;

  }


//
  function get_latest_position_data(){

 		$last_id = $this->db->insert_id();
 		$query = $this->db->select("*")
 						  ->from($this->table_positions)
 						  ->where('tbl_positions.ID', $last_id)
 						  ->get();

 		if( $query->num_rows() > 0 ){
 			return $query->result();
 		} else{
 			return false;
 		}					  
 	}

 
 function count_position_list(){

 		$query = $this->db->select('*')
 						          ->from($this->table_positions);

 		$pos["total_position_record"] = $this->db->count_all_results();

 		return $pos;

 }


  function count_item_list(){

    $query = $this->db->select('*')
                      ->from( $this->table_item_num );

    $item["total_item_record"] = $this->db->count_all_results();

    return $item;

 }


 function count_user_list(){

    $query = $this->db->select('*')
                      ->from($this->table_user);

    $user["total_user"] = $this->db->count_all_results();
    
    return $user;                  

 }


 function edit_cat_content($catData){

 		$catArray = array( 'category_name' => $catData['category_name'] ); 

 		$this->db->where('ID', $catData['ID']);
 		$this->db->update($this->table_cat, $catArray);

 		return true;
 	}

 	function get_dropdown_category(){

 		 $query = $this->db->select('*')
	                       ->from($this->table_cat)
	                       ->order_by('category_name','ASC')
	                       ->get()
	                       ->result_array();

        $dropdown = array('0'=>'Select Category');
        foreach($query as $value){
          $dropdown[$value['ID']] = $value['category_name'];
        }

        return $dropdown;

 	}


 	function auto_search_position($search_key){

        $array_like_param = array( 
                 'tbl_positions.position_title' => $search_key
                );

        $query = $this->db->select('tbl_positions.ID, tbl_positions.position_title')
                  		    ->or_like($array_like_param)
  			                  ->from($this->table_positions)
                          ->order_by('tbl_positions.position_title','ASC')
  			                  ->get();

        if( $query->num_rows > 0 ){
          foreach ($query->result_array() as $row){
            //$new_row['label']=htmlentities(stripslashes($row['ID']));
            $new_row['value']=htmlentities(stripslashes($row['position_title']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
         }else{

          echo json_encode(array('no_record_txt' => "No records found"));
          return false;

         }

    }

    function search_position_model($search_key){

        $array_like_param = array( 'tbl_positions.position_title' => $search_key );

        $query = $this->db->select('tbl_positions.*')
                          ->or_like($array_like_param)
                          ->from($this->table_positions)
                          ->order_by('tbl_positions.ID','DESC')
                          ->get();

        if( $query->num_rows > 0 ){

          $ret["search_result"] = $query->result();
          $ret["total_position_record"] = $query->num_rows();

          return $ret;

          //return $query->result();

        } else{

          return false;

        }         

    }

    // Search position ID

    function search_position_id( $search_key ){

        //$array_like_param = array( 'tbl_positions.position_title' => $search_key );

        $query = $this->db->select( 'tbl_positions.ID' )
                          ->where( 'position_title', $search_key )
                          ->from( $this->table_positions )
                          ->get();

        if( $query->num_rows > 0 ){

          $ret["search_result"] = $query->result();

          return $ret;

        } else{

          return false;

        }         

    }


    // Search qualified candidates

    function search_qualified_candidates( $search_key ){

        $query = $this->db->select( 'tbl_applicants.*' )
                          ->from( $this->table_applicants )
                          ->where( 'position_qualified', $search_key )
                          ->get();

        if( $query->num_rows > 0 ){

            $ret["search_result"] = $query->result();
            $ret["numQualifiedCandidates"] = $query->num_rows();

            return $ret;

        } else{

            return false;

        } 

    }

    //Print Qualified Candidates

    function print_qualified_candidates( $search_key ){

        $query = $this->db->select( 'tbl_applicants.*' )
                            ->from( $this->table_applicants )
                            ->where( 'position_qualified', $search_key )
                            ->get();

        $queryIDs = $this->db->select( 'tbl_applicants.id' )
                            ->from( $this->table_applicants )
                            ->where( 'position_qualified', $search_key )
                            ->get();                    


        $queryPos = $this->db->select( 'tbl_positions.*' )
                            ->from( $this->table_positions )
                            ->where( 'ID', $search_key )
                            ->get();

         $queryItem = $this->db->select( 'tbl_item_numbers.*' )
                            ->from( $this->table_item_num )
                            ->where( 'position_id', $search_key )
                            ->order_by( 'created_at', 'DESC' )
                            ->get();                    


        if( $query->num_rows > 0 ){

          /*foreach (($q1->result()) as $row1) {
            $prdtarray[] = $row1->product_name;
            }*/

            $ret["search_result_applicants"] = $query->result();
            $ret["search_result_IDs"] = $queryIDs->result();
            $ret["search_result_position"] = $queryPos->result();
            $ret["search_result_item"] = $queryItem->result();
            $ret["numQualifiedCandidates"] = $query->num_rows();

            return $ret;

        } else{

            return false;

        } 

    }

    // Get training and experience details

    function get_work_training_details( $arrayApplicantIDs ){

      $query = $this->db->select("tbl_work_experience.*")
                        ->from( $this->table_experience )
                        ->where_in( $this->table_experience.'.applicant_id', $arrayApplicantIDs )
                        ->get();

      $queryTraining = $this->db->select("tbl_training_seminars.*")
                            ->from( $this->table_training )
                            ->where_in( $this->table_training.'.applicant_id', $arrayApplicantIDs )
                            ->get();                  


      if( $query->num_rows > 0 ){

            $ret["search_result_experience"] = $query->result();  
            $ret["search_result_training"] = $queryTraining->result();  

            return $ret;

        } else{

            return false;

        } 


    }


    function delete_specific_cat( $cat_ids ){

      $query = $this->db->select("tbl_category.*")
                        ->from($this->table_cat)
                        ->join($this->table_par,$this->table_par.'.category ='.$this->table_cat.'.ID')
                        ->where_in( $this->table_cat.'.ID', $cat_ids )
                        ->get();

      if( $query->num_rows() == 0 ){
        
        $this->db->where_in( 'ID', $cat_ids );
        $this->db->delete( $this->table_cat );
        
        return true;

      } else{

        return false;

      }             

   }

}
