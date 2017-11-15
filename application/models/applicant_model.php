<?php

class applicant_model extends CI_Model{

  public $table_applicant = "tbl_applicants";
  public $table_work_experience = "tbl_work_experience";
  public $table_training_seminars = "tbl_training_seminars";
  public $table_photo = "tbl_photo";
  public $table_positions = "tbl_positions";

  function save_applicant( $applicantDetails ){

    $this->db->insert( $this->table_applicant, $applicantDetails );
    return true;

  }

  function update_applicant( $applicantDetails ){

    $this->db->where('id', $applicantDetails['id']);
    $this->db->update($this->table_applicant, $applicantDetails);

    return true;
  }

  function update_applicant_work( $appWorkDetails ){

    $this->db->where( 'id', $appWorkDetails['id'] );
    $this->db->update( $this->table_work_experience, $appWorkDetails );

    return true;
    
  }


  function update_applicant_seminar( $appSeminarDetails ){

    $this->db->where( 'id', $appSeminarDetails['id'] );
    $this->db->update( $this->table_training_seminars, $appSeminarDetails );

    return true;
    
  }


  function update_position_details( $appPosDetails ){

    $this->db->where( 'ID', $appPosDetails['ID'] );
    $this->db->update( $this->table_positions, $appPosDetails );

    return true;

  }


  function getapplicantList(){


        $querySeminar = $this->db->select('tbl_applicants.*, tbl_training_seminars.*')
                             ->from($this->table_applicant)
                             ->join( $this->table_training_seminars,$this->table_training_seminars.'.applicant_id ='.$this->table_applicant.'.id' )
                             ->group_by('tbl_training_seminars.applicant_id')
                             ->get();

        $queryWork = $this->db->select('tbl_applicants.*, tbl_work_experience.*')
                          ->from($this->table_applicant)
                          ->join( $this->table_work_experience,$this->table_work_experience.'.applicant_id ='.$this->table_applicant.'.id' )
                          ->group_by('tbl_work_experience.applicant_id')
                          ->get();

    		$query = $this->db->select( 'tbl_applicants.*, tbl_positions.ID, tbl_positions.position_title' )  
            				  ->from( $this->table_applicant )
                      ->join( $this->table_positions, $this->table_positions.'.ID ='.$this->table_applicant.'.position_qualified' )
                      ->order_by('tbl_applicants.created_at','DESC')
            				  ->get();

    		if( $query->num_rows > 0 ){

    			  $ret["applicantList"] = $query->result();
            $ret["totalApplicant"] = $query->num_rows();
            $ret["applicantExperience"] = $queryWork->result();
            $ret["applicantSeminar"] = $querySeminar->result();

          	return $ret;

    		} else{

    			return false;

    		}				  

  }



  function getApplicantsAllList(){

        $query = $this->db->select( 'tbl_applicants.*' )  
                      ->from( $this->table_applicant )
                      ->order_by('created_at','DESC')
                      ->get();


        return $query->result_array();

  }


  function saveWorkExperience( $workDetails ){

    $this->db->insert( $this->table_work_experience, $workDetails );
    return true;

  }

  function saveSeminarTraining( $seminarDetails ){

    $this->db->insert( $this->table_training_seminars, $seminarDetails );
    return true;

  }

  function delete_applicant( $applicantIDS ){

    $this->db->where_in( 'id', $applicantIDS );
    $this->db->delete( $this->table_applicant );

    return true;

  }


  function delete_applicant_workExperience( $applicantWorkIDs ){

    $this->db->where_in( 'id', $applicantWorkIDs );
    $this->db->delete( $this->table_work_experience );

    return true;

  }


  function delete_applicant_seminarDetails( $applicantSeminarIDs ){

    $this->db->where_in( 'id', $applicantSeminarIDs );
    $this->db->delete( $this->table_training_seminars );

    return true;

  }


  function delete_applicant_seminar( $applicantSeminarIDs ){

    $this->db->where_in( 'id', $applicantSeminarIDs );
    $this->db->delete( $this->table_training_seminars );
   
    return true;

  }


  function getAppWorkExp( $appID ){

     $queryAppWork = $this->db->select( 'tbl_work_experience.*' )  
                          ->from( $this->table_work_experience )
                          ->where( 'applicant_id', $appID )
                          ->get();

     $queryAppPhoto = $this->db->select( 'tbl_photo.photo_url' )  
                          ->from( $this->table_photo )
                          ->where( 'applicant_id', $appID )
                          ->get();

     $queryAppList = $this->db->select( 'tbl_applicants.*' )  
                          ->from( $this->table_applicant )
                          ->where( 'id', $appID )
                          ->get();               


      if( $queryAppWork->num_rows > 0 ){

          $ret["applicantList"] = $queryAppList->result();
          $ret["applicantExperience"] = $queryAppWork->result();
          $ret["applicantProfilePic"] = $queryAppPhoto->result();
    
          return $ret;

    }

 }


 function getAppSeminar( $appID ){

    $queryAppSeminar = $this->db->select( 'tbl_training_seminars.*' )  
                            ->from( $this->table_training_seminars )
                            ->where( 'applicant_id', $appID )
                            ->get();

     $queryAppList = $this->db->select( 'tbl_applicants.*' )  
                          ->from( $this->table_applicant )
                          ->where( 'id', $appID )
                          ->get();               


      if( $queryAppSeminar->num_rows > 0 ){

          $ret["applicantList"] = $queryAppList->result();
          $ret["applicantSeminar"] = $queryAppSeminar->result();
    
          return $ret;

      }

 }

 function saveApplicantPhoto( $appID, $file_name ){

   $photoDetails = array( 'applicant_id' => $appID, 'photo_url' => $file_name );

   $this->db->insert( $this->table_photo, $photoDetails );
   return true;

 }


 function getListPosition(){

    $query = $this->db->select( 'tbl_positions.*')
                      ->from( $this->table_positions )
                      ->order_by( 'position_title', 'ASC' )
                      ->get();

    if( $query->num_rows() > 0 ){

      $ret['positionsList'] = $query->result();
      return $ret;
      
    }                  

 }


}//end of the model