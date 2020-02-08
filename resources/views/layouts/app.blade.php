<!DOCTYPE html>
<html>
    <head>
        <title>Car Paint Job</title>

		<link href="css/style.css" rel="stylesheet" type="text/css">
		<script src="js/jquery-3.2.1.js" type="text/javascript"> </script>
		<script src="js/jquery-3.2.1.min.js" type="text/javascript"> </script>
		<meta name="csrf_token" content="{{ csrf_token() }}" />
		
    </head>
    <body>
        <div class="container">
           @yield('content')
        </div>
    </body>

	<script>
		
			$('document').ready(function(){
				
				$('#currcolor').on('change', function (e){
					var selColor = $('#currcolor :selected').val();
					if (selColor == "red") {
						$('.defaultimg').html("<img src='images/redcar.png'>");
					}
					
					else if (selColor == "green") {
						$('.defaultimg').html("<img src='images/greencar.png'>");
					}
					
					else {
						$('.defaultimg').html("<img src='images/bluecar.png'>");
					}
				});
				
				$('#tarcolor').on('change', function (e){
					var selColor = $('#tarcolor :selected').val();
					if (selColor == "red") {
						$('.targetcolor').html("<img src='images/redcar.png'>");
					}
					
					else if (selColor == "green") {
						$('.targetcolor').html("<img src='images/greencar.png'>");
					}
					
					else {
						$('.targetcolor').html("<img src='images/bluecar.png'>");
					}
				});
				
				$("#cardetails").submit(function(evt){
					evt.preventDefault();
					
					var formData = new FormData($(this)[0],$(this)[1]);
					$.ajax({
					
						url: '/process',
						type: 'POST',
						beforeSend: function (xhr) {
							var token = $('meta[name="csrf_token"]').attr('content');

							if (token) {
								  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
							}
						},
						data: formData,
						cache: false,
						contentType: false,
						enctype: 'multipart/form-data',
						processData: false,
						dataType:'json',
						success: function (response) {
							$("#currtable tr td").remove();
							var newbtn = "<input type='button' value='complete'/>"
							
							for (var prop in response.data1) {
								
								var row = $('<tr>');
								var item = response.data1[prop];

								$('<td>').html(item.platenumber).appendTo(row);
								$('<td>').html(item.currentcolor).appendTo(row);
								$('<td>').html(item.targetcolor).appendTo(row);
								$('<td>').html(item.action).appendTo(row);
								$('<td>').html(newbtn).attr('data-href',item.id).addClass("compbtn").appendTo(row);
								
								$("#currtable").append(row);
							}	
							$('#countjob').html('<b>'+'Queue Jobs: '+response.data2+'</b>');
							$(".plateno").val("");
							$("#currcolor").val("-- select an option --");
							$("#tarcolor").val("-- select an option --");
							$('.defaultimg').html("<img src='images/default.png'>");
							$('.targetcolor').html("<img src='images/default.png'>");
						}
					});
				});
				
				$(document).on('click','.compbtn',function(event){
					
					$.ajax({
						url:'/update',
						type:'POST',
						data:{upaction:$(this).data("href"),'_token':$('input[name=_token]').val()},
						dataType:'json',
						success: function(response){
							$("#currtable tr td").remove();
							var newbtn = "<input type='button' value='complete'/>"
							
							for (var prop in response.data1) {
								
								var row = $('<tr>');
								var item = response.data1[prop];

								$('<td>').html(item.platenumber).appendTo(row);
								$('<td>').html(item.currentcolor).appendTo(row);
								$('<td>').html(item.targetcolor).appendTo(row);
								$('<td>').html(item.action).appendTo(row);
								$('<td>').html(newbtn).attr('data-href',item.id).addClass("compbtn").appendTo(row);
								
								$("#currtable").append(row);
							}	
							
							$('#countjob').html('<b>'+'Queue Jobs: '+response.data2+'</b>');
						}
					});
					
				});
				
				var auto_refresh = setInterval(function(){
					$("#queuediv").load('/paintjobs').fadeIn("slow");
				},5000);
				
			});

		</script>
</html>
