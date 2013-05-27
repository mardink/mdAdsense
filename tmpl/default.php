<?php
/**
 * @package Joomla
 * @subpackage mdadsense
 * @copyright (C) 2012 Mardink Webdesign
 * @license GNU/GPL,
 * mdadsense is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 3
 * as published by the Free Software Foundation.

 * mdadsense is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	JFactory::getLanguage()->load('mod_mdadsense');
	$langSite = substr($params->get('locale'), 0, 2);
	if ($langSite != '') {
		$langSite .= '/';
	}
// get moduleclass suffix
	$moduleclass_sfx = $params->get('moduleclass_sfx');
	
	
	// get google adsense conde
	$adsense = $params->get('adsense');
	
// Define alignment
	$align = $params->get('align');
		if ($align == "1") { $alignpos = 'pull-left';} else {
		if ($align == "2") { $alignpos = 'center';} else { $alignpos = 'pull-right';}
	}
// define devices to show	
	$phone = $params->get('phone');
	if ($phone == "0") { $phonestate = ' hidden-phone';} else {
		 $phonestate = '';	}
		 $tablet = $params->get('tablet');
		 if ($tablet == "0") { $tabletstate = ' hidden-tablet';} else {
		 	$tabletstate = '';	}
		 	$desktop = $params->get('desktop');
		 	if ($desktop == "0") { $desktopstate = ' hidden-desktop';} else {
		 		$desktopstate = '';	}
?>
<div class="mdadsense<?php echo $moduleclass_sfx;?>">
<div class="<?php echo $phonestate;?><?php echo $tabletstate;?><?php echo $desktopstate;?>">
	<div class="<?php echo $alignpos;?>">
		<?php echo $adsense;?>
<p></p>
	</div>
</div>
</div>