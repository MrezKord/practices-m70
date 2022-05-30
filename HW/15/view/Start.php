<?php use Core\Application; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
</head>

<body>
    <div class="back bg-[url('back.jpg')] h-[100vh]">
        <div class="welcome-container">
            <p class="title">Welcome 👋</p>
            <?php if(Application::$app->isGust()) { ?>
            <a class="btn" href="/Register">Register</a>
            <a class="btn" href="/Login">Login</a>
            <?php }else { ?>
            <a class="btn" href="/home">Home</a>
            <a class="btn" href="/Logout">Logout</a>
            <?php } ?>
            <a class="btn" href="/doctorList">Doctors</a>
        </div>
    </div>
</body>

</html>