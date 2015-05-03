<?php
require_once('db.php');
$releasequery = $sql->query('SELECT releaseid, releasename, releasedate, releasecover FROM ' . $sql->get_table_prefix() . 'releases ORDER BY releasedate DESC');
echo '<ul id="releaselist">';
while($releaserow = $sql->fetch_assoc($releasequery)) {
	//Check hidden release
	if($sql->num_rows($sql->query('SELECT releaseid FROM ' . $sql->get_table_prefix() . 'hiddenrels WHERE releaseid = "' . $sql->real_escape_string($releaserow['releaseid']) . '"')) > 0) continue;
	echo '<li><a href="release.php?r=' . $releaserow['releaseid'] . '"><img class="thumb" alt="" src="' . $releaserow['releasecover'] . '"/><span class="releaselistitem">' . $releaserow['releasename'] . '</span></a></li>';
}
echo '</ul>';
?>