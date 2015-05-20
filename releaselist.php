<?php
require_once('db.php');
$releasequery = $sql->query('SELECT releaseid, releasename, releasedate, releasecover FROM ' . $sql->get_table_prefix() . 'releases ORDER BY releasedate DESC');
if($sql->error()) {
	echo '<div>Sorry, we couldn\'t get the list of releases. Technical info: ' . $sql->error() . '</div>';
} else {
	echo '<ul id="releaselist">';
	while($releaserow = $sql->fetch_assoc($releasequery)) {
		//Check hidden release
		$hiddenrelquery = $sql->query('SELECT releaseid FROM ' . $sql->get_table_prefix() . 'hiddenrels WHERE releaseid = "' . $sql->real_escape_string($releaserow['releaseid']) . '"');
		if(!$sql->error() && ($sql->num_rows($hiddenrelquery) > 0)) {
			continue;
		}

		echo '<li><a href="release.php?r=' . $releaserow['releaseid'] . '"><img class="thumb" alt="" src="' . $releaserow['releasecover'] . '"/><span class="releaselistitem">' . $releaserow['releasename'] . '</span></a></li>';
	}
	echo '</ul>';
}
?>