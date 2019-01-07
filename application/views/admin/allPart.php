<div class="container">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?=base_url()?>admin/Admin_page/admin"><i class="fa fa-dashboard"></i>Разделы</a></li>
            <li><a href="#">Партнеры</a></li>
        </ol>
        <br/>
    </section>
    <div class="well well-sm">
        <div class="row">
            <div class="pull-right">
                <a href="<?=base_url()?>admin/MainSections/addPartners">
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
                Название(alt)
            </th>
            <th colspan="2">
                Удаление
            </th>
        </tr>
        <?php
        $i=1;
        foreach($partners as $row)
        {
            echo '<tr>';
            echo '<td>'.$i++.'</td>';
            echo '<td><img class="photo_user" src="'.site_url().'public/images/partners/'.$row->img_name.'" alt="">'.'</td>';
            echo '<td>'.$row->alt_name.'</td>';
            echo '<td><a href="'.site_url().'admin/MainSections/deletePartners/'.$row->id.'"><button type="button" class="btn btn-danger">Удалить</button></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <?php
    echo $this->pagination->create_links();
    ?>


</div>