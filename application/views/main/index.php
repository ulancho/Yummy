<?php
//        echo "<pre>";
//        print_r($composition);
//        echo "</pre>";


?>
<section class="product">
    <div class="wrapper">
      <div class="productList flex">
          <?php
          foreach ($box as $box):?>

              <div class="productItem">
                  <div class="productItemFront">
                      <img src="<?=base_url()?>public/images/main/<?php echo $box['img_name'];?>" alt="">
                      <h3><?php echo $box['title'];?></h3>
                      <a href="#" class="productItemBtn">Заказать</a>
                  </div>
                  <div class="productItemBack">
                      <div class="productItemBackContent">

                          <p style="display: none;">Цена: <span id='one-good-<?=$box['id']?>'><?=$box['price']?></span></p>

                          <h3><?php echo $box['title'];?></h3>
                          <?php $i=0;
                          foreach ($composition[$i] as $box_composition):?>
                              <p><?php echo $box_composition['title'];?></p>
                          <?php  endforeach; $i++;?>

                          <div class="weight"><?php echo $box['weight'];?> кг</div>
                          <div class="price"><?php echo $box['price'];?> сом</div>
                      </div>
                      <a href="javascript:void(0)" onclick="goods.insert_good(this)" data-id="<?php echo $box['id'];?>" data-name="<?php echo $box['title'];?>" data-price="<?php echo $box['price'];?>" class="productItemBtn">Заказать</a>
                  </div>
              </div>
          <?php endforeach;?>
       </div>
    </div>
</section>
<section class="advantages">
    <div class="wrapper">
        <div class="advantagesList">
            <img src="<?=base_url()?>public/images/advantagesListBG.png" alt="">
            <ul class="clearfix flex">
                <li>Оптовый рынок “ Сары-озон Дыйкан" . Клубный 16а</li>
                <li>Или же Вы можете заказать уже готовую красиво оформленную корзину.</li>
                <li>Или же Вы можете заказать уже готовую красиво оформленную корзину.</li>
                <li>Оптовый рынок “ Сары-озон Дыйкан" . Клубный 16а</li>
                <li>Или же Вы можете заказать уже готовую красиво оформленную корзину.</li>
                <li>Оптовый рынок “ Сары-озон Дыйкан" . Клубный 16а</li>
            </ul>
        </div>
    </div>
</section>
<section class="delivery">
    <div class="wrapper">
        <h2>Доставка</h2>
        <p class="pseudo-bold">Для осуществления доставки в день заказа оформить заказ нужно до 15 часов.<br>
            Для доставки на следующий день оформить заказ нужно до 21 часа.</p>
        <div class="feedback">
            <form action="javascript:void(0)">
                <p class="error_index error">Заполните</p>
                <p class="ok_index ok">Ваша заявка успешно отправлена!!!</p>
                <div class="wrapFormInput clearfix">
                    <input id="call_index" class="call" type="text" required="" placeholder="Введите Ваш телефон">
                    <button class="add_request" data-attr="index">Попробовать</button>
                </div>
            </form>
            <p>Мы перезвоним через несколько минут! :)</p>
        </div>
    </div>
</section>
<section class="partners">
    <div class="wrapper">
        <h2>Партнеры</h2>
        <p>Компании, в которых наши сотрудники оперативно доставляют<br>
            потенциальным партнерам доставку на дом, в офис, кафе, рестораны и сети магазинов.
        </p>
        <div class="partnersList regular flex">
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part1.jpg" alt="">
            </div>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part2.jpg" alt="">
            </div>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part3.jpg" alt="">
            </div>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part1.jpg" alt="">
            </div>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part2.jpg" alt="">
            </div>
            <div class="partnersItem">
                <img src="<?=base_url()?>public/images/part3.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<section class="blog">
    <div class="wrapper">
        <h2>Блог</h2>
        <div class="blogList clearfix">
            <div class="blogListItem clearfix flex">
                <div class="blogListItemImg">
                    <div class="clipPathBorder">
                        <img src="<?=base_url()?>public/images/blog1.png" alt="">
                    </div>
                </div>
                <div class="blogListItemDes">
                    <h3>Бесплатная доставка фруктов!</h3>
                    <p>На нашем сайте интернет магазина «Yummi Fruit» есть удобный каталог самых свежих фруктов и овощей, - Вы можете заказать он-лайн доставку продуктов прямо на дом.</p>
                    <div class="blogListItemDesBtn clearfix">
                        <a href="#">Подробнее...</a>
                    </div>
                </div>
            </div>
            <div class="blogListItem clearfix">
                <div class="blogListItemImg">
                    <div class="clipPathBorder">
                        <img src="<?=base_url()?>public/images/blog1.png" alt="">
                    </div>
                </div>
                <div class="blogListItemDes">
                    <h3>Бесплатная доставка фруктов!</h3>
                    <p>На нашем сайте интернет магазина «Yummi Fruit» есть удобный каталог самых свежих фруктов и овощей, - Вы можете заказать он-лайн доставку продуктов прямо на дом.</p>
                    <div class="blogListItemDesBtn clearfix">
                        <a href="#">Подробнее...</a>
                    </div>
                </div>
            </div>
            <div class="blogListItem clearfix">
                <div class="blogListItemImg">
                    <div class="clipPathBorder">
                        <img src="<?=base_url()?>public/images/blog1.png" alt="">
                    </div>
                </div>
                <div class="blogListItemDes">
                    <h3>Бесплатная доставка фруктов!</h3>
                    <p>На нашем сайте интернет магазина «Yummi Fruit» есть удобный каталог самых свежих фруктов и овощей, - Вы можете заказать он-лайн доставку продуктов прямо на дом.</p>
                    <div class="blogListItemDesBtn clearfix">
                        <a href="#">Подробнее...</a>
                    </div>
                </div>
            </div>
            <div class="blogListItem clearfix">
                <div class="blogListItemImg">
                    <div class="clipPathBorder">
                        <img src="<?=base_url()?>public/images/blog1.png" alt="">
                    </div>
                </div>
                <div class="blogListItemDes">
                    <h3>Бесплатная доставка фруктов!</h3>
                    <p>На нашем сайте интернет магазина «Yummi Fruit» есть удобный каталог самых свежих фруктов и овощей, - Вы можете заказать он-лайн доставку продуктов прямо на дом.</p>
                    <div class="blogListItemDesBtn clearfix">
                        <a href="#">Подробнее...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="allBlogBtn">
            <a href="#">Посмотреть все новости</a>
        </div>
    </div>
</section>

