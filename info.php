<?php

$date_full = date("d-m-Y");

//Дата на сегодня
$date_d = date("d.m");

//Дата на месяц в перед
$date_m = date("m", strtotime('+1 month'));

//Гугл-таблица преобразованная в json
$json_google = "https://script.google.com/macros/s/xxxxxxxxxxxxxxxxxxxxxxxxxxx/exec";
$json = file_get_contents($json_google);
$array = json_decode($json, true);

//Создаем пустой массив для будущей сортировки по хронологии
$uniqid = array();
$uniqArray = array();
$count = 0;

$info = "Именинники сегодня:  ";
$info_date = "$date_full%0A$info";

$info2 = "Именинники в следующем месяце:  ";
$date_time = date("d.m.Y", strtotime('+1 month'));
$info_date2 = "$date_time%0A$info2";

?>