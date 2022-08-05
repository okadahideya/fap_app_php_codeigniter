<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info">
    <!-- ヘッダーナビ　左 -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
      </li>
    </ul>
    <!-- ヘッダーナビ　右 -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
<?php if($_SESSION['session']['role'] === ROLE_ADMIN): ?>
        <a class="nav-link" href="#" role="button">
          <i class="fas text-white">管理者: <?php echo $_SESSION['session']['name'] ?></i>
        </a>
<?php else:?>
        <a class="nav-link" href="#" role="button">
          <i class="fas text-white">ユーザー: <?php echo $_SESSION['session']['name'] ?></i>
        </a>
<?php endif; ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Console/Login/logout">
          <i class="fas text-white">ログアウト</i>
        </a>
      </li>
    </ul>
</nav>