<?php

    ob_start();
    session_start();

    if(isset($_SESSION["id"])) {
        header("Location: /");
        exit();
    }
    require_once "../config/configuration.php";
    require_once "../config/functions.php";


$pageName = "Login";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $errors = array();
        if(empty($_POST["username"]) || empty($_POST["password"])) {
            array_push($errors, "Please check all fields.");
            echo "<script>Swal.fire({position: 'top-end', toast: true, type: 'success', title: 'Please check all fields.', showConfirmButton: false, timer: 2500, icon: 'error'})</script>";
        }

        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $checkLogin = $database->prepare("SELECT * FROM `users` WHERE username = :username AND password = :password");
        $checkLogin->execute(["username" => $username, "password" => $password]);

        $arrayLogin = $checkLogin->fetch(PDO::FETCH_ASSOC);
        $checkIfUserHaveAccount = $checkLogin->rowCount();

        if(!$checkIfUserHaveAccount) {
            $error = error("The username and password do not match.");
        } else {

            $updateLastIP = $database->prepare("UPDATE `users` SET `last_ip` = :ip WHERE username = :username");
            $updateLastIP->execute(["ip" => $_SERVER["HTTP_CF_CONNECTING_IP"], "username" => $username]);

            $_SESSION["id"] = $arrayLogin["id"];
            $_SESSION["username"] = $arrayLogin["username"];
            $_SESSION["email"] = $arrayLogin["email"];
            $_SESSION["admin"] = $arrayLogin["admin"];
			
			$success = success("You are successfully logged in.");

            header('refresh:1.5; url=/');

        }

    }

?>
 <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.png' />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet" />
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" type="78c660154121d7f22531e64f-text/javascript"></script>
<style>
        #particles canvas {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .swoosh {
            background-image: url(bg.svg);
            background-repeat: no-repeat;
            background-size: 100% 505%;
            height: 200px;
        }

        .woosh {
            background-image: url(bg2.svg);
            background-repeat: no-repeat;
            background-size: 100% 505%;
            height: 200px;
        }
        @media (max-width: 580px) {
    .swoosh {
        background-size: 100% 270%;
    }
    .woosh {
        background-size: 100% 270%;
    }
        }
    </style>
</head>
</div>
</div>
</div>
</div>
<body class="bg-gray-900">
<div id="header" class="bg-gray-800">
<div class="bg-gray-900 lg:pt-0">
<div class="flex z-100 text-gray-200 bg-gray-900 inset-x-0 top-0 border-b-2 border-gray-800 lg:border-b-0 items-center">
<div class="w-full relative mx-auto px-6">
<div class="lg:border-b-2 lg:border-gray-800 h-20 flex flex-col justify-center">
<div class="flex items-center -mx-6">
<div class="lg:w-1/4 xl:w-1/5 pl-6 pr-6">
<div class="flex items-center">
<a href="/" class="block">
<h1 class="font-medium text-3xl mr-4">
MineLeaks
</h1>
</a>
<div class="hidden lg:flex">
</div>
</div>
</div>
<div class="flex flex-grow lg:w-3/4 xl:w-4/5">
<div class="hidden lg:flex lg:items-center lg:justify-between xl:w-1/4 px-6">
<div class="relative mr-4"></div>
</div>
</div>
<div class="hidden lg:flex lg:items-center lg:justify-between xl:w-1/4 px-6">
<div class="relative mr-4"></div>
<div class="flex justify-start items-center text-gray-200">
<a href="/register" class="transition duration-700 ease-in-out rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-blue-500 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Register</a>
</div>
</div>
</div>
</div>
</div>
</div>
</br>
<div class="lg:hidden flex justify-center content-center">
                        <?php
                        if(!isset($_SESSION["id"])) {
                            echo '
<a href="/register" class="transition duration-700 ease-in-out rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-blue-500 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Register</a>';
}
?>

<br>
</div>
<style>

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 400px;
  padding: 20px;
  width: 375px;
}

.form2 {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 100px;
  padding: 20px;
  width: 400px;
}

.title {
  color: #eee;
  font-family: sans-serif;
  font-size: 36px;
  font-weight: 600;
  margin-top: 30px;
}

.subtitle {
  color: #eee;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 40px;
}

.ic2 {
  margin-top: 30px;
}

.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}

.cut {
  background-color: #15172b;
  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}

.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}
	
.alert-danger {
    position: relative;
    background-color: #e53e3e;
    border-radius: 20px;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    width: 600px;
}

.alert-success {
    position: relative;
    background-color: #16D300;
    border-radius: 20px;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    width: 600px;
}
  </style>
</br>
  <center>
			<?php
            if (isset($error)) {
                echo "<center><br/><h5>" . $error . "</h5></center>";
            } elseif (isset($success)) {
                echo "<center><br/><h5>" . $success . "</h5></center>";
            }
            ?>
  </br>
  <form method="post">
    <div class="form">
      <div class="title">Login</div>
      <div class="input-container ic1">
        <input id="username" class="input" name="username" type="text" placeholder=" " />
        <div class="cut"></div>
        <label id="text" type="text" name="username" tabindex="1" class="placeholder">Username</label>
      </div>
      <div class="input-container ic2">
        <input id="password" class="input" name="password" type="password" placeholder=" " />
        <div class="cut"></div>
        <label id="password" type="text" name="password" tabindex="1"  class="placeholder">Password</>
      </div>
      <button  type="submit" class="submit">Login</button>
    </div>
  </form>
    <br />
    <p class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p>
<br>
  </center>
</html>
