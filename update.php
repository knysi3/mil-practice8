<?php
// //1. POSTデータ取得
$book_name = $_POST["book_name"];
$book_url = $_POST["book_url"];
$book_comment = $_POST["book_comment"];
$id = $_POST["id"];

// echo $book_name;
// echo $book_url;
// echo $book_comment;
// echo $id;

// //2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

// //３．データ登録SQL作成
$stmt = $pdo->prepare( "UPDATE gs_bm_table SET book_name = :book_name, book_url = :book_url, book_comment = :book_comment, registration_time = sysdate() WHERE id = :id;" );

$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    redirect('select.php');
}

// redirect('select.php');
?>