<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	JFactory::getLanguage()->load('mod_mddonate');
	$langSite = substr($params->get('locale'), 0, 2);
	if ($langSite != '') {
		$langSite .= '/';
	}
	
	// prepares the introductory text
	$introtext = '';
	
	if ($params->get('show_text', 1)) {
		$introtext = '<p>'.$params->get('intro_text', '').'</p>'."\n";
	}
	
	echo "\n";

	// Prepare the amount field / currency combobox or hide it
	$amountLine = '';
	
	if (!$params->get('show_amount')) {
		$amountLine .= '<input type="hidden" name="amount" value="'.$params->get('amount').'" />'."\n";
	} else {
		$amountLine .= JText::_('MOD_MDDONATE_AMOUNT').':&nbsp;<input type="text" name="amount" size="4" maxlength="10" value="'.$params->get('amount').'" style="text-align:right;" />'."\n";
	}
	
	// Get the list of currencies from the parameters and explode them into an array
	$currencies = explode(',', $params->get('currencies'));
	
	// Array lists the available PayPal Currencies as of 03/Jan/2009
	$availableCurrencies = Array('EUR', 'USD', 'GBP', 'CHF', 'AUD', 'HKD', 'CAD', 'JPY', 'NZD', 'SGD', 'SEK', 'DKK', 'PLN', 'NOK', 'HUF', 'CZK', 'ILS', 'MXN');
	
	// checks currency list against the available currencies list and discards errors.
	$sizeOfCurr = sizeof($currencies);
	for ($i = 0; $i < $sizeOfCurr; $i++) {
		for ($j = 0; $j < sizeof($availableCurrencies); $j++) {
			if ($currencies[$i] === $availableCurrencies[$j]) { 
				$isOk = 1;
				break;
			}
		}
		if (!$isOk) {
			unset($currencies[$i]);
		}
		$isOk = 0;
	}
	
	// Choose between a combo-box or a simple hidden text field based on size of the array
	if (sizeof($currencies) == 0) {
		$amountLine = '<p class="error">'.JText::_('Error - no currencies selected!').'<br/>'.JText::_('Please check the backend parameters!').'</p>';
		$fe_c = '';
	} else if (sizeof($currencies) == 1) {
		echo $introtext;
		$fe_c = '<input type="hidden" name="currency_code" value="' . $currencies[0] . '" />'."\n";
		if ($params->get('show_amount', 1)) {
			$fe_c .= '&nbsp;' . $currencies[0]."\n";
		}
	} else if (sizeof($currencies) > 1) {
		echo $introtext;
		if ($params->get('show_amount', 1)) { 
			$fe_c = '<select name="currency_code">'."\n";
			foreach($currencies as $row) {
				$fe_c .= '<option value="'.$row.'">'.$row.'</option>'."\n";
			}
			$fe_c .= '</select>'."\n";
		} else {
			$fe_c = '<input type="hidden" name="currency_code" value="' . $currencies[0] . '" />'."\n";
		}
	}
	
	$target = '';
	if ($params->get('open_new_window', 1)) {
		$target =  'target="paypal"';
	}
	
	// Sandbox is used for testing paypal procedures
	if ($params->get('use_sandbox', 1)) {
	?>
<form action="https://www.sandbox.paypal.com/<?php echo $langSite; ?>cgi-bin/webscr" method="post" <?php echo $target; ?>>
	<input type="hidden" name="cmd" value="_donations" />
	<input type="hidden" name="business" value="<?php echo$params->get('sandbox', ''); ?>" />
	<input type="hidden" name="return" value="<?php echo$params->get('return', ''); ?>" />
	<input type="hidden" name="undefined_quantity" value="0" />
	<input type="hidden" name="item_name" value="<?php echo$params->get('item_name', ''); ?>" />
	<?php echo $amountLine . $fe_c; ?>
	<input type="hidden" name="charset" value="utf-8" />
	<input type="hidden" name="no_shipping" value="1" />
	<input type="hidden" name="image_url" value="<?php echo$params->get('image_url', ''); ?>" />
	<input type="hidden" name="cancel_return" value="<?php echo$params->get('cancel_return', ''); ?>" />
	<input type="hidden" name="no_note" value="0" /><br /><br />
	<?php if ($fe_c != '') : ?>
	<div align="center">
		<input type="image" src="http://www.paypal.com/<?php echo $params->get('locale'); ?>/i/btn/<?php echo $params->get('pp_image'); ?>" name="submit" alt="PayPal secure payments." />
	</div>
	<?php endif; ?>
	</form>
	<?php } else {?>
	<form action="https://www.paypal.com/<?php echo $langSite; ?>cgi-bin/webscr" method="post" <?php echo $target; ?>>
	<input type="hidden" name="cmd" value="_donations" />
	<input type="hidden" name="business" value="<?php echo$params->get('business', ''); ?>" />
	<input type="hidden" name="return" value="<?php echo$params->get('return', ''); ?>" />
	<input type="hidden" name="undefined_quantity" value="0" />
	<input type="hidden" name="item_name" value="<?php echo$params->get('item_name', ''); ?>" />
	<?php echo $amountLine . $fe_c; ?>
	<input type="hidden" name="charset" value="utf-8" />
	<input type="hidden" name="no_shipping" value="1" />
	<input type="hidden" name="image_url" value="<?php echo$params->get('image_url', ''); ?>" />
	<input type="hidden" name="cancel_return" value="<?php echo$params->get('cancel_return', ''); ?>" />
	<input type="hidden" name="no_note" value="0" /><br /><br />
	<?php if ($fe_c != '') : ?>
	<div align="center">
		<input type="image" src="http://www.paypal.com/<?php echo $params->get('locale'); ?>/i/btn/<?php echo $params->get('pp_image'); ?>" name="submit" alt="PayPal secure payments." />
	</div>
	<?php endif; ?>
</form>
<?php }?>