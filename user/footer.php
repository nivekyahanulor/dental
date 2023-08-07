

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="../page/back/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../page/back/vendor/php-email-form/validate.js"></script>
  <script src="../page/back/vendor/quill/quill.min.js"></script>
  <script src="../page/back/vendor/tinymce/tinymce.min.js"></script>
  <script src="../page/back/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../page/back/vendor/chart.js/chart.min.js"></script>
  <script src="../page/back/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../page/back/vendor/echarts/echarts.min.js"></script>
  <script src="../page/back/js/moment.js"></script>
  <script src="../page/back/js/fullcalendar.js"></script>
  <script src="../page/back/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
  <style>
   .fc-day-grid-event{
	}
  </style>
  <?php 
		include('../controller/user-calendar.php');
		$calendar = array();
		while($res = $tbl_event->fetch_object()){ 
			 $start = $res->start;
			 $startDate  = date("Y-m-d", strtotime($start));
			 $end = $res->end;
			 $endDate  = date("Y-m-d", strtotime($end));
			 $calendar[] = array(   "title" => $res->title,
									  "description" => $res->description,
									  "percentage" => $res->discount,
									  "services" => str_replace('"', '',str_replace( array('[',']') , ''  ,$res->services )),
									  "start" => $startDate."T00:00:00.000",
									  "end"   => $endDate."T23:59:00",
									  "backgroundColor" => "blue",
									  "status" => "event",
									  "count" => "0",
								);
		}
		
		$appointments = array();
		while($res1 = $tbl_appointments->fetch_object()){ 
				
					 $start = $res1->request_date;
					 
					 $tbl_date = $mysqli->query("SELECT  request_date ,approved FROM `tbl_appointments` where request_date='$start'  ");
					 $dr       = $tbl_date->fetch_assoc();
					 
					 if($dr['dc'] >=11){
						$count = 1;
					 } else {
						$count = 0;
					 }
					 
					 $startDate  = date("Y-m-d", strtotime($start));
					 // if($_SESSION['id'] == $res1->user_id){
						 // $name =  $res1->firstname .' '. $res1->lastname;
					 // }
					
					    $colors = 'green';
                        $appointments[] = array( "title" =>date("g:i A", strtotime($res1->request_time)),
										  "start" => $startDate,
										  "time" => date("g:i A", strtotime($res1->request_time)),
										  "backgroundColor" => $colors,
										  "status" => "schedule",
										);
				}
				

	?>
  <script>
   // var link = 'https://donesdentalclinic.online/';
  var link = 'http://localhost/dental/';
  $(document).ready(function() {
	  
		$('#closecalendar').click(function() {
			$('#calendarmodal').modal('hide');
		});
		
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'month',
			events: <?php echo json_encode(array_merge($calendar,$appointments));?>,
			eventClick:  function(event, jsEvent, view) {
			   if(event.status=='event'){
			    $('#calendarmodal').modal('show');
				$('.modal').find('#name').html(''); 
			    $('.modal').find('#appointments').html('');
				$('.modal').find('#time').html(''); 
				
					$('.modal').find('#title').html('Title : <br>' + event.title + '<br><br>');
					$('.modal').find('#description').html('Description : <br>' + event.description+ '<br><br>');
					$('.modal').find('#percentage').html('Discount : <br>' + event.percentage+ '% <br><br>');
					$('.modal').find('#services').html('Services : <br>' + event.services+ ' <br><br>');
					$('.modal').find('#starts1').html('Start : <br>' +$.fullCalendar.moment(event.start).format('YYYY/MM/DD')+ '<br><br>');
					$('.modal').find('#ends1').html('End : <br>' +$.fullCalendar.moment(event.end).format('YYYY/MM/DD')+ '<br><br>');
			   } else {
				 $('.modal').find('#name').html('Patient Name : <br>' + event.title + '<br><br>'); 
			     $('.modal').find('#appointments').html('Appointment Date : <br>' +$.fullCalendar.moment(event.start).format('YYYY/MM/DD')+ '<br><br>');
				 $('.modal').find('#time').html('Appointment Time : <br>' + event.time + '<br><br>'); 
				 
				 
					 $('.modal').find('#title').html('');
					 $('.modal').find('#description').html('');
					 $('.modal').find('#starts1').html('');
					 $('.modal').find('#ends1').html('');
					 $('.modal').find('#services').html('');
					 $('.modal').find('#percentage').html('');
			   }
        },eventRender: function(info,cell) {
			if(info.count ==1){
				$('.fc-day[data-date="'+$.fullCalendar.moment(info.start).format()+'"]').css('background', "red");
				$('.fc-title').css('visibility', "hidden");
			}
		  }
		});
		
	});
	$('#date_appointment').on('change', function() {
	    var doc_id = $('#get-doc-time').val();
				$.ajax({
				   type: "POST",
				   url: link + 'controller/user-appointments.php',
				   data : {
							 'date'        : this.value , 
							 'doc_id'      : doc_id , 
							 'check-date': 'check',
						
					},
				   success: function(data)
				   {
						if(data == 'yes'){
							$("#process").show();
							$("#not-available").hide();
						} else {
							$("#not-available").show();
							$("#process").hide();
						}
				   }
			   });	
	});
	$('#time-appointments').on('change', function() {
				var date = $('#date_appointment').val();
	            var doc_id = $('#get-doc-time').val();
				$.ajax({
				   type: "POST",
				   url: link + 'controller/user-appointments.php',
				   data : {
							 'time'      : this.value , 
							 'date'      : date ,
							 'doc_id'    : doc_id , 
							 'check-time': 'check',
						
					},
				   success: function(data)
				   {
						if(data == 'yes'){
							$("#process").show();
							$("#not-available").hide();
						} else {
							$("#not-available").show();
							$("#process").hide();
						}
				   }
			   });	
	});
	$('#cpassword').on('change', function() {
		var passhash = CryptoJS.MD5(this.value).toString();
		var pp =  $("#ppassword").val();

		if(passhash != pp){
			$("#passres").show();
			$("#passres").html("<p color:red> Password not match to current password</p>");
		} else {
			$("#passres").hide();
			$("#newpass").show();
			$("#update-profile").show();
		}
	});
	
	function password_show_hide() {
	  var x = document.getElementById("cpassword");
	  var show_eye = document.getElementById("show_eye");
	  var hide_eye = document.getElementById("hide_eye");
	  hide_eye.classList.remove("d-none");
	  if (x.type === "password") {
		x.type = "text";
		show_eye.style.display = "none";
		hide_eye.style.display = "block";
	  } else {
		x.type = "password";
		show_eye.style.display = "block";
		hide_eye.style.display = "none";
	  }
	}
	
	function password_show_hide1() {
	  var x = document.getElementById("npassword");
	  var show_eye = document.getElementById("show_eye");
	  var hide_eye = document.getElementById("hide_eye");
	  hide_eye.classList.remove("d-none");
	  if (x.type === "password") {
		x.type = "text";
		show_eye.style.display = "none";
		hide_eye.style.display = "block";
	  } else {
		x.type = "password";
		show_eye.style.display = "block";
		hide_eye.style.display = "none";
	  }
	}
  
  </script>
    <script>
	$('#get-doc-time').on('change', function() {
		
	    var id = this.value;
		$.ajax({
			   type: "POST",
			   dataType: "json",
			   url:link+'/controller/get-doc-time.php',
			   data : {
					 'id'         : id, 
				},
			   success: function(data)
			   {
				 $("#dc-res").show(); 
				 $("#dc-res").html(data.time); 
				 
				 if(data.monday == 1){
						var monday = 1;
				 } else {
						var monday = "";
				 } if(data.tuesday == 1){
						var tuesday = 2;
				 } else {
						var tuesday = "";
				 } if(data.wednesday == 1){
						var wednesday = 3;
				 } else {
						var wednesday = "";
				 } if(data.thursday == 1){
						var thursday = 4;
				 } else {
						var thursday = "";
				 } if(data.friday == 1){
						var friday = 5;
				 } else {
						var friday = "";
				 }if(data.saturday == 1){
						var saturday = 6;
				 } else {
						var saturday = "";
				 }if(data.sunday == 1){
						var sunday = 0;
				 } else {
						var sunday = "";
				 }
				 const picker = document.getElementById('date_appointment');
					picker.addEventListener('input', function(e){
					  var day = new Date(this.value).getUTCDay();
					  if([monday,tuesday,wednesday,thursday,friday,saturday,sunday].includes(day)){
						e.preventDefault();
						this.value = '';
						alert('This Day is not allowed ! Dentist Day Off!');
					  }
				});
			   }
		 });
	});  
	
	
  </script>
</body>
<div class="modal" id="calendarmodal" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Calendar Details</h5>
              
              </div>
              <div class="modal-body">
											
						 <div id="name"></div>
						 <div id="appointments"></div>
						 <div id="time"></div>
						 <div id="title"></div>
						 <div id="description"></div>
						 <div id="services"></div>
						 <div id="percentage"></div>
						 <div id="starts1"></div>
						 <div id="ends1"></div>
											
              </div>
			   <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" id="closecalendar" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</html>