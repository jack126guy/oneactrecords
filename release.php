<?php
require('db.php');
//Output appropriate status
if(empty($_GET['r'])) {
	$releasename = 'Nonexistent Release';
	header('HTTP/1.1 404 Not Found');
} else {
	$releaseid = $sql->real_escape_string($_GET['r']);
	$releasequery = $sql->query('SELECT * FROM ' . $sql->get_table_prefix() . 'releases WHERE releaseid = "' . $releaseid . '"');
	if($sql->error()) {
		$releasename = 'Release We Couldn\'t Get';
		header('HTTP/1.1 500 Internal Server Error');
	} else {
		if($sql->num_rows($releasequery) == 0) {
			$releasename = 'Nonexistent Release';
			header('HTTP/1.1 404 Not Found');
		} else {
			$releaserow = $sql->fetch_assoc($releasequery);
			$releasename = $releaserow['releasename'];
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>"<?php echo $releasename;?>" by <?php echo $config['artist']; ?></title>
		<link rel="stylesheet" type="text/css" href="../styles.css"/>
		<link rel="stylesheet" type="text/css" href="musicstyles.css"/>
	</head>
	<body>
		<!-- common header -->
		<!-- end common header -->
		<?php
		//check for error
		if($sql->error()) {
			echo '<p>Sorry, we couldn\'t get the description for this release. Technical info: ' . $sql->error() . '</p>';
		} else {
			//check for nonexistent release
			if($sql->num_rows($releasequery) == 0) {
				echo '<p>Sorry, we couldn\'t find this release. Check the URL and try again. Or, <a href=".">head home</a>.</p>';
			} else {
				//release-specific header
				echo $releaserow['releaseheader'];
				//cover image
				echo '<div><img class="cover" src="' . $releaserow['releasecover'] . '" alt="Cover for &quot;' . $releaserow['releasename'] . '&quot;"/></div>';
				//release date
				$releasedate = strtotime($releaserow['releasedate']);
				echo '<p class="releasedate">Released <time datetime="' . date('Y-m-d', $releasedate) . '">' . date('j F Y', $releasedate) . '</time></p>';
				//description
				echo $releaserow['releasedesc'];
				//sections
				$secquery = $sql->query('SELECT * FROM ' . $sql->get_table_prefix(). 'sections WHERE releaseid = "' . $releaseid . '" ORDER BY secpos ASC');
				if($sql->error()) {
					echo '<p>Sorry, we couldn\'t get some information for this release. Technical info: ' . $sql->error() . '</p>';
				} else {
					//display each section
					$tparams['releaseid'] = $releaseid;
					while($secrow = $sql->fetch_assoc($secquery)) {
						echo '<h1>' . $secrow['sectitle'] . '</h1>';
						$tparams['secpos'] = $secrow['secpos'];
						include('templates/' . $secrow['sectemplate']);
					}
				}
			}
		}
		?>
	</body>
</html>