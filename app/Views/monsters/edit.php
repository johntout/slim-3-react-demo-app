<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Monster</title>
    <?php require app_dir().'/app/Views/common/head.php'; ?>
</head>
<body>
<div class="container" style="margin-top: 20px">
    <?php require app_dir().'/app/Views/common/messages.php'; ?>
    <h2>Edit Monster: <?= $monster->name() ?></h2>
    <div class="col-md-12">
        <form action="/monsters/update" method="post">
            <input type="hidden" name="csrf_name" value="<?= $csrf_name ?>">
            <input type="hidden" name="csrf_value" value="<?= $csrf_value ?>">
            <input type="hidden" name="id" value="<?= $monster->id() ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $monster->name() ?>">
            </div>
			<div class="form-group">
				<label for="level">Level:</label>
				<input type="number" class="form-control" id="level" name="level" value="<?= $monster->level() ?>">
			</div>
			<div class="form-group">
				<label for="type">Type:</label>
				<select class="form-control" name="type" id="type">
					<option value="outlaw" <?= $monster->type() == 'outlaw' ? 'selected' : '' ?>>Outlaw</option>
					<option value="shadowborne" <?= $monster->type() == 'shadowborne' ? 'selected' : '' ?>>Shadowborne</option>
					<option value="arcanist" <?= $monster->type() == 'arcanist' ? 'selected' : '' ?>>Arcanist</option>
					<option value="acolyte" <?= $monster->type() == 'acolyte' ? 'selected' : '' ?>>Acolyte</option>
					<option value="dragon" <?= $monster->type() == 'dragon' ? 'selected' : '' ?>>Dragon</option>
				</select>
			</div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/monsters" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>