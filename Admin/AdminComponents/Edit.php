<?php

require_once('Admin/Admin/Edit.php');
require_once('Admin/AdminUI.php');
require_once('SwatDB/SwatDB.php');

/**
 * Edit page for AdminComponents
 * @package Admin
 * @copyright silverorange 2004
 */
class AdminComponentsEdit extends AdminEdit {

	private $fields;

	public function init() {
		$this->ui = new AdminUI();
		$this->ui->loadFromXML('Admin/AdminComponents/edit.xml');

		$section_flydown = $this->ui->getWidget('section');
		$section_flydown->options = SwatDB::getOptionArray($this->app->db, 
			'adminsections', 'title', 'sectionid', 'displayorder');

		$group_list = $this->ui->getWidget('groups');
		$group_list->options = SwatDB::getOptionArray($this->app->db, 
			'admingroups', 'title', 'groupid', 'title');

		$this->fields = array('title', 'shortname', 'integer:section', 
			'boolean:show', 'boolean:enabled', 'description');
	}

	protected function saveData($id) {

		$values = $this->ui->getValues(array('title', 'shortname', 'section', 
			'show', 'enabled', 'description'));

		$this->app->db->beginTransaction();

		if ($id == 0)
			$id = SwatDB::insertRow($this->app->db, 'admincomponents', $this->fields,
				$values, 'integer:componentid');
		else
			SwatDB::updateRow($this->app->db, 'admincomponents', $this->fields,
				$values, 'integer:componentid', $id);

		$group_list = $this->ui->getWidget('groups');

		SwatDB::updateBinding($this->app->db, 'admincomponent_admingroup', 
			'component', $id, 'groupnum', $group_list->values, 'admingroups', 'groupid');
		
		$this->app->db->commit();

		$this->app->addMessage(sprintf(_S('Component "%s" has been saved.'), $values['title']));
	}

	protected function loadData($id) {

		$row = SwatDB::queryRow($this->app->db, 'admincomponents', 
			$this->fields, 'integer:componentid', $id);

		$this->ui->setValues(get_object_vars($row));

		$group_list = $this->ui->getWidget('groups');
		$group_list->values = SwatDB::queryColumn($this->app->db, 
			'admincomponent_admingroup', 'groupnum', 'component', $id);
	}
}
?>
