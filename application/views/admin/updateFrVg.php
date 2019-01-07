    <strong><center><?=$title?></center></strong>
<center><a href="<?=base_url()?>admin/MainSections/<?=$allfruits?>" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
</center>
<div class="col-lg-8 col-lg-offset-2">
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart("admin/MainSections/$procc", $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.Не больше 60 символов </label>
        <input class="form-control" type="hidden" name="id" value="<?=$arr[0]->id?>">
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => $arr[0]->name)); ?>
        <?php echo form_error('name');?>
    </div>
    <div class="form-group">
        <label for="">Введите цену.</label>
        <?php echo form_input(array('name'=>'price', 'id'=> 'price', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> $arr[0]->price)); ?>
        <?php echo form_error('price');?>
    </div>
    <div class="form-group">
        <label for="">Введите вес.</label>
        <?php echo form_input(array('name'=>'weight', 'id'=> 'weight', 'placeholder'=>'Вес', 'class'=>'form-control', 'value'=> $arr[0]->weight)); ?>
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
