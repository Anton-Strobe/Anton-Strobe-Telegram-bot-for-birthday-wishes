<?php

require_once('info.php');

foreach ($array as $key => $stroke) {

//Перезаписываем в новый массив
  foreach ($stroke as $val) {
    if (!in_array($val['Dates'], $uniqid)) {
      $val['Dates'] = date('d-m-Y', strtotime($val['Dates']));
      array_push($uniqArray, $val);
      $count++;
    }
  }

  //СОРТИРУЕМ
  asort($uniqArray);
  foreach ($uniqArray as $df) {

    //ДАТА МЕСЯЦ
    $fixed_m = date('m', strtotime($df['Dates']));

    //ДАТА ТОЛЬКО ДЕНЬ
    $fixed_d = date('d.m', strtotime($df['Dates']));
    if ($date_d == $fixed_d) {
    //if ($date_m == $fixed_m) {
      
      $token = "xxxxxxxxxxxxxxxxxxxxx";
      $chat_id = "xxxxxxxxxxxxxxxx";
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
// var options = {  
//   year: 'numeric',
//   month: 'numeric',
//   day: 'numeric'  
// };
// function createObject(dataArr) {
//   let obj = []
  
//   obj = dataArr.map(el => ({
//     Dates: (el[0].toLocaleString(options)), 
//     Tg: el[1],
//     FIO: el[2],
//     Dolznst: el[3],
//     Nambr: el[4],	
//     Podrazdelenie: el[5],
//     Sity: el[6],
//   }))
  
//   return obj
  
// }



//Нужно обратить внимание что таблица должна называться именно так: users Чтоб код считал именно эту страницу, по имени: users