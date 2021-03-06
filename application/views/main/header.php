<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="img/png" href="<?=base_url()?>public/img/faIcon.png">
    <link rel="stylesheet" href="<?=base_url()?>public/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css?ver=0.0.8">
    <link rel="stylesheet" href="<?=base_url()?>public/css/pagination.css?">
    <link rel="stylesheet" href="<?=$bootstrap?>">
    <title>Yummy fruit</title>
</head>
<body>
<header class="head <?=$noHomePage?>">
    <input id="url" type="hidden" value="<?=base_url()?>">
    <div class="wrapper clearfix">
        <div class="wrappHeadMenu">
            <div class="headContacts clearfix">
                <div class="headContactsWrap">
                    <div class="HeadContactsCode">
                        <span>+996 705</span>
                        <span>+996 553</span>
                    </div>
                    <div class="HeadContactsPhone">18 55 55</div>
                </div>
            </div>
            <div class="headMenuSocLink clearfix">
                <ul class="headMenu">
                    <li <?php if ( $_SERVER['REQUEST_URI'] == '/' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>">Главная</a></li>
                    <li <?php if ( $_SERVER['REQUEST_URI'] == '/main/fruits' ): ?> class="active" <?php endif; ?> ><a href="<?=base_url()?>main/fruits">Фрукты</a></li>
                    <li <?php if ( $_SERVER['REQUEST_URI'] == '/main/vegetables' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/vegetables">Овощи</a></li>
                    <li <?php if ( $_SERVER['REQUEST_URI'] == '/main/news' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/news">Новости</a></li>
                    <li <?php if ( $_SERVER['REQUEST_URI'] == '/main/contacts' ): ?> class="active" <?php endif; ?>><a href="<?=base_url()?>main/contacts">Контакты</a></li>
                </ul>
                <div class="headSocLink clearfix">
                    <ul>
                        <li class="Whats"><a href="https://api.whatsapp.com/send?phone=996505185555" target="blank_"></a></li>
                        <li class="inst"><a href="https://www.instagram.com/yummy_fruit.kg/" target="blank_"></a></li>
                        <li class="fb"><a href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logoWrap">
            <a href="<?=base_url()?>"><img src="<?=base_url()?>public/img/logo.png" alt="Yummy fruit"></a>
            <div class="logoParallax">
                <div id="logoParallax">
                    <img src="<?=base_url()?>public/img/logoParallax.png" alt="Yummy fruit" data-depth="0.9">
                </div>
            </div>
        </div>
        <div class="feedback">
            <form action="javascript:void(0)">
                <p class="error_head error">Заполните</p>
                <p class="ok_head ok">Ваша заявка успешно отправлена!!!</p>
                <div class="wrapFormInput clearfix">
                    <input id="call_head" type="text" name="call" class="call" placeholder="Введите Ваш телефон" required>
                    <button class="add_request" data-attr="head">Попробовать</button>
                </div>
            </form>
            <p>Мы перезвоним через несколько минут! :)</p>
        </div>
        <div id="HeadParallax" class="HeadParallax">
            <div data-depth="0.3" class="watermelon">
                <img src="<?=base_url()?>public/img/watermelon.png" alt="">
            </div>
            <div data-depth="0.1" class="par1">
                <img src="<?=base_url()?>public/img/par1.png" alt="">
            </div>
            <div data-depth="0.7" class="list1">
                <img src="<?=base_url()?>public/img/list1.png" alt="">
            </div>
            <div data-depth="0.3" class="coconut">
                <img src="<?=base_url()?>public/img/coconut.png" alt="">
            </div>
            <div data-depth="0.6" class="ban">
                <img src="<?=base_url()?>public/img/ban.png" alt="">
            </div>
            <div data-depth="0.2" class="gotovProd">
                <img src="<?=base_url()?>public/img/gotovProd.png" alt="">
            </div>
            <div data-depth="0.2" class="list2">
                <img src="<?=base_url()?>public/img/list2.png" alt="">
            </div>
            <div data-depth="0.2" class="plum">
                <img src="<?=base_url()?>public/img/plum.png" alt="">
            </div>
            <div data-depth="0.4" class="par2">
                <img src="<?=base_url()?>public/img/par2.png" alt="">
            </div>
            <div data-depth="0.1" class="par3">
                <img src="<?=base_url()?>public/img/par3.png" alt="">
            </div>
            <div data-depth="0.6" class="par4">
                <img src="<?=base_url()?>public/img/par4.png" alt="">
            </div>
            <div data-depth="0.5" class="par5">
                <img src="<?=base_url()?>public/img/par5.png" alt="">
            </div>
            <div data-depth="0.2" class="par6">
                <img src="<?=base_url()?>public/img/par6.png" alt="">
            </div>
            <div data-depth="0.1" class="par7">
                <img src="<?=base_url()?>public/img/par7.png" alt="">
            </div>
            <div data-depth="0.2" class="par8">
                <img src="<?=base_url()?>public/img/par8.png" alt="">
            </div>
            <div data-depth="0.1" class="par9">
                <img src="<?=base_url()?>public/img/par9.png" alt="">
            </div>
            <div data-depth="0.1" class="par10">
                <img src="<?=base_url()?>public/img/par10.png" alt="">
            </div>
        </div>
    </div>
</header>
<div class="basket-count <?=$none?>">
    <a href="<?=base_url()?>main/cart">
        <div class="basket-count-content">
            <div id="total total-cart-count" class="count badge">
                <div id="common-amount">0</div>
            </div>
        </div>
    </a>
</div>
<div class="modal"></div>