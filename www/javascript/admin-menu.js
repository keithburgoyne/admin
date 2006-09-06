function AdminMenu(id)
{
	this.client = new XML_RPC_Client('AdminSite/MenuViewServer');
	this.id = id;
}

AdminMenu.prototype.toggle = function()
{
	var bodytag = document.getElementsByTagName('body')[0];
	var shown = false;

	if (bodytag.className.indexOf('hide-menu') == -1) {
		bodytag.className += ' hide-menu';
	} else {
		bodytag.className = bodytag.className.replace(/hide-menu/, '');
		shown = true;
	}

	this.client.callProcedure('setShown', null, [shown], ['boolean']);
}

AdminMenu.prototype.toggleSection = function(id)
{
	var sectionTag = document.getElementById(this.id + '_section_' + id);
	var shown = false;

	if (sectionTag.className.indexOf('hide-menu-section') == -1) {
		sectionTag.className += ' hide-menu-section';
	} else {
		sectionTag.className =
			sectionTag.className.replace(/hide-menu-section/, '');

		shown = true;
	}

	this.client.callProcedure('setSectionShown', null,
		[id, shown], ['int', 'boolean']);
}
