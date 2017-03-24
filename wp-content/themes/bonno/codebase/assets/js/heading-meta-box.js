(function($) {
	$(function() {
		/* Media upload */
		var original_send_to_editor = window.send_to_editor;
		var currentUploadContainer = $('#bonno_heading_meta_box .image');

        var mediaUploader;

		$('#bonno_heading_upload_icon, #bonno_heading_meta_box .image img').click(function (e) {
            e.preventDefault();
            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
              mediaUploader.open();
              return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
              title: 'Choose Image',
              button: {
              text: 'Choose Image'
            }, multiple: false });

            // When a file is selected, grab the URL and set it as the text field's value
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#image-url').val(attachment.url);
                currentUploadContainer.find('input').val(attachment.url);
                currentUploadContainer.addClass('file-loaded');
                currentUploadContainer.find('img').attr('src', attachment.url);
            });
            // Open the uploader dialog
            mediaUploader.open();

		});

		$('#bonno_heading_delete_icon').click(function() {
			currentUploadContainer.find('img').attr('src', '');
			currentUploadContainer.find('input').val('');
			currentUploadContainer.removeClass('file-loaded');
			return false;
		});

	})
})(jQuery);
