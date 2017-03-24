"use strict";

var BonnoShortcodesModal = {
	local_ed : 'ed',
	init : function(ed) {
		BonnoShortcodesModal.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertButton(ed) {
		// setup the output of our shortcode to show in the wp editor
		var output = '[' + $('#shortcode_output').data('shortcode');
		if ($('#shortcode_output').data('params').length)
			output += $('#shortcode_output').data('params');
		output += ']' + $('#shortcode_output').data('content') + ed.selection.getContent({ 'format' : 'text' });
		if ($('#shortcode_output').data('shortcode-enclosing') == true)
			output += '[/' + $('#shortcode_output').data('shortcode') + ']';

		tinyMCEPopup.execCommand('mceInsertContent', false, output);
		// Return
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(BonnoShortcodesModal.init, BonnoShortcodesModal);


jQuery(document).ready(function($) {

	function build_shortcode_data(builder) {
		$('#shortcode_output').data('content', '');
		$('#shortcode_output').data('params', '');
		$('#shortcode_output').data('shortcode-enclosing', false);
		var parent = builder.parent();
		if (parent.find('.param').length) {
			$.each(parent.find('.param'), function(index, param) {
				if ($(param).data('type') === 'content') {
					var value = $(param).find('input').first().val();
					$('#shortcode_output').data('content', value );
				} else if ($(param).data('type') === 'text') {
					var input = $(param).find('input').first();
					var value = input.val();
					var key = input.data('key');
					if ( (key && value) || input.data('may-be-empty') != true ) 
						$('#shortcode_output').data('params', $('#shortcode_output').data('params') + ' ' + key + '="' + value + '"');
				} else if ($(param).data('type') === 'radio') {
					var checked = $(param).find('input:checked');
					if (checked.data('skip') != true) {
						var value = checked.val();
						var key = checked.data('key');
						$('#shortcode_output').data('params', $('#shortcode_output').data('params') + ' ' + key + '="' + value + '"');
					}
				} else if ($(param).data('type') === 'check') {
					var checked = $(param).find('input:checked');
					if (checked.length) {
						var values = [];
						$.each( checked, function(index, input) {
							values.push($(input).val());
						});
						$('#shortcode_output').data('params', $('#shortcode_output').data('params') + ' ' + $(param).find('input').first().data('key') + '="' + values.join() + '"');
					}
					
				}
			})
		}
		$('#shortcode_output').data('shortcode', builder.data('shortcode'));
		$('#shortcode_output').data('shortcode-enclosing', !!builder.data('shortcode-enclosing'));
	}

	function build_shortcode_preview(builder) {
		build_shortcode_data(builder);
		var output = '[' + $('#shortcode_output').data('shortcode');
				if ($('#shortcode_output').data('params').length)
					output += $('#shortcode_output').data('params');
				var editor_selection = '';
				if ($('#shortcode_output').data('shortcode-enclosing') == true && BonnoShortcodesModal.local_ed.selection.getContent({ 'format' : 'text' }).length)
					editor_selection = '...';
				output += ']' + $('#shortcode_output').data('content') + editor_selection;
				if ($('#shortcode_output').data('shortcode-enclosing') == true)
					output += '[/' + $('#shortcode_output').data('shortcode') + ']';
				builder.find('span').text(output);
	}

	$('.param input').on('change keyup', function() {
		var builder = $(this).parents('td').find('.buildshortcode');
		build_shortcode_preview(builder);
	});

	$('.menu a').click(function() {
		$('#bonno-shortcodes-container tr').hide();
		$('.menu a').removeClass('active');
		$('#bonno-shortcodes-container tr[data-group="' + $(this).data('group') + '"]').show();
		$(this).addClass('active');
	});

	$('.menu a').first().click();

	$('.default-icons input').change(function() {
		$('#' + $(this).parents('.default-icons').data('target')).val($(this).val()).change();
	});

	$( ".sortable-contaner" ).sortable({
		placeholder: "ui-state-highlight",
		update: function (e, ui) {
			build_shortcode_preview($(ui.item).parents('td').find('.buildshortcode'));
		}
	});

	$('.buildshortcode').click(function() {
		build_shortcode_data($(this));
		BonnoShortcodesModal.insert(BonnoShortcodesModal.local_ed);
	});

	setTimeout(function() {$('.preloader').fadeOut();$('.show-on-load').fadeIn();}, 1000);
	

});