<?php

require_once 'Admin/pages/AdminPage.php';
require_once 'Admin/AdminUI.php';

/**
 * Administrator Not Found page
 *
 * @package Admin
 * @copyright silverorange 2004
 */
class AdminSiteFront extends AdminPage
{
	// init phase
	// {{{ protected function initInternal()

	protected function initInternal()
	{
		$this->ui->loadFromXML(dirname(__FILE__).'/front.xml');
		$this->navbar->popEntry();
	}

	// }}}

	// build phase
	// {{{ protected function buildInternal()

	protected function buildInternal()
	{
		$this->buildMessages();
	}

	// }}}
}

?>
