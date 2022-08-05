<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>>質問内容</title>

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
        <h1>質問内容</h1>
        <div class="card mt-2">
          <div class="card-header border-0">
              <!-- フォーム -->
            <form action="" class="form-horizontal" method="POST">
                <div class="d-flex mt-3">
                    <div class="ml-3"><span class="font-weight-bold">投稿者名：</span><?php echo esc($questions['name']); ?></div>
                    <div class="ml-5"><span class="font-weight-bold">質問投稿時間：</span><?php echo esc($questions['create_at']); ?></div>
                </div>
<?php if($questions['user_id'] === $_SESSION['session']['id']): ?>
                <div class="card-footer text-right bg-white p-0 mb-3 pt-3">
                  <input type="submit" class="btn btn-primary border-0" value="編集" formaction="/Console/Question/new/<?php echo esc($questions['id']); ?>">
                  <input type="submit" class="btn btn-danger border-0 mr-4 ml-2" onclick="return confirm('投稿を削除しますか?')" value="削除" formaction="/Console/Question/delete/<?php echo esc($questions['id']); ?>">
                </div>
<?php endif; ?>
            </form>
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
            <div class="d-flex justify-content-between">
                <div class="w-25 p-1 text-center border border-dark bg-light pt-2 font-weight-bold ml-3">回答一覧</div>
                <div class="card-tools">
                  <a href="/Console/Answer/new?question_id=<?php echo $questions['id']; ?>">
                    <button type="button" class="btn bg-gradient-success mr-5">回答</button>
                  </a>
                </div>
            </div>
<?php if(!empty($_SESSION['createSucces'])): ?>
          <div class="alert alert-success pl-3 mt-3">
             <?php echo $_SESSION['createSucces']; ?>
          </div>
<?php endif; ?>
<?php foreach($answers as $answer): ?>
              <div class="w-75 border border-dark bg-light" style="margin: 30px 110px;">
                  <ul class="d-flex justify-content-between p-0 mt-2" style="list-style: none;">
                      <li class="ml-2"><span class="font-weight-bold">名前：</span><?php echo esc($answer['name']); ?></li>
                      <li class="mr-2"><span class="font-weight-bold">回答作成日：</span><?php echo esc($answer['create_at']); ?></li>
<?php     if($_SESSION['session']['id'] === $answer['user_id']): ?>
                      <li>
                          <a class="mr-2" href="/Console/Answer/edit/<?php echo esc($answer['id']); ?>?question_id=<?php echo esc($questions['id']); ?>">編集</a>
                      </li>
<?php     endif; ?>
                  </ul>
                  <div style="margin: 20px;">
                    <?php echo nl2br(htmlspecialchars($answer['text'], ENT_QUOTES, 'UTF-8')); ?>
                  </div>
              </div>
<?php endforeach; ?>
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
