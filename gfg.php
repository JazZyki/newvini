<?php
if(isset($_POST['submit'])) {
    $file = "gfg.json";
    $arr = array(
        'name'     => $_POST['name'],
        'email'    => $_POST['email'],
        'phone'    => $_POST['cell'],
        'birthday' => $_POST['dob'],
        'years'    => $_POST['study']
    );
    $json_string = json_encode($arr);
    file_put_contents($file, $json_string);
    echo $json_string;
}
?>
<!doctype html>
<html>
<head>
</head>
<body>
<div style="text-align: center;">
    <h1>Form</h1>
    <form name="form1" method="post" action="">
        <p>
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" placeholder="Your full name" autofocus required>
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email">
        </p>
        <p>
            <label for="cell">Cell: </label>
            <input type="tel" name="cell" id="cell">
        </p>
        <p>
            <label for="dob">Date of birth: </label>
            <input type="date" name="dob" id="dob">
        </p>
        <p>
            <label for="study">Years of art study: </label>
            0 <input type="range" name="study" id="study" min="0" max="16"> 16
        </p>
        <p style="text-align: center;">
            <input type="submit" name="submit" id="submit" value="Submit">
        </p>
    </form>
</div>
</body>
</html>