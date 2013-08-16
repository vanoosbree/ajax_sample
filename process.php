<?php
	require("connection.php");

	$data = array();

	if($_POST['action'] == 'create')
	{
		if(!(strlen($_POST['description']) > 0))
		{
			$data['error'] = "Enter some text for your note";
		}
		else	 
		{
			$query = "
				INSERT INTO notes (description, created_at, updated_at) 
				VALUES ('". $_POST['description'] ."', NOW(), NOW())
				";
			mysql_query($query);
		}
	}

	if($_POST['action'] == 'delete')
	{
		$query = "
			DELETE FROM notes
			WHERE id = " . $_POST['id'];
		
		mysql_query($query);
	}

	echo json_encode($data);
?>