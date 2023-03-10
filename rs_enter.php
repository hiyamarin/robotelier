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

        <div class="menu">
            <a target="_blank" href="<?php echo $_SESSION["menu_pdf"] ?>">商品一覧はここをクリック</a>
        </div>

        <div id="rs_date">
            <h4>*日付を入力してください*</h4>
            <input type="date" name="rs_date" value="<?php 
            if(isset($_POST["rs_date"])){
                echo $_POST["rs_date"];
            }else{
                echo "";
            }
            ?>" min="<?php echo $_SESSION["check_in_date"] ?>" max="<?php echo $_SESSION["check_out_date"] ?>"><br>
        </div>
        

        <div id="rs_munu">
        <h4>*メニューを選択してください*</h4> 
            <select class="rs_food" name="menu">
                <option><?php echo $_SESSION["rs_menu1"] ?></option>
                <option><?php echo $_SESSION["rs_menu2"] ?></option>
                <option><?php echo $_SESSION["rs_menu3"] ?></option>
            </select>

        <h4>*数量を選択してください*</h4>
            <select class="rs_number" name="rs_number">
                    <option value="数量">数量を選択</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
            </select>
        </div>

        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('hotel')">
            <input class="right_button" type="button" value="送信"  onclick="check('rsenter_check')">
        </div>


    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>
  
</body>
</html>