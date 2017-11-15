<?php
 
 class parms_model extends CI_Model{

 	public $table_par = "tbl_par";
 	public $table_cat = "tbl_category";
 	public $table_user = "tbl_user";


 	function get_online_user(){

 		$query = $this->db->select('*')
 						  ->from($this->table_user)
 						  ->where('status',1)
 						  ->get();

 		if( $query->num_rows() > 0 ){
 			return $query->result_array();
 		} else{
 			return false;
 		}
 	}
  

 	function insert_par_content($title,$date,$venue,$sponsor,$category,$file_name){

    $current_date = getdate();
 		$par_data = array(
 							'title_of_activity' =>  $title, 
 							'date'              =>  $date,
 							'venue'             =>  $venue,
 							'sponsors'          =>  $sponsor,
 							'category'          =>  $category,
 							'scanned_file'      =>  $file_name,
              'month_uploaded'    =>  $current_date['mon'],
              'day_uploaded'      =>  $current_date['mday'],
              'year_uploaded'     =>  $current_date['year']
 						);

 		$this->db->insert( $this->table_par, $par_data );
 		return true;

 	}


 	function edit_par_content($par_id,$par_edited_array){

 		$this->db->where('ID', $par_id);
 		$this->db->update($this->table_par, $par_edited_array);

 		return true;
 	}

 	function edit_par_content_Xfilename($par_id, $array_edited_par){

 		$this->db->where('ID', $par_id);
 		$this->db->update($this->table_par, $array_edited_par);

 		return true;
 	}


 	function get_par_list(){

 		$query = $this->db->select("tbl_par.*, tbl_category.category_name")
 						  ->from($this->table_par)
 						  ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
 						  //->join("tbl_category", "tbl_category.ID = tbl_par.category")
 						  ->order_by('tbl_par.ID','DESC')
 						  ->get();

 		if( $query->num_rows() > 0 ){

 			$ret['par_rows'] = $query->result();
 			$ret['parTotal'] = $query->num_rows();

 			return $ret;

 		} else{

 			return false;
 			
 		}			
    	  
 	}

 	function count_par_list(){

 		$query = $this->db->select('*')
 						          ->from($this->table_par);
 	
 		$par['total_par'] = $this->db->count_all_results();

 		return $par;				  
 	}

 	function get_specific_par($par_id){

 		$query = $this->db->select('*')
 						  ->from($this->table_par)
 						  ->where('ID',$par_id)
 						  ->get();

 		if( $query->num_rows() > 0 ){
 			return $query->result();
 		} else{
 			return false;
 		}						  
 	}

 	function get_to_edit_par_detail($par_id){

 		$query = $this->db->select('*')
 						  ->from($this->table_par)
 						  ->where('ID', $par_id)
 						  ->get();

 	    if( $query->num_rows() > 0 ){
 	    	return $query->result();
 	    } else{
 	    	return false;
 	    }					  

 	}

 	function get_latest_par_data(){

 		$last_id = $this->db->insert_id();
 		$query = $this->db->select('tbl_par.*, tbl_category.category_name')
 						  ->from($this->table_par)
 						  ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
 						  ->where('tbl_par.ID', $last_id)
 						  ->get();

 		if( $query->num_rows() > 0 ){
 			return $query->result();
 		} else{
 			return false;
 		}					  
 	}

 	function delete_specific_par( $par_ids ){

 		$this->db->where_in( 'ID', $par_ids );
 		$this->db->delete( $this->table_par );
   
 		return true;

 	}

 	function auto_search_par( $searchFilter, $search_key){


    if( $searchFilter == "Category" ){

      $array_like_param = array( 
               //'tbl_par.title_of_activity' => $search_key
               //'tbl_par.date' => $search_key, 
               //'tbl_par.venue' => $search_key, 
               //'tbl_par.sponsors' => $search_key,
               'tbl_category.category_name' => $search_key
               //'tbl_par.scanned_file' => $search_key
              );

      $query = $this->db->distinct()
                        ->select('tbl_par.*, tbl_category.category_name')
                        ->or_like($array_like_param)
                        ->from($this->table_par)
                        ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
                        ->group_by('tbl_category.category_name')
                        ->get();

      if( $query->num_rows > 0 ){
            foreach ( $query->result_array() as $row ){
              //$new_row['label']=htmlentities(stripslashes($row['ID']));
              $new_row['value']=htmlentities(stripslashes($row['category_name']));
              $row_set[] = $new_row; //build an array
           }
          echo json_encode($row_set); //format the array into json data
      } else{
        echo json_encode(array('no_record_txt' => "No records found"));
        return false;
      }

   } else if( $searchFilter == "Venue" ){


        $array_like_param = array( 
                   //'tbl_par.title_of_activity' => $search_key
                   //'tbl_par.date' => $search_key, 
                   'tbl_par.venue' => $search_key
                   //'tbl_par.sponsors' => $search_key,
                   //'tbl_category.category_name' => $search_key
                   //'tbl_par.scanned_file' => $search_key
                  );

          $query = $this->db->distinct()
                            ->select('tbl_par.*, tbl_category.category_name')
                            ->or_like($array_like_param)
                            ->from($this->table_par)
                            ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
                            ->group_by('tbl_par.venue')
                            ->get();

          if( $query->num_rows > 0 ){
                foreach ($query->result_array() as $row){
                  //$new_row['label']=htmlentities(stripslashes($row['ID']));
                  $new_row['value']=htmlentities(stripslashes($row['venue']));
                  $row_set[] = $new_row; //build an array
               }
              echo json_encode($row_set); //format the array into json data
          } else{
            echo json_encode(array('no_record_txt' => "No records found"));
            return false;
          }


   } else if( $searchFilter == "Filename" ){

         $array_like_param = array( 
                   //'tbl_par.title_of_activity' => $search_key
                   //'tbl_par.date' => $search_key, 
                   //'tbl_par.venue' => $search_key
                   //'tbl_par.sponsors' => $search_key,
                   //'tbl_category.category_name' => $search_key
                   'tbl_par.scanned_file' => $search_key
                  );

          $query = $this->db->distinct()
                            ->select('tbl_par.*, tbl_category.category_name')
                            ->or_like($array_like_param)
                            ->from($this->table_par)
                            ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
                            ->group_by('tbl_par.scanned_file')
                            ->get();

          if( $query->num_rows > 0 ){
                foreach ($query->result_array() as $row){
                  //$new_row['label']=htmlentities(stripslashes($row['ID']));
                  $new_row['value']=htmlentities(stripslashes($row['scanned_file']));
                  $row_set[] = $new_row; //build an array
               }
              echo json_encode($row_set); //format the array into json data
          } else{
            echo json_encode(array('no_record_txt' => "No records found"));
            return false;
          }

   } else if( $searchFilter == "Sponsors" ){

         $array_like_param = array( 
                   //'tbl_par.title_of_activity' => $search_key
                   //'tbl_par.date' => $search_key, 
                   //'tbl_par.venue' => $search_key
                   'tbl_par.sponsors' => $search_key
                   //'tbl_category.category_name' => $search_key
                   //'tbl_par.scanned_file' => $search_key
                  );

          $query = $this->db->distinct()
                            ->select('tbl_par.*, tbl_category.category_name')
                            ->or_like($array_like_param)
                            ->from($this->table_par)
                            ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
                            ->group_by('tbl_par.scanned_file')
                            ->get();

          if( $query->num_rows > 0 ){
                foreach ($query->result_array() as $row){
                  //$new_row['label']=htmlentities(stripslashes($row['ID']));
                  $new_row['value']=htmlentities(stripslashes($row['sponsors']));
                  $row_set[] = $new_row; //build an array
               }
              echo json_encode($row_set); //format the array into json data
          } else{
            echo json_encode(array('no_record_txt' => "No records found"));
            return false;
          }

   } else{

      $array_like_param = array( 
                   'tbl_par.title_of_activity' => $search_key
                  );

          $query = $this->db->select('tbl_par.*, tbl_category.category_name')
                            ->or_like($array_like_param)
                            ->from($this->table_par)
                            ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
                            ->get();

          if( $query->num_rows > 0 ){
                foreach ($query->result_array() as $row){
                  //$new_row['label']=htmlentities(stripslashes($row['ID']));
                  $new_row['value']=htmlentities(stripslashes($row['title_of_activity']));
                  $row_set[] = $new_row; //build an array
               }
              echo json_encode($row_set); //format the array into json data
          } else{
            echo json_encode(array('no_record_txt' => "No records found"));
            return false;
        }


   }
		   

}


  	function search_par_model( $searchTextFilter, $search_key ){

      if( $searchTextFilter == "Venue" ){
        $array_like_param = array( 'tbl_par.venue' => $search_key );
      } else if( $searchTextFilter == "Sponsors" ){
        $array_like_param = array( 'tbl_par.sponsors' => $search_key );
      } else if( $searchTextFilter == "Category" ){
        $array_like_param = array( 'tbl_category.category_name' => $search_key );
      } else if( $searchTextFilter == "Filename" ){
        $array_like_param = array( 'tbl_par.scanned_file' => $search_key );
      } else{
        $array_like_param = array( 'tbl_par.title_of_activity' => $search_key );
      }
      
  		//$array_like_param = array( 'tbl_category.category_name' => $search_key );

  		$query = $this->db->select('tbl_par.*, tbl_category.category_name')
          						  ->or_like($array_like_param)
          						  ->from($this->table_par)
          						  ->join($this->table_cat,$this->table_cat.'.ID ='.$this->table_par.'.category')
          						  ->order_by('tbl_par.ID','DESC')
          						  ->get();

  		if( $query->num_rows > 0 ){

  			$ret["search_result"] = $query->result();
        $ret["total_par"] = $query->num_rows();

        return $ret;

        //return $query->result();

  		} else{

  			return false;

  		}				  

  	}

    function count_uploads_perMonth( $year_val ){

      $array_months = range(1,12);
      $query = $this->db->select("*")
                    ->from($this->table_par)
                    ->where_in("month_uploaded",$array_months)
                    ->where("year_uploaded", $year_val)
                    ->get();

      $arr = $query->result_array();
      $result = array_count_values(array_column($arr,'month_uploaded'));
      $final_array = array();
      foreach($array_months as $value){
          $final_array[$value] = array_key_exists($value ,$result) ? $result[$value] : 0;
      }

      $ret["uploads_result"] = $final_array;

      return $ret;   

    }

    function get_year(){
      
      $query = $this->db->distinct()           
                        ->select("ID,year_uploaded")
                        ->from($this->table_par)
                        ->group_by('year_uploaded')
                        ->get()
                        ->result_array();

      $dropdown_year = array('0'=>'Select Year');

        foreach($query as $value){
          $dropdown_year[$value['ID']] = $value['year_uploaded'];
        }

        return $dropdown_year;
    }


    function check_title_duplicate( $title_to_check ){

      $query = $this->db->select( "*" )
                        ->from( $this->table_par )
                        ->where( "title_of_activity", $title_to_check )
                        ->get();

       if( $query->num_rows() > 0 ){

        return true;

       } else{

        return false;
        
       }   

   }

 }