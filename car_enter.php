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
    
        <div id="car_date">
            <h4>*日時を入力してください*</h4>

            <!-- 戻るを押したときに情報を維持 -->
            <input type="date" name="car_date" value="<?php 
            if(isset($_POST["car_date"])){
                echo $_POST["car_date"];
            }else{
                echo "";
            }
            ?>" min="<?php echo $_SESSION["check_in_date"] ?>" max="<?php echo $_SESSION["check_out_date"] ?>"><br>

            <input type="time" name="car_time" value="<?php
            if(isset($_POST["car_time"])){
                echo $_POST["car_time"] ;
            }else{
                echo "";
            }
             ?>">
        </div>

        <div id="car_place">
            <h4>*出発地点を選択してください*</h4>
            <select class="srt_place" name="srt_place">
                <option value="<?php echo $_SESSION["car_place1"] ?>"><?php echo $_SESSION["car_place1"] ?></option>
                <option value="<?php echo $_SESSION["car_place2"] ?>"><?php echo $_SESSION["car_place2"] ?></option>
                <option value="<?php echo $_SESSION["car_place3"] ?>"><?php echo $_SESSION["car_place3"] ?></option>
            </select>

            <h4>*終着地点を選択してください*</h4>
            <select class="fin_place" name="fin_place">
                <option value="<?php echo $_SESSION["car_place1"] ?>"><?php echo $_SESSION["car_place1"] ?></option>
                <option value="<?php echo $_SESSION["car_place2"] ?>"><?php echo $_SESSION["car_place2"] ?></option>
                <option value="<?php echo $_SESSION["car_place3"] ?>"><?php echo $_SESSION["car_place3"] ?></option>
            </select>
        </div>

        <div class="button">
            <input class="left_button" type="button" value="戻る" onclick="check('hotel')">
            <input class="right_button" type="button" value="送信"  onclick="check('carenter_check')">
        </div>

    </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>
  
</body>
</html>