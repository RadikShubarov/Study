<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <title>LAB_1</title>
</head>

<body id="first">



    <form method="POST" action="admin.php" class="form">
        <div class="author">
            <div class="submit-button mb-5">
                <p>Панель админа</p>
                <row>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Показать историю" name="show" style="background-color:#55cff5; width:240px; margin-bottom: 30px">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control field" name="deleteuser" style="background-color:#55cff5;margin-bottom: 30px; width:240px" placeholder="Введите имя">
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Удалить" name="delete" style="margin-bottom: 30px; width:240px; margin-bottom: 30px">
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Показать название функций" name="showfunction" style="background-color:#55cff5; width:240px; margin-bottom: 30px">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control field" name="enterfunction" style="background-color:#55cff5;margin-bottom: 30px; width:240px" placeholder="Введите название функции">
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Установить функцию" name="setfunction" style="margin-bottom: 30px; width:240px">
                    </div>
                </row>

            </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Сортировать по имени &#9650;" name="sortname" style="margin-left: 15%; margin-bottom: 30px; width:215px">
        <input class="btn btn-primary" type="submit" value="Сортировать по имени &#9660;" name="sortnamedesc" style="margin-bottom: 30px; width:215px">
        <input class="btn btn-primary" type="submit" value="Сортировать по времени &#9650;" name="sortdate" style="margin-bottom: 30px; width:220px">
        <input class="btn btn-primary" type="submit" value="Сортировать по времени &#9660;" name="sortdatedesc" style="margin-bottom: 30px; width:220px">
        <input class="btn btn-primary" type="submit" value="Сортировать по результату &#9650;" name="sortres" style="margin-bottom: 30px; width:233px">
        <input class="btn btn-primary" type="submit" value="Сортировать по результату &#9660;" name="sortresdesc" style="margin-bottom: 30px; width:233px">
        <div><input class="btn btn-primary" type="submit" value="Удалить результаты с базы" name="delres" style="margin-left: 43%; margin-bottom: 30px; width:233px"></div>
        
    </form>

    <!-- <input class="btn btn-primary" onclick="return myFunction1()" type="submit" value="Вернуться в функционал" name="return" style="margin-left: 36%; margin-bottom: 30px; width:215px" ;> -->
    
    <input class="btn btn-primary" onclick="return myFunction3()" type="submit" value="Вернуться на регистрацию" name="reg" style=" margin-left: 43%; margin-bottom: 30px; width:230px" ;>

    <?php
    $globals = $GLOBALS;
    $globals['query'] = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("../database.php");
        $link = db_connect();
        $name = $_POST['deleteuser'];
        $name_function = $_POST['enterfunction'];
        if (isset($_POST['show'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Имя</th>
                    <th>x</th>
                    <th>y</th>
                    <th>r</th>
                    <th>Время</th>
                    <th>Результат</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['showfunction'])) {
            $query_func = "SELECT name_func FROM func";
            $res_func = mysqli_query($link, $query_func);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Название функции</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res_func, MYSQLI_ASSOC)) {
                $name_func   = $row['name_func'];
                echo '<tr>';
                echo '<td>' . $name_func . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['setfunction'])) {
            if (empty($name_function)) {
                echo "<p style='margin-left: 42%;'>Введите имя функции!</p>";
            }
            $query_remove_func = "UPDATE func SET func_enable = 0 WHERE func_enable = 1";
            mysqli_query($link, $query_remove_func);
            $query_set_func = "UPDATE func SET func_enable = 1 WHERE name_func = '$name_function'";
            $result_query_function = mysqli_query($link, $query_set_func);
            echo $result_query_function;


            if ($result_query_function && !empty($name_function)) {
                echo "<p style='margin-left: 42%;'>Функция $name_function установлена!</p>";
            }
            if (!$result_query_function) {
                // echo "<p style='margin-left: 42%;'>Что-то пошло не так!</p>";
            }
        }

        if (isset($_POST['delete'])) {
            if (empty($name)) {
                echo "<p style='margin-left: 42%;'>Введите имя!</p>";
            }
            if ($name != "admin") {
                $querys = "DELETE FROM `users` WHERE username LIKE '$name'";
                $result_query = mysqli_query($link, $querys);
            }

            if ($result_query && !empty($name)) {
                echo "<p style='margin-left: 42%;'>User $name был удален!</p>";
            }
            if (!$result_query) {
                echo "<p style='margin-left: 42%;'>Something went wrong!</p>";
            }
        }
        if (isset($_POST['sortdate'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY cur_time";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Username</th>
                    <th>x</th>
                    <th>y</th>
                    <th>r</th>
                    <th>Время</th>
                    <th>Результат</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['sortres'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY result";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Имя</th>
                    <th>x</th>
                    <th>y</th>
                    <th>r</th>
                    <th>Время</th>
                    <th>Результат</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['sortname'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY username";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                        <th>Имя</th>
                        <th>x</th>
                        <th>y</th>
                        <th>r</th>
                        <th>Время</th>
                        <th>Результат</th>
                        </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['sortdatedesc'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY cur_time DESC";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Имя</th>
                    <th>x</th>
                    <th>y</th>
                    <th>r</th>
                    <th>Время</th>
                    <th>Результат</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['sortnamedesc'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY username DESC";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                        <th>Имя</th>
                        <th>x</th>
                        <th>y</th>
                        <th>r</th>
                        <th>Время</th>
                        <th>Результат</th>
                        </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }

        if (isset($_POST['sortresdesc'])) {
            $query = "SELECT username,x,y,r,cur_time,result FROM work,users WHERE work.user_id = users.id ORDER BY result DESC";
            $res = mysqli_query($link, $query);
            echo '<div class="col-12 mb-5" style="margin-left: 38%;">';
            echo '<table border="5">';
            echo '<tr>
                    <th>Имя</th>
                    <th>x</th>
                    <th>y</th>
                    <th>r</th>
                    <th>Время</th>
                    <th>Результат</th>
                    </tr>';
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $name   = $row['username'];
                $x = $row['x'];
                $y = $row['y'];
                $r = $row['r'];
                $cur_time = $row['cur_time'];
                $result = $row['result'];
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $x . '</td>';
                echo '<td>' . $y . '</td>';
                echo '<td>' . $r . '</td>';
                echo '<td>' . $cur_time . '</td>';
                echo '<td>' . $result . '</td>';
            }
            echo "</div>";
        }
        if (isset($_POST['delres'])) {
            $query = "DELETE FROM work";
            $res = mysqli_query($link, $query);
            if ($res) {
                echo "<p style='margin-left: 42%;'>Таблица результатов очищена!</p>";
            }
        }
    }
    ?>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


    <script src="../js/buttons.js"></script>
    <script src="../js/inputValid.js"></script>

</body>

</html>
