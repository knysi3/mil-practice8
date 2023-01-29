<?php
//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<tr>";
    $view .= '<th scope="row">'.$result['id'].'</th>';
    $view .= '<th scope="row">'.$result['book_name'].'</th>';
    $view .= '<td scope="row"><a href="' .$result['book_url']. '">Link</a></td>';
    $view .= '<td scope="row">'.$result['book_comment'].'</td>';
    $view .= '<td scope="row">'.$result['registration_time'].'</td>';

    $view .= '<td scope="row">';
    $view .= '<a href="details.php?id=' . $result['id'] . '" class="btn btn-primary">';
    $view .= '更新';
    $view .= '</a>';
    $view .= '</td>';

    $view .= '<td scope="row">';
    $view .= '<a href="delete.php?id=' . $result['id'] . '" class="btn btn-primary">';
    $view .= '削除';
    $view .= '</a>';
    $view .= '</td>';

    $view .= "</tr>";
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">書籍名</th>
      <th scope="col">URL</th>
      <th scope="col">コメント</th>
      <th scope="col">登録日時</th>
    </tr>
  </thead>
  <tbody>
    <?= $view ?>
  </tbody>
</table>
</div>
<!-- Main[End] -->

</body>
</html>
