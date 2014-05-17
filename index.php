<?php
//redirect to release URL if r parameter is set
if(!empty($_GET['r'])) {
 header('Location: http' . (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off' ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/release.php?r=' . $_GET['r']);
}
require('config.php');
?>
<html>
 <head>
  <meta charset="UTF-8"/>
  <title>Awesome Music</title>
  <link rel="stylesheet" type="text/css" href="../styles.css"/>
  <link rel="stylesheet" type="text/css" href="musicstyles.css"/>
 </head>
 <body>
  <h1>Recent Releases</h1>
  <?php include('releaselist.php');?>
 </body>
</html>