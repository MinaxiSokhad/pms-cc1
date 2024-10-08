<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/admin/"><img src="/assets/images/logo.svg" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/admin/"><img src="/assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <?php
            //   $defaultImage = "https://bootdey.com/img/Content/avatar/avatar7.png";
            $storage = "/storage/uploads/";
            $defaultImage = "/storage/uploads/download.png";
            // $url = "http://192.168.1.30/storage/uploads/";   
            $profileImage = !empty($profileImg['image']) ? $storage . $profileImg['storage_filename'] : $defaultImage;

            ?>
            <img class="img-xs rounded-circle " src="<?php echo e($profileImage) ?>" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal" style="color:white"><?php echo e($profileImg['name']); ?></h5>
            <span>Project Member</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/changePassword" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/toDolist" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>


    <!-- <li class="nav-item menu-items">
      <a class="nav-link" href="/admin/"> -->
    <!-- <span class="menu-icon">
      <i class="fas fa-wifi-1"></i>
    </span> -->
    <!-- <span class="menu-title">Dashboard</span>
      </a>
    </li> -->
    <li class="nav-item menu-items <?= ($_SERVER['REQUEST_URI'] == '/admin/') ? 'active' : '' ?>">
      <a class="nav-link" href="/admin/">
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <?php //dd($_SESSION['user_type']);
    if ($_SESSION['user_type'] == "A"): ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="/admin/customers" aria-expanded="false" aria-controls="ui-basic">

          <span class="menu-title">Customers</span>

        </a>
      </li>
    <?php endif; ?>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/admin/projects">

        <span class="menu-title">Projects</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="/admin/tasks">

        <span class="menu-title">Tasks</span>
      </a>
    </li>
    <?php //dd($_SESSION['user_type']);
    if ($_SESSION['user_type'] == "A"): ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="/admin/members">

          <span class="menu-title">Members</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</nav>