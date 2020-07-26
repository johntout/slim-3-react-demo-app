<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Users</title>
        <?php require app_dir().'/app/Views/common/head.php'; ?>
	</head>
	<body>
		<div class="container" style="margin-top: 20px">


			<div class="col-md-12">
                <?= user()->fullName() ?> <br><br>
				<a href="/dashboard" class="btn btn-primary" style="margin-bottom: 20px">Dashboard</a>
				<a href="/users/create" class="btn btn-success" style="margin-bottom: 20px">Create User</a>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Edit</th>
							<th>ID</th>
							<th>Name</th>
							<th>Last Name</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach($users as $user) : ?>
							<tr>
								<td><a href="/users/edit/<?= $user->id() ?>">Edit</a></td>
								<td><?= $user->id() ?></td>
								<td><?= $user->name() ?></td>
								<td><?= $user->last_name() ?></td>
								<td><?= $user->email() ?></td>
							</tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>