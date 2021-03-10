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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
					// tell our server we need the contents of these files
					require_once('src/Group/group.php');
					require_once('src/Student/student.php');

					// get an array of all groups from the db
					$groups = \Group::listGroups();

					// make sure we have some groups to loop through
					if (!empty($groups)) {
						// keep track of highest number of group members
						$maxNum = 0;

						// loop over each group to get the member count
						foreach ($groups as $group) {
							// if max is less than current groups count, set max to current count otherwise leave it
							$maxNum = ($maxNum < $group->countMembers() ? $group->countMembers() : $maxNum);
						}

						// create header row with number of slots based on max member count
						for ($i = 0; $i < $maxNum; ++$i) {
							echo '<th>Member ' . ($i + 1) . '</th>';
						}
						// dont forget to create a header for the repo url
						echo '<th>Group Repo URL</th>';
					}
					?>
				</thead>
				<tbody>
					<?php
					// make sure we have some groups to loop through
					if (!empty($groups)) {
						// for each group
						foreach ($groups as $group) {
							// create a label for that group number
							echo '<tr><td>Group Number ' . $group->getGroupNumber() . '</td>';
							// get a list of students in that group
							$students = Student::listStudentsByGroup($group);
							// keep track of the member count
							$memCount = 0;
							// loop over each student
							foreach ($students as $student) {
								// create slot for the student with first and last name
								echo '<td>'.$student->getFirstName().' '.$student->getLastName().'</td>';
								// don't forget to update the count
								$memCount++;
							}
							// make sure we even off the table
							while ($memCount < $maxNum) {
								// insert an empty td for smaller groups
								echo '<td></td>';
								// update the mem count so we dont loop forever
								$memCount++;
							}

							$repoURL = urldecode($group->getRepositoryURL());
							// create the slot for the group repo
							echo "<td><a href='$repoURL'>$repoURL</a></td>";
							// finish that row and go on to the next group
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
			$error = array();
			$bError = false;

			if (isset($_POST['submit-btn'])) {
				if (!empty(trim($_POST['firstName']))) {
					$student->firstName = trim($_POST['firstName']);
				} else {
					$bError = true;
					$error['firstName'] = 'First Name cannot be empty!!';
				}

				if (!empty(trim($_POST['lastName']))) {
					$student->setLastName(trim($_POST['lastName']));
				} else {
					$bError = true;
					$error['lastName'] = 'Last Name cannot be empty!!';
				}

				if (!empty(trim($_POST['email']))) {
					$student->setEmail(trim($_POST['email']));
				} else {
					$bError = true;
					$error['email'] = 'Email cannot be empty!!';
				}

				if (!empty(trim($_POST['studentRepoURL']))) {
					$student->setRepositoryURL(trim($_POST['studentRepoURL']));
				} else {
					$bError = true;
					$error['studentRepoURL'] = 'Personal Repository URL cannot be empty!!';
				}

				if (!empty($_POST['things_i_like'])) {
					if (count($_POST['things_i_like']) > 0) {
						echo "Some things you like are:";
						foreach ($_POST['things_i_like'] as $key => $value) {
							echo "<li>" . $value . "</li>";
						}
					}
				}

				if (!empty(trim($_POST['groupNum']))) {
					$group->setGroupNumber($_POST['groupNum']);
				} else {
					$bError = true;
					$error['groupNum'] = 'Select a Group Number!!';
				}
				if (!empty(trim($_POST['groupURL']))) {
					$group->setRepositoryURL(trim($_POST['groupURL']));
				} else {
					$bError = true;
					$error['groupURL'] = 'Please enter the group URL!!';
				}

				if (!$bError) {
					$groupID = $group->createGroup();
					if($groupID){
						$student->groupID = $groupID;
						echo '<h1>Group created success</h1>';
					} else {
						echo '<h1>GROUP FAILURE</h1>';
					}
					echo ($student->createStudent()? '<h1>Student created success</h1>':'<h1>STUDENT FAILURE</h1>');
				}
			}
			?>

			<form method="post" name='testform' id='testform' action='#testform'>
				<fieldset class="form-group">
				<div class="form-row">
					<legend>User Info</legend>
					<label for="firstName">First Name</label>
					<input type="text" class="form-control <?=(isset($error['firstName'])?'is-invalid':'')?>" id="firstName" name="firstName" <?= ($student->getFirstName() ? 'value="' . $student->getFirstName() . '"' : ''); ?> placeholder="Enter your first name" required />
					<label for="lastName">Last Name</label>
					<input type="text" class="form-control" id="lastName" name="lastName" <?= ($student->getLastName() ? 'value="' . $student->getLastName() . '"' : ''); ?> placeholder="Enter you last name" required>
				</div>
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" <?= ($student->getEmail() ? 'value="' . $student->getEmail() . '"' : ''); ?> placeholder="Enter your email" required><br />
					<label for="studentRepoURL">Personal Repository URL</label>
					<input type="studentRepoURL" class="form-control" id="studentRepoURL" name="studentRepoURL" <?= ($student->getRepositoryURL() ? 'value="' . $student->getRepositoryURL() . '"' : ''); ?> placeholder="Enter your GitHub URL" required>
					<fieldset class="form-check">
						<legend>I like:</legend>
						<label for="til_tv">TV</label>
						<input type="checkbox" class="form-check-input" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][0]) ? 'checked' : ''); ?> value="tv" id="til_tv" /></br>
						<label for="til_movies">Movies</label>
						<input type="checkbox" class="form-check-input" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][1]) ? 'checked' : ''); ?> value="movies" id="til_movies" /></br>
						<label for="til_music">Music</label>
						<input type="checkbox" class="form-check-input" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][2]) ? 'checked' : ''); ?> value="music" id="til_music" /></br>
						<label for="til_games">Gaming</label>
						<input type="checkbox" class="form-check-input" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][3]) ? 'checked' : ''); ?> value="games" id="til_games" /></br>
						<label for="til_computers">Computers</label>
						<input type="checkbox" class="form-check-input" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][4]) ? 'checked' : ''); ?> value="computers" id="til_computers" /></br>
					</fieldset>
				</fieldset>
				<fieldset class="form-group">
					<legend>Group Info</legend>
					<label for="groupNum">Group Number</label>
					<input type="number" min="1" max="4" id="groupNum" name="groupNum" <?= ($group->getGroupNumber() ? 'value="' . $group->getGroupNumber() . '"' : ''); ?> required></br>
					<label for="groupURL">Group Repo URL</label>
					<input type="url" id="groupURL" name="groupURL" <?= ($group->getRepositoryURL() ? 'value="' . $group->getRepositoryURL() . '"' : ''); ?> required></br>
				</fieldset>
				<input type="submit" name="submit-btn" value="Go"/>
			</form>
		</div>
	</main>
	<footer></footer>
	<!-- bootstrap js load last -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	<script src="js/main.js"></script>
</body>

</html>