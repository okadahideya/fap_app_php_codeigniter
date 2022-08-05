<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link bg-info">
      <span class="brand-text ml-5">FAQ管理システム</span>
    </a>
    <!-- サイドバー -->
    <div class="sidebar p-0">
      <div class="bg-black">
        <div class="user-panel d-flex pl-2">
        <div class="info">
        <a href="#" class="d-block">MAIN NAVIGATION</a>
        </div>
        </div>
      </div>
        <!-- サイドバー ナビ -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<?php if($_SESSION['session']['role'] === ROLE_ADMIN): ?>
        <li class="nav-item">
              <a href="/Console/Account/index" class="nav-link w-100">
              <ion-icon name="people-outline"></ion-icon>
              <p class="ml-2">
                ユーザー一覧
              </p>
              </a>
            </li>
<?php endif; ?>
            <li class="nav-item">
              <a href="/Console/Question/index" class="nav-link w-100">
              <ion-icon name="people-outline"></ion-icon>
              <p class="ml-2">
                FAQ一覧
              </p>
              </a>
            </li>
        </ul>
        <!-- /.サイドバー ナビ  -->
    </div>
    <!-- /.サイドバー -->
</aside>