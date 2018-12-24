
<div class="col-lg-4 col-lg-offset-4">
        <strong><center>Добваление коробки</center></strong>
    <a href="<?=base_url()?>admin/MainSections/allBox" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
    <span class="fa fa-"></span>
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart('admin/MainSections/addBox', $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.</label>
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => set_value('firstname'))); ?>
        <?php echo form_error('name');?>
    </div>
    <div class="form-group">
        <label for="">Введите вес.</label>
        <?php echo form_input(array('name'=>'weight', 'id'=> 'weight', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
        <?php echo form_error('weight');?>
    </div>
    <div class="form-group">
        <label for="">Введите цену.</label>
        <?php echo form_input(array('name'=>'price', 'id'=> 'price', 'placeholder'=>'Цена', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
        <?php echo form_error('price');?>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 composition">
        <label for="">Cостав коробки.</label>
            <div class="display-flex margin3">
        <?php echo form_input(array('name'=>'composition[0]', 'id'=> 'composition', 'placeholder'=>'состав', 'class'=>'form-control', 'value'=> set_value('lastname'))); ?>
            </div>
        </div>
        <div class="col-sm-2">
            <label for="">&nbsp</label>
            <button class="btn btn-default btn-success plus">+</button>
        </div>
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