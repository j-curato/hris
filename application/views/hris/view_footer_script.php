<!-- JavaScript -->
  <!--<script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.min.js"></script>-->
  
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/jquery_ui/external/jquery/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/jquery_ui/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/notify.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/dataTables/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/dataTables/datetime-moment.js"></script>

 
   <script type="text/javascript">

   var user_fname = $(".user_fname").text();

    $(function(){


    $("#helloworld-btn").click(function(e){

      e.preventDefault();

      $(this).hide();
      window.print();
      $(this).show();

    });


      $(".alert-success").hide();

      localStorage.setItem("update", "0");

      $('body').on('click', '.btn-refresh', function(){
          localStorage.setItem("update", "1");
      });

      window.setInterval(function(){
       if(localStorage["update"] == "1"){
         location.reload();     
       }
      }, 500);
      
      /*$(".btn-refresh").click(function(e){

        e.preventDefault();
        location.reload();

      });*/
      

      $('#table-applicant-contents').dataTable({
                 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                  columnDefs : [ 
                    { type : 'date', targets : [2] } 
                    ],"order": [[ 2, 'desc' ]] 
      });


      $('#table-appWork-contents').dataTable({
                 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                  columnDefs : [ 
                    { type : 'date', targets : [5] } 
                    ],"order": [[ 5, 'desc' ]] 
      });


      $('#table-appSeminar-contents').dataTable({
                 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                  columnDefs : [ 
                    { type : 'date', targets : [5] } 
                    ],"order": [[ 5, 'desc' ]] 
      });

      $('#table-position-contents').dataTable({
                 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                  columnDefs : [ 
                    { type : 'date', targets : [9] } 
                    ],"order": [[ 9, 'desc' ]] 
      });

      $('#table-item-contents').dataTable({
                 "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                  columnDefs : [ 
                    { type : 'date', targets : [6] } 
                    ],"order": [[ 6, 'desc' ]] 
      });

      $("#auto_search_par_form").autocomplete({
        
          source: function(request, response) {
              $.ajax({
                  url: "<?php echo base_url(); ?>main_controller/get_autosearch_par_data/",
                  dataType: "json",
                  data: {
                      term : request.term,
                      searchFilterText : $("#searchText_id option:selected").text()
                  },
                  success: function(data) {
                      response(data);
                  }
              });
          },
          min_length: 3,
          delay: 300
     });

      

  
      /*$("#auto_search_par_form").autocomplete({

        var searchFilterText = $("#searchText_id option:selected").text();

        source: "<?php echo base_url(); ?>main_controller/get_autosearch_par_data/"+searchFilterText

      });*/

      $("#auto_search_position_form").autocomplete({

        source: "<?php echo base_url(); ?>main_controller/get_autosearch_position_data/"

      });


      $("#auto_search_user_form").autocomplete({

        source: "<?php echo base_url(); ?>main_controller/get_autosearch_user_data/"

      });


      $("#pagination_id a").click(function(e){

        e.preventDefault();
        $.ajax({
          type: "POST",
          url: $(this).attr("href"),
          data: "<?php echo base_url(); ?>main_controller/main_menu/",
          success: function(res){
            $("body").html(res);
          }
        });
        return false;
      });

    });

   
   //Applicant Modal

   $(".add-applicant-btn").click(function(e){
      e.preventDefault();
      $(".add-par-modal").modal({show:true});
       //Datepicker Start and End Date

      var currentDate = new Date();
      var lastDate = new Date(new Date().getFullYear(), 11, 31);
      var day = currentDate.getDate();


            $("#inputDate").daterangepicker({

                format: 'YYYY-MM-DD',
                startDate: day,
                endDate: lastDate,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            } 
            /*function(start, end, label) {
                alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        }*/ );

    });

$(".add-work-btn").click(function(e){
    e.preventDefault();
  
    var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){
      $('#table-applicant-contents tr.tbl-applicant-row').filter(':has(:checkbox:checked)').each(function() {
        // this = tr
        $tr = $(this);
        $('td', $tr).each(function() {
              
            document.getElementById("appWorkID").value = $tr.find('td:eq(22)').html();
            document.getElementById("editLastName").value = $tr.find('td:eq(3)').html();
            document.getElementById("editFirstName").value = $tr.find('td:eq(4)').html();

            $(".add-work-modal").modal({show:true});

        });

    });
      
    }else{
      swal("Please select a record. Thanks.", "")
    }
})


$(".add-workExp-btn").click(function(e){
  e.preventDefault();
  
  $(".add-work-modal").modal({show:true});

})


$(".add-seminar-btn").click(function(e){
  e.preventDefault();
  
  var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){
      $('#table-applicant-contents tr.tbl-applicant-row').filter(':has(:checkbox:checked)').each(function() {
        // this = tr
        $tr = $(this);
        $('td', $tr).each(function() {
              
            document.getElementById("appSeminarID").value = $tr.find('td:eq(22)').html();
            document.getElementById("editLastName").value = $tr.find('td:eq(3)').html();
            document.getElementById("editFirstName").value = $tr.find('td:eq(4)').html();

            $(".add-seminar-modal").modal({show:true});

        });

    });
      
    }else{
      swal("Please select a record. Thanks.", "")
    }
})


$(".add-appSeminar-btn").click( function(e){
  e.preventDefault();

  $(".add-seminar-modal").modal({show:true});

});


$(".add-photo-btn").click(function(e){
  e.preventDefault();

  var valArray = [];    
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){
  
      $(".upload-photo-modal").modal( { show:true } );
      document.getElementById("appProfileID").value = valArray;

     }else{
       swal("Please select a record. Single selection only. Thanks.", "")
     } 

});

$(".btn-upload-photo").click(function(e){
  
  e.preventDefault();

      var postdata = {
          'applicantID': $("#appProfileID").val()
        };

      $.ajaxFileUpload({

             url: "<?php echo base_url(); ?>main_controller/saveApplicantPhoto/",
             secureuri:false,
             fileElementId:'userfile',
             dataType:'json',
             data:postdata,
             success: function(data){

                 if( data.notify == "Success" ){

                    $(".alert-add-success").fadeIn(100);
                    $(".alert-add-success").delay(2000).fadeOut(800);
                    
                  }else{
                    console.log(data.notify);
                }

             }

        });
      
});


   //Category Modal

   $(".add-cat-btn").click(function(e){
      e.preventDefault();
      $(".add-cat-modal").modal({show:true});
   });

   //Position Item Modal

   $(".add-item-btn").click(function(e){
      e.preventDefault();
      $(".add-position-item-modal").modal({show:true});
   });

   //User Modal Adding Form

   $(".add-user-btn").click(function(e){
      e.preventDefault();
      $(".add-user-modal").modal({show:true});
   });

   //User Modal Edit Form

   $(".btn-edit-user").click(function(e){

    e.preventDefault();
    var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){

      $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').each(function() {
          // this = tr
          $tr = $(this);
          $('td', $tr).each(function() {
             
              document.getElementById("user_id-edit").value = $tr.find('td:eq(1)').html();
              document.getElementById("inputFirstname-edit").value = $tr.find('td:eq(2)').html();
              document.getElementById("inputLastname-edit").value = $tr.find('td:eq(3)').html();;
              document.getElementById("inputPosition-edit").value = $tr.find('td:eq(5)').html();
              document.getElementById("inputUsername-edit").value = $tr.find('td:eq(4)').html();

              if( $tr.find('td:eq(7)').html() == "Administrator" ){
                document.getElementById("inputAccessLevel-edit").value = 1;
              } else{
                document.getElementById("inputAccessLevel-edit").value = 2;
              }

              
             $(".edit-user-modal").modal({show:true});
             $(".password-form").hide();  
             $(".password-label").hide();  

          });
            
            return false;

      });

    }else{

      swal("Please select a record. Thanks.", "")

  }
      
});


//Applicant Work Experience Modal Edit Form

   $(".btn-edit-applicant").click(function(e){

    e.preventDefault();
    var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){

      $('#table-appWork-contents tr.tbl-appWork-row').filter(':has(:checkbox:checked)').each(function() {
          //this = tr
          $tr = $(this);
          $('td', $tr).each(function() {
             
              document.getElementById("editAppID").value = $tr.find('td:eq(8)').html();
              document.getElementById("editCompanyName").value = $tr.find('td:eq(1)').html();
              document.getElementById("editAppWork").value = $tr.find('td:eq(2)').html();
              document.getElementById("editStartDateID").value = $tr.find('td:eq(6)').html();
              document.getElementById("editEndDateID").value = $tr.find('td:eq(7)').html();

              
              $(".edit-work-modal").modal({show:true});

          });
            
            return false;
      });

    }else{

      swal("Please select a record. Thanks.", "")

  }
      
});


//Applicant Seminar Modal Edit Form

   $(".btn-edit-applicant-seminar").click(function(e){

    e.preventDefault();
    var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){

      $('#table-appSeminar-contents tr.tbl-seminar-row').filter(':has(:checkbox:checked)').each(function() {
          //this = tr
          $tr = $(this);
          $('td', $tr).each(function() {
             
              document.getElementById("appSeminarPID").value = $tr.find('td:eq(0) input').val();
              document.getElementById("seminarTitleEdit").value = $tr.find('td:eq(1)').html();
              document.getElementById("venueNameEdit").value = $tr.find('td:eq(2)').html();
              document.getElementById("editStartDate").value = $tr.find('td:eq(6)').html();
              document.getElementById("editEndDate").value = $tr.find('td:eq(7)').html();

              
              $(".edit-seminar-modal").modal({show:true});

          });
            
            return false;
      });

    }else{

      swal("Please select a record. Thanks.", "")

  }
      
});


   // Click Change password button

   $(".btn-change-pswrd").click(function(e){
    e.preventDefault();
    $(".password-label").show();
    $(".password-form").show();
   });
    


//PAR Edit Modal

  $(".btn-edit").click(function(e){

    e.preventDefault();

    var valArray = [];  
   
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){

    $('#table-applicant-contents tr.tbl-applicant-row').filter(':has(:checkbox:checked)').each(function() {
        // this = tr
        $tr = $(this);
        $('td', $tr).each(function() {
    
            document.getElementById("applicantID").value = $tr.find('td:eq(22)').html();
            document.getElementById("editDateReceive").value = dateFormat($tr.find('td:eq(2)').html(), "yyyy-mm-dd");
            document.getElementById("editLastName").value = $tr.find('td:eq(3)').html();
            document.getElementById("editFirstName").value = $tr.find('td:eq(4)').html();
            document.getElementById("editMiddleName").value = $tr.find('td:eq(5)').html();
            document.getElementById("editAge").value = $tr.find('td:eq(6)').html();
            document.getElementById("editStatus").value = $tr.find('td:eq(7)').html();
            document.getElementById("editSex").value = $tr.find('td:eq(8)').html();
            document.getElementById("editAddress").value = $tr.find('td:eq(9)').html();
            document.getElementById("editMunicipality").value = $tr.find('td:eq(10)').html();
            document.getElementById("editProvince").value = $tr.find('td:eq(21)').html();
            document.getElementById("editContactNum").value = $tr.find('td:eq(12)').html();
            document.getElementById("editDesiredPosition").value = $tr.find('td:eq(13)').html();
            document.getElementById("editPositionQualified").value = $tr.find('td:eq(25)').html();
            document.getElementById("editSchoolAttended").value = $tr.find('td:eq(15)').html();
            document.getElementById("editEducationUndergrad").value = $tr.find('td:eq(16)').html();
            document.getElementById("editYear").value = $tr.find('td:eq(17)').html();
            document.getElementById("editEduPostgrad").value = $tr.find('td:eq(18)').html();
            document.getElementById("editSchoolAttendedPost").value = $tr.find('td:eq(19)').html();
            document.getElementById("editEligibility").value = $tr.find('td:eq(20)').html();
            

            $(".edit-applicant-modal").modal({show:true});

        });

    });
  } else{
    swal("Please select a record. Thanks.", "")
  }

});

//Position title Edit Modal

$(".btn-edit-position").click(function(e){

  e.preventDefault();

  var valArray = [];      
      
    $("input:checkbox:checked").each(function(i){
      valArray[i] = $(this).val();
    });

    if( valArray.length > 0 && valArray.length == 1 ){

       $('#table-cat-contents tr.tbl-cat-row').filter(':has(:checkbox:checked)').each(function() {
            // this = tr
            $tr = $(this);
            $('td', $tr).each(function() {
                // If you need to iterate the TD's     
                document.getElementById("posID-edit").value = $tr.find('td:eq(1)').html();
                document.getElementById("editPos-id").value = $tr.find('td:eq(2)').html();
                document.getElementById("editDesc-id").value = $tr.find('td:eq(3)').html();
                document.getElementById("editSalary-id").value = $tr.find('td:eq(4)').html();
                document.getElementById("editEdu-id").value = $tr.find('td:eq(5)').html();
                document.getElementById("editExp-id").value = $tr.find('td:eq(6)').html();
                document.getElementById("editTraining-id").value = $tr.find('td:eq(7)').html();
                document.getElementById("editElig-id").value = $tr.find('td:eq(8)').html();

                $(".edit-cat-modal").modal({show:true});
                
                return false;
            });

        });

     } else{
        swal("Please select a record. Thanks.", "")
     }

});


// Submit and save par data

    $(".submit-par").click(function(e){

     e.preventDefault();
      
      var button_text = $(this).text();
      
      if( button_text == "Submit" ){

        var title = $("#inputActivity").val();
        var date = $("#inputDate").val();
        var venue = $("#inputVenue").val();
        var sponsor = $("#inputSponsors").val();
        var category = $("#category-id").val();
        var file_name = $("#userfile").val();

        //$("#flash").show();
        //$("#flash").fadeIn(400).html('<img src="<?php echo base_url(); ?>asset/img/loading14.gif" align="absmiddle" style="width:50%; height:80px;margin-left:-230px;">');

        var postdata = {
          'title': title,
          'date': date,
          'venue': venue,
          'sponsor': sponsor,
          'category': category,
          'file_name': file_name
        };
        
       
        $.ajaxFileUpload({

             url: "<?php echo base_url(); ?>main_controller/save_par_form_data/",
             secureuri:false,
             fileElementId:'userfile',
             dataType:'json',
             data:postdata,
             success: function(data){

                 if(data.notify=='Success'){  
                 var len = data.latest_content.length;
                 var txt = "";
                 //console.log(data.parCount);

                if(len > 0){

                    for(var i=0;i<len;i++){
                    
                          txt += "<tr class='tbl-par-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all par-id-checkbox' id='radio_check_all par-id-checkbox' value="+data.latest_content[i].ID+"></td><td style='display:none;'>"+data.latest_content[i].ID+
                                   "</td><td>"+data.latest_content[i].title_of_activity+"</td><td>"+data.latest_content[i].date+"</td><td style='display:none;'>"+data.latest_content[i].date+"</td><td>"+data.latest_content[i].venue+"</td><td>"+data.latest_content[i].sponsors+
                                   "</td><td>"+data.latest_content[i].category_name+"</td><td><a href='<?php echo base_url('scanned_docs/"+data.latest_content[i].scanned_file+"'); ?>' target='_blank'>"+data.latest_content[i].scanned_file+"</a></td><td style='display:none;'>"+data.latest_content[i].category+"</td></tr>";
                        //}
                    } if( txt != "" ){
                      
                        $("#table-par-contents").prepend(txt);
                        document.getElementById("badgePar_total").textContent = data.parCount;
                    }    
                }
                  
                  $(".alert-add-success").fadeIn(100);
                  $(".alert-add-success").delay(2000).fadeOut(800);

                  document.getElementById("par-form").reset();
                  //console.log(data.notify);
                 }
                 else{
                   //console.log(data.notify);
                 }
             }

          });

        return false;
    } 

}); //end

$(".submit-applicant").click(function(e){
  e.preventDefault();
  $.post("<?php echo base_url(); ?>main_controller/saveapplicant/", $("#applicant-form").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-add-success").fadeIn(100);
             $(".alert-add-success").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");
});


$(".submit-workExperience").click(function(e){
  e.preventDefault();
  
  $.post("<?php echo base_url(); ?>main_controller/save_workExperience/", $("#applicant-workExperience-form").serialize(), function(data){
    
    if( data.notify=="Success" ){

      $(".alert-add-success").fadeIn(100);
      $(".alert-add-success").delay(2000).fadeOut(800);
      $("#companyNameID").val('');
      $("#workID").val('');
      $("#startDateID").val('');
      $("#endDateID").val('');

      setTimeout(function(){
          window.location.reload(1);
      }, 2000);

    }else{

      console.log(data.notify);

    }

  },"json");

});


$(".save-workExp").click( function(e){

  e.preventDefault();

  var appID = document.getElementById("appWorkID").value;
  var companyName = document.getElementById("companyNameID").value;
  var work = document.getElementById("workID").value;
  var startDate = document.getElementById("startDateID").value;
  var endDate = document.getElementById("endDateID").value;

  $.post("<?php echo base_url(); ?>main_controller/save_workExperience/", $("#applicant-workExperience-form").serialize(), function(data){

          if(data.notify=='Success'){  

                 var txt = "";
                 txt += "<tr class='tbl-appWork-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all appID-checkbox' id='radio_check_all appID-checkbox' value="+appID+"></td><td>"+companyName+
                         "</td><td>"+work+"</td><td>"+startDate+"</td><td>"+endDate+"</td></tr>";
                       
                  $("#table-appWork-contents").prepend(txt);
                   
                  
                  $(".alert-add-success").fadeIn(100);
                  $(".alert-add-success").delay(2000).fadeOut(800);
                  $("#companyNameID").val('');
                  $("#workID").val('');
                  $("#startDateID").val('');
                  $("#endDateID").val('');
                  setTimeout(function(){
                   window.location.reload(1);
                  }, 2000);
                  
            } else{

              console.log(data.notify);

            }  
             
       },"json");

})//end


//Update applicant work details
$(".save-updates").click( function(e){

  e.preventDefault();

  $.post("<?php echo base_url(); ?>main_controller/update_app_work/", $(".update-applicantWork-form").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-updateWork-success").fadeIn(100);
             $(".alert-updateWork-success").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");

})//end


// Update Seminar Details
$(".btn-update-seminar").click( function(e){

  e.preventDefault();

  $.post("<?php echo base_url(); ?>main_controller/update_app_seminar/", $(".applicant-seminar-edit-form").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-update-seminar-success").fadeIn(100);
             $(".alert-update-seminar-success").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");

})//end


// Update Application Position Details
$(".update-applicant-position").click( function(e){

  e.preventDefault();

  $.post("<?php echo base_url(); ?>main_controller/update_position_details/", $(".applicant-position-update").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-success-position-details").fadeIn(100);
             $(".alert-success-position-details").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");

})//end


$(".submit-seminarTraining").click(function(e){
  e.preventDefault();
  
  $.post("<?php echo base_url(); ?>main_controller/saveSeminarTraining/", $("#applicant-seminar-form").serialize(), function(data){
    
    if( data.notify=="Success" ){

      $(".alert-add-success").fadeIn(100);
      $(".alert-add-success").delay(2000).fadeOut(800);
      $("#seminarID").val('');
      $("#venueID").val('');
      $("#startDateID").val('');
      $("#endDateID").val('');

      setTimeout(function(){
          window.location.reload(1);
      }, 2000);

    }else{

      console.log(data.notify);

    }

  },"json");

});


$(".save-appSeminar").click( function(e){
  e.preventDefault();

  var appID = document.getElementById("appSeminarID").value;
  var seminarName = document.getElementById("seminarID").value;
  var venue = document.getElementById("venueID").value;
  var startDate = document.getElementById("startDateID").value;
  var endDate = document.getElementById("endDateID").value;

  $.post("<?php echo base_url(); ?>main_controller/saveSeminarTraining/", $("#applicant-seminar-form").serialize(), function(data){

          if( data.notify=='Success' ){  

              var txt = "";
              txt += "<tr class='tbl-seminar-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all appID-checkbox' id='radio_check_all appID-checkbox' value="+appID+"></td><td>"+seminarName+
                      "</td><td>"+venue+"</td><td>"+startDate+"</td><td>"+endDate+"</td></tr>";
                       
              $("#table-appSeminar-contents").prepend(txt);
              $(".alert-add-success").fadeIn(100);
              $(".alert-add-success").delay(2000).fadeOut(800);
              $("#seminarID").val('');
              $("#venueID").val('');
              $("#startDateID").val('');
              $("#endDateID").val('');

              setTimeout(function(){
                window.location.reload(1);
              }, 2000);

            } else{

              console.log(data.notify);

            }  
             
       },"json");

})//end


//Submit and save par category data

$(".submit-position").click(function(e){

        e.preventDefault();
        $(".submit-position").disabled = true;
      
        $.post('<?php echo base_url(); ?>main_controller/save_position_form_data/',$("#position-form").serialize(), function(data){

          document.getElementById('loading-image').style.display="block";

          if(data.notify=='Success'){  

              setTimeout(function(){
                 $(".alert-add-success").fadeIn(100);
                 $(".alert-add-success").delay(2000).fadeOut(800);
                 window.location.reload(1);
              }, 2000);
                  
            } else{

              console.log(data.notify);

            }
             
       },"json");
  

}); //end


$(".submit-item-number").click( function(e) {
  e.preventDefault();
  $.post("<?php echo base_url(); ?>main_controller/insert_item_number/", $(".position-item-form").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-addItem-success").fadeIn(100);
             $(".alert-addItem-success").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");
});


//PAR update function

$(".update-applicant").click(function(e){
    
     e.preventDefault();
    // var appID = $("#applicantID").val();
    
     $.post("<?php echo base_url(); ?>main_controller/update_applicant/", $(".applicant-form-edit").serialize(), function(data){

           if(data.notify == "Success"){

             $(".alert-edit-success").fadeIn(100);
             $(".alert-edit-success").delay(2000).fadeOut(800);
             setTimeout(function(){
                 window.location.reload(1);
              }, 2000);

           }else{

            console.log(data.notify);

           }

        },"json");

      
});

/*******************************************/

function HandleBrowseClick(){

    var fileinput = document.getElementById("userfile-edit");
    fileinput.click();

}

function Handlechange(){

    var fileinput = document.getElementById("userfile-edit");
    var textinput = document.getElementById("filename-edit");
    textinput.value = fileinput.value.replace(/^.*\\/, "");

}

$(".update-cat").click(function(e){
  
  e.preventDefault();

  var catID = document.getElementById("cat_id-edit").value;
  var catName = document.getElementById("inputCategory-edit").value;

  $.post("<?php echo base_url(); ?>main_controller/save_edited_cat", $("#cat-form-edit").serialize(), function(data){

    if( data.notify == "Success" ){

          var txt = "";
                  //console.log(data.data_id.title_of_activity);
                  //console.log(data.data_id);

                  txt += "<tr class='tbl-cat-row'><td><input type='checkbox' checked='checked' style='width:30px; height:20px;' class='radio_check_all cat-id-checkbox' id='radio_check_all cat-id-checkbox' value="+catID+"></td><td style='display:none;'>"+catID+
                         "</td><td>"+catName+"</td></tr>";
                 
                  //$("#table-par-contents tr.tbl-par-row").replaceWith(txt);
                  $('#table-cat-contents tr.tbl-cat-row').filter(':has(:checkbox:checked)').replaceWith(txt);
                  
                  $(".alert-edit-success").fadeIn(100);
                  $(".alert-edit-success").delay(2000).fadeOut(800);

    }

  }, "json");

});


/******************************************** Ajax Delete Function **********************************************************************/

// Applicant Work Delete

$(".btn-delete-applicant-work").click(function(e){

  e.preventDefault();

  var valArray = [];
  var FileName_array = [];
 
  $("input:checkbox:checked").each(function(i){
    valArray[i] = $(this).val();
  });

     if( valArray.length > 0 ){

     swal({   

      title: "Are you sure you want to delete this record/s?",   
      text: "You will not be able to recover this record!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      cancelButtonText: "No, cancel plx!",   
      closeOnConfirm: false,   
      closeOnCancel: false }, 

      function(isConfirm){   

        if (isConfirm) {    

          $.post("<?php echo base_url(); ?>main_controller/delete_applicantWorkRecord", { 'applicantIDs': valArray } , function(data){
              
            if( data.notify == "Success" ){
               swal("Deleted!", "The record has been deleted.", "success");
              setTimeout(function(){
                   window.location.reload(1);
              }, 2000);

            } else{

              console.log(data.notify);

            }

          }, 'json');  

        } else {     
          swal("Cancelled", "Your record is safe now :)", "error");   
        } 

      });

    } else{
      swal("Please select a record. Thanks.", "")
    }
 
});


//Delete Applicant Seminar Details

$(".btn-delete-applicant-seminar").click(function(e){

  e.preventDefault();

  var valArray = [];
  var FileName_array = [];
 
  $("input:checkbox:checked").each(function(i){
    valArray[i] = $(this).val();
  });

     if( valArray.length > 0 ){

     swal({   

      title: "Are you sure you want to delete this record/s?",   
      text: "You will not be able to recover this record!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      cancelButtonText: "No, cancel plx!",   
      closeOnConfirm: false,   
      closeOnCancel: false }, 

      function(isConfirm){   

        if (isConfirm) {    

          $.post("<?php echo base_url(); ?>main_controller/delete_applicantSeminarDetails", { 'applicantIDs': valArray } , function(data){
              
            if( data.notify == "Success" ){
              swal("Deleted!", "The record has been deleted.", "success");
              setTimeout(function(){
                   window.location.reload(1);
              }, 2000);

            } else{

              console.log(data.notify);

            }

          }, 'json');  

        } else {     
          swal("Cancelled", "Your record is safe now :)", "error");   
        } 

      });

    } else{
      swal("Please select a record. Thanks.", "")
    }
 
});


// PAR Category Delete

$(".btn-delete-cat").click(function(e){

  e.preventDefault();

  //var parID = $("input:checkbox:checked").val();
  var valArray = [];
  $("input:checkbox:checked").each(function(i){
    valArray[i] = $(this).val();
  });

  var postdata = { 'cat_IDs':valArray };

  if( valArray.length > 0 && valArray.length == 1){

     swal({   

      title: "Are you sure you want to delete this record?",   
      text: "You will not be able to recover this record!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      cancelButtonText: "No, cancel plx!",   
      closeOnConfirm: false,   
      closeOnCancel: false }, 

      function(isConfirm){   

        if (isConfirm) {    

          $.post("<?php echo base_url(); ?>main_controller/delete_cat", postdata, function(data){

          if( data.notify == "Success" ){

             $('#table-cat-contents tr.tbl-cat-row').filter(':has(:checkbox:checked)').remove();
             //$("#notify_section").notify("Record successfully deleted.", "success");
             swal("Deleted!", "The record has been deleted.", "success");
             document.getElementById("badgeCat_total").textContent = data.catCount;

          } else{

           //swal("Cannot delete category. \n The category is currently in used.", "")
           swal("Cannot delete category! \n The category is currently in used.", "", "warning");

          }

          }, 'json');

        } else {     

          swal("Cancelled", "Your record is safe now :)", "error"); 

        } 

      });

    } else{
      swal("Please select a record. Thanks.", "")
    }

});


// User Delete Script
// PAR Category Delete

$(".btn-delete-user").click(function(e){

  e.preventDefault();
  //var parID = $("input:checkbox:checked").val();
  var valArray = [];
  $("input:checkbox:checked").each(function(i){
    valArray[i] = $(this).val();
  });

  var postdata = { 'user_IDs':valArray };

   if( valArray.length > 0 && valArray.length == 1 ){

     swal({   

      title: "Are you sure you want to delete this record?",   
      text: "You will not be able to recover this record!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      cancelButtonText: "No, cancel plx!",   
      closeOnConfirm: false,   
      closeOnCancel: false }, 

      function(isConfirm){   

        if (isConfirm) {    

          $.post("<?php echo base_url(); ?>main_controller/delete_user", postdata, function(data){

            if( data.notify == "Success" ){

               $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').remove();
               //$("#notify_section").notify("User successfully deleted.", "success");
               swal("Deleted!", "The record has been deleted.", "success");
               document.getElementById("badgeUser_total").textContent = data.userCount;

             } else{

                alert("Cannot delete selected user. User in used.");

              }

            }, 'json');

        } else {     

          swal("Cancelled", "Your record is safe now :)", "error"); 

        } 

      });

    } else{
      swal("Please select a record. Thanks.", "")
    }
 
});


// Search script


$("#searchText_id").change(function(){

  var searchTextval = $("option:selected", this).text();

  document.getElementsByName("searchFormText")[0].placeholder = "Search by "+searchTextval;

});


$('.search-form').focus(function(){
    /*to make this flexible, I'm storing the current width in an attribute*/
    $(this).attr('data-default', $(this).width());
    $(this).animate({ width: 500 }, 'fast');
}).blur(function(){
    /* lookup the original width */
    var w = $(this).attr('data-default');
    $(this).animate({ width: 260 }, 'slow');
});


//Category search form effect

$('.search-form-cat').focus(function(){
    /* to make this flexible, I'm storing the current width in an attribute */
    $(this).attr('data-default', $(this).width());
    $(this).animate({ width: 500 }, 'fast');
}).blur(function(){
    /* lookup the original width */
    var w = $(this).attr('data-default');
    $(this).animate({ width: 260 }, 'slow');
});


// User search form effect

$('.search-form-user').focus(function(){

    /*to make this flexible, I'm storing the current width in an attribute*/
    $(this).attr('data-default', $(this).width());
    $(this).animate({ width: 500 }, 'fast');
}).blur(function(){
    /* lookup the original width */
    var w = $(this).attr('data-default');
    $(this).animate({ width: 260 }, 'slow');
});

/* Onclick PAR searching */

$(".btn-search-par").click(function(){

    var search_val = $(".search-form").val();
    var searchTextFilter = $("#searchText_id option:selected").text();

    var postdata = { 'search_val': search_val, 'searchTextFilter': searchTextFilter };
    
    $.post("<?php echo base_url(); ?>main_controller/search_par_control", postdata, function(data){

      if( data.notify == "Success" ){

        console.log(data.parCount);

         var len = data.search_par.length;
                var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        //if(data.content[i].contents && data.content[i].Genre){
                            txt += "<tr class='tbl-par-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all par-id-checkbox' id='radio_check_all par-id-checkbox' value="+data.search_par[i].ID+"></td><td style='display:none;'>"+data.search_par[i].ID+
                                   "</td><td>"+data.search_par[i].title_of_activity+"</td><td>"+data.search_par[i].date+"</td><td style='display:none;'>"+data.search_par[i].date+"</td><td>"+data.search_par[i].venue+"</td><td>"+data.search_par[i].sponsors+
                                   "</td><td>"+data.search_par[i].category_name+"</td><td><a href='<?php echo base_url('scanned_docs/"+data.search_par[i].scanned_file+"'); ?>' target='_blank'>"+data.search_par[i].scanned_file+"</a></td><td style='display:none;'>"+data.search_par[i].category+"</td></tr>";
                        //}
                    }
                    if(txt != ""){
                        $('#table-par-contents tbody').html(txt);
                        document.getElementById("badgePar_total").textContent = data.parCount;
                    }
                }

      } else{

        console.log(data.notify);

      }

    },'json');

});

/* Onkeypress PAR searching */

$('.search-form').keydown( function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

    if(key == 13) {

         e.preventDefault();

         var searchTextFilter = $("#searchText_id option:selected").text();
         var search_val = $(".search-form").val();
         var postdata = { 'search_val': search_val,'searchTextFilter':searchTextFilter };
        
        $.post("<?php echo base_url(); ?>main_controller/search_par_control", postdata, function(data){

          if( data.notify == "Success" ){
  
             var len = data.search_par.length;
                    var txt = "";
                    if(len > 0){
                        for(var i=0;i<len;i++){
                            //if(data.content[i].contents && data.content[i].Genre){
                                txt += "<tr class='tbl-par-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all par-id-checkbox' id='radio_check_all par-id-checkbox' value="+data.search_par[i].ID+"></td><td style='display:none;'>"+data.search_par[i].ID+
                                       "</td><td>"+data.search_par[i].title_of_activity+"</td><td>"+data.search_par[i].date+"</td><td style='display:none;'>"+data.search_par[i].date+"</td><td>"+data.search_par[i].venue+"</td><td>"+data.search_par[i].sponsors+
                                       "</td><td>"+data.search_par[i].category_name+"</td><td><a href='<?php echo base_url('scanned_docs/"+data.search_par[i].scanned_file+"'); ?>' target='_blank'>"+data.search_par[i].scanned_file+"</a></td><td style='display:none;'>"+data.search_par[i].category+"</td></tr>";
                            //}
                        }
                        if(txt != ""){
                            //$("#table-par-contents tbody").empty().append(txt);
                             $('#table-par-contents tbody').html(txt);
                             document.getElementById("badgePar_total").textContent = data.parCount;
                        }
                    }

          } else{

            console.log(data.notify);

            }

        },'json');
    }
});



/* Onkeypress PAR category searching */

$('.search-form-cat').keydown( function(e) {

    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

    if(key == 13) {

        e.preventDefault();

        var search_val = $(".search-form-cat").val();
        var postdata = {'search_val': search_val};
        
        $.post("<?php echo base_url(); ?>main_controller/search_cat_control", postdata, function(data){

          if( data.notify == "Success" ){
  
             var len = data.search_cat.length;
                    var txt = "";
                    if(len > 0){
                        for(var i=0;i<len;i++){
                            //if(data.content[i].contents && data.content[i].Genre){
                                txt += "<tr class='tbl-cat-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all cat-id-checkbox' id='radio_check_all cat-id-checkbox' value="+data.search_cat[i].ID+"></td><td style='display:none;'>"+data.search_cat[i].ID+
                                       "</td><td>"+data.search_cat[i].category_name+"</td></tr>";
                            //}
                        }
                        if(txt != ""){
                            //$("#table-par-contents tbody").empty().append(txt);
                             $('#table-cat-contents tbody').html(txt);
                             document.getElementById("badgeCat_total").textContent = data.catCount;
                        }
                    }

          } else{

            console.log(data.notify);

            }

        },'json');
    }
});


/* Onclick PAR Category searching */

$(".btn-search-position").click(function(){

    var search_val = $(".search-form-position").val();
    var postdata = {'search_val': search_val};
    
    $.post("<?php echo base_url(); ?>main_controller/search_position_control", postdata, function(data){

      if( data.notify == "Success" ){

        console.log(data.positionCounter);

         var len = data.search_position.length;
                var txt = "";

                if(len > 0){

                    for(var i=0;i<len;i++){
                        //if(data.content[i].contents && data.content[i].Genre){
                           txt += "<tr class='tbl-cat-row'><td><input type='checkbox' style='width:30px; height:20px;' class='cat-id-checkbox' id='radio_check_all' value="+data.search_position[i].ID+"></td><td style='display:none;'>"+data.search_position[i].ID+
                                  "</td><td>"+data.search_position[i].position_title+"</td><td>"+data.search_position[i].description+"</td><td>"+data.search_position[i].salary_grade+"</td><td>"+data.search_position[i].education+"</td><td>"+data.search_position[i].experience+"</td><td>"+data.search_position[i].training+"</td><td>"+data.search_position[i].eligibility+"</td></tr>";
                        //}
                    }

                    if(txt != ""){
                        $('#table-cat-contents tbody').html(txt);
                        document.getElementById("badgeCat_total").textContent = data.positionCounter;
                    }
                }

      } else{

        console.log(data.notify);

      }

    },'json');

});


/* Filter candidates */

$(".btn-search-candidates").click(function(){

    var search_val = $(".search-form-position").val();
    var postdata = {'search_val': search_val};
    
    $.post("<?php echo base_url(); ?>main_controller/search_position_id", postdata, function(data){

      var posID = data.posID[0]['ID'];

      if( data.notify == "Success" ){

              $.post("<?php echo base_url(); ?>main_controller/get_qualifiedCandidates_details", { 'posID': data.posID[0]['ID'] }, function(data){

              if( data.notify == "Success" ){

                console.log(data.qualifiedCandidates);

                 var len = data.qualifiedCandidates.length;
                 var txt = "";

                        if( len > 0 ){

                            for( var i = 0; i < len; i++ ){
                                //if(data.content[i].contents && data.content[i].Genre){
                                   txt += "<tr class='tbl-candidate-row'><td><input type='checkbox' style='width:30px; height:20px;' id='applicantID' value="+data.qualifiedCandidates[i].id+"></td><td>"+data.qualifiedCandidates[i].first_name+" "+data.qualifiedCandidates[i].last_name+
                                          "</td><td>"+data.qualifiedCandidates[i].contact_number+"</td><td>"+data.qualifiedCandidates[i].education_postgrad+"</td><td><a href='<?php echo base_url('main_controller/showWorkExperience/"+data.qualifiedCandidates[i].id+"'); ?>' target='_blank'>"+"View Experience"+
                                          "</a></td><td><a href='<?php echo base_url('main_controller/showSeminarTrainings/"+data.qualifiedCandidates[i].id+"'); ?>' target='_blank' >"+"View Training"+"</a></td></tr>";
                                //}
                            }

                         } 

                } else{

                  txt += "<tr class='tbl-candidate-row'><td>"+"</td><td>"+"</td><td>"+"</td><td style='font-size:24px;'>"+"No records found"+"</td><td>"+"</td><td>"+"</td></tr>";

                }

                if(txt != ""){
                    $('#table-candidate-contents tbody').html(txt);
                    document.getElementById("total_candidates").textContent = data.numQualifiedCandidates;
                    document.getElementById("print-candidates-btn").href='<?php echo base_url("main_controller/print_qualified_candidates") ?>'+'/'+posID;
                }

              },'json');

      } else{

        console.log(data.notify);

      }

    },'json');

});


/* Onclick User searching */

$(".btn-search-user").click(function(){

    var search_val = $(".search-form-user").val();
    var postdata = {'search_val': search_val};
    
    $.post("<?php echo base_url(); ?>main_controller/search_user_control", postdata, function(data){

      if( data.notify == "Success" ){

        console.log(data.userCount);

         var len = data.search_user.length;
                var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        //if(data.content[i].contents && data.content[i].Genre){
                             txt += "<tr class='tbl-user-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="+data.search_user[i].ID+"></td><td style='display:none;'>"+data.search_user[i].ID+
                                       "</td><td>"+data.search_user[i].fname+"</td><td>"+data.search_user[i].lname+"</td><td>"+data.search_user[i].username+"</td><td>"+data.search_user[i].position+
                                       "</td><td>"+data.search_user[i].status+"</td><td>"+data.search_user[i].privilege+"</td></tr>";
                        //}
                    }
                    if(txt != ""){
                        $('#table-user-contents tbody').html(txt);
                        document.getElementById("badgeUser_total").textContent = data.userCount;
                    }
                }

      } else{

        console.log(data.notify);

      }

    },'json');

});


/* Onkeypress User searching */

$('.search-form-user').keydown( function(e) {
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    if(key == 13) {

        e.preventDefault();

        var search_val = $(".search-form-user").val();
        var postdata = {'search_val': search_val};
        
        $.post("<?php echo base_url(); ?>main_controller/search_user_control", postdata, function(data){

          if( data.notify == "Success" ){

             var len = data.search_user.length;
                    var txt = "";
                    if(len > 0){
                        for(var i=0;i<len;i++){
                            //if(data.content[i].contents && data.content[i].Genre){
                                txt += "<tr class='tbl-user-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="+data.search_user[i].ID+"></td><td style='display:none;'>"+data.search_user[i].ID+
                                       "</td><td>"+data.search_user[i].fname+"</td><td>"+data.search_user[i].lname+"</td><td>"+data.search_user[i].username+"</td><td>"+data.search_user[i].position+
                                       "</td><td>"+data.search_user[i].status+"</td><td>"+data.search_user[i].privilege+"</td></tr>";
                            //}
                        }
                        if(txt != ""){
                            //$("#table-par-contents tbody").empty().append(txt);
                             $('#table-user-contents tbody').html(txt);
                             document.getElementById("badgeUser_total").textContent = data.userCount;
                        }
                    }

          } else{

            console.log(data.notify);

            }

        },'json');
    }
});

//Start and End Date


//User Script

$(".submit-user").click(function(e){

  e.preventDefault();

  var password = document.getElementById("inputPassword")
     ,confirm_password = document.getElementById("inputCpassword");

  var fname = document.getElementById("inputFirstname").value,
              lname = document.getElementById("inputLastname").value,
              position = document.getElementById("inputPosition").value,
              username = document.getElementById("inputUsername").value,
              user_password = document.getElementById("inputPassword").value,
              user_privilege = $("#inputAccessLevel :selected").text();//document.getElementById("inputAccessLevel").text,
              user_status = document.getElementById("inputStatus").value;

        
  var postdata = { "fname":fname, 
                   "lname":lname, 
                   "username":username, 
                   "position":position, 
                   "password":user_password, 
                   "privilege":user_privilege,
                   "status":user_status,
                   "theme_name":"Default"
                 };

         console.log(postdata);        

  
  if(password.value != confirm_password.value) {

    //alert("Passwords Don't Match");
    swal("Passwords Don't Match!", "", "warning");

  } else {

      //$.post("<?php echo base_url(); ?>main_controller/add_user", $("#user-form").serialize(), function(data){
      $.post("<?php echo base_url(); ?>main_controller/add_user", postdata, function(data){

      if(data.notify=='Success'){  

                   var len = data.latest_content.length; 
                   var txt = "";
                   //console.log(data.parCount);

                  if(len > 0){

                      for(var i=0;i<len;i++){
                         
                            txt += "<tr class='tbl-user-row'><td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="+data.latest_content[i].ID+"></td><td style='display:none;'>"+data.latest_content[i].ID+
                                     "</td><td>"+data.latest_content[i].fname+"</td><td>"+data.latest_content[i].lname+"</td><td>"+data.latest_content[i].username+"</td><td>"+data.latest_content[i].position+
                                     "</td><td>"+data.latest_content[i].status+"</td><td>"+data.latest_content[i].privilege+"</td></tr>";
                          //}
                      } if( txt != "" ){
                        
                          $("#table-user-contents").prepend(txt);
                          document.getElementById("badgeUser_total").textContent = data.userCount;
                      }    
                  }
                    
                    
                     $(".alert-addUser-success").fadeIn(100);
                     $(".alert-addUser-success").delay(2000).fadeOut(800);


                    document.getElementById("user-form").reset();
                    //console.log(data.notify);
                   } else{
                     console.log(data.notify);
                   }
      

    }, 'json');
    
  }

});


//User Script for submission of updates

$(".update-user").click(function(e){

  e.preventDefault();

        var user_id_stored = document.getElementById("user_id-edit").value,
            fname = document.getElementById("inputFirstname-edit").value,
            lname = document.getElementById("inputLastname-edit").value,
            position = document.getElementById("inputPosition-edit").value,
            username = document.getElementById("inputUsername-edit").value,
            access_level = $("#inputAccessLevel-edit :selected").text();//document.getElementById("inputAccessLevel-edit").value,
            currentPassword = document.getElementById("CurrentPassword").value,
            newPassword = document.getElementById("NewPassword").value,
            confirmPassword = document.getElementById("ConfirmPassword").value;
        var user_status;    


        var postdata = { "user_id":user_id_stored, "fname":fname, "lname":lname, "username":username, "position":position, "new_password":newPassword, "privilege":access_level };


  if( currentPassword == "" ){
    
      $.post("<?php echo base_url(); ?>main_controller/save_edited_user/", postdata, function(data){

              if(data.notify == "Success"){

                $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').each(function() {
          
                      $tr = $(this);
                      $('td', $tr).each(function() {                 
                          user_status = $tr.find('td:eq(6)').html();        
                      });    

                      return false;
                  });

                  var txt = "";
                
                  txt += "<tr class='tbl-user-row'><td><input type='checkbox' checked='checked' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="+user_id_stored+"></td><td style='display:none;'>"+user_id_stored+"</td><td>"+fname+
                          "</td><td>"+lname+"</td><td>"+username+"</td><td>"+position+"</td><td>"+user_status+"</td><td>"+access_level+"</td></tr>";
                 
                  //$("#table-par-contents tr.tbl-par-row").replaceWith(txt);
                  $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').replaceWith(txt);
                  
                  $(".alert-edit-success").fadeIn(100);
                  $(".alert-edit-success").delay(2000).fadeOut(800);

              } else{

                console.log(data.notify);

              }

          },"json");
       
 } else{

       if( newPassword != confirmPassword ){

             //alert("Password does not match");
             swal("Passwords Don't Match!", "", "warning");

            } else{

                $.post("<?php echo base_url(); ?>main_controller/save_edited_user", postdata, function(data){

                if(data.notify=='Success'){  

                      $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').each(function() {
              
                          $tr = $(this);
                          $('td', $tr).each(function() {                 
                              user_status = $tr.find('td:eq(6)').html();        
                          });    

                          return false;
                      });

                      var txt = "";
                    
                      txt += "<tr class='tbl-user-row'><td><input type='checkbox' checked='checked' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="+user_id_stored+"></td><td style='display:none;'>"+user_id_stored+"</td><td>"+fname+
                              "</td><td>"+lname+"</td><td>"+username+"</td><td>"+position+"</td><td>"+user_status+"</td><td>"+access_level+"</td></tr>";
                     
                      //$("#table-par-contents tr.tbl-par-row").replaceWith(txt);
                      $('#table-user-contents tr.tbl-user-row').filter(':has(:checkbox:checked)').replaceWith(txt);
                      
                      $(".alert-edit-success").fadeIn(100);
                      $(".alert-edit-success").delay(2000).fadeOut(800);
              } else{

                  console.log(data.notify);

              }
                

              }, 'json');
              
          }

     }   

});

//Check current password script - http://www.dti.gov.ph/dti/index.php/resources/statistics

function check_current_password(){
 
  var entered_password = $("#CurrentPassword").val(),
      user_id = document.getElementById("user_id-edit").value;
  var postdata = { "entered_password":entered_password, "user_id":user_id };


  $.post("<?php echo base_url(); ?>main_controller/check_current_password", postdata, function(data){

    if( data.notify == "Success" ){
      //alert("Password match");
      swal("Passwords Match!", "", "success");
      $("#NewPassword").prop("disabled", false);
      $("#ConfirmPassword").prop("disabled", false);
      $(".update-user").prop("disabled", false);
    } else{
      swal("Passwords Don't Match!", "", "warning");
      $("#NewPassword").prop("disabled", true);
      $("#ConfirmPassword").prop("disabled", true);
      $(".update-user").prop("disabled", true);
    }

  },'json');
  
}

// Check PAR Title if Exist Script

function check_title_repeat(){

   var check_title = $("#inputActivity").val();
   

  $.post("<?php echo base_url(); ?>main_controller/check_title_exist", {'check_title':check_title}, function(data){

   
    if(data.notify == "Success"){

      //alert("Dear Ms. Buros: \n The title already exist.");
      //swal({   title: "There is an error " + user_fname + ". \n The title already exist!",   text: "",   type: "error",   confirmButtonText: "" });
      swal({   title: "There is an error "+ user_fname +".\n The title already exist!",   text: "",   type: "error",   confirmButtonText: "" });

      $("#inputDate, #inputVenue, #inputSponsors, #category-id, #userfile, .submit-par").prop( "disabled", true );
     

    } else{

      //console.log(data.notify);
      swal("Good job " + user_fname + " ! Title is unique", "", "success")
      $("#inputDate, #inputVenue, #inputSponsors, #category-id, #userfile, .submit-par").prop( "disabled", false );

    }

  },'json');

}
     
  </script>

  <!-- Include Required Prerequisites -->
  <!--<script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>-->
  <script src="<?php echo base_url();?>asset/js/moment.min.js"></script>
  <!--<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap/3.3.2/css/bootstrap.css" />
  <link href="<?php echo base_url();?>asset/bootstrap/css/bootstrap_cdn.css" rel="stylesheet" type="text/css" />-->
  <?php if( isset($theme_name) ){ ?>

    <link href="<?php echo base_url(); ?>asset/bootswatch/<?php echo $theme_name; ?>/<?php echo $theme_name; ?>.css" rel="stylesheet" type="text/css" />

  <?php } ?>


  <!-- Include Date Range Picker -->
  <!--<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>-->
  <script src="<?php echo base_url();?>asset/js/daterangepicker.js"></script>
  <!--<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />-->
  <link href="<?php echo base_url();?>asset/bootstrap/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url();?>asset/js/ajaxfileupload.js"></script> 
  <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap_latest.js"></script>
  <script src="<?php echo base_url();?>asset/js/date.format.js"></script>





 