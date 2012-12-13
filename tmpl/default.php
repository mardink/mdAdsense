<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	JFactory::getLanguage()->load('mod_mdadsense');
	$langSite = substr($params->get('locale'), 0, 2);
	if ($langSite != '') {
		$langSite .= '/';
	}
// get google adsense conde
	$adsense = $params->get('adsense');
	
// Define alignment
	$align = $params->get('align');
		if ($align == "1") { $alignpos = 'pull-left';} else {
		if ($align == "2") { $alignpos = 'center';} else { $alignpos = 'pull-right';}
	}
// define devices to show	
	$show = $params->get('show');
	if ($show == "1") { $showstate = 'visible';} else {
		 $showstate = 'hidden';	}
	$device = $params->get('device');
		 if ($device == "1") { $device1 = '-phone';} else {
		 	if ($device == "2") { $device1 = '-tablet';} else { $device1 = '-desktop';}
		 }
$showdevice = "$showstate" . "$device1";
?>
<div class="<?php echo $showdevice;?>">
	<div class="<?php echo $alignpos;?>">
		<?php echo $adsense;?>
<p></p>
	</div>
</div>