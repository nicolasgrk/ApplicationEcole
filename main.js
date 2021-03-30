$(document).ready(function(){ 
    
    $('#open_modal').click(function(){ 
        $('#modal_to_open').css(
            { 
                'display':'block'
            }
        )

    });


    $('#close_modal').click(function(){ 
        $('#modal_to_open').css(
            { 
                'display':'none'
            }
        )

    });

});