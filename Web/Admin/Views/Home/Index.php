<h3>Admin İndex Sayfası</h3>


<a href="<?=Url("admin/add")?>">User Ekle</a>



<?php
foreach((array)$deger as $item){?>

    <div>
        <?=$item["Name"] ?>
        <?=$item["Id"] ?>
        <a href="<?=Url('admin/user/delete/'.$item["Id"])?>" >Sil</a>
    </div>

<?php } ?>