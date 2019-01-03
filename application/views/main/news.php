<section class="blog">
    <div class="wrapper">
        <h2>Блог</h2>
        <div class="blogList clearfix">
            <?php foreach ($news as $row):?>
            <div class="blogListItem clearfix flex">
                <div class="blogListItemImg">
                    <div class="clipPathBorder">
                        <img src="<?=base_url()?>public/images/news/<?=$row->img_name?>" alt="продукты в Бишкеке">
                    </div>
                </div>
                <div class="blogListItemDes">
                    <h3><?=$row->title?>!</h3>
                    <p><?=$row->title2?>...</p>
                    <div class="blogListItemDesBtn clearfix">
                        <a href="<?=base_url()?>Main/oneNews/<?=$row->id?>">Подробнее...</a>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="flex-center" style="margin-left: 44%;">
        <?php
        echo $this->pagination->create_links();
        ?>
        </div>
    </div>
    </section>
