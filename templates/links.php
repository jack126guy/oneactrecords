<?php
if(!empty($tparams['releaseid'])) {
	echo '<ul>';
	$linksquery = $sql->query('SELECT * FROM ' . $sql->get_table_prefix() . 'links WHERE releaseid = "' . $tparams['releaseid'] . '" ORDER BY linkpos ASC');
	if($sql->error()) {
		echo '<li>Error occured getting the links. Sorry :( Technical info: ' . $sql->error() . '</li>';
	} else {
		if($sql->num_rows($linksquery) > 0) {
			while($linksrow = $sql->fetch_assoc($linksquery)) {
				echo oar_links_generate($linksrow['linkname'], $linksrow['linkref'], $linksrow['linkdesc'], $linksrow['linktech']);
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
				echo oar_links_generate(
					$clinksrow['linkname'] ? $clinksrow['linkname'] : $clinksrow['commname'],
					$clinksrow['linkref'],
					$clinksrow['linkdesc'] ? $clinksrow['linkdesc'] : $clinksrow['commdesc'],
					$clinksrow['linktech'] ? $clinksrow['linktech'] : $clinksrow['commtech']
				);
			}
		}
	}
	echo '</ul>';
}

/**
 * Generate a link based on the given information.
 * @param string $name Name of link
 * @param string $ref Link target
 * @param string $desc Description
 * @param string $tech Technical info
 * @return string HTML code for the link
 */
function oar_links_generate($name, $ref, $desc, $tech) {
	$result = '';
	$result .= '<li>';
	//Name
	$result .= '<span class="title"><a href="' . $ref . '">' . $name . '</a></span>';
	//Description
	if($desc) {
		$result .= '<span class="hidden">: </span>';
		$result .= '<span class="desc">' . $desc . '</span>';
	}
	//Technical info
	if($tech) {
		//Leading space is hidden because styles already add visual space
		$result .= '<span class="hidden"> [</span>';
		$result .= '<span class="techspec">' . $tech . '</span>';
		$result .= '<span class="hidden">]</span>';
	}
	$result .= '</li>';
	return $result;
}
?>