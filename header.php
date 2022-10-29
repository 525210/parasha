<?php
$active_class = $_SERVER['SCRIPT_NAME'];
$success = "btn btn-outline-success me-2";
$warning = "btn btn-outline-warning me-2";
?>
<!DOCTYPE html>
<html dir="rtl" lang="he">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="img/icons.gif" rel="icon" />
    <title>טיפול בנתונים</title>




    <!-- Web Fonts
    ======================== -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>



    <!-- Stylesheet
    ======================== -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<header>
<div class="container mt-2">
    <div class="shadow p-3 mb-1 bg-body rounded">
    <nav class="navbar bg-light">
        <form class="container-fluid justify-content-center mt-2 mb-2">
            <a href='/'><button class="<?php if($active_class == '/index.php'){echo $warning;}else{echo $success;};?>" type="button">מנויים</button></a>
            <a href='parasha.php'><button class="<?php if($active_class == '/parasha.php'){echo $warning;}else{echo $success;};?>" type="button">עיון הפרשה</button></a>
            <a href='halacha.php'><button class="<?php if($active_class == '/halacha.php'){echo $warning;}else{echo $success;};?>" type="button">עיון ההלכה</button></a>
            <a href='ms_gil.php'><button class="<?php if($active_class == '/ms_gil.php'){echo $warning;}else{echo $success;};?>" type="button">מספר גיליון</button></a>
<!--            <a href='#'><button class="btn btn-outline-warning me-2" type="button">מספר גיליון</button></a>-->
<!--            <a href='#'><button class="btn btn-outline-warning me-2" type="button">מספר גיליון</button></a>-->
        </form>
    </nav>
</div>
</div>
</header>
