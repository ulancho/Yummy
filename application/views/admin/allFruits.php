<div class="container">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Разделы</a></li>
            <li><a href="#"><?=$title?></a></li>
        </ol>
        <br/>
    </section>
    <div class="well well-sm">
        <div class="row">
            <div class="pull-right">
                <a href="<?=base_url()?>admin/MainSections/<?=$add?>">
                    <button class="btn  btn-success">
                        <i class="fa fa-fw fa-plus"></i>
                        Добавить
                    </button>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th>
                №
            </th>
            <th>
                Фото
            </th>
            <th>
                Название
            </th>
            <th>
                Цена
            </th>
            <th colspan="2">
                Редактирование
            </th>
        </tr>
        <?php
        $i=1;
        foreach($fruits as $row)
        {
            echo '<tr>';
            echo '<td>'.$i++.'</td>';
            echo '<td><img class="photo_user" src="'.site_url().'public/images/fruits/'.$row->img_name.'" alt="">'.'</td>';
            echo '<td>'.$row->name.'</td>';
            echo '<td>'.$row->price.'</td>';
            echo '<td><a href="'.site_url().'admin/MainSections/updateBox/'.$row->id.'"><button type="button" class="btn btn-primary">Редактировать</button></a></td>';
            echo '<td><a href="'.site_url().'admin/MainSections/'.$delete.'/'.$row->id.'"><button type="button" class="btn btn-danger">Удалить</button></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <?php
    echo $this->pagination->create_links();
    ?>


</div>