<?php
session_start();
include("post.php");
include("header.php");


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_name = $_POST["teamname"];
    $skill = $_POST["skill-level"];
    $day =  $_POST["gameday"];
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $db_name = "x";
    $conn->exec("USE $db_name");

    $sql = "INSERT INTO teams (team_name, team_skill, players_num, game_date) VALUES (:team_name, :skill, 0, :day)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':skill', $skill);
    $stmt->bindParam(':day', $day);

    $stmt->execute();

    $_SESSION["teamname"] = $team_name;
    $_SESSION["skill-level"] = $skill;
    $_SESSION["gameday"] = $day;

    // Redirect the user to the home page
    header("Location: dashboard.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Teamt</title>
</head>
<body">
    <link rel="stylesheet" href="newteam.css">
    <div class="center-div">
        <div class="signup-container">
            <p class="title2">Add New Team</p>
            <form class="form" method="POST">
                <div class="input-group">
                    <label for="teamname">Team Name</label>
                    <input type="text" name="teamname" id="teamname" required>
                </div>
                <div class="input-group">
                    <label for="skill-level">Skill level</label>
                    <input type="text" name="skill-level" id="skill-level" required>
                </div>
                <div class="input-group">
                    <label for="gameday">Game Day</label>
                    <input type="text" name="gameday" id="gameday" required>
                    <br><br>
                </div>
                <button class="newteam">Submit</button>
            </form>
        </div>
    </div>
    </body>

</html>






<?php
include("footer.html");
?>