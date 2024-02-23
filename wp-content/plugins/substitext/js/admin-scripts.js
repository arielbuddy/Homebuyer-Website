jQuery(document).ready(function($) {
    $('#select_all_vars').click(function() {
        $('input[type="checkbox"][name="variable_names[]"]').prop('checked', this.checked);
    });

    $('.copy-button').click(function() {
        var shortcode = $(this).data('shortcode');
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(shortcode).select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'Shortcode copied: ' + shortcode : 'Unable to copy';
            console.log(msg); // Or display this message in a UI element
        } catch (err) {
            console.log('Error in copying text: ', err);
        }

        tempInput.remove();
    });
});
