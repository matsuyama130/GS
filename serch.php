<?php
session_start();
include('functions.php');
check_session_id();

$user_id = $_SESSION['user_id'];

try{



$pdo = connect_to_db();



//$sql = 'SELECT * FROM lost_table ORDER BY takeout ASC';
$sql = 
'SELECT * FROM lost_table LEFT OUTER JOIN (SELECT lost_id, COUNT(id) AS check_count FROM check_table GROUP BY lost_id) AS result_table ON lost_table.id = result_table.lost_id';
'SELECT * FROM lost_table LEFT OUTER JOIN(SELECT factory_key, COUNT(id) AS factory_name FROM factory_table GROUP BY factory_key) AS result_table ON lost_table.place = result_table.factory_key';
'SELECT * FROM lost_table LEFT OUTER JOIN factory_table  ON  lost_table.place = factory_table.id';
'SELECT * FROM lost_table LEFT OUTER JOIN area_table  ON  lost_table.area = area_table.id';

    //SQL文を実行して、結果を$stmtに代入する。
    $stmt = $pdo->prepare(" SELECT * FROM lost_table WHERE  submit_name LIKE '%" . $_POST["search_name"] . "%' "); 

    //実行する
    $stmt->execute();
    echo "OK";
    echo "<br>";
 }catch(PDOException $e){
    echo "失敗:" . $e->getMessage() . "\n";
    exit();
}
?>
<html>
    <body>
        <table>
            <tr><th>ID</th><th>Name</th><th>remark</th></tr>
            <!-- ここでPHPのforeachを使って結果をループさせる -->
            <?php foreach ($stmt as $row): ?>
            <tr>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[5]?></td>
                <td><?php echo $row[6]?></td>
            </tr>

                <?php endforeach; ?>
        </table>
    </body>

  
</html>