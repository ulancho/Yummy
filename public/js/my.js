$(document).ready(function(){
     $(".call").mask("0(999) 99-99-99");
    var url = $('#url').val();

    $('.add_request').on('click',function () {
        var attr = $(this).data('attr');
        var call = `#call_${attr}`;
        var error = `.error_${attr}`;
        var ok = `.ok_${attr}`;
        var number = $(call).val();
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

    $('#check').on('click',function () {
        var total = localStorage.getItem('cart');
        $("#good").val(total);
    });

});

function checkOut(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = $('#url').val();
    $('body').addClass("loading");
    $.ajax({
        method: "POST",
        url: url+"Main/cart_proc",
        data: all_inputs,
        dataType: "JSON",
         contentType: false,
         processData: false
    }).done(function(message) {
        $('body').removeClass("loading");
        $("#good").val('');
        $("#total").val('');
        localStorage.removeItem("cart");
        alert('Товары оформлены! Спасибо за покупку!  Ваш заказ составил ' + message.total + ' сомов.');
        location.reload();

    });
}

function add_cont(context) {
    var form = $(context)[0];
    var all_inputs = new FormData(form);
    var url = $('#url').val();
    var error = $('.error');
    var ok = $('.ok');
    $('body').addClass("loading");
    $.ajax({
        method: "POST",
        url: url+"Main/contactAction",
        data: all_inputs,
        dataType: "JSON",
        contentType: false,
        processData: false
    }).done(function(data) {
        $('body').removeClass("loading");
        if(data.error == '1'){
            error.show();
            ok.hide();
        }
        else{
            error.hide();
            ok.show();
        }
    });
}