<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Monsters</title>
        <?php require app_dir().'/app/Views/common/head.php'; ?>
		<script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
		<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
		<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
		<style>
			.search-button {
				margin-top: 20px;
				margin-bottom: 20px;
			}
		</style>
	</head>
	<body>
		<div class="container" style="margin-top: 20px">
            <?php require app_dir().'/app/Views/common/messages.php'; ?>

			<div class="row">
				<div class="col-md-12">
                    <?= user()->fullName() ?> <br><br>
					<a href="/dashboard" class="btn btn-primary" style="margin-bottom: 20px">Dashboard</a>
					<a href="/monsters/create" class="btn btn-success" style="margin-bottom: 20px">Create Monster</a>
				</div>
			</div>

			<br />
			<div class="row">
				<div class="col-md-12">
					<div id="search-form"></div>
				</div>
			</div>
		</div>

		<!-- Load our React component. -->
		<script type="text/babel" src="/monsters.js"></script>
	</body>
</html>