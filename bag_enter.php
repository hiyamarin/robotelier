<!DOCTYPE html>
<html lang="jp">
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

<?php
        if(isset($_POST["message"])){
            echo '<div class="error"><b>' . $_POST["message"] . '</b></div>';
        }

 ?>

    <form action="./index.php" method="POST" name="checkform">
        <input type="hidden" name="status" value="">

        <div id="bag_date">
            <h4>*日時を入力してください*</h4>
        
        <!-- 戻るを押したときに情報を維持 -->
            <input type="date" name="bag_date" value="<?php 
            if(isset($_POST["bag_date"])){
                echo $_POST["bag_date"];
            }else{
                echo "";
            }
            ?>" min="<?php echo $_SESSION["check_in_date"] ?>" max="<?php echo $_SESSION["check_out_date"] ?>"><br>

            <input type="time" name="bag_time" value="<?php 
            if(isset($_POST["bag_time"])){
                echo $_POST["bag_time"];
            }else{
                echo "";
            }
            ?>">
        </div>

        <div id="bag_place">
            <h4>*受け取り場所を選択してください*</h4>
            <select class="rsv_place" name="rsv_place">
                <option value="フロント">フロント</option>
                <option value="自室の前">自室の前</option>
                <option value="ホテルの玄関前">ホテルの玄関前</option>
            </select>
        </div>

        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('hotel')">
            <input class="right_button" type="button" value="送信"  onclick="check('bagenter_check')">
        </div>

    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>
  
</body>
</html>