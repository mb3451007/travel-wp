jQuery(document).ready(function ($) {
    let mediaUploader;

    $('.auth-image-upload-button').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const target = button.data('target');
        const field = $(`#${target}`);
        const preview = button.siblings('.auth-image-preview');

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Select an Image',
            button: {
                text: 'Use this Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            field.val(attachment.id);
            preview.html('<img src="' + attachment.url + '" style="max-width: 300px; max-height: 300px;">');
        });

        mediaUploader.open();
    });

    $('.auth-image-remove-button').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const target = button.data('target');
        const field = $(`#${target}`);
        const preview = button.siblings('.auth-image-preview');

        field.val('');
        preview.html('');
    });
});

