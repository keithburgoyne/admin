<?php

require_once 'SwatDB/SwatDBRecordsetWrapper.php';
require_once 'Admin/dataobjects/AdminUser.php';

/**
 * A recordset wrapper class for AdminUser objects
 *
 * @package   Admin
 * @copyright 2007-2015 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @see       AdminUser
 */
class AdminUserWrapper extends SwatDBRecordsetWrapper
{
	// {{{ protected function init()

	protected function init()
	{
		parent::init();

		$admin_user_class =
			SwatDBClassMap::get('AdminUser');

		$this->row_wrapper_class = $admin_user_class;
		$this->index_field = 'id';
	}

	// }}}
}

?>
