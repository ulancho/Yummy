$(document).ready(function(){
     $(".call").mask("0(999) 99-99-99");

    $('.add_request').on('click',function () {
        var attr = $(this).data('attr');
        var call = `#call_${attr}`;
        var error = `.error_${attr}`;
        var ok = `.ok_${attr}`;
        var number = $(call).val();
        var url = $('#url').val();
        $('body').addClass("loading");
        $.ajax({
            method:"POST",
            dataType:'JSON',
            url:url+"Main/add_request",
            data:{number:number}
             // contentType:false,
            // processData:false,
        }).done(function(data){
            $('body').removeClass("loading");
            if(data.error == '1'){
              $(error).show();
                $(ok).hide();
            }
            else{
                $(error).hide();
                $(ok).show();
            }
        });
    });


});