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

    <h4>日時</h4>
    <div class="span">
        <span><?php echo $_POST["car_date"] ?></span><br>
        <span><?php echo $_POST["car_time"] ?></span>
    </div> 

    <h4>経路</h4>
    <div class="span">
        <span><?php echo $_POST["srt_place"] ?></span>
        ～
        <span><?php echo $_POST["fin_place"] ?></span>
    </div>

    <form action="./index.php" method="post" name="checkform">
        <input type="hidden" name="status" value=""> 
    
    <!-- 前ページに遷移したとき情報を保持する -->
        <input type="hidden" id="car_date" name="car_date" value="<?php echo $_POST["car_date"] ?>"><br>
        <input type="hidden" id="car_time" name="car_time" value="<?php echo $_POST["car_time"] ?>">

        <input type="hidden" id="srt_place" name="srt_place" value="<?php echo $_POST["srt_place"] ?>"><br>
        <input type="hidden" id="fin_place" name="fin_place" value="<?php echo $_POST["fin_place"] ?>">


        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('carenter')">
            <input class="right_button" type="button" value="完了" onclick="check('car_fin')">
        </div>
    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>

</body>
</html>