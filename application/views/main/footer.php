<section class="delivery">
    <div class="wrapper">
        <h2>Доставка</h2>
        <p class="pseudo-bold">Для осуществления доставки в день заказа оформить заказ нужно до 15 часов.<br>
            Для доставки на следующий день оформить заказ нужно до 21 часа.</p>
        <div class="feedback">
            <form action="javascript:void(0)">
                <p class="error_footer error">Заполните</p>
                <p class="ok_footer ok">Ваша заявка успешно отправлена!!!</p>
                <div class="wrapFormInput clearfix">
                    <input id="call_footer" class="call" type="text" required="" placeholder="Введите Ваш телефон">
                    <button class="add_request" data-attr="footer">Попробовать</button>
                </div>
            </form>
            <p>Мы перезвоним через несколько минут! :)</p>
        </div>
    </div>
</section>
<section class="partners">
    <div class="wrapper">
        <h2>Партнеры</h2>
        <p>Мы работаем с нашими потенциальными партнерами уже много лет и поэтому за качество продукции даем 100% гарантию
        </p>
        <div class="partnersList regular flex">
            <?php foreach ($partners as $rou):?>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/partners/<?=$rou['img_name']?>" alt="<?=$rou['alt_name']?>">
            </div>
            <?php endforeach;?>
        </div>
    </div>
</section>
<section class="blog">
    <div class="wrapper">
        <h2>Блог</h2>
        <div class="blogList clearfix">

            <?php foreach ($news as $row):?>
                <div class="blogListItem clearfix flex">
                    <div class="blogListItemImg">
                        <div class="clipPathBorder">
                            <img src="<?=base_url()?>public/images/news/<?=$row['img_name']?>" alt="продукты в Бишкеке">
                        </div>
                    </div>
                    <div class="blogListItemDes">
                        <h3><?=$row['title']?>!</h3>
                        <p><?=$row['title2']?>...</p>
                        <div class="blogListItemDesBtn clearfix">
                            <a href="<?=base_url()?>Main/oneNews/<?=$row['id']?>">Подробнее...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class="allBlogBtn">
            <a href="<?=base_url()?>main/news">Посмотреть все новости</a>
        </div>

    </div>
</section>
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
                    <span>0705</span>
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
            <div class="footerPhoneEmail clearfix">
                <p>Мы в соц.сетях:</p>
                <div class="headSocLink clearfix">
                    <ul>
                        <li class="Whats"><a href="https://api.whatsapp.com/send?phone=996505185555" target="blank_"></a></li>
                        <li class="inst"><a href="https://www.instagram.com/yummy_fruit.kg/" target="blank_"></a></li>
                        <li class="fb"><a href="#"></a></li>
                    </ul>
                </div>
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
                <li <?php if ($_SERVER['REQUEST_URI'] == '/' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>">Главная</a></li>
                <li <?php if ($_SERVER['REQUEST_URI'] == '/main/fruits' ): ?> class="active" <?php endif; ?> ><a href="<?=base_url()?>main/fruits">Фрукты</a></li>
                <li <?php if ($_SERVER['REQUEST_URI'] == '/main/vegetables' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/vegetables">Овощи</a></li>
                <li <?php if ($_SERVER['REQUEST_URI'] == '/main/news' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/news">Новости</a></li>
                <li <?php if ($_SERVER['REQUEST_URI'] == '/main/contacts' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/contacts">Контакты</a></li>
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