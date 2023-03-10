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
    <p class="fin">以下の内容で予約いたしました。</p>

    <h4>日時</h4>
    <div class="span">
        <span><?php echo $_POST["bag_date"] ?></span><br>
        <span><?php echo $_POST["bag_time"] ?></span>
    </div> 

    <h4>経路</h4>
    <div class="span">
        <span><?php echo $_POST["rsv_place"] ?></span>
    </div>

    <form action="./index.php" class="one_button" method="post" name="checkform">
        <input type="hidden" name="status" value="">

        <div class="button">
            <input  type="button" value="完了" onclick="check('hotel')">
        </div>
    </form>
    
    <p class="fin">完了を押すとホテルの画面に戻ります。</p>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>
</body>
</html>