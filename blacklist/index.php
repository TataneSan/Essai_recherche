<?php
    error_reporting(0);
    session_start();

    require_once "../config/configuration.php";
    require_once "../config/functions.php";

    if(isset($_POST["blacklist"])) {
    $errors = array();

    if(!isset($_SESSION["id"])) {
            $error = error("You must be logged in.");
            array_push($errors, "You must be logged in.");
         }

    if(empty($_POST["bl_username"]) || empty($_POST["bl_email"]) || empty($_POST["bl_ip"]) || empty($_POST["bl_uuid"]) || empty($_POST["blacklist_code"])) {
        $error = error("Please verify all fields.");
        array_push($errors, "Please verify all fields.");
    }

    $blacklistUsername = htmlspecialchars($_POST["bl_username"]);
    $blacklistEmail = htmlspecialchars($_POST["bl_email"]);
    $blacklistIP = htmlspecialchars($_POST["bl_ip"]);
    $blacklistUUID = htmlspecialchars($_POST["bl_uuid"]);
    $blacklistCode = htmlspecialchars($_POST["blacklist_code"]);

    if(strstr($blacklistUsername, " ")) {
        $error = error("You can blacklist only one username.");
        array_push($errors, "You can blacklist only one username.");
    }
    if(strstr($blacklistEmail, " ")) {
        $error = error("You can blacklist only one email.");
        array_push($errors, "You can blacklist only one email.");
    }
    if(strstr($blacklistIP, " ")) {
        $error = error("You can blacklist only one ip.");
        array_push($errors, "You can blacklist only one ip.");
    }
    if(strstr($blacklistUUID, " ")) {
        $error = error("You can blacklist only one UUID.");
        array_push($errors, "You can blacklist only one UUID.");
    }

    if(!filter_var($blacklistEmail, FILTER_VALIDATE_EMAIL)) {
        $error = error("Please enter a valid email.");
        array_push($errors, "Please enter a valid email.");
    }
    if(!filter_var($blacklistIP, FILTER_VALIDATE_IP)) {
        $error = error("Please enter a valid ip.");
        array_push($errors, "Please enter a valid ip.");
    }
    if(!strstr($blacklistUUID, "-")) {
        $error = error("Please enter a valid UUID.");
        array_push($errors, "Please enter a valid UUID.");
    }
    if(strlen($blacklistUsername) < 3) {
        $error = error("Please enter a valid username.");
        array_push($errors, "Please enter a valid username.");
    }

    $checkGift = $database->prepare("SELECT * FROM code WHERE code = :code");
    $checkGift->execute(["code" => $blacklistCode]);
    $arrayGift = $checkGift->fetch(PDO::FETCH_ASSOC);
    $giftCount = $checkGift->rowCount();

    if(!$giftCount) {
        $error = error("Your blacklist code is invalid.");
        array_push($errors, "Your blacklist code is invalid.");
    }

    if($arrayGift["claimed"] == 1) {
        $error = error("Your code is already claimed. If it is an error please contact support on Discord.");
        array_push($errors,"Your code is already claimed. If it is an error please contact support on Discord.");
    }

    if(sizeof($errors) < 1) {
        $updateGift = $database->prepare("UPDATE code SET claimed = 1, date = UNIX_TIMESTAMP(), username = :username WHERE code = :code");
        $updateGift->execute(["username" => $_SESSION["username"], "code" => $blacklistCode]);

        $addBlacklist = $database->prepare("INSERT INTO blacklist VALUES(NULL, :username, :bl_username, :bl_email, :bl_ip, :bl_uuid, UNIX_TIMESTAMP())");
        $addBlacklist->execute(["username" => $_SESSION["username"], "bl_username" => $blacklistUsername, "bl_ip" => $blacklistIP, "bl_email" => $blacklistEmail, "bl_uuid" => $blacklistUUID]);

        $success = success("Blacklist added with success. You will be in the blacklist soon");

    }

}

    ?>
 <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Blacklist</title>
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
<style>
.coucou { 
display: inline-block; 
position: absolute; 
background-color: #1a202c;
top: 0; 
left: 0; 
z-index: -1; 
} 
.vague { 
display: inline-block; 
position: absolute; 
width: 100%; 
top: 0; 
left: 0; 
} 
</style>
<div class="vague"> 
<svg class="coucou" viewBox="0 0 500 250" preserveAspectRatio="xMinYMin meet">
    <path d="M0, 180 C120, 180 150, 0 500, 180 L500, 00 L0, 0 Z" style="stroke:none; fill: #12161E;"></path> 
</svg>
<body class="bg-gray-900">
<div id="header" class="bg-gray-800">
<div class="vague">
<div class="flex z-100 text-gray-200 inset-x-0 top-0 border-b-2 border-gray-800 lg:border-b-0 items-center">
<div class="w-full relative mx-auto px-6">
<div class="lg:border-b-2 lg:border-gray-700 h-20 flex flex-col justify-center">
<div class="flex items-center -mx-6">
<div class="lg:w-1/4 xl:w-1/5 pl-6 pr-6">
<div class="flex items-center">
<a href="/" class="block">
<h1 class="font-medium text-3xl mr-4">
MineLeaks
</h1>
</a>
<div class="hidden lg:flex">
<a href="/" class="transition duration-700 ease-in-out px-8 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Search</a>
<a href="/blacklist" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 bg-gray-800 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">BlackList</a>
<a href="/dox" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Dox</a>
<a href="https://discord.com/invite/mineleaks-fun" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Discord</a>
<a href="/tos" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">ToS</a>
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
                    <?php
                        if(!isset($_SESSION["id"])) {
                            echo '
<a href="/register" class="transition duration-700 ease-in-out rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-blue-500 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Register</a>
<a href="/login" class="transition duration-700 ease-in-out ml-4 rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-green-600 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Login</a>';
                        }
                    ?>
                                                            <?php
                        if(isset($_SESSION["id"])) {
                            echo '
<a href="/logout" class="transition duration-700 ease-in-out rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-red-600 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Logout</a>';
                        }
                    ?>
</div>
</div>
</div>
</div>
</div>
</div>
<style>

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 650px;
  padding: 20px;
  width: 320px;
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
h5 {
    position: relative;  background-color: #e53e3e;border-radius: 20px;box-sizing: border-box;height: auto; padding: 10px;width: 500px;
    }
  </style>
</br>
  <center>
    <div class="form2">
      <button style="position: relative; bottom: 33px;" onclick="window.open('https://shoppy.gg/product/yJmRwcD');"  class="submit">Buy a Code</button>
    </div>
<div style="color: white;">
                          <?php
            if (isset($error)) {
                echo "<center><br/><h5>" . $error . "</h5></center>";
            } elseif (isset($success)) {
                echo "<br/>" . $success . "";
            }
            ?>
  </br>
  <form method="post">
    <div class="form">
      <div class="title">BlackList</div>
      <div class="subtitle">Must get a code before blacklist</div>
      <div class="input-container ic1">
        <input name="bl_username" id="username" class="input" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="username" class="placeholder">Username</label>
      </div>
      <div class="input-container ic2">
        <input name="bl_email" id="mail" class="input" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="mail" class="placeholder">Mail</label>
      </div>
      <div class="input-container ic2">
        <input name="bl_ip" id="ip" class="input" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="ip" class="placeholder">IP</>
      </div>
            <div class="input-container ic2">
        <input name="bl_uuid" id="uuid" class="input" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="uuid" class="placeholder">UUID</>
      </div>
                  <div class="input-container ic2">
        <input name="blacklist_code" id="uuid" class="input" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="uuid" class="placeholder">Code</>
      </div>
      <button type="text" name="blacklist" class="submit">Submit</button>
    </div>
  </form>
    <br />
    <p class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p>
<br>
  </center>
</html>
