<form id="gaming-gear-link-form" class="gamingformbx" action="" method="post">
			 <div class="top-50">
				
			 

					<div class="form-group">
						<input required="" type="text" name="c_linkname[]" id="c_linkname" class="input-social" placeholder="Link's name">
					
					</div>
					
					<div class="ty-pl-s">
						<div class="form-group items">
						
							<div class="ty-playstation">
								<input required="" type="url" name="c_link[]" id="c_link[]" placeholder="URL" class="input-social">
							 </div>
						 
						 
						</div>
						
					</div>
					
			 
	 
	   	   <div class="text-center form-group"><button class="add-more add" type="button">+ </button></div>
			 </div>
			 
				<div class="ty-apply-box text-center">
					<button class="apply_btn" type="submit" name="gaming-link" id="gaming-link">Apply</button>
					</div>
  
   </form>
   
   
   <script>
   
   $(document).ready(function() {
  //$(".delete").hide();
  //when the Add Field button is clicked
  $(".add").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $(".items").append(
      '<div class="ty-playstation linkalign"><p><input type="text"  name="c_linkname[]" required  id="c_linkname" placeholder="Link name"  class="input-social"></p><input  type="url"  required name="c_link[]"  id="c_link[]" placeholder="URL" class="input-social"> <button class="delete"><i class="fa fa-trash-o"></i></button></div> '
    );
  });
  $("body").on("click", ".delete", function(e) { 
	$(this).closest(".ty-playstation").remove();
	var del_id = $(this).attr('id');
	
	var dataString =  "del_id="+ del_id;
                        
                    	$.ajax({
                    			type: "POST",
                    			url: BASE_URL+"delete_gaming_gear_links",
                    			data: dataString,
                    			success: function(html) {
                    			
                                	 
                    			},
                    			beforeSend:function(d){
                                    $('#load_data').html("<center><strong style='color:red'><div class='loader'></div>  Please Wait...<br></strong></center>");
                                }
                    	 });
						 
  });
  
  
  
  
});
   
$('#gaming-gear-link-form').submit(function(event){ 
       event.preventDefault();
    
    $.ajax({
        url: BASE_URL+"submit_gaming_gear_links",
        method:"POST",  
        data:$('#gaming-gear-link-form').serialize(),
        type:'json',
        success: function(msg) {
            
            if (msg == 'YES'){
				
				swal({
				  title: "Success!!",
				  text: "Your list of links updated  !",
				  icon: "success",
				  button: "Ok",
				}).then(function() {
                          location.reload();
                       });
				var i=1;
                  	//$('#show-my-services1').remove();
                  	//$('#gaming-gear-link-form')[0].reset();
        }
                
            else if (msg == 'NO'){
				swal({
				  title: "Sorry !",
				  text: "Gaming Gear Link Exists !",
				  icon: "error",
				  button: "Ok !",
				});
                
            }
            else {
                $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

// end submit gaming links

   </script>
   
   
   <?php
   
   
function submit_gaming_gear_links(){
		
		$data = array();
        $userData = array();
        $data = array();
		date_default_timezone_set('Asia/Calcutta');
		$reg_date = date('Y-m-d h:i:sa');
        $user = $this->web_model->getRows(array('id'=>$this->session->userdata('userId')));
       
       
       $gamelink = $this->input->post('c_link[]');
       $gamelinkname = $this->input->post('c_linkname[]');
		 
       $this->web_model->delete_gaming_gear_link_user($user['id']);
      
			for($i=0; $i< count($gamelink);$i++) {
			   
                    $gaminggearData = array(
                        'link' => $gamelink[$i],
                        'linkname' => $gamelinkname[$i],
        				'uid' => $user['id'],
        				'cdate' => $reg_date,
                    );
            
                    $insert = $this->web_model->save_gaming_gear_link($gaminggearData);
			   }
                if($insert){
                    
                    echo 'YES';
                }
				else{
                    
                    echo 'NO';
                }
    	 
	}
	
	
function delete_gaming_gear_links(){
		
		$data = array();
        $userData = array();
        $data = array();
		date_default_timezone_set('Asia/Calcutta');
		$reg_date = date('Y-m-d h:i:sa');
        $user = $this->web_model->getRows(array('id'=>$this->session->userdata('userId')));
       
       
       $del_id = $this->input->post('del_id'); 
		 
       $this->web_model->delete_gaming_gear_link_id($del_id);
       
                    
                    echo 'YES';
  
    	 
	}
   
   ?>