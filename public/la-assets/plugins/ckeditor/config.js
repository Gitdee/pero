/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Table,HorizontalRule,SpecialChar,Anchor,Maximize,About,Styles,Font,FontSize,Subscript,Superscript';
  
  
  config.format_bold_text = {element:"p", name: "Bold Text", styles: {"font-weight": "600"}, attributes: {"class": 'bold_text'}};
	config.format_margin_top_text = {element:"p", name: "Text with Margin Top", attributes: {"class": 'margin-top-30'}};
  config.format_margin_top_bold_text = {element:"p", name: "Bold Text with Margin Top", attributes: {"class": 'bold_text margin-top-30'}};
  config.format_margin_size_36_text = {element:"p", name: "Text Font Size 36", attributes: {"class": 'size-36'}};
  config.format_margin_size_36_bold_text = {element:"p", name: "Bold Text Font Size 36", attributes: {"class": 'bold_text size-36'}};
  
  config.format_margin_size_76_text = {element:"p", name: "Text Font Size 76", attributes: {"class": 'size-76'}};
	config.format_margin_size_76_bold_text = {element:"p", name: "Bold Text Font Size 76", attributes: {"class": 'bold_text size-76'}};
  
  // Set the most common block elements.
	config.format_tags = 'h1;h2;h3;p;bold_text;margin_top_text;margin_top_bold_text;margin_size_36_text;margin_size_36_bold_text;margin_size_76_text;margin_size_76_bold_text';

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.allowedContent = true;
  config.extraPlugins = 'colorbutton,panel,floatpanel,panelbutton,button';
  /*config.contentsCss = [
		'/css/main/font-awesome.min.css',
		'/css/main/ckeditor_content.css'
	];*/
	
};
