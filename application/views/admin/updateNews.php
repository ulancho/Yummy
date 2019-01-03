    <strong><center>Коробки</center></strong>
<center><a href="<?=base_url()?>admin/MainSections/allNews" class="text-primary">ПЕРЕЙТИ К ПРОСМОТРУ</a>
    <h4>Пожалуйста, введите необходимую информацию ниже</h4>
</center>
<div class="col-lg-8 col-lg-offset-2">
    <?php
    $fattr = array('class' => 'form-signin');
    echo form_open_multipart('admin/MainSections/updateNewsAction', $fattr);
    ?>
    <div class="form-group">
        <label for="">Введите название.</label>
        <input class="form-control" type="hidden" name="id" value="<?=$news[0]->id?>">
        <?php echo form_input(array('name'=>'name', 'id'=> 'name', 'placeholder'=>'Название', 'class'=>'form-control', 'value' => $news[0]->title)); ?>
        <?php echo form_error('name');?>
    </div>

    <div class="form-group">
        <label for="">Введите текст.</label>
        <?php echo form_textarea(array('name'=>'text', 'id'=> 'text', 'placeholder'=>'Информация', 'class'=>'form-control', 'value'=> $news[0]->text)); ?>
        <?php echo form_error('text');?>
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
