<?php
$date_full = date("d-m-Y");

//Дата на сегодня
$date_d = date("d-m");

//Дата на месяц в перед
$date_m = date("m", strtotime('+1 month'));

//Гугл-таблица преобразованная в json. Пример: $json_google = "https://script.google.com/macros/s/xxxxxxxxxxxxxxxxxxxxxxxxxx/exec";
include 'json_google.php';

$json = file_get_contents($json_google);
$array = json_decode($json, true);

//Создаем пустой массив для будущей сортировки по хронологии
$uniqid = array();
$uniqArray = array();
$count = 0;

foreach ($array as $key => $stroke) {

//Перезаписываем в новый массив
  foreach ($stroke as $val) {
    if (!in_array($val['Dates'], $uniqid)) {
      $val[Dates] = date('d-m-Y', strtotime($val[Dates]));
      array_push($uniqArray, $val);
      $count++;
    }
  }

  //СОРТИРУЕМ
  asort($uniqArray);
  foreach ($uniqArray as $df) {

    //ДАТА МЕСЯЦ
    $fixed_m = date('m', strtotime($df[Dates]));

    //ДАТА ТОЛЬКО ДЕНЬ
    $fixed_d = date('d-m', strtotime($df[Dates]));

    if ($date_d == $fixed_d) {
    //if ($date_m == $fixed_m) {


      //Токен и чат айди от бота в телеграме. ПРИМЕР:  //$token = "XXXXXXXXXX:XXXXXXXXXXXXXXXXXXXXXXXXXX";  //$chat_id = "-XXXXXXXXXXXXX";
      include 'token_telegram.php';
     
      $counter = 0;
      foreach ($df as $key => $value) {
        // if ($counter == 0) {
        //   $txt .= "<b>"  . "</b> " . $fixed_d . "%0A";
        // }
        if ($counter > 0) {
          $txt .= "<b>"  . "</b> " . $value . "%0A";
        }
        $counter++;
      };
      $counter = 0;
      $txt .=  "_______________________________";
      $txt .=  "%0A";
    }
  }
}


$info = "Именинники сегодня:  ";
$info_date = "$date_full%0A$info";

$info2 = "Именинники в следующем месяце:  ";
$date_time = date("d.m.Y", strtotime('+1 month'));
$info_date2 = "$date_time%0A$info2";

//ЗАГОЛОВОК на сегодня
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$info_date}", "r");

//ЗАГОЛОВОК на месяц
//$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$info_date2}", "r");

$sendToTelegram2 = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

//Код js который преобразует гугл-таблицу в json
//Этот код вставляем в гугл таблице, раздел: Расширения-> App Script


// function doGet() {
//   let result = {};
//   let users = SpreadsheetApp
//                 .getActiveSpreadsheet()
//                 .getSheetByName('Users')
//                 .getDataRange()
//                 .getValues()
//   users.shift()
//     result.users = createObject(users)
//     return ContentService.createTextOutput(JSON.stringify(result))
//            .setMimeType(ContentService.MimeType.JSON)
         
// }
// const sortedActivities = obj.sort((a, b) => b.date - a.date)
// function createObject(dataArr) {
//   let obj = []
  
//   obj = dataArr.map(el => ({
//     Dates: el[0], 
//     Tg: el[1],
//     FIO: el[2],
//     Dolznst: el[3],
//     Nambr: el[4],	
//     Podrazdelenie: el[5],
//     Sity: el[6],
//   }))
//     return obj
//   }



//Нужно обратить внимание что таблица должна называться именно так: users Что код считал именно эту страницу, по имени: users