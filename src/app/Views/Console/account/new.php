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
        <h1>ユーザー<small class="lead text-muted ml-1">user</small> </h1>
        <div class="card mt-2">
          <div class="card-header border-0">
            <h3 class="card-title d-block">ユーザー登録</h3>
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
            <form action="/console/account/create" class="form-horizontal" method="POST" >
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="card-body p-0 mt-3">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">名前</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-75 p-3" name="name" id="inputEmail3" placeholder="名前" value="<?php echo esc($data['name']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control w-75 p-3" name="email" id="inputEmail3" placeholder="sample@gmail.com" value="<?php echo esc($data['email']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control w-75 p-3" name="password" id="inputEmail3" placeholder="password">
                            <p>８文字以上&nbsp;大文字小文字の半角英数字<br>いずれかの記号&nbsp;#%$&@-,&nbsp;を含むパスワードにしてください</p>
<?php if (!empty($data['id'])): ?>
                              <p>*パスワードが空白の場合、前回のパスワードで保存されます</p>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">権限</label>
                        <div class="col-sm-10 mt-2">
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10 m-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role[]" value="管理者"<?php if (array_key_exists('role',$data) && $data['role'] == 1){ echo "checked";} ?>>
                                        <label class="form-check-label" for="inlineRadio1">管理者</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role[]" value="ユーザー"<?php if (array_key_exists('role',$data) && $data['role'] == 2){ echo "checked";} ?>>
                                        <label class="form-check-label" for="inlineRadio2">ユーザー</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-white p-0 mt-3 mb-3 pt-3 border-top">
                  <button type="submit" class="btn btn-primary bg-success border-0">登録</button>
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
