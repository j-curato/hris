<?php

class theme_model extends CI_Model{
	
  public $table_theme = "tbl_theme";
  public $table_user = "tbl_user";

  function activate_theme( $theme_name ){

  	$query = $this->db->select( "*" )
  					  ->from( $this->table_theme )
  					  ->where( "status",1 )
  					  ->get()
  					  ->row_array();		  

  	if( $query["theme_name"] != $theme_name ){

	  	$where_param = array( 'theme_name' => $query["theme_name"] );
	  	$this->db->where( $where_param );
	  	$this->db->update( $this->table_theme,array('status' => 0) );

	  	$where_param = array( 'theme_name' => $theme_name );
	  	$this->db->where( $where_param );
	  	$this->db->update( $this->table_theme,array('status' => 1) );

	  	return $theme_name;

  	} else{

  		return $query["theme_name"];

  	}				  
  
  }


  function activate_user_theme( $user_id, $theme ){

  		$where_param = array( 'ID' => $user_id );
	  	$this->db->where( $where_param );
	  	$this->db->update( $this->table_user, array('theme_name' => $theme) );

	  	return $theme;

  }


  function user_activated_theme( $user_id ){

  	$query = $this->db->select( "theme_name" )
  					  ->from( $this->table_user )
  					  ->where( "ID",$user_id )
  					  ->get()
  					  ->row_array();

  	return $query["theme_name"];		
  			  
  }


}