<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= env('APP') ?> Panel</title>
    <?php require app_dir().'/app/Views/common/head.php'; ?>
</head>
<body>
<div class="container" style="margin-top: 20px">
    <?php require app_dir().'/app/Views/common/messages.php'; ?>

    <div class="col-md-12">
        <?= user()->fullName() ?> <br><br>
        <a href="/users" class="btn btn-primary" style="margin-bottom: 20px">Users</a>
        <a href="/monsters" class="btn btn-primary" style="margin-bottom: 20px">Monsters</a>
        <a href="/logout" class="btn btn-danger" style="margin-bottom: 20px">Logout</a>
    </div>
</div>
</body>
</html>