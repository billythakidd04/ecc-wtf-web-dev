<!doctype html>
<html>

<head>
    <title>
        this is a title
    </title>
    <!-- <style>
        p {
            color: green;
        }
        div[name="intro"] {
            background: red;
        }
    </style> -->
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
</head>

<body>
    <div name="intro">
        <!--This is my intro section i have stuff here-->
        <h3 style="color: red;">This is my intro section!</h3>
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
    <div name="tables">
        <h3>This is my table section!</h3>
        <p>The table below is created dynamically from a php script...</p>
        <table>
            <thead>
                <th></th>
                <?php
                require_once('src/groups_maker.php');
                $groups = createGroups();

                // echo '<pre>';
                // var_dump($groups);
                // echo '</pre>';

                foreach ($groups[0] as $k => $v) {
                    echo "<th>Member " . ($k + 1) . "</th>";
                } ?>
            </thead>
            <tbody>
                <?php
                foreach ($groups as $key => $value) {
                ?>
                    <tr>
                        <?php
                        echo ("<td>Group " . ($key + 1) . "</td>");

                        foreach ($value as $id => $student) {
                            echo "<td id='student_$id'>$student</td>";
                        } ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div name=links>
        <!-- links -->
        <h3>This is my links section!</h3>
        <a href="https://www.google.com" target="_blank">This is a link to google</a>
        <br />
        <a href="test_2/test_2.htm" target="_blank">This is a test page on my site</a>
    </div>
    <div name="images">
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
</body>

</html>