<div style="display: none">

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

                <div id='price-<?=$box['id']; ?>' class='price'>0</div>
                <span id='count-<?=$box['id']; ?>' class='count'>0</span>

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

<div class="table-responsive">
    <table border="5">
        <thead>
        <tr>
            <th>Наименование товара</th>
            <th>Количество</th>
            <th>Сумма</th>
            <th>Уменьшить</th>
            <th>Увеличить</th>
            <th>Обнулить</th>
        </tr>
        </thead>
        <tbody id="exist_goods">

        </tbody>
    </table>
    <div id="itogo">

    </div>
    <div id="check">

    </div>
</div>

<br />
<a class="btn btn-info" href="order.html">Оформить заказ</a>