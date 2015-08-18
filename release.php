<?php
require_once(dirname(__FILE__) . '/include/db.php');
require_once(dirname(__FILE__) . '/config/general.php');
//Output appropriate status
if(empty($_GET['r'])) {
	$releasename = 'Nonexistent Release';
	header('HTTP/1.1 404 Not Found');
} else {
	$releaseid = $oar_sql->real_escape_string($_GET['r']);
	$releasequery = $oar_sql->query('SELECT * FROM `' . $oar_sql->get_table_prefix() . 'releases` WHERE releaseid = \'' . $releaseid . '\'');
	if($oar_sql->error()) {
		$releasename = 'Release We Couldn\'t Get';
		header('HTTP/1.1 500 Internal Server Error');
	} else {
		if($oar_sql->num_rows($releasequery) == 0) {
			$releasename = 'Nonexistent Release';
			header('HTTP/1.1 404 Not Found');
		} else {
			$releaserow = $oar_sql->fetch_assoc($releasequery);
			$releasename = $releaserow['releasename'];
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>"<?php echo htmlspecialchars($releasename);?>" by <?php echo htmlspecialchars($oar_config['artist']); ?></title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>
	<body>
		<!-- common header -->
		<!-- end common header -->
		<?php
		//check for error
		if($oar_sql->error()) {
			echo '<p>Sorry, we couldn\'t get the description for this release. Technical info: ' . $oar_sql->error() . '</p>';
		} else {
			//check for nonexistent release
			if($oar_sql->num_rows($releasequery) == 0) {
				echo '<p>Sorry, we couldn\'t find this release. Check the URL and try again. Or, <a href=".">head home</a>.</p>';
			} else {
				//release-specific header
				echo $releaserow['releaseheader'];
				//cover image
				if($releaserow['releasecover']) {
					echo '<div><img class="cover" src="' . $releaserow['releasecover'] . '" alt="Cover for &quot;' . $releaserow['releasename'] . '&quot;"/></div>';
				}
				//release date
				$releasedate = strtotime($releaserow['releasedate']);
				echo '<p class="releasedate">Released <time datetime="' . date('Y-m-d', $releasedate) . '">' . date('j F Y', $releasedate) . '</time></p>';
				//description
				echo $releaserow['releasedesc'];
				//sections
				$secquery = $oar_sql->query('SELECT * FROM `' . $oar_sql->get_table_prefix(). 'sections` WHERE releaseid = \'' . $releaseid . '\' ORDER BY secpos ASC');
				if($oar_sql->error()) {
					echo '<p>Sorry, we couldn\'t get some information for this release. Technical info: ' . $oar_sql->error() . '</p>';
				} else {
					//display each section
					$tparams['releaseid'] = $releaseid;
					while($secrow = $oar_sql->fetch_assoc($secquery)) {
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