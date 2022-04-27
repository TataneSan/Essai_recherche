<?php
    error_reporting(0);
    session_start();

    require_once "../config/configuration.php";
    require_once "../config/functions.php";

    $pageName = "Dox";

    $stats = new stats();
    $totalUsers = $stats->totalUsers($database);
    $totalSearch = $stats->totalSearch($database);

    if(isset($_POST["create_dox"])) {
        $errors = array();

        if(!isset($_SESSION["id"])) {
            $error = error("You must be logged in.");
            array_push($errors, "You must be logged in.");
         }

        if(empty($_POST["title"]) || empty($_POST["content"])) {
            $error = error("Please verify all fields");
            array_push($errors, "Please verify all fields");
        }

        $doxTitle = htmlspecialchars($_POST["title"]);
        $doxContent = htmlspecialchars($_POST["content"]);
        $doxAuthor = htmlspecialchars($_SESSION["username"]);

        if(strlen($doxTitle) > 40) {
            $error = error("The title must be less than 40 characters long.");
            array_push($errors, "The title must be less than 40 characters long.");
        }

        if(strlen($doxContent) < 30) {
            $error = error("The content must be more than 30 characters long.");
            array_push($errors, "The content must be more than 30 characters long.");
        }
        
        if(strstr($doxContent, "SELECT") || strstr($doxContent, "FROM") || strstr($doxContent, "NULL") || strstr($doxContent, "AND") || strstr($doxContent, "WHERE") || strstr($doxContent, "LIKE") || strstr($doxContent, "script")) {
            $error = error("Nice try ;)");
            array_push($errors, "Nice try ;)");
        }

        if(sizeof($errors) < 1) {
            $addDox = $database->prepare("INSERT INTO doxs VALUES(NULL, :title, :content, :author, UNIX_TIMESTAMP(), 0, 0)");
            $addDox->execute(["title" => $doxTitle, "content" => $doxContent, "author" => $_SESSION["username"]]);
            $success = success("Your dox has been sent successfully, please wait while the administration checks it.");
        }

    }

?>

 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Dox</title>
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
<div class="flex z-100 text-gray-200  inset-x-0 top-0 border-b-2 border-gray-800 lg:border-b-0 items-center">
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
<a href="/blacklist" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">BlackList</a>
<a href="/dox" class=" bg-gray-800 transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Dox</a>
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
  height: 500px;
  padding: 20px;
  width: 550px;
}

.form2 {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 175px;
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
    <div style="color: white;">
                          <?php
            if (isset($error)) {
                echo "<center><br/><h5>" . $error . "</h5></center>";
            } elseif (isset($success)) {
                echo "<br/>" . $success . "";
            }
            ?>
              </div>
  </br>
  <div class="form">
       <form method="post">
                                    <h4 class="title">Post a dox</h4>
                                    <br/>
                                    <input style="height: 50px; width: 500px;" type="text" name="title" class="input" placeholder="Title">
                                    <br/>
                                </br>
                                    <textarea class="input" name="content" placeholder="Content" style="margin-top: 0px; margin-bottom: 0px; height: 175px; width: 500px; resize: horizontal;"></textarea>
                                    <center><button style="height: 50px; width: 150px; "type="submit" name="create_dox" class="submit">Create Dox</button></center>
                                </form>
                            </div>
    <br />
      <style>
        th {
  height: 70px;
  width: 0%;
}
th, td {
  padding: 15px;
  text-align: left;
  color: #eee;
}
    </style>
    <div>
            <h2 style="" class="text-2xl text-left"> </h2>
                            <h4 class="title">List of dox</h4>
                            <br />
                        </div>
<table class="rounded-lg" style="border: 2px solid black; border-collapse: collapse; background-color: #15172b; height: 75px; width: 1000px;">
                                    <thead>
                                    <tr>
                                        <th style="border: 2px solid black;" scope="col">Title</th>
                                        <th style="border: 2px solid black;" scope="col">Author</th>
                                        <th style="border: 2px solid black;" scope="col">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $getInformations = $database->query("SELECT * FROM doxs WHERE blacklisted = 0 AND approved = 1");
                                        while($doxInformations = $getInformations->fetch(PDO::FETCH_ASSOC)) {

                                            $doxID = $doxInformations["id"];
                                            $doxTitle = htmlspecialchars($doxInformations["title"]);
                                            $doxAuthor = htmlspecialchars($doxInformations["author"]);
                                            $doxDate = $doxInformations["create_date"];

                                            echo '
                                                <tr>
                                                    <td style="border: 2px solid black;"><a href="/doxs.php?id='.$doxID.'">'.$doxTitle.'</td>
                                                    <td style="border: 2px solid black;">'.$doxAuthor.'</td>
                                                    <td style="border: 2px solid black;">'._ago($doxDate).'</td>
                                                </tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <br/>
                                                                <p class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p><br />
                            </div>
<center>
  </center>
</html>
