<div class="container">
    <div class="row">
        <a href="<?=base_url()?>admin/MainSections/allBox">
        <div class="col-md-3">
            <div class="card-counter primary">
                <i class="fa fa-database"></i>
                <span class="count-numbers"><?=$box?></span>
                <span class="count-name">Коробки</span>
            </div>
        </div>
        </a>
        <a href="<?=base_url()?>admin/MainSections/allFruits">
        <div class="col-md-3">
            <div class="card-counter danger">
                <i class="fa fa-database"></i>
                <span class="count-numbers"><?=$fruits?></span>
                <span class="count-name">Фрукты</span>
            </div>
        </div>
        </a>
        <a href="<?=base_url()?>admin/MainSections/allVege">
        <div class="col-md-3">
            <div class="card-counter success">
                <i class="fa fa-database"></i>
                <span class="count-numbers"><?=$vegetables?></span>
                <span class="count-name">Овощи</span>
            </div>
        </div>
        </a>
        <a href="<?=base_url()?>admin/MainSections/allNews">
        <div class="col-md-3">
            <div class="card-counter info">
                <i class="fa fa-database"></i>
                <span class="count-numbers">0</span>
                <span class="count-name">Новости</span>
            </div>
        </div>
        </a>
</div>