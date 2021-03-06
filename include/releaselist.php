<?php
require_once(dirname(__FILE__) . '/db.php');
include_once(dirname(__FILE__) . '/../config/general.php');
$releasequery = $oar_sql->query('SELECT releaseid, releasename, releasedate, releasecover FROM `' . $oar_sql->get_table_prefix() . 'releases` ORDER BY releasedate DESC');
if($oar_sql->error()) {
	echo '<div>Sorry, we couldn\'t get the list of releases. Technical info: ' . $oar_sql->error() . '</div>';
} else {
	echo '<ul id="releaselist">';
	while($releaserow = $oar_sql->fetch_assoc($releasequery)) {
		//Check hidden release
		$hiddenrelquery = $oar_sql->query('SELECT releaseid FROM `' . $oar_sql->get_table_prefix() . 'hiddenrels` WHERE releaseid = \'' . $oar_sql->real_escape_string($releaserow['releaseid']) . '\'');
		if(!$oar_sql->error() && ($oar_sql->num_rows($hiddenrelquery) > 0)) {
			continue;
		}

		if($releaserow['releasecover']) {
			$releasecover = $releaserow['releasecover'];
		} else {
			$releasecover = $oar_config['defaultcover'];
		}
		echo '<li><a href="release.php?r=' . $releaserow['releaseid'] . '"><img class="thumb" alt="" src="' . $releasecover . '"/><span class="releaselistitem">' . $releaserow['releasename'] . '</span></a></li>';
	}
	echo '</ul>';
}
?>