<div class="col-lg-4 col-lg-offset-4">
        <strong><center>Добваление фруктов</center></strong>
    <a href="<?=base_url()?>admin/MainSections/<?=$all?>" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
    <span class="fa fa-"></span>
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart("admin/MainSections/$form", $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.</label>
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => set_value('firstname'))); ?>
        <?php echo form_error('name');?>
    </div>
    <div class="form-group">
        <label for="">Введите вес.</label>
        <?php echo form_input(array('name'=>'weight', 'id'=> 'weight', 'placeholder'=>'Вес', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
        <?php echo form_error('weight');?>
    </div>
    <div class="form-group">
        <label for="">Введите цену.</label>
        <?php echo form_input(array('name'=>'price', 'id'=> 'price', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
        <?php echo form_error('price');?>
    </div>
    <div class="form-group">
        <label for="photo">Фото:</label>
        <input id="photo" name="photo" type="file" class="form-control" accept="image/*" >
        <div class="alert alert-danger">
            <?php echo $imgerror;?>
        </div>
    </div>
    <?php echo form_submit(array('value'=>'Добавить', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
</div>