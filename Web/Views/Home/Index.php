<?php include_once(_root."/Web/Views/Shared/_header.php")?>

<h3>İndex Sayfası</h3>

<a href="add">Ekleme yerıne git</a>

    <br>    <br><br>

<?php
foreach((array)$deger as $item){?>

    <div>
        <?=$item["Name"] ?>
        <?=$item["Id"] ?>
        <a href="user/delete/<?=$item["Id"]?>" >Sil</a>
    </div>

<?php } ?>
<?php include_once(_root."/Web/Views/Shared/_footer.php")?>