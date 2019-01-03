<div class="container">
    <h1 class="text-center">Ваши покупки</h1>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Наименование товара</th>
            <th>Количество/кг</th>
            <th>Сумма</th>
            <th>Уменьшить</th>
            <th>Увеличить</th>
            <th>Обнулить</th>
        </tr>
        </thead>
        <tbody id="exist_goods">

        </tbody>
    </table>
</div>
<div id="itogo"></div>
<div id="check"></div>
    <div id="zakaz" class="collapse">
        <form action="javascript:void(0)" onsubmit="checkOut(this)">
            <input type="hidden" id="good" name="good" class="form-control">
            <div class="form-group">
                <label for="pwd">Имя:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="pwd">Телефон:</label>
                <input type="text" name="phone" class="form-control" id="phone" required>
            </div>
            <div class="form-group">
                <label for="pwd">Адресс:</label>
                <input type="text" name="adress" class="form-control" id="adress" required>
            </div>
            <input class="btn btn-default" type="submit" value="Оформить заказ">
        </form>
    </div>
</div>
