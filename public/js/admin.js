$(document).ready(function() {
    // для плюса
var i = 1;
var form = $('.composition');
$('.plus').on('click', function () {
    var nameInput = `<div class="display-flex margin3">
<input required type="text" name="composition[${i}]" class="form-control" placeholder="состав">\n
     <button class="btn btn-danger delete-inp">-</button>
            </div>
`;
    form.append(nameInput);
    i++;
});
    // удаление поля
    $('body').on('click', '.delete-inp', function () {
       let prev =  $(this).prev();
        prev.remove();
        $(this).remove();
    });

})

