<?php
ini_set('display_errors', 1);
?>
<!doctype html>
<html>

<head>
	<title>
		this is a title
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="css/styles.css" /> 
	<link rel="stylesheet" href="css/nav.css" /> -->
	<style>
		.navbar {
			background-color: rgb(51, 4, 4);
		}
	</style>
</head>

<body>
	<header class="container-fluid">
		<div id="intro" class="jumbotron">
			<!-- This is my intro section i have stuff here -->
			<div class="row">
				<h1 class="col-8">This is my intro section!<a href="slides/"><span class="badge bg-warning text-dark">Click4Slides!</span></a></h1>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark">
			<div class="container-fluid">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="html-test.php" class="nav-link">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a role="button" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							By Week
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-item">
								<a href="../Week_1_intro_to_html/html_test.html">Week 1 - Intro to HTML</a>
							</li>
							<li class="dropdown-item">
								<a href="../Week_2_css_and_intro_to_php/html_test.php">Week 2 - CSS and intro to PHP</a>
							</li>
							<li class="dropdown-item">
								<a href="../Week_3_github_and_cli/html_test.php">Week 3 - GitHub and CLI</a>
							</li>
							<li class="dropdown-item">
								<a href="../Week_4_Advanced_CSS/html_test.php">Week 4 - Advanced CSS</a>
							</li>
						</ul>
					</li>
					<!-- TODO Fix this section -->
					<!-- <li class="nav-item dropdown">
						<a role="button" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							By Topic
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-item"><a href="">HTML</a></li>
							<li class="dropdown-item"><a href="">CSS</a></li>
							<li class="dropdown-item"><a href="">PHP</a></li>
							<li class="dropdown-item"><a href="">CLI</a></li>
						</ul>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="https://github.com/billythakidd04/ecc-wtf-web-dev" class="navBtn">Go to GitHub</a>
					</li>
				</ul>
				<a class="navbar-brand" href="#">ECC WFD</a>
			</div>
		</nav>
	</header>
	<main>
		<div id="tables">

			<p>Aint it nice? have some lorem ipsum</p>
			<p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo sunt est voluptatem rerum quisquam, accusantium
				illo cupiditate quas quam blanditiis nostrum perspiciatis quae. Sunt iusto, recusandae inventore nostrum
				doloribus eos!
			</p>
			<ul>
				<li>thing</li>
				<li>thing</li>
				<li>thing</li>
				<li>thing</li>
			</ul>
		</div>
		<div id="tables">
			<h3>This is my table section!</h3>
			<p>The table below is created dynamically from a php script...</p>
			<table>
				<thead>
					<th></th>
					<?php
					require_once('src/groups_maker.php');
					$groups = createGroups();

					foreach (max($groups) as $k => $v) {
						echo "<th>Member " . ($k + 1) . "</th>";
					}
					?>
				</thead>
				<tbody>
					<?php
					foreach ($groups as $key => $value) {
						echo '<tr>';
						echo ("<td>Group " . ($key + 1) . "</td>");

						foreach ($value as $id => $student) {
							echo "<td id='student_$id'>$student</td>";
						}
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div id="links">
			<!-- links -->
			<h3>This is my links section!</h3>
			<a href="https://www.google.com" target="_blank">This is a link to google</a>
			<br />
			<a href="test_2/test_2.htm" target="_blank">This is a test page on my site</a>
		</div>
		<div id="images">
			<h3>This is my images section!</h3>
			<div>
				<p>If you want to learn more about space <strong>click here!</strong></p>
				<a href="https://bfy.tw/QIyN">
					<img src="img/reflection-nebulae-vdb-14--15-adam-blockscience-photo-library.jpg" alt="A cool picture of space. If you want to learn more about space click it!" />
				</a>
			</div>
			<div>
				<p>This is just some other image of space.</p>
				<img src="https://previews.123rf.com/images/nasaimages/nasaimages1804/nasaimages180400298/98681418-reflection-nebula-the-site-of-star-formation-.jpg" alt="This is just some other image of space" />
			</div>
		</div>

		<div id="form" name="form">
			<?php
			$first = '';
			$last = '';
			$about = '';

			if (isset($_POST['submit-btn'])) {

				if (!empty(trim($_POST['firstName']))) {
					$first = trim($_POST['firstName']);
				} else {
					echo "<h1 style='color: red'>First Name cannot be empty!!</h1>";
				}

				if (!empty(trim($_POST['lastName']))) {
					$last = trim($_POST['lastName']);
				} else {
					echo "<h1 style='color: red'>Last Name cannot be empty!!</h1>";
				}

				if (!empty(trim($_POST['aboutMe']))) {
					$about = trim($_POST['aboutMe']);
				} else {
					echo "<h1 style='color: red'>About Me cannot be empty!!</h1>";
				}

				if ($first && $last) {
					echo "<p>Full name entered:" . $first . ' ' . $last . "</p>";
					echo "<p>Your info:" . $about . "</p>";
				}

				if (!empty($_POST['things_i_like'])) {
					if (count($_POST['things_i_like']) > 0) {
						echo "Some things you like are:";
						foreach ($_POST['things_i_like'] as $key => $value) {
							echo "<li>" . $value . "</li>";
						}
					}
				}
			}
			?>

			<form method="post" name='testform' id='testform' action='#testform'>
				<fieldset>
					<legend>Text Inputs</legend>
					<label for="firstName">First Name</label>
					<input type="text" id="firstName" name="firstName" <?= ($first ? 'value="' . $first . '"' : ''); ?> placeholder="first name" required /></br>
					<label for="lastName">Last Name</label>
					<input type="text" id="lastName" name="lastName" <?= ($last ? 'value="' . $last . '"' : ''); ?> placeholder="Enter you last name"' required></br>
				<label for="aboutMe">Tell us about yourself</label>
				<textarea id="aboutMe" name="aboutMe" placeholder="Tell us something you would like us to know about you"' required><?= ($about ? $about : ''); ?></textarea></br>
				</fieldset>
				<fieldset>
					<legend>Checkboxes</legend>
					<label for="til_tv">TV</label>
					<input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][0]) ? 'checked' : ''); ?> value="tv" id="til_tv" /></br>
					<label for="til_movies">Movies</label>
					<input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][1]) ? 'checked' : ''); ?> value="movies" id="til_movies" /></br>
					<label for="til_music">Music</label>
					<input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][2]) ? 'checked' : ''); ?> value="music" id="til_music" /></br>
					<label for="til_games">Gaming</label>
					<input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][3]) ? 'checked' : ''); ?> value="games" id="til_games" /></br>
					<label for="til_computers">Computers</label>
					<input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][4]) ? 'checked' : ''); ?> value="computers" id="til_computers" /></br>
				</fieldset>
				<input type="submit" name="submit-btn" value="Go" />
			</form>
		</div>
	</main>
	<footer></footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>