<!-- JavaScript -->

  <script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.min.js"></script>
 
   <script type="text/javascript">
    $(function(){

      //alert("Hi Jun! welcome back!!!");

    });

    $("#btn-add").click(function(){
      
     $.post('<?php echo base_url(); ?>sample/save_player',$("#add_form").serialize(),function(data){       
           if(data.notify == "Success"){
             console.log(data.notify);
           }
        },"json");
      
    });

    function change_barangay_2(){

        var brgy_id = $("#brgy_id_1").val();
        var data_val = {'brgy_id':brgy_id};

        $.ajax({
             type: "POST",
             url:"<?php echo base_url();?>admin/get_barangay_list",
             data:data_val,
             dataType:'json',
             success: function(data)
              {
               $('#brgy_id_2').empty();
               $.each(data,function(id,val)
               {
                   /* var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(id);
                    opt.text(val);
                    $('#brgy_id_2').append(opt); */
                    var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(val.id);
                    opt.text(val.label);
                    $('#brgy_id_2').append(opt);
                });
              }
         });

     } //end change


     function populate_position_dropdown(){

      var team_id = $("#team-dropdown").val();
      var data_val = {'team_id':team_id};
      //alert(team_id);

        $.ajax({

          type: "POST",
          url: "<?php echo base_url(); ?>sample/get_player_position",
          data: data_val,
          dataType: 'json',
          success: function(data)
              {
               $('#position-dropdown').empty();
               $.each(data,function(id,val)
               {
                   /* var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(id);
                    opt.text(val);
                    $('#brgy_id_2').append(opt); */
                    var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(val.id);
                    opt.text(val.label);
                    $('#position-dropdown').append(opt);
                });
              }


        });

     }

     function populate_players_dropdown(){
       var position_id = $("#position-dropdown").val();
       alert(position_id);
     }


    

   </script>