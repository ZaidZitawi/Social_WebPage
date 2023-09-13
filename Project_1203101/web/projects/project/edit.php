<?php
session_start();
include("post.php");
include("header.php");


// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit();
}

// Check if the team ID is provided in the query parameter
if (isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];

    // Retrieve the team information from the database based on the team ID
    $sql = "SELECT * FROM teams WHERE team_id = :team_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $team = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the form data
            $team_name = $_POST["team_name"];
            $skill_level = $_POST["skill_level"];
            $game_day = $_POST["game_day"];

            // Update the team information in the database
            $sql_update = "UPDATE teams SET team_name = :team_name, team_skill = :team_skill, game_date = :game_date WHERE team_id = :team_id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':team_name', $team_name);
            $stmt_update->bindParam(':team_skill', $skill_level);
            $stmt_update->bindParam(':game_date', $game_day);
            $stmt_update->bindParam(':team_id', $team_id);
            $stmt_update->execute();

            // Redirect the user to the dashboard
            header("Location: dashboard.php");
            exit();
        }

        // Display the form with pre-filled team information
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Team</title>

</head>

<body>
    <h1>Edit Team</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
        <label for="team_name">Team Name:</label>
        <input type="text" name="team_name" id="team_name" value="<?php echo $team['team_name']; ?>" required><br><br>
        <label for="skill_level">Skill Level:</label>
        <input type="text" name="skill_level" id="skill_level" value="<?php echo $team['team_skill']; ?>" required><br><br>
        <label for="game_day">Game Day:</label>
        <input type="text" name="game_day" id="game_day" value="<?php echo $team['game_date']; ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
    <br>
</body>

</html>

<?php
    }else {
        echo "Team not found.";
    }
    }else {
        echo "Invalid team ID.";
}

// Close the database connection
$conn = null;
?>






<?php
include("footer.html");
?>