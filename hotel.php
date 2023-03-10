<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <script type="text/javascript" src="index.js"></script>
    
    <title>ROBOTELIER</title>
    <script>
        function cancel(status, id){
            let checkSaveFlg = window.confirm('キャンセルを実行してもよろしいですか？');
            if(!checkSaveFlg) {
                return;
            }            
            document.forms.cancelform.status.value = status;
            document.forms.cancelform.id.value = id;
            document.forms.cancelform.submit();
        }
        /*function logout(){
            let checkSaveFlg = window.confirm('ログアウトします。よろしいですか？');
            if(!checkSaveFlg) {
                return;
            }            
            document.forms.cancelform.status.value = status;
            document.forms.cancelform.id.value = id;
            document.forms.cancelform.submit();
        }*/

        $(function(){
            $(".logout").click(function(){
                var undefined= window.confirm('ログアウトします。よろしいですか？');
                //alert(undefined);
                if(undefined){
                    // alert("ログアウトするよ");
                    //document.forms.logout.submit();
                }
                else{
                    // alert("ログアウトしないお");
                    document.forms.logout.status.value = "hotel";
                }
            })
            });
    </script>    
</head>
<body>

    <header id="header">

        <div class="logo">
            <img src="images/logo3.png" alt="ろぼテリエ" width="80%">
        </div>
        <nav>
            <ul id="g-navi">
                <li><form action="index.php" method="POST">
                    <button type="submit"><img src="images/car.png" alt="車の手配" width="30%;"><h5>車の手配</h5></button>
                    <input type="hidden" name="status" value="carenter"></form></li>

                <li><form action="index.php" method="POST">
                    <button type="submit"><img src="images/bag.png" alt="荷物管理" width="30%;"><h5>荷物管理</h5></button>
                    <input type="hidden" name="status" value="bagenter"></form></li>

                <li><form action="index.php" method="POST">
                    <button type="submit"><img src="images/service.png" alt="ルームサービス" width="30%;"><h5>ルームサービス</h5></button>
                    <input type="hidden" name="status" value="rsenter"></form></li>

            </ul>
        </nav>

        

        <div class="hello">
        <?php echo $_SESSION["member_name"] . "さん　こんにちは！" ?>

            <div class="logout">
                <form action="index.php" name="logout" method="POST"> 
                    <button>ログアウト</button>
                    <input type="hidden" name="status" value="logout">
                </form>
            </div>
        </div>

        

    </header>
    
    

    <h1>宿泊中</h1>

    <div class="hotel_detail">
        <img src="<?php echo $_SESSION["img_path"] ?>" alt="ホテル写真">
        <ul>
            <li>ホテル名　<?php echo '<strong style="font-size:25px;">' . $_SESSION["hotel_name"] . '</strong>' ?></li>
            <li>アクセス　<?php echo '<strong style="font-size:25px;">' . $_SESSION["access"] . '</strong>' ?></li>
            <li>電話番号　<?php echo '<strong style="font-size:25px;">' . $_SESSION["tel"] . '</strong>' ?></li>
            <li>予約番号　<?php echo  '<strong style="font-size:25px;">' . sprintf('%08d' ,$_SESSION["reservation_id"] . '</strong>') ?></li>

            <div id="map" style="width:570px; height:400px"></div>

            <script type="text/javascript">
                function initMap() {
                var opts = {
                    zoom: 17,
                    center: new google.maps.LatLng(<?php echo $_SESSION["lat"] ?>, <?php echo $_SESSION["lng"] ?>),
                    styles:
                        [
                        {
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            },
                            {
                                "saturation": 60
                            },
                            {
                                "lightness": -30
                            },
                            {
                                "weight": 4
                            }
                            ]
                        },
                        {
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#523735"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#c9b2a6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#dcd2be"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#ae9e90"
                            }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#93817c"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#a5b076"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#447530"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#fdfcf8"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f8c967"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#e9bc62"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#e98d58"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#db8555"
                            }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#806b63"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#8f7d77"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#b9d3c2"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#92998d"
                            }
                            ]
                        }
                        ]
                };
                var map = new google.maps.Map(document.getElementById("map"), opts);
                }
            </script>

            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_TJYyO1ktv6eUuc4BQ8vw8z4zjVR1mh4&callback=initMap">
            </script>
        </ul>

        
    </div>

    <form action="./index.php" method="post" name="cancelform">
        <input type="hidden" name="status" value=""> 
        <input type="hidden" name="id" value=""> 
    </form>

    <div class="reserv_detail">
        <h3>予約内容</h3>
        <ul>
            <li><strong style="font-size:20px;">宿泊日数　　　　</strong><?php echo  $_SESSION["check_in_date"] ?> ～ <?php echo $_SESSION["check_out_date"]?></li>
            <li><strong style="font-size:20px;">部屋タイプ　　　</strong><?php echo $_SESSION["room_type"] ?></li>
            <li><strong style="font-size:20px;">その他宿泊条件　</strong></li>
        </ul>
        <div class="amount">
            <h3>合計金額</h3>
            <p><?php echo '<strong style="font-size:30px;">' . $_SESSION["amount"]  . '</strong>' ?>円</p>
        </div>

        <div class="car_rsv">
            <h3>車の手配予約</h3>
            <?php 
                if(count($_SESSION["car_arrange_list"]) == 0){

                    ?>
                    <h4>現在予約はありません。</h4>
                    <?php

                }else{
            ?>
            <table align="center" border="1">
                <tr>
                    <th>予約番号</th><th>出発日</th><th>出発時刻</th><th>出発地点</th><th>終着地点</th><th></th>
                </tr>
            <?php 
            foreach($_SESSION["car_arrange_list"] as $car_arrange){
                echo "<tr>";
                echo "<td>" . ($car_arrange["id"]) ."</td>";
                echo "<td>" . ($car_arrange["departure_date"]) . "</td>";
                echo "<td>" . ($car_arrange["departure_time"]) . "</td>";
                echo "<td>" . ($car_arrange["departure_place"]) . "</td>";
                echo "<td>" . ($car_arrange["destination"]) . "</td>";
                echo "<td><button onclick=\"cancel('car_cancel', " .  ($car_arrange["id"]) . ")\">キャンセル</button></td>";
                echo "</tr>";

            }?>
            </table>
            <?php
                }
            ?>
        </div>

        <div class="bag_rsv">
            <h3>荷物管理予約</h3>
            <?php 
                if(count($_SESSION["luggage_list"]) == 0){

                    ?>
                    <h4>現在予約はありません。</h4>
                    <?php

                }else{
            ?>
            <table align="center" border="1">
                <tr>
                    <th>予約番号</th><th>受取日</th><th>受取時刻</th><th>受取場所</th><th></th>
                </tr>
            <?php 
            foreach($_SESSION["luggage_list"] as $luggage){
                echo "<tr>";
                echo "<td>" . ($luggage["id"]) ."</td>";
                echo "<td>" . ($luggage["return_date"]) . "</td>";
                echo "<td>" . ($luggage["return_time"]) . "</td>";
                echo "<td>" . ($luggage["return_place"]) . "</td>";
                echo "<td><button onclick=\"cancel('bag_cancel', " .  ($luggage["id"]) . ")\">キャンセル</button></td>";
                echo "</tr>";

            }?>
            </table>
            <?php
                }
            ?>
        </div>

        <div class="rs_rsv">
            <h3>ルームサービス予約</h3>
            <div class="menu">
                <a target="_blank" href="<?php echo $_SESSION["menu_pdf"] ?>">商品一覧はここをクリック</a>
            </div>
            <?php 
                if(count($_SESSION["rs_list"]) == 0){

                    ?>
                    <h4>現在予約はありません。</h4>
                    <?php

                }else{
            ?>
            <table align="center" border="1">
                <tr>
                    <th>予約番号</th><th>予約日</th><th>ご注文内容</th><th>数量</th><th></th>
                </tr>
            <?php 
            foreach($_SESSION["rs_list"] as $rs){
                echo "<tr>";
                echo "<td>" . ($rs["id"]) ."</td>";
                echo "<td>" . ($rs["rs_date"]) . "</td>";
                echo "<td>" . ($rs["menu"]) . "</td>";
                echo "<td>" . ($rs["rs_number"]) . "</td>";
                echo "<td><button onclick=\"cancel('rs_cancel', " .  ($rs["id"]) . ")\">キャンセル</button></td>";
                echo "</tr>";

            }?>
            </table>
            <?php
                }
            ?>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-5/js/5-1-5.js"></script>

    <footer>
        <small>&copy2023 ROBOTELIER</small><br>
        <span class="pr">HAL東京　2年制　情報処理学科　ひやま　りん</span>
    </footer>

    
</body>
</html>