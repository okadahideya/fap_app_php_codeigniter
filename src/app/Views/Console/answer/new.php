<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>回答作成</title>

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
        <h1>回答作成</h1>
        <div class="card mt-2">
          <div class="card-header border-0">
              <div class="card-body p-0 mt-3">
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <div class="font-weight-bold" style="margin-left: 16px;">質問タイトル</div>
                            <div class="w-100 bg-light mt-3" style="margin: 30px 150px 10px 110px">
                              <?php echo nl2br(htmlspecialchars($questions['title'], ENT_QUOTES, 'UTF-8')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <div class="font-weight-bold" style="margin-left: 16px;">質問内容</div>
                            <div class="w-100 bg-light mt-3" style="margin: 30px 150px 10px 110px">
                              <?php echo nl2br(htmlspecialchars($questions['text'], ENT_QUOTES, 'UTF-8')); ?>
                            </div>
                        </div>
                    </div>
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
            <form action="/Console/Answer/create" class="form-horizontal" method="POST">
                <input type="hidden" name="id" value="<?php echo esc($answer['id']); ?>">
                <input type="hidden" name="question_id" value="<?php echo esc($questions['id']); ?>">
                <div class="card-footer text-right bg-white p-0 mb-3 pt-3">
                  <button type="submit" class="btn btn-primary bg-success border-0">回答作成</button>
                </div>   
                <div class="card-body p-0 mt-3">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="font-weight-bold">回答内容<span class="text-danger font-weight-bold">(必須)</span></div>
                            <textarea name="text" cols="150" rows="20" value=""><?php echo esc($answer['text']); ?></textarea>
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
