<?php
//OpenGraph (Facebook) and Twitter Cards
include_once('config_general.php');
include_once('config_social.php');
echo '<meta property="og:title" content="' . $releasename . '"/>';
echo '<meta property="og:type" content="music.song"/>';
echo '<meta property="og:image" content="' . $releaserow['releasecover'] . '"/>';
echo '<meta property="og:url" content="http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/release.php?r=' . $releaseid . '"/>';
echo '<meta property="og:description" content="' . strip_tags($releaserow['releasedesc']) . '"/>';
echo '<meta property="og:locale" content="' . $config['locale_language'] . ($config['locale_region'] ? '_' . $config['locale_region'] : '') . '"/>';
echo '<meta property="og:site_name" content="' . htmlspecialchars($config['artist']) . '\'s Music"/>';
if($config['social_twitter_artisthandle']) {
	echo '<meta property="twitter:creator" content="' . $config['social_twitter_artisthandle'] . '"/>';
}
if($config['social_twitter_artistid']) {
	echo '<meta property="twitter:creator:id" content="' . $config['social_twitter_artistid'] . '"/>';
}
echo '<meta property="twitter:card" content="summary"/>';
?>