<?php
	require("connection.php");
?>

<html>
	<head>
		<title>Post-Its</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	
		<!-- AJAX and jQuery -->
		<script type="text/javascript">
			$(document).ready(function(){
				
				//AJAX for first form
				$('#create_note').submit(function(){
					var form = $(this);
					$.post(
						form.attr('action'),
						form.serialize(),
						function(data){
							if(data.error)
							{
								$('#submit').after("<div class='error'>" + data.error + "</div>");
								$('.error').css('color', 'red');
								$('.error').fadeOut(2000);
							}
							displayNotes();
							$('textarea').val('');
						}, "json");
					return false;
				});

				function displayNotes()
				{
					$.post(
						"display_notes.php",
						function(data){
							$('#notes').html(data);
							attachEventListeners();
							$('.background').click(function(){
								$(this).fadeOut(400, function(){ //callback in action! put in the fadeOut() before submitting the form for deletion
									$($(this).parent('.note_form')).submit();
								});
							});
						}
					);
				}

				function attachEventListeners()
				{
					$('.note_form').submit(function(){
						var form = $(this);
						$.post(
							form.attr('action'),
							form.serialize(),
							function(data){
								displayNotes();
							}, "json");
						return false;
					});
				}

				displayNotes();
			});
		</script>
	</head>

	<body class="container hero-unit">
		<h1>My Posts:</h1>

		<div id="container">
			<div id="notes"></div>
		</div>
		<div class="clearfix"></div>
		<form id="create_note" action="process.php" method="post">
			<textarea name="description" placeholder="Enter your description here..."></textarea><br />
			<input id="submit" type="submit" value="Post It!" />
			<input type='hidden' name='action' value='create' />
		</form>		
	</body>
</html>