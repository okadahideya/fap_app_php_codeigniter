<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ログイン</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/console/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/console/dist/css/adminlte.min.css">
  <style>
      #main-div {
          margin-top: 200px;
      }
  </style>
</head>
<body class="bg-light">  
<div class="d-flex justify-content-center" id="main-div">
    <div class="card card-info w-50">
        <div class="card-header">
            <h3 class="card-title">FAQ管理システム</h3>
        </div>
        <!-- エラー表示 -->
<?php if(!empty($_SESSION['errMessageFlash'])): ?>
            <ul class="alert alert-danger m-0">
                <li>
                    <?php echo esc($_SESSION['errMessageFlash']); ?>
                </li>
            </ul>
<?php endif; ?>
<?php    foreach ($errorMessage as $message): ?>
            <ul class="alert alert-danger m-0">
                <li>
                    <?php echo esc($message); ?>
                </li>
            </ul>
<?php    endforeach; ?>
        <form action="/console/Login/auth" class="form-horizontal" method="POST">
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" value="<?php echo esc($data['email']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center bg-white">
                    <button type="submit" class="btn btn-info">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>

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