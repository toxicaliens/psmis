<?php set_layout("base.php"); ?>

<div id="login" class=" form">
<?php if ( isset($_SESSION['loginerror']) ) { ?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Warning!</strong> <?php echo $_SESSION['loginerror'] ?>
		</div>
<?php unset($_SESSION['loginerror']); } ?>
<?php if ( isset($_SESSION['loginerror2']) ) { ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> <?php echo $_SESSION['loginerror2'] ?>
		</div>
<?php unset($_SESSION['loginerror2']); } ?>
	<section class="login_content">
		<form action="#" method="post">
			<h1>School System</h1>
			<div>
				<input type="text" class="form-control" placeholder="Username" name="username" required="required"/>
			</div> 

			<div>
				<input type="password" class="form-control" placeholder="Password" name="password" required/>
			</div>

			<input type="hidden" name="entry_point" value="valid" />
			<div>
				<input type="submit" class="btn btn-default" value="Login" />
				<a class="reset_pass" href="#">Lost your password?</a>
			</div>
			<div class="clearfix"></div>
	      	<div class="separator">
		        <p class="change_link">New to site?
		          <a href="#toregister" class="to_register"> Create Account </a>
		        </p>
		        <div class="clearfix"></div>
		        <br />
		        <?php include('config/template/layouts/footer.php'); ?>
	      </div>
		</form>
	</section>
</div>