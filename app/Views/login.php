<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= env('APP') ?> Panel</title>
    <?php require app_dir().'/app/Views/common/head.php'; ?>
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-form">
    <?php require app_dir().'/app/Views/common/messages.php'; ?>

    <form action="/login" method="post">
        <input type="hidden" name="csrf_name" value="<?= $csrf_name ?>">
        <input type="hidden" name="csrf_value" value="<?= $csrf_value ?>">
        <h2 class="text-center"><?= env('APP') ?> Panel</h2>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
    </form>
</div>
</body>
</html>