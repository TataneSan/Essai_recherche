<?php

    ob_start();
    session_start();

    if(isset($_SESSION["id"])) {
        header("Location: /");
        exit();
    }

    require_once "../config/configuration.php";
    require_once "../config/functions.php";

    $pageName = "Register";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = array();

        if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) ||empty($_POST["repeat_password"])) {
            $error = error("Please verify all fields.");
            array_push($errors, "Please verify all fields.");
        }

        if (empty($_POST['g-recaptcha-response'])) {
          $error = error("Please fill the captcha.");
          array_push($errors, "Please fill the captcha.");
        }

        $captcha = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode("6LeKUY0bAAAAACtcfFApNhnK2GwhhqfjFRIwj5r-") . '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if (!$responseKeys["success"]) {
          $error = error("Please fill the captcha.");
          array_push($errors, "Please fill the captcha.");
        } 

        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $cpassword = htmlspecialchars($_POST["repeat_password"]);
        


        if($password != $cpassword) {
            $error = error("The passwords do not match.");
            array_push($errors, "The passwords do not match.");
        }

        if(strlen($password) < 6 | strlen($cpassword) < 6) {
            $error = error("Your password must be at least 6 characters long");
            array_push($errors, "Your password must be at least 6 characters long");
        }

        if(strlen($username) < 5) {
            $error = error("Your username must be between 5 and 15 characters long.");
            array_push($errors, "Your username must be between 5 and 15 characters long.");
        }

        if(strlen($username) > 15) {
            $error = error("Your username must be between 5 and 15 characters long.");
            array_push($errors, "Your username must be between 5 and 15 characters long.");
        }

        if(!ctype_alnum($username)) {
            $error = error("Your username is invalid, some characters are not allowed.");
            array_push($errors, "Your username is invalid, some characters are not allowed.");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = error("Your email seems invalid, please enter a valid email.");
            array_push($errors, "Your email seems invalid, please enter a valid email.");
        }
        
        if (!domainWhiteList($email)) {
           $error = error('Email domain is blacklisted, in case of error, please contact administrator');
           array_push($errors, "Email domain is blacklisted, in case of error, please contact administrator");
        }

        $usernameCheck = $database->prepare("SELECT * FROM users WHERE username = :username");
        $usernameCheck->execute(["username" => $username]);
        $usernameResult = $usernameCheck->fetchAll();

        if(!empty($usernameResult)) {
            $error = error("A user with the same username is already registered.");
            array_push($errors, "A user with the same username is already registered.");
        }

        $emailCheck = $database->prepare("SELECT * FROM users WHERE email = :email");
        $emailCheck->execute(["email" => $email]);
        $emailResult = $emailCheck->fetchAll();

        if(!empty($emailResult)) {
            $error = error("A user with the same email address is already registered.");
            array_push($errors, "A user with the same email address is already registered.");
        }

        if(sizeof($errors) < 1) {
            $userCreate = $database->prepare("INSERT INTO users VALUES(NULL, :username, :email, :password, 0, :registered_ip, :last_ip, UNIX_TIMESTAMP())");
            $userCreate->execute(["username" => $username, "email" => $email, "password" => $password, "registered_ip" => $_SERVER["HTTP_CF_CONNECTING_IP"], "last_ip" => $_SERVER["HTTP_CF_CONNECTING_IP"]]);
            $success = success("You are now registered, you can connect!");

            header('refresh:2; url=/login');
        }

    }
    
        function domainWhiteList($email)
    
    {
       if (endsWith($email, "outlook.fr")) return true;
       if (endsWith($email, "outlook.com")) return true;
       if (endsWith($email, "hotmail.com")) return true;
       if (endsWith($email, "hotmail.fr")) return true;
       if (endsWith($email, "yahoo.com")) return true;
       if (endsWith($email, "yahoo.fr")) return true;
       if (endsWith($email, "msn.com")) return true;
       if (endsWith($email, "msn.fr")) return true;
       if (endsWith($email, "gmail.com")) return true;
	   if (endsWith($email, "orange.fr")) return true;
       if (endsWith($email, "googlemail.com")) return true;
       if (endsWith($email, "wanadoo.com")) return true;
       if (endsWith($email, "wanadoo.fr")) return true;
       if (endsWith($email, "sfr.fr")) return true;
       if (endsWith($email, "protonmail.com")) return true;
       if (endsWith($email, "yandex.ru")) return true;
       if (endsWith($email, "live.fr")) return true;
	   if (endsWith($email, "icloud.com")) return true;
       return false;
    }
    
    function endsWith($haystack,$needle) 
    {
        return substr($haystack, -strlen($needle))===$needle;
    }


?>
 <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Register</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='shortcut icon' type='image/x-icon' href='/assets/img/favicon.png' />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet" />
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" type="78c660154121d7f22531e64f-text/javascript"></script>
<script src="//www.google.com/recaptcha/api.js"></script>
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
<a href="/login" class="transition duration-700 ease-in-out ml-4 rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-green-600 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Login</a>
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
<a href="/login" class="transition duration-700 ease-in-out ml-4 rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-green-600 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Login</a>';
}
?>
</div>
<style>

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 620px;
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

.form3 {
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
    background-color: #1BB619;
    border-radius: 20px;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    width: 600px;
}
  </style>
</br>
  <center>
  </br>
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
      <div class="title">Register</div>
      <div class="input-container ic1">
        <input id="username" class="input" type="text" name="username" placeholder=" " />
        <div class="cut"></div>
        <label for="username" class="placeholder">Username</label>
      </div>
      <div class="input-container ic2">
        <input id="mail" class="input" type="text" name="email" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="mail" class="placeholder">Mail</label>
      </div>
      <div class="input-container ic2">
        <input id="password" class="input" type="password" name="password" placeholder=" " />
        <div class="cut"></div>
        <label for="password" class="placeholder">Password</>
      </div>
         <div class="input-container ic2">
        <input id="rpassword" class="input" type="password" name="repeat_password" placeholder=" " />
        <div class="cut"></div>
        <label for="rpassword" class="placeholder">Password</>
      </div>
      <div class="input-container ic2">
        <div class="g-recaptcha" data-sitekey="6LeKUY0bAAAAAIFpH91Cf3tJ19Y7JJPr98Y_9DnA"> </div>
      </div>
      <button type="submit" class="submit">Register</button>
    </div>
  </form>
    <br />
    <p class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p>
<br>
  </center>
</html>
