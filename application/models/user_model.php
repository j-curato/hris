<?php

class user_model extends CI_Model{


public $table_user = "tbl_user";



function get_user_compare_password($user_email){

    $params = array( 'username' => $user_email );
    $query = $this->db->select("password")
                      ->from($this->table_user)
                      ->where($params)
                      ->get();

    return $query->row_array();

  }


function validate_users( $users, $query_password ){

    $verify_password = password_verify( $users['password'], $query_password );

    $params = array( 'username' => $users['email_add'] );
    $query = $this->db->select('*')
              ->from($this->table_user)
              ->where($params)
              ->get();

    if( $query->num_rows() > 0 && $verify_password == TRUE ){

      $this->db->where($params);
      $this->db->update($this->table_user,array('status' => 1));

      return $query->result();

     } else{

      return false; 

     }          

  }


function add_user( $user_data ){

$this->db->insert( $this->table_user, $user_data );

return true;
 
}


function count_user_list(){

    $query = $this->db->select('*')
                      ->from($this->table_user);

    $user["total_user"] = $this->db->count_all_results();
    
    return $user;                  

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

  function get_latest_user_data(){

    $last_id = $this->db->insert_id();
    $query = $this->db->select('*')
              ->from($this->table_user)
              ->where('tbl_user.ID', $last_id)
              ->get();

    if( $query->num_rows() > 0 ){
      return $query->result();
    } else{
      return false;
    }  

  }

  function check_current_password( $user_id, $entered_password ){

    $where_array = array( "ID" => $user_id );
    //$hashed_password = password_hash( $entered_password, PASSWORD_DEFAULT );

    $query = $this->db->select("password")
                      ->from( $this->table_user )
                      ->where( $where_array )
                      ->get()
                      ->row_array();

    if( password_verify( $entered_password, $query["password"]) ){

      return true;

    } else{

      return false;

    }                 

  }

  function save_edited_user( $user_id, $user_edited_array ){

    $this->db->where('ID', $user_id);
    $this->db->update($this->table_user, $user_edited_array);

    return true;
    
  }

  //User search function

  function auto_search_user( $search_key ){

      $array_like_param = array( 
               'tbl_user.fname' => $search_key
              );

      $query = $this->db->select( 'tbl_user.fname' )
                        ->or_like( $array_like_param )
                        ->from( $this->table_user )
                        ->order_by( 'tbl_user.fname','ASC' )
                        ->get();

      if( $query->num_rows > 0 ){
        foreach ($query->result_array() as $row){
          //$new_row['label']=htmlentities(stripslashes($row['ID']));
          $new_row['value']=htmlentities(stripslashes($row['fname']));
          $row_set[] = $new_row; //build an array
        }
        echo json_encode($row_set); //format the array into json data
      }

    }

  function search_user_model($search_key){

      $array_like_param = array( 'tbl_user.fname' => $search_key );

      $query = $this->db->select('tbl_user.*')
                        ->or_like( $array_like_param )
                        ->from( $this->table_user )
                        ->order_by( 'tbl_user.fname','ASC' )
                        ->get();

      if( $query->num_rows > 0 ){

        $ret["search_result"] = $query->result();
        $ret["total_user"] = $query->num_rows();

        return $ret;

        //return $query->result();

      } else{

        return false;

      }         

    }

    function delete_specific_user( $user_ids ){

      $this->db->where_in( 'ID', $user_ids );
      $this->db->delete( $this->table_user );
   
      return true;           

   }



}