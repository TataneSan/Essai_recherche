<?php

    error_reporting(0);
    session_start();

    if(!isset($_SESSION["id"])) {
        header("Location: /login");
        exit();
    }

    if($_SESSION["admin"] == "0") {
        header("Location: /");
        exit();
    }

    require_once "../../config/configuration.php";
    require_once "../../config/functions.php";

    $pageName = "Dox";

    $stats = new stats();
    $totalUsers = $stats->totalUsers($database);
    $totalSearch = $stats->totalSearch($database);

    if(isset($_POST["blacklist_dox"])) {
        $doxID = $_POST["blacklist_dox"];
        $checkBlacklist = $database->prepare("SELECT * FROM doxs WHERE id = :doxID");
        $checkBlacklist->execute(["doxID" => $doxID]);

        $arrayBlacklist = $checkBlacklist->fetch(PDO::FETCH_ASSOC);
        $blacklisted = $arrayBlacklist["blacklisted"];

        if($blacklisted == 1) {
            $error = error("The dox is already blacklisted.");
        } else {
            $blacklistDox = $database->prepare("UPDATE doxs SET blacklisted = 1 WHERE id = :doxID");
            $blacklistDox->execute(["doxID" => $doxID]);
            $success = success("The dox has been blacklisted with success.");
        }
    }

    if(isset($_POST["approved_dox"])) {
        $doxID = $_POST["approved_dox"];
        $checkApproved = $database->prepare("SELECT * FROM doxs WHERE id = :doxID");
        $checkApproved->execute(["doxID" => $doxID]);

        $arrayApproved = $checkApproved->fetch(PDO::FETCH_ASSOC);
        $approved = $arrayApproved["blacklisted"];

        if($approved == 1) {
            $error = error("The dox is already approved.");
        } else {
            $approvedDox = $database->prepare("UPDATE doxs SET approved = 1 WHERE id = :doxID");
            $approvedDox->execute(["doxID" => $doxID]);
            $success = success("The dox has been approved with success.");
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
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script></head>
</div>
</div>
</div>
</div>
<body class="bg-gray-900">
<div id="header" class="bg-gray-900">
<div class="bg-gray-900 lg:pt-0">
<div class="flex z-100 text-gray-200 bg-gray-900 inset-x-0 top-0 border-b-2 border-gray-800 lg:border-b-0 items-center">
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
<a href="/dox" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Dox</a>
<a href="https://discord.gg/WDFFqz5kDE" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Discord</a>
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
  margin-top: 2px;
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

  </style>
<style>
        th {
  height: 70px;
  width: 70%;
}
th, td {
  padding: 11px;
  text-align: left;
 font-size: 15px;
  width: 10px;
  border: 2px solid black;
  color: white;
  column-width: 45rem;
}

</style>
                                <table class="rounded-lg" style="border: 2px solid black; border-collapse: collapse; background-color: #15172b; margin-top: 50px; margin-left: 50px;">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">TITLE</th>
                                        <th scope="col" >CONTENT</th>
                                        <th scope="col">AUTHOR</th>
                                        <th scope="col">CREATED DATE</th>
                                        <th scope="col">BLACKLISTED</th>
                                        <th scope="col">APPROVED</th>
                                        <th scope="col">BLACKLIST DOX</th>
                                        <th scope="col">APPROVED DOX</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form method="post">
                                        <?php
                                        $getDoxs = $database->query("SELECT * FROM doxs");
                                        while ($getInformations = $getDoxs->fetch(PDO::FETCH_ASSOC)) {

                                            $doxID = $getInformations["id"];
                                            $doxTitle = $getInformations["title"];
                                            $doxContent = $getInformations["content"];
                                            $doxAuthor = $getInformations["author"];
                                            $doxCreateDate = $getInformations["create_date"];
                                            $doxBlacklisted = $getInformations["blacklisted"];
                                            $doxApproved = $getInformations["approved"];

                                            if($doxBlacklisted == 0) {
                                                $doxBlacklisted = 'NO';
                                            } else {
                                                $doxBlacklisted = 'YES';
                                            }

                                            if($doxApproved == 0) {
                                                $doxApproved = 'NO';
                                            } else {
                                                $doxApproved = 'YES';
                                            }


                                            echo '<tr>
                                           <td>'.$doxID.'</td>
                                           <td>'.htmlspecialchars($doxTitle).'</td>
                                           <td>'.htmlspecialchars($doxContent).'</td>
                                           <td>'.htmlspecialchars($doxAuthor).'</td>
                                           <td>'._ago($doxCreateDate).'</td>
                                           <td>'.$doxBlacklisted.'</td>
                                           <td>'.$doxApproved.'</td>
                                            <td><button class="btn btn-outline-danger mb-2 mixin" name="blacklist_dox" value="'.htmlspecialchars($doxID).'">Blacklist</button></td>
                                            <td><button class="btn btn-outline-success mb-2 mixin" name="approved_dox" value="'.htmlspecialchars($doxID).'">Approved</button></td>
                                        </tr>';

                                        }
                                        ?>
                                    </form>
                                    </tbody>
                                </table>
                            </br>
</html>
