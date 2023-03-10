<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" rel="stylesheet" type="text/css">
    <title>ROBOTELIER</title>
    <script>
        function check(status){
            document.forms.checkform.status.value = status;
            //alert(document.forms.checkform.status.value);
            document.forms.checkform.submit();

        }
    </script>
</head>

<body>
    <p class="check">まだ予約は完了していません。</p>

    <h4>日時</h4>
    <div class="span">
        <span><?php echo $_POST["bag_date"] ?></span><br>
        <span><?php echo $_POST["bag_time"] ?></span>
    </div> 

    <h4>受け取り場所</h4>
        <div class="span">
            <span><?php echo $_POST["rsv_place"] ?></span>
        </div>

       
    <form action="./index.php" method="POST" name="checkform">
        <input type="hidden" name="status" value="">

        <input type="hidden" id="bag_date" name="bag_date" value="<?php echo $_POST["bag_date"] ?>"><br>
        <input type="hidden" id="bag_time" name="bag_time" value="<?php echo $_POST["bag_time"] ?>">

        <input type="hidden" id="rsv_place" name="rsv_place" value="<?php echo $_POST["rsv_place"] ?>"><br>

        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('bagenter')">
            <input class="right_button" type="button" value="完了" onclick="check('bag_fin')">
        </div>
    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>
</body>
</html>