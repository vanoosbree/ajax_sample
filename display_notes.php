<?php
	require("connection.php");

	$query = "SELECT * FROM notes";
	$notes = fetch_all($query);

	foreach ($notes as $note)
	{
		echo "
			<form class='note_form' action='process.php' method='post'>
				<div class='background'>
					<p class='note_text'>" . $note['description'] . "</p>
					<input type='hidden' name='id' value='". $note['id'] . "' />
					<input type='hidden' name='action' value='delete' />
				</div>
			</form>
		";
	}
?>