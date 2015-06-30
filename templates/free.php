<?php
if(!empty($tparams['releaseid']) && ($tparams['secpos'] >= 0)) {
	$freesecquery = $sql->query('SELECT seccontent FROM `' . $sql->get_table_prefix() . 'freesecs` WHERE releaseid = \'' . $tparams['releaseid'] . '\' AND secpos = ' . $tparams['secpos']);
	if($sql->error()) {
		echo '<p>Error occured getting the content. Sorry :( Technical info: ' . $sql->error() . '</p>';
	} else {
		if($sql->num_rows($freesecquery) > 0) {
			$freesecrow = $sql->fetch_assoc($freesecquery);
			echo $freesecrow['seccontent'];
		} else {
			echo '<p>Could not find content!</p>';
		}
	}
}
?>