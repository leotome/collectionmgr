<?php
require_once 'config/db.php';
	$sql = "SELECT * FROM albums al JOIN media_type tp ON al.media_type=tp.id_type JOIN recordlabels lb ON al.label=lb.id_label ORDER BY al.artist";
	$query = $dbh->prepare($sql); //Prepare the query:
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_CLASS);
	//Assign the data which you pulled from the database (in the preceding step) to a variable.
?>
﻿<html>
<head>
	<meta charset="utf-8">
        <style>
        thead{
             border-bottom: 1px solid black;
             display: table-header-group;
        }
        </style>
</head>
<body>
<table border="1">
	<thead>
		<tr>
			<td><b>Cover</b></td>
			<td><b>Artist</b></td>
			<td><b>Album</b></td>
			<td><b>Release year</b></td>
			<td><b>Type</b></td>
			<td><b>Label</b></td>
			<td><b>Actions</b></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
			if($query->rowCount() > 0){
				foreach($results as $result){
			?>
			<td><img src="images/album_art/<?php echo htmlentities($result->id);?>.jpeg" width="60"></td>
			<td><?php echo htmlentities($result->artist);?></td>
			<td><?php echo htmlentities($result->album);?></td>
			<td><?php echo htmlentities($result->relyear);?></td>
			<td><?php echo htmlentities($result->type_name);?> (x<?php echo htmlentities($result->media_amount);?>)</td>
			<td><?php echo htmlentities($result->label_name);?></td>
                        <td><a href="tracklist.php?id=<?php echo htmlentities($result->id);?>" target="popup" onclick="window.open('tracklist.php?id=<?php echo htmlentities($result->id);?>','popup','width=600,height=600,scrollbars=yes,resizable=no'); return false;">View details</a></td>
		</tr>
		<?php
	}}
	?>
	</tbody>
</table>
</body>
</html>
