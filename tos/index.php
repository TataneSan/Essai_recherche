<?php
    error_reporting(0);
    session_start();

?>

 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MineLeaks - ToS</title>
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
<a href="/dox" class=" transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Dox</a>
<a href="https://discord.com/invite/mineleaks-fun" class="transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">Discord</a>
<a href="/tos" class="bg-gray-800 transition duration-700 ease-in-out ml-4 px-3 py-2 rounded-md text-2x1 font-medium text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-700">ToS</a>
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
  <center><h1 class="title" style="margin-top: 30px;">Terms of Service</h1></center>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
  <p class="title" style="margin-left: 30px; font-size: 25px; margin-top: 20px;">1. Terms</p>
  <p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
By accessing the website at https://mineleaks.fun, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</br>
</br>
</p>

<p class="title" style="margin-left: 30px; font-size: 25px">2. Disclaimer</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
1. The materials on MineLeaks's website are provided on an 'as is' basis. MineLeaks makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</br>
</br>

2. Further, MineLeaks does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.</br>
</br>
</p>
<p class="title" style="margin-left: 30px; font-size: 25px">3. Limitations</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
In no event shall MineLeaks or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on MineLeaks's website, even if MineLeaks or a MineLeaks authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</br>
</br>
</p>

<p class="title" style="margin-left: 30px; font-size: 25px">4. Accuracy of materials</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
The materials appearing on MineLeaks's website could include technical, typographical, or photographic errors. MineLeaks does not warrant that any of the materials on its website are accurate, complete or current. MineLeaks may make changes to the materials contained on its website at any time without notice. However MineLeaks does not make any commitment to update the materials.</br>
</p>
</br>
<p class="title" style="margin-left: 30px; font-size: 25px">5. Links</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
MineLeaks has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by MineLeaks of the site. Use of any such linked website is at the user's own risk.</br>
</br>
</p>
<p class="title" style="margin-left: 30px; font-size: 25px">6. Modifications</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
MineLeaks may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</br>
</br>
</p>

<p class="title" style="margin-left: 30px; font-size: 25px">7. Governing Law</p>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">
These terms and conditions are governed by and construed in accordance with the laws of United States and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</br>
</p>
</br>
</p>
</br>
<center><h1 class="title">Privacy Policy</h1></center>
<p class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px; margin-top: 30px;">
1. Your privacy is important to us. It is MineLeaks's policy to respect your privacy regarding any information we may collect from you across our website, https://mineleaks.fun/, and other sites we own and operate.</br>
</br>

2. We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent. We also let you know why we’re collecting it and how it will be used.</br>
</br>

3. We only retain collected information for as long as necessary to provide you with your requested service. What data we store, we’ll protect within commercially acceptable means to prevent loss and theft, as well as unauthorized access, disclosure, copying, use or modification.</br>
</br>

4. We don’t share any personally identifying information publicly or with third-parties, except when required to by law.</br>
</br>

5. Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot accept responsibility or liability for their respective privacy policies.</br>
</br>
6. You are free to refuse our request for your personal information, with the understanding that we may be unable to provide you with some of your desired services.</br>
</br>

7. Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information. If you have any questions about how we handle user data and personal information, feel free to contact us.</br>
</br>

<center class="title" style="color: #a0aec0; font-size: 20px; margin-left: 80px;">This policy is effective as of June 28, 2021.</center>
</br>
</p>

<center>
    <p class="text-center text-gray-500 text-xs">
©2021 MineLeaks. All rights reserved.<br><a href="/tos" target="_blank">Terms of Service</a> · <a href="/tos" target="_blank">Privacy Policy</a>
</p>
<br>
  </center>
</html>
