<div id="contact" class="container">
    <h2 class="text-center mainfont">Наши контакты</h2>
    <div class="row">
        <div class="col-md-4">
            <p>Наш адресс.</p>
            <p><span class="glyphicon glyphicon-envelope"></span>г. Бишкек Оптовый рынок <br>
                “Сары-озон Дыйкан". <br>
                ул. Клубная 16а</p>
            <p><span class="glyphicon glyphicon-envelope"></span>(0505) (0507) (0553) (0773) 185555</p>
            <p><span class="glyphicon glyphicon-envelope"></span>odzyna@mail.ru</p>
        </div>
        <div class="col-md-8">
            <div class="row">
                <form action="javascript:void(0)" method="post" onsubmit="add_cont(this)">
                <div class="col-sm-6 form-group">
                    <input class="form-control" id="name" name="name" placeholder="Имя" type="text">
                </div>
                <div class="col-sm-6 form-group">
                    <input class="form-control"  name="phone_cont" placeholder="Номер телефона" type="number">
                </div>
            </div>
            <textarea class="form-control" id="comments" name="comments" placeholder="Ваше сообщение" rows="5"></textarea>
            <br>
            <div class="row">
                <div class="col-md-6 form-group">
                   <p class="error" style="color: red;">Заполните, пожалуйста, все поля</p>
                   <p class="ok" style="color: green;">Ваше сообщение успешно отправлено</p>
                </div>
                <div class="col-md-6 form-group">
                    <input class="btn btn-default pull-right" type="submit" value="Отправить">
                </div>
            </div>
            </form>
        </div>
    </div>

</div>