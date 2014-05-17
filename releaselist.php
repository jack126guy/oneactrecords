<?php
include('db.php');
$releasequery = $sql->query('SELECT releaseid, releasename, releasedate, releasecover FROM ' . $sql->get_table_prefix() . 'releases ORDER BY releasedate DESC');
while($releaserow = $sql->fetch_assoc($releasequery)) {
 //MOD: check hidden release
 if($sql->num_rows($sql->query('SELECT releaseid FROM ' . $sql->get_table_prefix() . 'hiddenrels WHERE releaseid = "' . $sql->real_escape_string($releaserow['releaseid']) . '"')) > 0) continue;

 echo '<div><a href="release.php?r=' . $releaserow['releaseid'] . '"><img class="thumb" alt="" src="' . $releaserow['releasecover'] . '"/><span class="releaselistitem">' . $releaserow['releasename'] . '</span></a></div>';
}
?>