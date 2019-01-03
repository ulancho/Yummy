<div style="display: none">

    <?php
    foreach ($box as $box):?>

        <div class="productItem">
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
            </div>
        </div>
    <?php endforeach;?>

        <?php foreach ($prod as $row):?>
            <div class="productItem">
                <div class="productItemBack">
                    <div class="productItemBackContent">
                        <p style="display: none;"><span id='one-good-<?=$row['id']?>'><?=$row['price']?></span></p>
                        <div id='price-<?=$row['id']; ?>' class='price'>0</div>
                        <span id='count-<?=$row['id']; ?>' class='count'>0</span>
                        <div class="weight"><?=$row['weight']?> кг</div>
                        <div class="price"><?=$row['price']?> Сом</div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>


    <div class="productList partnersList regular flex">
        <?php foreach ($prodvg as $rowvg):?>
            <div class="productItem">
                <div class="productItemBack">
                    <div class="productItemBackContent">
                        <p style="display: none;"><span id='one-good-<?=$rowvg['id']?>'><?=$rowvg['price']?></span></p>
                        <div id='price-<?=$rowvg['id']; ?>' class='price'>0</div>
                        <span id='count-<?=$rowvg['id']; ?>' class='count'>0</span>
                        <div class="weight"><?=$rowvg['weight']?> кг</div>
                        <div class="price"><?=$rowvg['price']?> Сом</div>
                    </div>
                    <a href="javascript:void(0)" onclick="goods.insert_good(this)" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['name'];?>" data-price="<?php echo $row['price'];?>" class="productItemBtn">Заказать</a>
                </div>
            </div>
        <?php endforeach;?>
    </div>




</div>