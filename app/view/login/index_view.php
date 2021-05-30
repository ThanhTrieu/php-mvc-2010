<?php if(!defined('ROOT_PATH')) { exit('can not access'); } ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
				<h1 class="text-center my-3">Login user</h1>
				<form class="p-3 border" method="post" action="index.php?c=login&m=handle">
					<div class="form-group">
						<label>User</label>
						<input type="text" class="form-control" name="username"/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password"/>
					</div>
					<button name="btnLogin" type="submit" class="btn btn-primary"> Login </button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>