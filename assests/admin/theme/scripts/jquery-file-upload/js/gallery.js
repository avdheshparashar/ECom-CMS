$(function() 
{
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('.fileuploadForm').fileupload();

    // Enable iframe cross-domain access via redirect option:
    $('.fileuploadForm').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

});