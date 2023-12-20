
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./mvc/view/login/login.css?v1">
    

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

</head>
<body>
    <div class="container">
        <form method="post">
            <table>
                <tr>
                    <td class="label">
                        <label for="username">Tên đăng nhập</label>
                    </td>
                    <td>
                        <input  name="username" id="username" type="text" placeholder="name" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="inputPassword">Mật khẩu</label>
                    </td>
                    <td>
                        <input  name="password" id="inputPassword" type="text" placeholder="Password" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Đăng nhập">
                    </td>
                </tr>
            </table>
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
