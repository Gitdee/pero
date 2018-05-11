CKEDITOR.plugins.add('site_media', {
	init: function(editor){
		
		editor.addCommand('siteMediaBrowse', {
			exec: function(editor){
				window.open('/admin/site_media/', '_blank');
			}
		});
		
		editor.ui.addButton('site_media_browse', {
			label: 'Site Media',
			command: 'siteMediaBrowse',
			icon: this.path + 'images/browse.png'
		});
		
	}
});