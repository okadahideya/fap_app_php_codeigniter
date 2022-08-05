<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ユーザー一覧</title>
  
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
<?php echo include(__DIR__ . '/../global/header.php'); ?>
  
  <!-- メイン サイドバー -->
<?php echo include(__DIR__ . '/../global/sideBer.php'); ?>

  <!-- コンテンツ -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1>ユーザー<small class="lead text-muted ml-1">user</small> </h1>
        <div class="card mt-2">
          <div class="card-header border-0">
            <h3 class="card-title">ユーザー一覧</h3>
            <div class="card-tools">
              <a href="/console/account/new">
                <button type="button" class="btn btn-block bg-gradient-success">新規作成</button>
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
                          <th>ID</th>
                          <th>名前</th>
                          <th>email</th>
                          <th>権限</th>
                          <th >設定</th>
                        </tr>
                    </thead>
                    <tbody>
              <!-- アカウント一覧 取得 -->
<?php foreach ($accounts as $accont): ?>
                <tr>
                  <td class="text-right"><?php echo esc($accont['id']); ?></td>
                  <td><?php echo esc($accont['name']); ?></td>
                  <td><?php echo esc($accont['email']); ?></td>
<?php     if(esc($accont['role']) == 1): ?>
                        <td>管理者</td>
<?php     else: ?>
                        <td>ユーザー</td>
<?php     endif; ?>
                  <td class="d-flex justify-content-around">
                    <a class="text-primary" href="/console/Account/new/<?php echo esc($accont['id']); ?>">編集</a>
                    <a class="text-danger" onclick="return confirm('<?php echo ($accont['name']); ?>を本当に削除しますか?')" href="/console/account/delete/<?php echo esc($accont['id']); ?>">削除</a>
                  </td>
                </tr>
<?php endforeach; ?>
                    </form>
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
