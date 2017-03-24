(function () {
	"use strict";
	tinymce.create('tinymce.plugins.bonnoshortcodes', {
		init: function (editor, url) {
			// Register commands
			var w = document.body.clientWidth / 1.3,
				h = document.body.clientHeight / 1.3;
			if(w > 900) w = 900;
			if(h > 700) h = 700;
			editor.addCommand('mcebutton', function () {
				editor.windowManager.open({
					title: "Shortcodes",
					file: ajaxurl + '?action=bonno_shorcodes_window', // file that contains HTML for our modal window
					width: w, // size of our window
					height: h , // size of our window
					inline: 1
				}, 
				{
					plugin_url: url
				});
			});
			// Register Shortcode Button
			editor.addButton('bonno_shortcode_button', {
				title: 'Shortcodes',
				cmd: 'mcebutton',
				image: 'http://bonno/wp-content/plugins/ajax-load-more/admin/img/add.png',
				text: 'Shortcodes'
			});
		}
	});

	// Register plugin
	tinymce.PluginManager.add('bonno_shortcode_button', tinymce.plugins.bonnoshortcodes);
})();