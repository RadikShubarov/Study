<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>LAB_1</title>
</head>

<body>


<div class="container content">
    <div class="row ">
        <div class="col-12 header">
            <h3>Лабораторная №1 Шубаров P33212 Кирьяков P33212 Вариант 31075</h3>
        </div>
        <div class="col-12 graph ml-5"><img src="img/area.png"></div>
        <?php
        $start = microtime(True);
        if (isset($_GET['submit'])) {
            $x = (float)filter_input(INPUT_GET, 'x');
            $y = (int)filter_input(INPUT_GET, 'y');
            $r = (float)filter_input(INPUT_GET, 'r');

            $r_range = array(1, 1.5, 2, 2.5, 3);

            $correct = False;
            if(!empty($x) and !empty($y) and !empty($r) and $x >= -5 and $x <= 5 and $y >= -5 and $y <= 3 and in_array($r, $r_range)) {
                $correct = True;
            }

            if ($correct){
                $hit = True;

                if ($x >= 0) {
                    if ($y >= 0) {
                        $hit = False;
                    } else {
                        $dist = sqrt($x ** 2 + $y ** 2);
                        $hit = $dist <= $r;
                    }
                } else {
                    if ($y >= 0) {
                        $hit = $y <= $r / 2 and $x > -$r;
                    } else {
                        $hit = $y >= ($x - $r);
                    }
                }

                $hit_str = 'Промах';
                if ($hit) {
                    $hit_str = 'Попадание';
                }

                echo '<div class="col-12" >';
                echo '<h3>' . $hit_str . '</h3>';
            } else {
                echo '<div class="col-12" >';
                echo '<h3>Неверные данные</h3>';
            }

        }
        ?>

        <form method="GET" action="lab1.php" class="forms">
            <div class="col-12 X-changes mb-3">
                <p>Изменение X: Text</p>
                <input type="text" class="form-control field"  name="x"style="background-color:#55cff5; "
                       placeholder="Введите X в диапозоне (-5..5)" required>
            </div>
            <div class="col-12 Y-button mb-2">
                <p>Изменение Y: Button</p>
                <input type="hidden" name="y" id="y_field" required>
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="-5">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="-4">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="-3">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="-2">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="-1">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="0">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="1">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="2">
                <input class="btn btn-primary y-button" type="button" onclick="changeY(this)" value="3">
            </div>
            <div class="col-12 R-button mb-5">
                <p>Изменение R: Button</p>
                <input type="hidden" name="r" id="x_field" required>
                <input class="btn btn-primary r-button" type="button" onclick="changeX(this)" value="1">
                <input class="btn btn-primary r-button" type="button" onclick="changeX(this)" value="1.5">
                <input class="btn btn-primary r-button" type="button" onclick="changeX(this)" value="2">
                <input class="btn btn-primary r-button" type="button" onclick="changeX(this)" value="2.5">
                <input class="btn btn-primary r-button" type="button" onclick="changeX(this)" value="3">
            </div>
            <div class="col-12 submit-button mb-5">
                <input class="btn btn-primary" type="submit" value="Отправить" name="submit">
            </div>
        </form>
        <?php
        if (isset($x, $y, $r, $hit_str, $start)) {
            $duration = microtime(True) - $start;
            $result = array(
                $x, $y, $r,
                $hit_str,
                time(),
                $duration
            );
            $_SESSION['results'][] = $result;
        }

        if (isset($_SESSION['results'])) {
            echo '<div class="col-12 mb-5">';
            echo '<table border="2">';
            echo '<tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>Результат</th>
                    <th>Время работы</th>
                    <th>Текущее время</th>
                    </tr>';
            foreach ($_SESSION['results'] as $value) {
                $x_cur = $value[0];
                $y_cur = $value[1];
                $r_cur = $value[2];
                $hit_cur = $value[3];
                $time_cur = $value[4];
                $duration_cur = $value[5];

                $ftime = date('H:i:s', $time_cur);

                echo '<tr>';
                echo '<td>' .$x_cur .'</td>';
                echo '<td>' .$y_cur .'</td>';
                echo '<td>' .$r_cur .'</td>';
                echo '<td>' .$hit_cur .'</td>';
                echo '<td>' .sprintf('%.8f', $duration_cur) .'</td>';
                echo '<td>' .$ftime .'</td>';
            }
            echo '</div>';
        }
        ?>
    </div>


</div>


<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>


<script src="./js/buttons.js"></script>
<script src="./js/inputValid.js"></script>

</body>
</html>

