<!DOCTYPE html>
<html lang="jp">

    <head>
        <meta charset="utf-8">
        <title>ROBOTELIER</title>

        <link rel="stylesheet" href="css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="login_top">
            <img src="images/logo3.png" alt="ろぼテリエ" width="25%">
            <p>ホテル予約時と同じメールアドレスを入力してください。</p>
        </div>
        
        <div class="error">
        <?php
        if(isset($_POST["message"])){
            echo '<div class="login_top"><b>' . $_POST["message"] . '</b></div>';
        }

        ?>
        </div>
        
        <form class="login_form" action="index.php" method="post">
            <div class="login_enter">
                <p>メールアドレス<br><input type="email" name="login_email" placeholder="Email"></p>
                <p>パスワード<br><input type="password" name="login_password" placeholder="Password"></p>
            </div>
        
            <div class="button">
                <input type="submit" value="完了">
            </div>
        </form>

    <footer>
        <small>&copy2023 ROBOTELIER</small>
    </footer>

    </body>
</html>