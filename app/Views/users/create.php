<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create User</title>
    <?php require app_dir().'/app/Views/common/head.php'; ?>
</head>
<body>
<div class="container" style="margin-top: 20px">
    <?php require app_dir().'/app/Views/common/messages.php'; ?>
    <h2>Create user</h2>
    <div class="col-md-12">
        <form action="/users/insert" method="post">
            <input type="hidden" name="csrf_name" value="<?= $csrf_name ?>">
            <input type="hidden" name="csrf_value" value="<?= $csrf_value ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= session()->get('users.create.name') ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= session()->get('users.create.last_name') ?>">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= session()->get('users.create.email') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="/users" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>