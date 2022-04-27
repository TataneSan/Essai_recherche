<?php
    error_reporting(0);
    session_start();

    require_once "config/configuration.php";
    require_once "config/functions.php";

	$stats = new stats();

    ?>
 <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Home</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet" />
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" type="78c660154121d7f22531e64f-text/javascript"></script>
<?php

if(isset($_POST["search"])) {
        $errors = array();

    if(!isset($_SESSION["id"])) {
            $error = error("You must be logged in to search.");
            array_push($errors, "You must be logged in to search.");
    }

    if(empty($_POST["research"])) {
        $error = error("Please verify all fields.");
        array_push($errors, "Please verify all fields.");
    }

    $research = $_POST["research"];
    
    $checkCooldown = $database->prepare("SELECT * FROM logs WHERE `date` + :cooldown > UNIX_TIMESTAMP() AND searcher = :username");
    $checkCooldown->execute(["username" => $_SESSION["username"], "cooldown" => "3"]);
    if($checkCooldown->fetchColumn(0) > 0) {
        $error = error("Please wait 3 seconds enter each research.");
        array_push($errors, "Please wait 3 seconds enter each research.");
    }
	


    if(strstr($research, "@") && strlen($research) < 15) {
        $error = error("Nice try :)");
        array_push($errors, "Nice try :)");
    }

    if(strstr($research, "protonmail") && strlen($research) < 19) {
        $error = error("Nice try :)");
        array_push($errors, "Nice try :)");
    }

    if(strstr($research, "ORANGE") || strstr($research, "nmail") || strstr($research, "tmail") || strstr($research, "FREE") || strstr($research, "YAHOO") || strstr($research, "SFR") || strstr($research, "HOTMAIL") || strstr($research, "OUTLOOK") || strstr($research, "GMAIL") || strstr($research, "PROTON") || strstr($research, "GMX") || strstr($research, "LAPOSTE") || strstr($research, "ICLOUD") || strstr($research, "LIVE") || strstr($research, "WANADOO") || strstr($research, "orange") || strstr($research, "free") || strstr($research, "yahoo") || strstr($research, "sfr") || strstr($research, "hotmail") || strstr($research, "outlook") || strstr($research, "gmail") || strstr($research, "proton") || strstr($research, "gmx") || strstr($research, "laposte") || strstr($research, "icloud") || strstr($research, "live") || strstr($research, "wanadoo")) {
        if(strlen($research) < 15) {
            $error = error("Sah quel plaisir !");
            array_push($errors, "Sah quel plaisir !");
        }
    }

    if(strstr($research, "'") || strstr($research, "|") || strstr($research, "\\") || strstr($research, "#") || strstr($research, "&") || strstr($research,"%") || strstr($research, "=") || strstr($research, "$") || strstr($research, "FROM") || strstr($research, "LIKE") || strstr($research, "order") || strstr($research, "ORDER") || strstr($research, ";") || strstr($research, ")") || strstr($research, "*") || strstr($research, "+") || strstr($research, "/") || strstr($research, "{") || strstr($research, "}") || strstr($research, ">") || strstr($research, "<") || strstr($research, '"') || strstr($research, "!") || strstr($research, "^") || strstr($research, "[") || strstr($research, "]") || strstr($research, "{") || strstr($research, ",") || strstr($research, "£") || strstr($research, "´") || strstr($research, "`") || strstr($research, "~") || strstr($research, "«") || strstr($research, "»") || strstr($research, "¯")) {
        $error = error("Nice try :)");
        array_push($errors, "Nice try :)");
    }

    if(strstr($research, ".") && strlen($research) < 11) {
        $error = error("Your search cannot contain this kind of characters");
        array_push($errors, "Your search cannot contain this kind of characters.");
    }

    if(strstr($research, ":") && strlen($research) < 20) {
        $error = error("Your search cannot contain this kind of characters");
        array_push($errors, "Your search cannot contain this kind of characters.");
    }

    if(strlen($research) < 3) {
        $error = error("Please check that your search is at least 5 characters long.");
        array_push($errors, "Please check that your search is at least 5 characters long.");
    }

    $checkBlacklist = $database->prepare("SELECT * FROM blacklist WHERE bl_username LIKE :username OR bl_email LIKE :email OR bl_ip LIKE :ip OR bl_uuid LIKE :uuid");
    $checkBlacklist->execute(["username" => "%{$research}%", "email" => "%{$research}%", "ip" => "%{$research}%", "uuid" => "%{$research}%"]);
    if($checkBlacklist->fetchColumn(0) > 0) {
        $error = error("This target is blacklisted.");
        array_push($errors, "This target is blacklisted.");
    }

        if(sizeof($errors) < 1) {
            $getURL = $database->prepare("SELECT * FROM api");
            $getURL->execute();

            $getApi = $getURL->fetch(PDO::FETCH_ASSOC);
            $url = $getApi["url"];
			
			if(strstr($research, "@")) {
				if(filter_var($research, FILTER_VALIDATE_EMAIL)) {
					$target = ",".$research.",";
				}
			} else {
				$target = $research.",";
			}
			
			if(strstr($research, ".")) {
				if(filter_var($research, FILTER_VALIDATE_IP)) {
					$target = ",".$research.",";
				}
			} else {
				$target = $research.",";
			}
			
			if(strstr($research, "-")) {
				$target = ",".$research;
			} else {
				$target = $research.",";
			}
						
            $arrayFind = array("[username]", "[target]");
            $arrayReplace = array($_SESSION["username"], "$target");
            $api = str_replace($arrayFind, $arrayReplace, $url);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            curl_close($ch);

            if(!$result) {
                $error = error("Nothing was found.");
            } else {
                $updateLogs = $database->prepare("INSERT INTO logs VALUES(NULL, :search, :username, UNIX_TIMESTAMP())");
                $updateLogs->execute(["search" => $research, "username" => $_SESSION["username"]]);
            }

        }
    }
    ?>
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
.form2 {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 175px;
  padding: 20px;
  width: 400px;
}

table {
  border-collapse: collapse;
}

        }
    </style>
</script></head>
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
<a href=" " class="block">
<h1 class="font-medium text-3xl mr-4">
MineLeaks
</h1>
</a>
<div class="hidden lg:flex">
<a href="/" class="transition duration-700 ease-in-out px-8 py-2 rounded-md text-2x1 font-medium text-gray-300 bg-gray-800 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Search</a>
<a href="/blacklist" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">BlackList</a>
<a href="/dox" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Dox</a>
<a href="https://discord.gg/mineleaks-fun" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Discord</a>
<a href="/tos" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">ToS</a>
  <?php  if($_SESSION["admin"] == "1") {
        echo'<a href="/admin/" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 bg-red-800 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Admin</a>';
    }
    ?>
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
<div id="particles"></div>
<div class="w-full particles max-w-screen-xl relative mx-auto px-6 pt-16 pb-40 md:pb-24">

<div class="lg:hidden flex justify-center content-center">
                        <?php
                        if(!isset($_SESSION["id"])) {
                            echo '
<a href="/register" class="transition duration-700 ease-in-out rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-blue-500 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Register</a>
<a href="/login" class="transition duration-700 ease-in-out ml-4 rounded-lg px-4 md:px-5 xl:px-4 py-3 md:py-4 xl:py-3 bg-green-600 hover:bg-red-600 md:text-lg xl:text-base text-white font-semibold leading-tight shadow-md">Login</a>';
}
?>

<br>

</div>
<div class="xl:flex -mx-6">
<div class="px-6 text-gray-200 text-center animate__animated animate__fadeInUp animate__slow md:text-center xl:text-center max-w-2xl md:max-w-3xl mx-auto"><span class="text-2xl">Search over
<span class="text-blue-500 font-medium">18,551,039</span>
lines !</span>
	

<br />

</h1>
<br />
<form method="post">
  <div class="inline-block relative w-200" style="width: 400px;">
     <input class="transition-colors duration-100 ease-in-out bg-gray-700 text-gray-200 shadow-md focus:outline-none border border-transparent placeholder-gray-500 rounded-lg py-2 pr-4 pl-4 block w-full appearance-none leading-normal ds-input" type="text" name="research" placeholder="🔍   Search..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-label="search input" dir="auto" style="position: relative; vertical-align: top;" />
  </div>
<br />
<div class="inline-block relative w-40">
<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-300">
</div>
</div>
<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>

        /* if you prefer to functionize and use onclick= rather then the .on bind
        function hide_show(){
            $(this).hide();
            $("#hidden-div").show();
        }
        */

        $(function(){
            $("#chkbtn").on('click',function() {
                $(this).hide();
                $("#hidden-div").show();
            }); 
        });
    </script>
    <style>
    .hidden-div {
        display:none
    }
    </style>
     <center><button type="submit" name="search" id="chkbtn" class="transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-103 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
Search
     </button>
		 </center>
</form>
</br>
    <style>
        th {
  height: 70px;
}
th, td {
font-size: 12px;
  padding: 5px;
  text-align: left;
  width: 300px;
}
		
.btncrack {
	margin-bottom: 0px;
	margin-left: 0px;
}
h5 {
    position: relative;  background-color: #e53e3e;border-radius: 20px;box-sizing: border-box;height: auto; padding: 10px;width: 500px;
    }
    </style>
            <h2 style="" class="text-2xl text-left"> </h2>
                          <?php
            if (isset($error)) {
                echo "<center><br/><h5>" . $error . "</h5></center>";
            } elseif (isset($success)) {
                echo "<br/>" . $success . "";
            }
            ?>
        </br>
<center>
	
<script>
        
	$(document).on('click', "[id*='crack']", function() {
            
		var hash = $("button#"+this.id).parent().get(0).firstChild.text;
		var button = $("button#"+this.id);
		$(button).hide();

		$.ajax(
		{
			url: "/decrypt.php",
			method: "POST",
			data: {'hash':hash},
			datatype: 'json',
			success: function(data) {
				if(data === '') {
					$(button).parent().append("Not Found ! Maybe try on <a target='_blank' style='color: dodgerblue;' href='https://hashes.com'>hashes.com</a>");
					$(button).parent().css("color", "orange");
				}
				else {
					$(button).parent().append("Found : ", data);
					$(button).parent().css("color", "limegreen");
				}
			}
		});
	})
</script>
	
        <div style="position: relative;">
                                        <?php
                                            if(isset($result)) {
												                                                    echo '
																									            <div style="position: relative;  background-color: #15172b;border-radius: 20px;box-sizing: border-box;height: auto; padding: 20px;width: 1500px; right: 390px;">
<table style="">
                                    <tr>
                                        <th style="border: 2px solid black;" scope="col">Username</th>
                                        <th style="border: 2px solid black;" scope="col">Email</th>
                                        <th style="border: 2px solid black;" scope="col">Password</th>
                                        <th style="border: 2px solid black;" scope="col">IP</th>
                                        <th style="border: 2px solid black;" scope="col">UUID</th>
                                    </tr>';
                                                $line = explode("\n",$result);

                                                for ($start=0; $start < count($line); $start++) {

                                                    $username = explode(",", $line[$start])[0];
                                                    $email = explode(",", $line[$start])[1];
                                                    if(strlen(explode(",", $line[$start])[2]) < 32 || strstr(explode(",", $line[$start])[2], "$")){
                                                        $password = explode(",", $line[$start])[2];
                                                    } else {
                                                        $password = "<a id='hash-" . $start . "'>" . explode(",", $line[$start])[2] . "</a><br /><button class='btncrack transition duration-500 ease-in-out transform hover:scale-103 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded' id='crack-". $start . "'>Crack Me</button>";
                                                    }

                                                    
                                                    $ip = explode(",", $line[$start])[3];
                                                    $uuid = explode(",", $line[$start])[4];

                                                    echo '
                                    <tbody>
                                                    <tr>
                                                    <th style="border: 2px solid black;">'.$username.'</th>
                                                    <th style="border: 2px solid black;">'.$email.'</th>
                                                    <th style="border: 2px solid black;">'.$password.'</th>
                                                    <th style="border: 2px solid black;">'.$ip.'</th>
                                                    <th style="border: 2px solid black;">'.$uuid.'</th>
                                                    </tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
	</center>
                                                  
<center>
<br>
<br>
<div style="width: 350px; height: 300px; margin-bottom: 15px" class="col-span-6 sm:col-span-2 bg-gray-800 text-gray-200 rounded-lg p-4 animate__fadeIn animate__animated animate__delay-1s mt-10">
<br>
<img style="display: block; margin: 0 auto; width: 110px; height: 110px;" src="leaked.png" alt="MineLeaks" />
<h1 class="font-medium text-2xl">Search</h1>
<p>
<br />
Searches are free and unlimited. <br />
All searches are anonymous.
</p>
</center>
<br />
<br />
<br />
<br />
<br />
<p style="margin-top: 5px;"class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p>
</div>
</div>
<div style="margin-bottom: -160px;"class="flex inline justify-center"><br>
</div>
</body>
</html>
