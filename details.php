<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];
echo $id;

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
if($status == false){
    sql_error($status);
}else{
    $result = $stmt->fetch();
    var_dump($result);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
      <div class="mb-3 row">
        <label for="inputBookName" class="col-sm-1 col-form-label">書籍名</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="inputBookName" name="book_name" value="<?= $result['book_name'] ?>">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="inputUrl" class="col-sm-1 col-form-label">書籍URL</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="inputUrl" name="book_url" value="<?= $result['book_url'] ?>">
        </div>
      </div>

      <div class="mb-3 row">
        <label for="inputBookComment" class="col-sm-1 col-form-label">書籍コメント</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="inputBookComment" name="book_comment" value="<?= $result['book_comment'] ?>">
        </div>
      </div>
      <input type="hidden" name="id" value="<?= $result['id'] ?>">
      <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
