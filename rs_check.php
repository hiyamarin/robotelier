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
    <p class="check">まだ予約は完了していません</p> 

    <h4>日付</h4>
    <div class="span">
        <span><?php echo $_POST["rs_date"] ?></span>
    </div>

    <h4>選択メニュー</h4>
    <div class="span">
        <span><?php echo $_POST["menu"] ?></span>
    </div>

    <h4>数量</h4>
    <div class="span">
        <span><?php echo $_POST["rs_number"] ?>人前</span>
    </div>

    <form action="./index.php" method="post" name="checkform">
        <input type="hidden" name="status" value=""> 
    
    <!-- 前ページに遷移したとき情報を保持する -->
        <input type="hidden" name="rs_date" value="<?php echo $_POST["rs_date"] ?>">
        <input type="hidden" name="menu" value="<?php echo $_POST["menu"] ?>"><br>
        <input type="hidden" name="rs_number" value="<?php echo $_POST["rs_number"] ?>">


        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('rsenter')">
            <input class="right_button" type="button" value="完了" onclick="check('rs_fin')">
        </div>
    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>

</body>
</html>