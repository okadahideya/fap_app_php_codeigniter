<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ユーザー新規作成</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/console/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/console/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- ヘッダーナビ -->
<?php include(__DIR__ . '/../global/header.php'); ?>

  <!-- メイン サイドバー -->
<?php include(__DIR__ . '/../global/sideBer.php'); ?>


  <!-- コンテンツ -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1>質問新規投稿</h1>
        <div class="card mt-2">
          <div class="card-header border-0">
            <!-- <h3 class="card-title d-block">質問投稿</h3> -->
            <div class="card-body p-0">
              </div>
                <!-- エラー表示 -->
<?php if (!empty($errorMessage)): ?>
                <ul class="alert alert-danger m-0">
<?php    foreach ($errorMessage as $message): ?>
              <li>
                <?php echo esc($message); ?>
              </li>
<?php    endforeach ?>
            </ul>
<?php endif ?>
              <!-- フォーム -->
            <form action="/Console/Question/create" class="form-horizontal" method="POST">
            <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
                <div class="card-footer text-right bg-white p-0 mb-3 pt-3">
                  <button type="submit" class="btn btn-primary bg-success border-0">投稿</button>
                </div>   
                <div class="card-body p-0 mt-3">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="font-weight-bold">質問タイトル<span class="text-danger font-weight-bold">(必須) 128文字以内で入力してください</span></div>
                            <textarea name="title" cols="150" rows="2"><?php echo esc($question['title']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="font-weight-bold">質問内容<span class="text-danger font-weight-bold">(必須)</span></div>
                            <textarea name="text" cols="150" rows="20" value=""><?php echo esc($question['text']); ?></textarea>
                        </div>
                    </div>
                </div>      
            </form>
          </div>
        </div>
        </div>
    </div>
  </div>
  <!-- /.コンテンツ -->

  <!-- フッター -->
<?php include(__DIR__ . '/../global/footer.php'); ?>


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/console/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/assets/console/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="/assets/console/dist/js/adminlte.min.js"></script>
<script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> 
<script  nomodule  src = "https:// unpkg .com / ionicons @ 5.5.2 / dist / ionicons / ionicons.js"></script> 
</body>
</html>
