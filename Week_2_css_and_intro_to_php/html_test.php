<?php
ini_set('display_errors', 1);
?>
<!doctype html>
<html>

<head>
    <title>
        this is a title
    </title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
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
                require_once('src/groups_maker.php');
                $groups = createGroups();

                // Debugging
                // echo '<pre>';
                // var_dump($groups);
                // echo '</pre>';

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
        <p>Here's a cool picture of space. If you want to learn more about space <strong>click it!</strong><br />
            <a href="https://bfy.tw/QIyN">
                <img src="img/reflection-nebulae-vdb-14--15-adam-blockscience-photo-library.jpg">
            </a>
            <br />
            This is just some other image of space.<br />
            <img src="https://previews.123rf.com/images/nasaimages/nasaimages1804/nasaimages180400298/98681418-reflection-nebula-the-site-of-star-formation-.jpg">
        </p>
    </div>

    <div id="form" name="form">
        <?php
        $first = '';
        $last = '';
        if (isset($_POST['submit-btn'])) {

            if (!empty($_POST['firstName'])) {
                $first = $_POST['firstName'];
            } else {
                echo "<h1 style='color: red'>First Name cannot be empty!!</h1>";
            }

            if (!empty($_POST['lastName'])) {
                $last = $_POST['lastName'];
            } else {
                echo "<h1 style='color: red'>Last Name cannot be empty!!</h1>";
            }

            echo "<p>Full name entered:" . $first . ' ' . $last . "</p>";

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
            <input type="text" name="firstName" <?= ($first ? 'value="' . $first . '"' : ''); ?> placeholder="first name" />
            <input type="text" name="lastName" <?= ($last ? 'value="' . $last . '"' : ''); ?> placeholder="Enter you last name"'></br>
            <input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][0]) ? 'checked' : ''); ?> value="tv"/>Tv</br>
            <input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][1]) ? 'checked' : ''); ?> value="movies"/>movies</br>
            <input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][2]) ? 'checked' : ''); ?> value="music"/>music</br>
            <input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][3]) ? 'checked' : ''); ?> value="games"/>games</br>
            <input type="checkbox" name="things_i_like[]" <?= (!empty($_POST['things_i_like'][4]) ? 'checked' : ''); ?> value="computers"/>computers</br>
            <input type="submit" name="submit-btn" value="Go"/>
        </form>
    </div>
</body>

</html>