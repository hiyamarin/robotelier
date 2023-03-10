
    <?php
    session_start();

    if(isset($_POST["status"]) && strcmp($_POST["status"], "logout") == 0){
        $_SESSION = array();
    }

    //ページ遷移ごとに初回かどうか確認する
    if(!isset($_SESSION["status"])){
        require("login.php");
        $_SESSION["status"] = "login";
        exit();
    }

    $host = 'localhost';
    $username = 'root';
    $passwd = '';
    $dbname = 'robotest';
    
    $db = new mysqli($host, $username, $passwd, $dbname);
    

    // 接続チェック
    if (!$db) {
        die('データベースの接続に失敗しました。');
    }
    if(strcmp($_SESSION["status"], "login") == 0){


        // ログイン画面

    // フォームを受け取れるかの確認
        if(!isset($_POST["login_email"])){
            require ('login.php');
            exit();
        }
        
        if(!isset($_POST["login_password"])){
            require ('login.php');
            exit();

        }
        $login_email = $_POST["login_email"];
        $login_password = $_POST["login_password"];
    
    //フォームが受け取れたあとにDBと比較
        $sql = "select id, member_name, password from member where mail_address ='" . $login_email  . "'";
        if($result = $db -> query($sql)){
            if ($row = $result->fetch_assoc()){
                if(strcmp($login_password, $row["password"]) == 0){

                    //ログイン状態保持を開始
                    $_SESSION["member_name"] = $row["member_name"];
                    $_SESSION["member_id"] = $row["id"];
                    $_SESSION["status"] = "hotel";
                    
                }else{
                    $_POST["message"] = "メールアドレスかパスワードが違います";
                    require ('login.php');
                    exit();
                }
            }else{
                $_POST["message"] = "メールアドレスかパスワードが違います";
                require ('login.php');
                exit();
            }
        }else{
            $_POST["message"] = "メールアドレスかパスワードが違います";
            require ('login.php');
            exit();
        }

    }

    // index.phpに来たファイルのstatusが何かを判別
    if(isset($_POST["status"])){
        $_SESSION["status"] = $_POST["status"];
    }

    // キャンセルボタンが押されたときの処理
    if(strcmp($_SESSION["status"], "car_cancel") == 0){
        $sql = "DELETE FROM car_arrange WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->close();

        $_SESSION["status"] = "hotel";

    }
    if(strcmp($_SESSION["status"], "bag_cancel") == 0){
        $sql = "DELETE FROM luggage WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->close();

        $_SESSION["status"] = "hotel";

    }
    if(strcmp($_SESSION["status"], "rs_cancel") == 0){
        $sql = "DELETE FROM room_service WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->close();

        $_SESSION["status"] = "hotel";

    }




// ホテル画面
    if(strcmp($_SESSION["status"], "hotel") == 0){
        $sql = "SELECT a.amount, a.check_in_date, a.check_out_date, a.room_type, a.id as reservation_id, b.hotel_name, b.access, b.img_path, b.tel, b.lat, b.lng, b.menu_pdf, c.car_place1, c.car_place2, c.car_place3, c.rs_menu1, c.rs_menu2, c.rs_menu3 FROM reservation a, hotel b, pulldown c  WHERE a.member_id = ? && c.hotel_id = b.id AND a.hotel_id = b.id";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_SESSION["member_id"]);
        $stmt->execute();
        $stmt->bind_result($amount, $check_in_date, $check_out_date, $room_type, $reservation_id, $hotel_name, $access, $img_path, $tel, $lat, $lng, $menu_pdf, $car_place1, $car_place2, $car_place3, $rs_menu1, $rs_menu2, $rs_menu3);
        $stmt->fetch(); 
        $_SESSION["img_path"] = $img_path;
        $_SESSION["hotel_name"] = $hotel_name;
        $_SESSION["access"] = $access;
        $_SESSION["tel"] = $tel;
        $_SESSION["reservation_id"] = $reservation_id;
        $_SESSION["amount"] = $amount;
        $_SESSION["check_in_date"] = $check_in_date;
        $_SESSION["check_out_date"] = $check_out_date;
        $_SESSION["room_type"] = $room_type;
        $_SESSION["check_out_date"] = $check_out_date;
        $_SESSION["lat"] = $lat;
        $_SESSION["lng"] = $lng;
        $_SESSION["car_place1"] = $car_place1;
        $_SESSION["car_place2"] = $car_place2;
        $_SESSION["car_place3"] = $car_place3;
        $_SESSION["rs_menu1"] = $rs_menu1;
        $_SESSION["rs_menu2"] = $rs_menu2;
        $_SESSION["rs_menu3"] = $rs_menu3;
        $_SESSION["menu_pdf"] = $menu_pdf;
        $stmt->close();

    
        // 車の手配予約確認 
        $sql = "SELECT id, departure_date, departure_time, departure_place, destination FROM car_arrange WHERE reservation_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_SESSION["reservation_id"]);
        $stmt->execute();
        $stmt->bind_result($id, $departure_date, $departure_time, $departure_place, $destination);
        $car_arrange_list = array();
        while($stmt->fetch()){
            $car_arrange = array('id' => $id, 'departure_date' => $departure_date, 'departure_time' => $departure_time, 'departure_place' => $departure_place, 'destination' => $destination);
            array_push($car_arrange_list, $car_arrange);

        } 
         $_SESSION["car_arrange_list"] = $car_arrange_list;


        // 荷物管理予約確認 
        $sql = "SELECT id, return_date, return_time, return_place FROM luggage WHERE reservation_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_SESSION["reservation_id"]);
        $stmt->execute();
        $stmt->bind_result($id, $return_date, $return_time, $return_place);
        $luggage_list = array();
        while($stmt->fetch()){
            $luggage = array('id' => $id, 'return_date' => $return_date, 'return_time' => $return_time, 'return_place' => $return_place);
            array_push($luggage_list, $luggage);

        } 
        $_SESSION["luggage_list"] = $luggage_list;

        // ルームサービス予約確認 
        $sql = "SELECT id, rs_date, menu, rs_number FROM room_service WHERE reservation_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_SESSION["reservation_id"]);
        $stmt->execute();
        $stmt->bind_result($id, $rs_date, $menu, $rs_number);
        $rs_list = array();
        while($stmt->fetch()){
            $rs = array('id' => $id, 'rs_date' => $rs_date, 'menu' => $menu, 'rs_number' => $rs_number);
            array_push($rs_list, $rs);

        } 
         $_SESSION["rs_list"] = $rs_list;
 
        require ('hotel.php');
        exit();

 }

// 車の予約画面遷移
    if(strcmp($_SESSION["status"], "carenter") == 0){
        require ('car_enter.php');
        exit();

    }

    // フォーム入力なしの場合
    if(strcmp($_SESSION["status"], "carenter_check") == 0){
        $check_ok = TRUE;
        $_POST["message"] = "";
        if(empty($_POST["car_date"])){
            $_POST["message"] .= "日付を入力してください。";
            $check_ok = FALSE;
        }
        if(empty($_POST["car_time"])){
            $_POST["message"] .= "時間を入力してください。";
            $check_ok = FALSE;
        }


        if(!$check_ok){
            $_SESSION["status"] = "carenter";
            require ('car_enter.php');
            exit();
        }


        require ('car_check.php');
        exit();

    }
    if(strcmp($_SESSION["status"], "car_fin") == 0){

// フォーム情報をDBに送信
        try{
            $sql = "INSERT INTO car_arrange (reservation_id, departure_date, departure_time, departure_place, destination) VALUES(?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

// "型"　VALUEを？にすることで文字列にする SQLインジェクション攻撃を防ぐ
            $stmt->bind_param("issss", $_SESSION["reservation_id"], $_POST["car_date"], $_POST["car_time"], $_POST["srt_place"], $_POST["fin_place"]);
            $stmt->execute();
    
    
        }catch(PDOException $e){
            echo 'DB接続エラー' . $e->getMessage();
            }
        require ('car_fin.php');
        exit();
    }


// 荷物管理画面遷移
    if(strcmp($_SESSION["status"], "bagenter") == 0){
        require ('bag_enter.php');
        exit();

    }

    if(strcmp($_SESSION["status"], "bagenter_check") == 0){

        $check_ok = TRUE;
        $_POST["message"] = "";
        if(empty($_POST["bag_date"])){
            $_POST["message"] .= "日付を入力してください。";
            $check_ok = FALSE;
        }
        if(empty($_POST["bag_time"])){
            $_POST["message"] .= "時間を入力してください。";
            $check_ok = FALSE;
        }


        if(!$check_ok){
            $_SESSION["status"] = "bagenter";
            require ('bag_enter.php');
            exit();
        }
        
        require ('bag_check.php');
        exit();

    }

    if(strcmp($_SESSION["status"], "bag_fin") == 0){
        try{
            $sql = "INSERT INTO luggage (reservation_id, return_date, return_time, return_place) VALUES(?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("isss", $_SESSION["reservation_id"], $_POST["bag_date"], $_POST["bag_time"], $_POST["rsv_place"]);
            $stmt->execute();
    
    
        }catch(PDOException $e){
            echo 'DB接続エラー' . $e->getMessage();
            }
        require ('bag_fin.php');
        exit();

    }

    // ルームサービス画面遷移
    if(strcmp($_SESSION["status"], "rsenter") == 0){
        require ('rs_enter.php');
        exit();

    }

    if(strcmp($_SESSION["status"], "rsenter_check") == 0){

        $check_ok = TRUE;
        $_POST["message"] = "";
        if(empty($_POST["rs_date"])){
            $_POST["message"] .= "日付を入力してください。";
            $check_ok = FALSE;
        }

        if(!$check_ok){
            require ('rs_enter.php');
            exit();
        }

        require ('rs_check.php');
        exit();
    }

    if(strcmp($_SESSION["status"], "rs_fin") == 0){
        try{
            $sql = "INSERT INTO room_service (reservation_id, rs_date, menu, rs_number) VALUES(?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("isss", $_SESSION["reservation_id"], $_POST["rs_date"], $_POST["menu"], $_POST["rs_number"]);
            $stmt->execute();
    
    
        }catch(PDOException $e){
            echo 'DB接続エラー' . $e->getMessage();
            }
        require ('rs_fin.php');
        exit();

    }

    ?>
