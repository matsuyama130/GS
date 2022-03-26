<?php
session_start();
include('functions.php');
//check_session_id();

//$user_id = $_SESSION['user_id'];








$pdo = connect_to_db();



//$sql = 'SELECT * FROM lost_table ORDER BY takeout ASC';
$sql = 
'SELECT * FROM task_table LEFT OUTER JOIN (SELECT task_id, COUNT(id) AS check_count FROM check_table GROUP BY task_id) AS result_table ON task_table.id = result_table.task_id';

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
    <td>{$record["id"]}</td>  
    <td>{$record["date"]}</td>
    <td>{$record["area_a"]}</td>
    <td>{$record["area_b"]}</td>
<td>{$record["staff"]}</td>
    </tr>
  ";
}
//<td><a href='task_check_create.php?task_id={$record["id"]}'>？{$record['check_count']}</a></td>
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
       <div>
       <a href="task.php"><img src="img/kezuriya.png" alt="">
       <br> 
       <a href="task.php">管理者画面</a>
       
    </div>
      </legend>
   
    
    


 <div class="input" >
    <table class="table1" >
      <thead>
        <tr>
          <th>No.</th>
          <th>いつまで</th>
          <th>現在地</th>
          <th>お届先</th>
          <th>依頼者</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
     </div>

    
 <br> 
<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vRNo8Wmiox7RS99ySS1cUA7u0E_tA3Hm1BPdiETucffHQnQDqxRcaX5LAAD7smdmx3XGLP0xqcg0Y7D/embed?start=false&loop=false&delayms=60000" frameborder="0" width="100%" height="839" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>

  </div>
    </fieldset>







  



</body>

</html>