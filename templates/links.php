<?php
if(!empty($tparams['releaseid'])) {
	echo '<ul>';
	$linksquery = $sql->query('SELECT * FROM ' . $sql->get_table_prefix() . 'links WHERE releaseid = "' . $tparams['releaseid'] . '" ORDER BY linkpos ASC');
	if($sql->error()) {
		echo '<li>Error occured getting the links. Sorry :( Technical info: ' . $sql->error() . '</li>';
	} else {
		if($sql->num_rows($linksquery) > 0) {
			while($linksrow = $sql->fetch_assoc($linksquery)) {
				echo '<li><span class="title"><a href="' . $linksrow['linkref'] . '">' . $linksrow['linkname'] . '</a></span> <span class="desc">' . $linksrow['linkdesc'] . '</span> <span class="techspec">' . $linksrow['linktech'] . '</span></li>';
			}
		}
	}
	//Get common links
	$clinksquery = $sql->query('SELECT * FROM ' . $sql->get_table_prefix() . 'linkforms INNER JOIN ' . $sql->get_table_prefix() . 'commonlinks ON ' . $sql->get_table_prefix() . 'linkforms.formname = ' . $sql->get_table_prefix() . 'commonlinks.formname WHERE releaseid = "' . $tparams['releaseid'] . '" ORDER BY formpos ASC');
	if($sql->error()) {
		echo '<li>Error occured getting the links. Sorry :( Technical info: ' . $sql->error() . '</li>';
	} else {
		if($sql->num_rows($clinksquery) > 0) {
			while($clinksrow = $sql->fetch_assoc($clinksquery)) {
				echo '<li><span class="title"><a href="' . $clinksrow['linkref'] . '">' . (empty($clinksrow['linkname']) ? $clinksrow['commname'] : $clinksrow['linkname']) . '</a></span> <span class="desc">' . (empty($clinksrow['linkdesc']) ? $clinksrow['commdesc'] : $clinksrow['linkdesc']) . '</span> <span class="techspec">' . (empty($clinksrow['linktech']) ? $clinksrow['commtech'] : $clinksrow['linktech']) . '</span></li>';
			}
		}
	}
	echo '</ul>';
}
?>