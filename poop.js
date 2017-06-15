jQuery( document ).on( 'click', '.poop-button', function() {
    var post_id = jQuery(this).data('id');
    jQuery.ajax({
        url : postpoop.ajax_url,
        type : 'post',
        data : {
            action : 'post_poop_add_poop',
            post_id : post_id
        },
        success : function( response ) {
            jQuery('#poop-count').html( response );
        }
    });

    return false;
})