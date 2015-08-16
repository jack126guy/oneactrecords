<?php
//OpenGraph (Facebook) and Twitter Cards
include_once('config_general.php');
include_once('config_social.php');
echo '<meta property="og:title" content="' . $releasename . '"/>';
echo '<meta property="og:type" content="music.song"/>';
echo '<meta property="og:image" content="' . $releaserow['releasecover'] . '"/>';
echo '<meta property="og:url" content="http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/release.php?r=' . $releaseid . '"/>';
echo '<meta property="og:description" content="' . strip_tags($releaserow['releasedesc']) . '"/>';
echo '<meta property="og:locale" content="' . $oar_config['locale']['language'] . ($oar_config['locale']['region'] ? '_' . $oar_config['locale']['region'] : '') . '"/>';
echo '<meta property="og:site_name" content="' . htmlspecialchars($oar_config['artist']) . '\'s Music"/>';
if($oar_config['social']['twitter']['artisthandle']) {
	echo '<meta property="twitter:creator" content="' . $oar_config['social']['twitter']['artisthandle'] . '"/>';
	echo '<meta property="twitter:site" content="' . $oar_config['social']['twitter']['artisthandle'] . '"/>';
}
if($oar_config['social']['twitter']['artistid']) {
	echo '<meta property="twitter:creator:id" content="' . $oar_config['social']['twitter']['artistid'] . '"/>';
	echo '<meta property="twitter:site:id" content="' . $oar_config['social']['twitter']['artistid'] . '"/>';
}
echo '<meta property="twitter:card" content="summary"/>';
?>