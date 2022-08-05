<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQ一覧</title>
  
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
<?php include(__DIR__. '/../global/header.php'); ?>

  <!-- メイン サイドバー -->
<?php include(__DIR__ . '/../global/sideBer.php'); ?>


  <!-- コンテンツ -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1>FAQ一覧</h1>
        <div class="card mt-2">
          <div class="card-header border-0">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <!-- 検索フォーム -->
              <form action="/Console/Question/index" method="POST">
                  <div class="input-group d-flex flex-column">
                    <input type="search" class="form-control form-control-lg w-100 bg-light" name="title" placeholder="タイトル検索" value="<?php echo esc($search['title']); ?>">
                    <div class="form-check mt-3 mb-3">
                      <input class="form-check-input" id="textRole" type="checkbox" name="role" value="ベストアンサー"<?php if(!empty($search['role'])){echo "checked";} ?>>
                      <label class="form-check-label" for="textRole">ベストアンサーチェック</label>
                      <input class="form-check-input" id="textUser" style="margin-left: 10px;" type="checkbox" name="text" value="回答"<?php if(!empty($search['text'])){echo "checked";} ?> >
                      <label class="form-check-label" style="margin-left: 30px;" for="textUser">回答チェック</label>
                    </div>
                    <div class="input-group text-center">
                      <button type="submit" class="btn btn-lg btn-default mx-auto d-block">検索</button>
                    </div>
                  </div>
              </form>
            </div>
            </div>
            <div class="card-tools">
              <a href="/Console/Question/new">
                <button type="button" class="btn btn-block bg-gradient-success">新規投稿</button>
              </a>
            </div>
          </div>
<?php if(!empty($_SESSION['createSucces'])): ?>
          <div class="alert alert-success pl-3">
            <?php echo $_SESSION['createSucces']; ?>
          </div>
<?php endif; ?>
            <div class="card-body">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th class="text-center">投稿者</th>
                          <th class="">タイトル</th>
                          <th class="text-center">作成日</th>
                          <th class="text-center">ベストアンサーチェック</th>
                          <th class="text-center">回答チェック</th>
                        </tr>
                    </thead>
                    <tbody>
              <!-- FAQ一覧 取得 -->
<?php foreach($questions as $question): ?>
                <tr>
                  <td class="text-center"><?php echo esc($question['name']); ?></td>
                  <td class="text-truncate" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 500px;">
                    <a href="/Console/Question/show/<?php echo esc($question['id']); ?>">
                      <?php echo esc($question['title']); ?>
                    </a>
                  </td>
                  <td class=""><?php echo esc($question['create_at']); ?></td>
                  <td>
                    <div class="form-check text-center">
                      <input class="form-check-input" type="radio" name="" id="" value=""<?php if(!empty($question['is_best_answer'])){echo "checked";} ?>>
                    </div>
                  </td>
                  <td>
                    <div class="form-check text-center">
                      <input class="form-check-input" type="radio" name="" id="" value=""<?php if(!empty($question['is_answer']) || !empty($question['is_best_answer'])){echo "checked";} ?>>
                    </div>
                  </td>
                </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- /.コンテンツ -->

  <!-- フッター -->
<?php include(__DIR__ . '/../global/footer.php'); ?>

</div><!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/console/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/console/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/console/dist/js/adminlte.min.js"></script>
<script type = "module" src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> 
<script nomodule src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
</body>
</html>
