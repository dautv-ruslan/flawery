<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <?php if (isset($title)) { ?>
            <title>
                <?php echo "$title"; ?>
            </title>
        <?php } ?>
        <?php if ($theme == "light") { ?>
            <link rel="stylesheet" href="/<?php echo $css_folder; ?>/style_1.css"/>
        <?php } else { ?>
            <link rel="stylesheet" href="/<?php echo $css_folder; ?>/style.css"/>
        <?php } ?>
        <?php
        // Загружаем стили для страниц
        if (!isset($nav)) {
            $nav = "sklad";
        }
        if ($nav == "sklad") {
            echo "<link rel=\"stylesheet\" href=\"/$css_folder/sklad.css\"/>"; // Страница "Склад"
        } elseif ($nav == "sell") {
            echo "<link rel=\"stylesheet\" href=\"/$css_folder/sell.css\"/>"; // Страница "Продажи"
        } elseif ($nav == "charges") {
            echo "<link rel=\"stylesheet\" href=\"/$css_folder/charges.css\"/>"; // Страница "Расходы"
        } else {
            echo "<link rel=\"stylesheet\" href=\"/$css_folder/showcase.css\"/>"; // Страницы, которые не вошли в предыдущие
        }
        ?>
        <link rel="stylesheet" href="/<?php echo $css_folder; ?>/fonts/Roboto/roboto.css"/>
        <link rel="stylesheet" href="/<?php echo $css_folder; ?>/fonts/Comfortaa/comfortaa.css"/>
        <link rel="stylesheet" href="/<?php echo $bootstrap_folder; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="/<?php echo $css_folder; ?>/jquery-ui.css">
        <link rel="stylesheet" href="/<?php echo $css_folder; ?>/select2.min.css">
        <!--[if lt IE 9]>
        <script src = "http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="/<?php echo $js_folder; ?>/jquery-3.4.1.min.js"></script>
        <script src="/<?php echo $js_folder; ?>/jquery-ui.js"></script>
        <script src="/<?php echo $js_folder; ?>/select2.min.js"></script>
        <script src="/<?php echo $js_folder; ?>/Chart.min.js"></script>
        <script src="/<?php echo $js_folder; ?>/common.js"></script>
    </head>
    <body>
        <?php
        // Отображаем названия месяцев
        $month = array("", "Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
        ?>
        <div class="head hidden-xs">
            <a href="/"><div class="fadmin">f<span>admin</span></div></a>
            <div class="date">Сегодня <?php echo date("d ") . $month[date("n")] . date(" Y\, H:i") ?></div>
        </div>
        <div class="header-mobile visible-xs-block">
            <div class="mobile-menu">
                <div class="menu_button">
                    <img src="/<?php echo $images_folder; ?>/ico_menu_mobile.svg" alt="Menu">
                </div>
                <span class="title"><?php echo $header; ?></span>
                <div class="checkradios">    
                    <img src="/<?php echo $images_folder; ?>/ico_graph.svg" alt="Graph">
                </div>
            </div>
            <nav class="nav">
                <ul>
                    <li class="nav-item"><a class="nav-link" href="/sklad">Склад</a></li>
                </ul>
            </nav>
        </div>
        <div class="fon">