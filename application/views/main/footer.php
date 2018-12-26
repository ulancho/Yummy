<div class="basket-count">
    <a href="<?=base_url()?>main/cart">
    <div class="basket-count-content">
        <div id="total total-cart-count" class="count badge">
            <div id="common-amount">0</div>
        </div>
    </div>
    </a>
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
                <li><a href="#">Главная</a></li>
                <li class="active"><a href="#">Фрукты</a></li>
                <li><a href="#">Овощи</a></li>
                <li><a href="#">Новости</a></li>
                <li><a href="#">Контакты</a></li>
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