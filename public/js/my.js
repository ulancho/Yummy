$(document).ready(function(){
     $(".call").mask("0(999) 99-99-99");

    $('.add_request').on('click',function () {
        var number = $('#call').val();
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
              $('.error').show();
            }
            else{
                $('.error').hide();
                $('.ok').show();
            }
        });
    });


});