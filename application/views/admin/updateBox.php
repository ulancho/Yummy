    <strong><center>Коробки</center></strong>
<center><a href="<?=base_url()?>admin/MainSections/allBox" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
<h4>Пожалуйста, введите необходимую информацию ниже</h4>
</center>
<div class="col-lg-4 col-lg-offset-1">
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart('admin/MainSections/updateBoxActionMain', $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.Не больше 60 символов </label>
        <input class="form-control" type="hidden" name="id" value="<?=$box[0]->id?>">
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => $box[0]->title)); ?>
        <?php echo form_error('name');?>
    </div>
    <div class="form-group">
        <label for="">Введите цену.</label>
        <?php echo form_input(array('name'=>'price', 'id'=> 'price', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> $box[0]->price)); ?>
        <?php echo form_error('price');?>
    </div>
    <div class="form-group">
        <label for="">Введите вес.</label>
        <?php echo form_input(array('name'=>'weight', 'id'=> 'weight', 'placeholder'=>'Вес', 'class'=>'form-control', 'value'=> $box[0]->weight)); ?>
        <?php echo form_error('weight');?>
    </div>

    <div class="form-group">
        <label for="photo">Фото:</label>
        <input id="photo" name="photo" type="file" class="form-control" accept="image/*" >
        <div class="alert alert-danger">
            <?php echo $imgerror;?>
        </div>
    </div>
    <?php echo form_submit(array('value'=>'Изменить', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>



<div class="col-lg-4 col-lg-offset-1">
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart('admin/MainSections/updateBoxActionTwo', $fattr);
    ?>
    <input class="form-control" type="hidden" name="box_id" value="<?=$box[0]->id?>">
    <?php
    foreach ($composition as $box_composition):?>
    <div class="form-group">
        <label for="">Введите название</label>
        <input name="id[]" type="hidden" value="<?=$box_composition['id']?>">
            <input name="composition[]" class="form-control" type="text" value="<?=$box_composition['title']?>">
    </div>
<?php
    endforeach;?>
    <?php echo form_submit(array('value'=>'Изменить', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>