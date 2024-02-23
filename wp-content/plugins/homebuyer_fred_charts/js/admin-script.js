jQuery(document).ready(function($) {
    $('.copy-shortcode').click(function() {
        var seriesId = $(this).data('series-id');
        var shortcode = `[homebuyer_fred_data series_id="${seriesId}" series_source="" series_start="2000-01-01" series_end=""]`;
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(shortcode).select();
        document.execCommand('copy');
        tempInput.remove();
        alert('The shortcode is copied to the clipboard.');
    });
});