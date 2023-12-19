<?php
session_start();

if ((isset($_POST['submit'])) && ($_POST['submit'])) {

    $preparedStm = $data['model']->login($_POST['username'], $_POST['password']);
    $user= mysqli_fetch_array($preparedStm);
    if ($user != null) {
        header("location: home");
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/mvc/view/home/home.css">
</head>
<body>
    <div class="container">
        <form method="post">
            <div >
                <input  name="username" id="username" type="text" placeholder="name" />
                <label for="username">Tên đăng nhập</label>
            </div>
            <div>
                <input  name="password" id="inputPassword" type="text" placeholder="Password" />
                <label for="inputPassword">Mật khẩu</label>
            </div>
            <div  id="login-button">
                <input type="submit" name="submit" value="Đăng nhập">
            </div>
        </form>
    </div>
</body>
<script>
    // let button = document.getElementById("submit")
    // button.addEventListener("click", (e)=>{
    //     e.preventDefault()
    // })
</script>
</html>