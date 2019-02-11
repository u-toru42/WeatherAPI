<?php
    #weather情報を初期化し、空にする
    $weather = "";
    #error情報を初期化し、空にする
    $error = "";
    #_GET(フォームから送信されるデータを格納するグローバル変数,<form>でmethod属性を指定せず,$_GETでデータを受け取る送信できるデータはテキストだけ、送信できる情報量に制限あり)'city'というキーをもっているデータが有るかどうか,もしもキーが有れば、()の中の処理をする
    if (array_key_exists('city', $_GET)) {
        #file_get_contents(URLにアクセスしてデータを取得する)、出力された都市名を.$_GET[].と置き換え、以下は一度検索してから&以降のデータで引き出す
        $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=d9bcc814da55a18c8420be97e96cf02d");
        #JSONデータから連想配列キーを付けた状態で取り出す,引数を連想配列にする指示=true
        $weatherArray = json_decode($urlContents,true);
        
        #検索窓下にデータを入れ、表示するように設定
        $weather = $_GET['city'].":".$weatherArray['weather'][0]['main'].",".$weatherArray['weather'][0]['description'];
    }


?>

  <!-- bootstrapから -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <style type="text/css">
      
      html { 
          background: url(wallpaper.jpeg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 450px;
              
          }
          
          input {
              
              margin: 20px 0;
              
          }
          
          #weather {
              
              margin-top:15px;
              
          }
         
      </style>
      
  </head>
  <body>
    
      <div class="container">
      
          <h1>What's The Weather?</h1>
          
          
          
          <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php  if (array_key_exists('city', $_GET)) { echo $_GET['city'];  } ?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      
          <div id="weather"><?php 
              #$weatherに値が入っていれば天気情報を表示する
              if ($weather) {
                  
                  echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
              #errorが出ればエラー情報を表示する    
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                  
              }
              
              ?></div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
