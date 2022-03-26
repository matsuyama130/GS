<?php
session_start();
include('functions.php');
check_session_id();


//〇
//var_dump($_POST);
//exit();

// id受け取り
// DB接続
// SQL実行




$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM lost_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);



try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sample.css">
  <title>FACTORY MANAGER</title>
      <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
  <header>

  </header>

  <body class="body">

  
    <form action="lost_update.php" method="POST">
       
    <fieldset>
     <legend>
       <a href="index.php"><img src="img/kezuriya.png" alt=""></div>
       <br> 
       <a href="index.php">作業者画面</a>
      </legend>
 <div class="menu">
   <a href="task.php">タスク登録</a>
    <a href="tool.php">ツール登録</a>
  <a href="lost_logout.php">ログアウト</a>
 </div>
 <div class="profile">
    <header>

     <br> 
      <legend>ツール編集画面</legend> 
    </header>
  </div>







    <br> 
     <div class="input" >
       <div>
         <div>
          工場：<select name="place" value="<?= $record['place'] ?>">
                <option value="1">本社工場  </option>

                </select>
          </div>     
          <div>
          区画：<select name="area" value="<?= $record['area'] ?>">
                  <option value="A-1">A-1</option>
                  <option value="A-2">A-2</option>
                  <option value="A-3">A-3</option>
                  <option value="B-1">B-1</option>
                  <option value="B-2">B-2</option>
                  <option value="B-3">B-3</option>
                  <option value="B-1">B-1</option>
                  <option value="B-2">B-2</option>
                  <option value="B-3">B-3</option>
                  <option value="棚">棚</option>
                  </select>
          </div>
          <div>
           機械：<select name="machine" value="<?= $record['machine'] ?>">
                <option value="TAC-800">TAC-800</option>
                <option value="TAC-950">TAC-950</option>
                <option value="TAC-510">TAC-510</option>
                <option value="SL-603-1">SL-603-1</option>
                <option value="SL-603-2">SL-603-2</option>
                <option value="SL-603-3">SL-603-3</option>
                <option value="SL-603-4">SL-603-4</option>
                <option value="2SP-V80">2SP-V80</option>
                <option value="NLX-4000">NLX-4000</option>
                <option value="SL-25-G">SL-25-G</option>
                <option value="SL-25-W">SL-25-W</option>
                <option value="CL-200">CL-200</option>
                <option value="SL-403">SL-403</option>
                <option value="NL-2500">NL-2500</option>
                <option value="NL-3000">NL-3000</option>
                <option value="NLX-4000">NLX-4000</option>
                <option value="VM73">VM73</option>
                <option value="A66">A66</option>
                <option value="VP1200">VP1200-1</option>
                <option value="VP1200">VP1200-2</option>
                <option value="MX520-PC4">MX520-PC4</option>
                <option value="NV-5000">NV-5000</option>
                <option value="NV-5000-APC">NV-5000-APC</option>
                <option value="YZ-352">YZ-352</option>
                <option value="YZ-500">YZ-500</option>
                <option value="YZ-1332">YZ-1332</option>
                <option value="MCR-A5C">MCR-A5C</option>
                <option value="MA-600H">MA-600H</option>
                <option value="B6G">B6G</option>
                <option value="V33">V33</option>
                </select>
           </div>
         </div>
       <br> 
      <div>
        <div>
 ツール棚番：<select name="tana_key" value="<?= $record['tana_key'] ?>">
                  <option value="機械">機械</option>                 
                  <option value="A-1">A-1</option>
                  <option value="A-2">A-2</option>
                  <option value="A-3">A-3</option>
                  <option value="B-2">B-2</option>
                  <option value="B-3">B-3</option>
                  <option value="B-4">B-4</option>
                  <option value="B-5">B-5</option>
                  <option value="B-6">B-6</option>
                  <option value="B-7">B-7</option>
                  <option value="B-8">B-8</option>
                  <option value="C-1">C-1</option>
                  <option value="C-2">C-2</option>
                  <option value="C-3">C-3</option>
                  <option value="C-4">C-4</option>
                  <option value="C-5">C-5</option>
                  <option value="C-6">C-6</option>
                  <option value="C-7">C-7</option>
                  <option value="C-8">C-8</option>
                  <option value="C-9">C-9</option>
                  <option value="C-10">C-10</option>
                  <option value="C-11">C-11</option>
                  <option value="C-12">C-12</option>
                  <option value="D-1">D-1</option>
                  <option value="D-2">D-2</option>
                  <option value="D-3">D-3</option>
                  </select>

      </div>
          <div>
            ツール種類：<select name="type_key" value="<?= $record['type_key'] ?>">
                  <option value="inside">inside</option>
                  <option value="out micro">out micro</option>
                  <option value="special micro">special micro</option>
                  <option value="u micro">u micro</option>
                  <option value="out caliper">out caliper</option>
                  <option value="blade micro">blade micro</option>
                  <option value="3 point micro">3 point micro</option>
                  <option value="Inner micro">Inner micro</option>
                  <option value="depth">depth</option>
                  <option value="dial inner caliper">dial inner caliper</option>
                  <option value="cylinder gauge">cylinder gauge</option>
                  <option value="densitometer">densitometer</option>
                  <option value="ph meter">ph meter</option>
                  <option value="original gauge">original gauge</option>
                  <option value="pin gauge">pin gauge</option>
                  <option value="mastering">mastering</option>
                  <option value="inner instrument">inner instrument</option>
                  <option value="out instrument">out instrument</option>
                  </select>
      </div>

      <div>
        ツール名称：<input type="text" name="gauge_name" value="<?= $record['gauge_name'] ?>">
      </div>
       </div>
       
<br> 
<div>
   <div>
        登録日：<input type="date" name="date" value="<?= $record['date'] ?>">
      </div>

        <div>
        使用者：<select name="staff" value="<?= $record['staff'] ?>">
                  <option value="冨岡義勇">冨岡義勇</option>
                  <option value="胡蝶しのぶ">胡蝶しのぶ</option>
                  <option value="煉獄杏寿郎">煉獄杏寿郎</option>
                  <option value="宇髄天元">宇髄天元</option>
                  <option value="甘露寺蜜璃">甘露寺蜜璃</option>
                  <option value="伊黒小芭内">伊黒小芭内</option>
                  <option value="不死川実弥">不死川実弥</option>
                  <option value="時透無一郎">時透無一郎</option>
                  <option value="悲鳴嶼行冥">悲鳴嶼行冥</option>
                  </select>
          </div>
<div>
  <input type="hidden" name="id" value="<?= $record["id"] ?>">
</div>
       
      
       </div>
     
     
     
</div>
</form>
    <br> 

  <div class="input" >
      <div>
        <button>submit</button>
      </div>

      </div>
 <br> 
<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vRNo8Wmiox7RS99ySS1cUA7u0E_tA3Hm1BPdiETucffHQnQDqxRcaX5LAAD7smdmx3XGLP0xqcg0Y7D/embed?start=false&loop=false&delayms=60000" frameborder="0" width="100%" height="839" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>

    </fieldset>


</body>

 
    









    <body class="body">

  
    <form action="lost_create.php" method="POST">
    


</html>