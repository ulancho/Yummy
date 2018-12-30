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

                          <?php
                          $id_box = $box['id'];
                          $box_compositions = $this->AdminModels->getBoxComposition($id_box);

                          foreach ($box_compositions as $box_composition):?>

                              <p><?php echo $box_composition['title'];?></p>

                          <?php endforeach;?>

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

