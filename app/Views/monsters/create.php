<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Monster</title>
    <?php require app_dir().'/app/Views/common/head.php'; ?>
</head>
<body>
<div class="container" style="margin-top: 20px">
    <?php require app_dir().'/app/Views/common/messages.php'; ?>
    <h2>Create Monster</h2>
    <div class="col-md-12">
        <form action="/monsters/insert" method="post">
            <input type="hidden" name="csrf_name" value="<?= $csrf_name ?>">
            <input type="hidden" name="csrf_value" value="<?= $csrf_value ?>">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?= session()->get('monsters.create.name') ?>">
			</div>
			<div class="form-group">
                <label for="level">Level:</label>
                <input type="number" class="form-control" id="level" name="level" value="<?= session()->get('monsters.create.level') ?>">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" id="type">
                    <option value="outlaw" <?= session()->get('monsters.create.type') == 'outlaw' ? 'selected' : '' ?>>Outlaw</option>
                    <option value="shadowborne" <?= session()->get('monsters.create.type') == 'shadowborne' ? 'selected' : '' ?>>Shadowborne</option>
                    <option value="arcanist" <?= session()->get('monsters.create.type') == 'arcanist' ? 'selected' : '' ?>>Arcanist</option>
                    <option value="acolyte" <?= session()->get('monsters.create.type') == 'acolyte' ? 'selected' : '' ?>>Acolyte</option>
                    <option value="dragon" <?= session()->get('monsters.create.type') == 'dragon' ? 'selected' : '' ?>>Dragon</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="/monsters" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>