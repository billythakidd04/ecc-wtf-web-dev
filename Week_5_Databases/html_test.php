<?php
ini_set('display_errors', 1);
?>
<!doctype html>
<html>

<head>
	<title>
		this is a title
	</title>
	<!-- bootstrap css not used atm-->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
	<!-- site css -->
	<link rel="shortcut icon" type="image/jpg" href="img/favicon.png" />
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/nav.css" />
</head>

<body>
	<header class="container">
		<nav>
			<div class="navbar">
				<a href="index.htm" class="navBtn">Home</a>
				<div class="dropdown">
					<button class="dropbtn">By Week</button>
					<div class="dropdown-content">
						<a href="">Week 1 - Intro to HTML</a>
						<a href="">Week 2 - CSS and intro to PHP</a>
						<a href="">Week 3 - GitHub and CLI</a>
						<a href="">Week 4 - Advanced CSS</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">By Language</button>
					<div class="dropdown-content">
						<a href="">HTML</a>
						<a href="">CSS</a>
						<a href="">PHP</a>
						<a href="">JS</a>
					</div>
				</div>
				<a href="https://github.com/billythakidd04/ecc-wtf-web-dev" class="navBtn">Go to GitHub</a>
			</div>
		</nav>
	</header>
	<main>
		<div id="intro">
			<!--This is my intro section i have stuff here-->
			<h1><a href="slides/">Click here for the slides</a></h1>
			<h3>This is my intro section!</h3>
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
					require_once('src/Group/group.php');
					require_once('src/Group/groups_maker.php');
					require_once('src/Student/student.php');

					$groups = Group::listGroups();
					$students = Student::listStudents();

					echo '<h1>Groups</h1>';
					echo '<pre>';
					var_dump($groups);
					echo '</pre>';

					echo '<h1>Students</h1>';
					echo '<pre>';
					var_dump($students);
					echo '</pre>';

					if (!empty($groups)) {
						while ($result = $groups->fetch_array(\MYSQLI_ASSOC)) {
							echo 'Groups<pre>';
							var_dump($result);
							echo '</pre>';
							// echo "<th>Member " . ($k + 1) . "</th>";
						}
					}

					if (!empty($students)) {
						while ($result = $students->fetch_array(\MYSQLI_ASSOC)) {
							echo 'Students<pre>';
							var_dump($result);
							echo '</pre>';
							// echo "<th>Member " . ($k + 1) . "</th>";
						}
					}
					?>
				</thead>
				<tbody>
					<?php
					if (!empty($groups)) {
						foreach ($groups as $key => $value) {
							echo '<tr>';
							echo ("<td>Group " . ($key + 1) . "</td>");

							foreach ($value as $id => $student) {
								echo "<td id='student_$id'>$student</td>";
							}
							echo '</tr>';
						}
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
			$student = new Student();
			$group = new Group();
			$bError = false;

			// var_dump($_POST);

			if (isset($_POST['submit-btn'])) {
				if (!empty(trim($_POST['firstName']))) {
					$student->sFirstName = trim($_POST['firstName']);
				} else {
					$bError = true;
					echo "<h1 style='color: red'>First Name cannot be empty!!</h1>";
				}

				if (!empty(trim($_POST['lastName']))) {
					$student->sLastName = trim($_POST['lastName']);
				} else {
					$bError = true;
					echo "<h1 style='color: red'>Last Name cannot be empty!!</h1>";
				}

				if (!empty(trim($_POST['email']))) {
					$student->sEmail = trim($_POST['email']);
				} else {
					$bError = true;
					echo "<h1 style='color: red'>Email cannot be empty!!</h1>";
				}

				if (!empty(trim($_POST['studentRepoURL']))) {
					$student->sRepoURL = trim($_POST['studentRepoURL']);
				} else {
					$bError = true;
					echo "<h1 style='color: red'>Personal Repository URL cannot be empty!!</h1>";
				}

				// if ($student  null && $bError) {
				// 	echo "<p>Full name entered:" . $first . ' ' . $last . "</p>";
				// 	echo "<p>Your info:" . $about . "</p>";
				// }

				if (!empty($_POST['things_i_like'])) {
					if (count($_POST['things_i_like']) > 0) {
						echo "Some things you like are:";
						foreach ($_POST['things_i_like'] as $key => $value) {
							echo "<li>" . $value . "</li>";
						}
					}
				}

				if (!empty(trim($_POST['groupNum']))) {
					$student->nGroupID = trim($_POST['groupNum']);
					$group->nGroupNum = $student->nGroupID;
				} else {
					$bError = true;
					echo "<h1 style='color: red'>Select a Group Number!!</h1>";
				}
				if (!empty(trim($_POST['groupURL']))) {
					$group->sRepoURL = trim($_POST['groupURL']);
				} else {
					$bError = true;
					echo "<h1 style='color: red'>Please enter the group URL!!</h1>";
				}

				if (!$bError) {
					echo ($group->createGroup()? '<h1>Group created success</h1>':'<h1>GROUP FAILURE</h1>');
					echo ($student->createStudent()? '<h1>Student created success</h1>':'<h1>STUDENT FAILURE</h1>');
				}
			}
			?>

			<form method="post" name='testform' id='testform' action='#testform'>
				<fieldset>
					<legend>User Info</legend>
					<label for="firstName">First Name</label>
					<input type="text" id="firstName" name="firstName" <?= ($student->sFirstName ? 'value="' . $student->sFirstName . '"' : ''); ?> placeholder="Enter your first name" required /></br>
					<label for="lastName">Last Name</label>
					<input type="text" id="lastName" name="lastName" <?= ($student->sLastName ? 'value="' . $student->sLastName . '"' : ''); ?> placeholder="Enter you last name" required></br>
					<label for="email">Email</label>
					<input type="email" id="email" name="email" <?= ($student->sEmail ? 'value="' . $student->sEmail . '"' : ''); ?> placeholder="Enter your email" required>
					<label for="studentRepoURL">Personal Repository URL</label>
					<input type="studentRepoURL" id="studentRepoURL" name="studentRepoURL" <?= ($student->sRepoURL ? 'value="' . $student->sRepoURL . '"' : ''); ?> placeholder="Enter your GitHub URL" required>
					<fieldset>
						<legend>I like:</legend>
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
				</fieldset>
				<fieldset>
					<legend>Group Info</legend>
					<label for="groupNum">Group Number</label>
					<input type="number" min="1" max="4" id="groupNum" name="groupNum" <?= ($group->nGroupNum ? 'value="' . $group->nGroupNum . '"' : ''); ?> required></br>
					<label for="groupURL">Group Repo URL</label>
					<input type="url" id="groupURL" name="groupURL" <?= ($group->sRepoURL ? 'value="' . $group->sRepoURL . '"' : ''); ?> required></br>
				</fieldset>
				<input type="submit" name="submit-btn" value="Go" />
			</form>
		</div>
	</main>
	<footer></footer>
	<!-- bootstrap js load last -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html