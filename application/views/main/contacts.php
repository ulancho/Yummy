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
<footer>
    <h2>как с нами связаться:</h2>
    <div class="wrapper clearfix flex">
        <div class="map" id="map"></div>
        <div class="footerContacts">
            <div class="footerAddress">
                г. Бишкек Оптовый рынок<br>
                “Сары-озон Дыйкан".<br>
                ул. Клубная 16а
            </div>
            <p class="footerPhoneTitle">Наши контактные телефоны:</p>
            <div class="footerPhone clearfix">
                <div class="footerPhoneCode">
                    <span>0505</span>
                    <span>0507</span>
                    <span>0553</span>
                    <span>0773</span>
                </div>
                <div class="footerPhoneNum">185555</div>
            </div>
            <div class="footerPhoneEmail">
                <p>Наш E-mail:</p>
                <span>odzyna@mail.ru</span>
            </div>
            <div class="copyriht">
                <p>Все права зазищены © 2019г. <br>Сайт разработан: http://webformat.kg</p>
            </div>
        </div>
    </div>
</footer>
<div class="mob-links-overlay">
    <div class="table">
        <div class="middle">
            <div class="logoMob">
                <img src="<?=base_url()?>public/img/logo.png" alt="">
            </div>
            <ul class="menuMob">
                <li class="active"><a href="<?=base_url()?>">Главная</a></li>
                <li><a href="<?=base_url()?>main/fruits">Фрукты</a></li>
                <li><a href="<?=base_url()?>main/vegetables">Овощи</a></li>
                <li><a href="<?=base_url()?>main/news">Новости</a></li>
                <li><a href="<?=base_url()?>main/contacts">Контакты</a></li>
            </ul>
        </div>
    </div>
    <div class="mob-close">
        <span></span>
        <span></span>
    </div>
</div>
<div class="mob-menu">
    <a href="#" class="menu-toggle-icon">
        <span></span>
        <span></span>
        <span></span>
    </a>
</div>
<script  src="<?=base_url()?>public/js/jquery.min.js"></script>
<script  src="<?=base_url()?>public/slick/slick.js"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmOPD3DvI4xloaqfg0DOgY9ONlgisziT4&callback=initMap"></script>
<script  src="<?=base_url()?>public/js/common.js"></script>
<script  src="<?=base_url()?>public/js/parallax.min.js"></script>
<script  src="<?=base_url()?>public/js/bootstrap.min.js"></script>
<script  src="<?=base_url()?>public/js/jquery.maskedinput.min.js"></script>
<script  src="<?=base_url()?>public/js/my.js"></script>
<script  src="<?=base_url()?>public/js/cart.js"></script>
<script>
    var logoParallax = document.getElementById('logoParallax');
    var parallax = new Parallax(logoParallax);
    var HeadParallax = document.getElementById('HeadParallax');
    var parallax = new Parallax(HeadParallax);
    function initMap() {
        var uluru = {lat: 42.8834499, lng: 74.5426138};
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 17, center: uluru});
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>
</body>
</html>