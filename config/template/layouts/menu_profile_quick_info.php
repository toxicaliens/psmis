<div class="navbar nav_title" style="border: 0;">
  <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span><?php echo (isset($_SESSION['sys_name'])) ? $_SESSION['sys_name'] : 'SMIS'; ?></span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile">
  <div class="profile_pic">
    <img src="<?php echo $_SESSION['prof_pic']; ?>" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Welcome,</span>
    <h2><?php echo $_SESSION['user_name']; ?></h2>
  </div>
</div>
<!-- /menu profile quick info -->