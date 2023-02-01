<?php
// Start the session
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("database.php");
    $link = db_connect();
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    if (empty($name) || empty($pass)) {
        echo "Имя или пароль не заданы";
    }
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    if ($_POST['submitreg']) {
        $query = "INSERT INTO users(username,pass) VALUES ('$name','$hash')";
        $reg_result = mysqli_query($link, $query);
        if (!$reg_result)
            die(mysqli_error($link));
        echo "<p style='margin-left: 42%;'>Пользователь $name добавлен!</p>";
    }

    if ($_POST['submit']) {
        $querys = "SELECT pass FROM `users` WHERE username LIKE '$name'";
        $user_id_query = "SELECT id FROM `users` WHERE username LIKE '$name'";
        $result_query = mysqli_query($link, $querys);
        $user_id = mysqli_query($link, $user_id_query);
        $row = mysqli_fetch_array($result_query, MYSQLI_ASSOC);
        $row_id = mysqli_fetch_array($user_id, MYSQLI_ASSOC);
        $hash = $row['pass'];
        $id = $row_id['id'];

        if (password_verify($pass, $hash)) {
            $_SESSION['id'] = $id;
            if ($name == "admin") {
                header("Location:http://lab/admin/admin.php");
            } else
                header("Location:http://lab/lab1.php");
        } else {
            echo "<p style='margin-left: 42%;'>Пользователя нет или неверный пароль!</p>";
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>LAB_1</title>
</head>

<body id="first">
    <form method="POST" action="index.php" class="form">
        <div class="author">
            <div class="submit-button mb-5">
                <p>Авторизация</p>
                <input type="text" class="form-control field" name="user" style="background-color:#55cff5;margin-bottom: 30px; " placeholder="Введите имя">
                <input type="text" class="form-control field" name="pass" style="background-color:#55cff5; margin-bottom: 30px;" placeholder="Введите пароль">
                <input class="btn btn-primary" type="submit" value="Регистрация" name="submitreg">
                <input class="btn btn-primary" type="submit" value="Войти" name="submit">
            </div>
        </div>
    </form>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


    <script src="./js/buttons.js"></script>
    <script src="./js/inputValid.js"></script>

</body>

</html>