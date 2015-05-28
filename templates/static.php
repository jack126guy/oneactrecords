<?php
if(!empty($tparams['releaseid']) && ($tparams['secpos'] >= 0)) {
	$staticquery = $sql->query('SELECT stcontent FROM ' . $sql->get_table_prefix() . 'static INNER JOIN ' . $sql->get_table_prefix() . 'staticsecs ON ' . $sql->get_table_prefix() . 'static.stid = ' . $sql->get_table_prefix() . 'staticsecs.stid WHERE ' . $sql->get_table_prefix() . 'staticsecs.releaseid = "' . $tparams['releaseid'] . '" AND ' . $sql->get_table_prefix() . 'staticsecs.secpos = ' . $tparams['secpos']);
	if($sql->error()) {
		echo '<p>Error occured getting the content. Sorry :( Technical info: ' . $sql->error() . '</p>';
	} else {
		if($sql->num_rows($staticquery) > 0) {
			$staticrow = $sql->fetch_assoc($staticquery);
			echo $staticrow['stcontent'];
		} else {
			echo '<p>Could not find content!</p>';
		}
	}
}
?>