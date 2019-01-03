<section class="product">
    <div class="wrapper">
        <h2><?=$title?></h2>
        <div class="productList partnersList regular flex">
            <?php foreach ($prod as $row):?>
            <div class="productItem">
                <div class="productItemFront">
                    <img class="img-param" src="<?=base_url()?>public/images/fruits/<?=$row['img_name']?>" alt="фрукты и овощи">
                    <h3><?=$row['name']?></h3>
                    <a href="#" class="productItemBtn">Заказать</a>
                </div>
                <div class="productItemBack">
                    <div class="productItemBackContent">
                        <p style="display: none;"><span id='one-good-<?=$row['id']?>'><?=$row['price']?></span></p>
                        <h3><?=$row['name']?></h3>
                        <div class="weight"><?=$row['weight']?> кг</div>
                        <div class="price"><?=$row['price']?> Сом</div>
                    </div>
                    <a href="javascript:void(0)" onclick="goods.insert_good(this)" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['name'];?>" data-price="<?php echo $row['price'];?>" class="productItemBtn">Заказать</a>
                </div>
            </div>
            <?php endforeach;?>

        </div>
    </div>
</section>
