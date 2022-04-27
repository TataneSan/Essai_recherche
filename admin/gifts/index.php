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

    $pageName = "Gift";

    $stats = new stats();
    $totalUsers = $stats->totalUsers($database);
    $totalSearch = $stats->totalSearch($database);

    if(isset($_POST["create_gift"])) {
        $code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 15);
        $createGift = $database->prepare("INSERT INTO code VALUES(NUll, :code, 0, 0, UNIX_TIMESTAMP())");
        $createGift->execute(["code" => $code]);
        $success = success("New gift created with success.");
    }

?>

 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - Gifts</title>
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

.form3 {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 100px;
  padding: 20px;
  width: 200px;
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
<center>
</br>
                    </br>
                            <div class="form2">
                                <form method="post">
                                    <center><button type="submit" name="create_gift" class="submit">Create Gift</button></center>
                                </form>
                            </div>
                        </br>
<style>
        th {
  height: 70px;
  width: 70%;
}
th, td {
  padding: 15px;
  text-align: left;
  width: 300px;
  border: 2px solid black;
  color: white;
}

</style>
                                   <table style="border: 2px solid black; border-collapse: collapse; background-color: #15172b; ">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">CODE</th>
                                            <th scope="col">CLAIMED</th>
                                            <th scope="col">CLAIMED BY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $getGifts = $database->query("SELECT * FROM code");
                                            while ($getInformations = $getGifts->fetch(PDO::FETCH_ASSOC)) {
                                                $giftID = $getInformations["id"];
                                                $giftCode = $getInformations["code"];
                                                $giftClaimed = $getInformations["claimed"];
                                                $giftUsername = $getInformations["username"];

                                                if($giftClaimed == 0) {
                                                    $giftClaimed = '<a><i data-feather="x-circle"></i></a>';
                                                } else {
                                                    $giftClaimed = '<a><i data-feather="check-circle"></i></a>';
                                                }

                                                if(is_numeric($giftUsername)) {
                                                    $giftClaimedBy = '<a><i data-feather="x-circle"></i></a>';
                                                } else {
                                                    $giftClaimedBy = $giftUsername;
                                                }

                                                echo '<tr>
                                           <td>'.$giftID.'</td>
                                           <td>'.htmlspecialchars($giftCode).'</td>
                                           <td>'.$giftClaimed.'</td>
                                           <td>'.$giftClaimedBy.'</td>
                                        </tr>';

                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</center>

</html>
