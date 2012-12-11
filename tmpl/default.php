<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	JFactory::getLanguage()->load('mod_mdadsense');
	$langSite = substr($params->get('locale'), 0, 2);
	if ($langSite != '') {
		$langSite .= '/';
	}
	