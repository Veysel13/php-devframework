<?php include_once(_root."/Web/Views/Shared/_header.php")?>
    <!DOCTYPE html>
    <html>
    <body>
    <h2>Home index </h2>

    <?= my_errors(isset($error_message)?$error_message:null);?>


    <form action="<?=Url("/add")?>" method="post">
        First name:<br>
        <input type="text" name="Name" value="Mickey">
        <br>
        Description:<br>
        <input type="text" name="Description" value="Mouse">
        <br><br>
        email:<br>
        <input type="text" name="Email" value="">
        <br><br>
        email:<br>
        <input type="number" name="Age">
        <br><br>
        <button type="submit" value="Submit">Ekle</button>
    </form>

    </body>
    </html>


<?php include_once(_root."/Web/Views/Shared/_footer.php")?>