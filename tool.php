<?php
session_start();
include('functions.php');
check_session_id();

$user_id = $_SESSION['user_id'];


$pdo = connect_to_db();



//$sql = 'SELECT * FROM lost_table ORDER BY takeout ASC';
$sql = 
'SELECT * FROM lost_table LEFT OUTER JOIN (SELECT lost_id, COUNT(id) AS check_count FROM check_table GROUP BY lost_id) AS result_table ON lost_table.id = result_table.lost_id';
'SELECT * FROM lost_table LEFT OUTER JOIN(SELECT factory_key, COUNT(id) AS factory_name FROM factory_table GROUP BY factory_key) AS result_table ON lost_table.place = result_table.factory_key';
'SELECT * FROM lost_table LEFT OUTER JOIN factory_table  ON  lost_table.place = factory_table.id';
'SELECT * FROM lost_table LEFT OUTER JOIN area_table  ON  lost_table.area = area_table.id';




$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
//exit();


$output = "";

foreach ($result as $record) {
  $output .= "
    <tr>
          <td><a href='lost_edit.php?id={$record["id"]}'>edit</a></td>
      <td><a href='lost_delete.php?id={$record["id"]}'>delete</a></td>
      <td>{$record["date"]}</td>
      <td>{$record["place"]}</td>
      <td>{$record["area"]}</td>
      <td>{$record["machine"]}</td>
      <td>{$record["tana_key"]}</td>
      <td>{$record["type_key"]}</td>
      <td>{$record["gauge_name"]}</td>
      <td>{$record["staff"]}</td>


    </tr>
  ";
}
//<td><a href='check_create.php?user_id={$user_id}&lost_id={$record["id"]}'>移動({$record['check_count']})</a></td>


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

  
    <form action="lost_create.php" method="POST">
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
      <legend>ツール登録画面 - 工場内で使用中の共有具一覧作成</legend>
    </header>
  </div>
    <br> 
     <div class="input" >
       <div>
         <div>
          工場：<select name="place">
                <option value="1">本社工場  </option>

                </select>
          </div>     
          <div>
          区画：<select name="area">
                  <option value="A-1">A-1</option>
                  <option value="A-2">A-2</option>
                  <option value="A-3">A-3</option>
                  <option value="B-1">B-1</option>
                  <option value="B-2">B-2</option>
                  <option value="B-3">B-3</option>
                  <option value="C-1">C-1</option>
                  <option value="C-2">C-2</option>
                  <option value="C-3">C-3</option>
                  <option value="棚">棚</option>
                  </select>
          </div>
          <div>
           機械：<select name="machine">
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
 ツール位置：<select name="tana_key">
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
            ツール種類：<select name="type_key">
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
        ツール名称：<input type="text" name="gauge_name">
      </div>
       </div>
       
<br> 
<div>
   <div>
        登録日：<input type="date" name="date">
      </div>

        <div>
        使用者：<select name="staff">
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




<body>
  <fieldset>
    <legend>ツールリスト（工場内で使用中の共有具一覧）</legend>

    <table class="table2">
      <thead>
        <tr>
          <th>編集</th>
          <th>削除</th>
          <th>日時</th>
          <th>工場</th>
          <th>エリア</th>
          <th>機械</th>
          <th>棚</th>
          <th>種類</th>
          <th>ツール</th>
          <th>登録者</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>
  
</html>