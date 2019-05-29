
    <!DOCTYPE html>
    <html>
    <body>
    <h2>Admin Home index </h2>

    <?php
    if (isset($eror_message)){?>
        <div>
            <?= $eror_message?>
        </div>
    <?php  }?>



    <form action="<?=Url("admin/add")?>" method="post">
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

