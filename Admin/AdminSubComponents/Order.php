<?php

require_once('Admin/Admin/Order.php');
require_once('SwatDB/SwatDB.php');

/**
 * Order page for AdminSubComponents
 * @package Admin
 * @copyright silverorange 2005
 */
class AdminSubComponentsOrder extends AdminOrder {

	private $parent;

	public function init() {
		parent::init();

		$this->parent = SwatApplication::initVar('parent');
		$form = $this->ui->getWidget('orderform');
		$form->addHiddenField('parent', $this->parent);
	}

	public function display() {
		$frame = $this->ui->getWidget('frame');
		$frame->title = _S("Order Sub-Components");
		parent::display();
	}

	public function loadData() {
		$where_clause = sprintf('component = %s',
			$this->app->db->quote($this->parent, 'integer'));

		$order_list = $this->ui->getWidget('order');
		$order_list->options = SwatDB::getOptionArray($this->app->db, 'adminsubcomponents', 
			'title', 'subcomponentid', 'displayorder, title', $where_clause);

		$sql = 'select sum(displayorder) from adminsubcomponents where '.$where_clause;
		$sum = $this->app->db->queryOne($sql, 'integer');
		$radio_list = $this->ui->getWidget('options');
		$radio_list->value = ($sum == 0) ? 'auto' : 'custom';
	}
	
	public function saveIndex($id, $index) {
		SwatDB::updateColumn($this->app->db, 'adminsubcomponents', 'integer:displayorder',
			$index, 'integer:subcomponentid', array($id));
	}
}
?>
