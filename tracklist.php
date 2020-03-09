<?php
require 'config/db.php';
$id = $_GET['id'];
	$sql = "SELECT al.artist, al.album, al.relyear, al.media_amount, lb.label_name, tp.type_name FROM albums al JOIN media_type tp ON al.media_type=tp.id_type JOIN recordlabels lb ON al.label=lb.id_label WHERE al.id='".$id."';";
	$query = $dbh->prepare($sql); //Prepare the query:
	$query->execute();
	$albuminfo=$query->fetch();
	//Assign the data which you pulled from the database (in the preceding step) to a variable.

        $checker = "SELECT tk.cd_number, COUNT(tk.id) AS total FROM album_track_list tk WHERE tk.album_id='".$id."' GROUP BY tk.cd_number;";
        $myQuery = $dbh->prepare($checker); //Prepare the query:
        $myQuery->execute();
        $trackinfo=$myQuery->fetchAll(PDO::FETCH_CLASS);
?>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<table>
	<tr>
		<td rowspan="5">
			<img src="images/album_art/<?php echo htmlentities($id);?>.jpeg" width="150">
		</td>
		<td>
		<b>Artist:</b> <?php echo htmlentities($albuminfo["artist"]);?>
		</td>
	</tr>
	<tr>
		<td>
		<b>Album:</b> <?php echo htmlentities($albuminfo["album"]);?>
		</td>
	</tr>
	<tr>
		<td>
		<b>Release Year:</b> <?php echo htmlentities($albuminfo["relyear"]);?>
		</td>
	</tr>
	<tr>
		<td>
		<b>Label:</b> <?php echo htmlentities($albuminfo["label_name"]);?>
		</td>
	</tr>
	<tr>
		<td>
		<b>(<?php echo htmlentities($albuminfo["media_amount"]);?>x) <?php echo htmlentities($albuminfo["type_name"]);?></b><br>
		<?php
                foreach($trackinfo as $no){
                        echo "#".htmlentities($no->cd_number)." - ".htmlentities($no->total)." tracks<br>";
                }
                ?>
		</td>
	</tr>
        <?php
        for($t=1;$t<=$albuminfo["media_amount"];$t++){
                $tracknames = "SELECT tk.id, tk.track_name FROM album_track_list tk WHERE tk.album_id='".$id."' AND tk.cd_number=".$t.";";
                $trackQuery = $dbh->prepare($tracknames); //Prepare the query:
                $trackQuery->execute();
                $tknames = $trackQuery->fetchAll(PDO::FETCH_CLASS);
                echo '<tr><td colspan="2" style="background-color:rgba(244, 244, 244, 0.5)"><b>Disc #'.$t.'</b></td></tr>';
                foreach($tknames as $names){
                        echo '<tr><td><u>Track '.htmlentities($names->id).'</u></td><td>'.htmlentities($names->track_name).'</td></tr>';
                }
        }
        ?>
</table>
</body>
</html>
