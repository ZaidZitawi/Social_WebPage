<?php
session_start();
include("post.php");
include("header.php");
// Check if the team ID is provided in the query parameter
if (isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];

    // Retrieve the team information from the database based on the team ID
    $sql = "SELECT * FROM teams WHERE team_id = :team_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->execute();
    $team = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($team) {
        // Display the team information
        echo '<h1>Team Information</h1>';
        echo '<ol>';
        echo '<li>Team Name: ' . $team['team_name'] . '</li>';
        echo '<li>Skill of the Team: ' . $team['team_skill'] . '</li>';
        echo '<li>Number of Players: ' . $team['players_num'] . '</li>';
        echo '<li>Game Day: ' . $team['game_date'] . '</li>';
        echo '</ol>';

        // Retrieve the players in the team from the database
        $sql_players = "SELECT * FROM players WHERE team_id = :team_id";
        $stmt_players = $conn->prepare($sql_players);
        $stmt_players->bindParam(':team_id', $team_id);
        $stmt_players->execute();
        $players = $stmt_players->fetchAll(PDO::FETCH_ASSOC);

        if ($players) {
            echo '<h2>Players in the Team</h2>';
            echo '<ul>';
            foreach ($players as $player) {
                echo '<li>' . $player['player_name'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo 'No players found in the team.';
        }
    } else {
        echo 'Team not found.';
    }
} else {
    echo 'Invalid team ID.';
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addplayer"])) {
    $team_id = $_GET["team_id"];
    $player_name = $_POST["playername"];

    // Check if the team is full (players number is 9)
    $sql_team = "SELECT * FROM teams WHERE team_id = :team_id";
    $stmt_team = $conn->prepare($sql_team);
    $stmt_team->bindParam(':team_id', $team_id);
    $stmt_team->execute();
    $team = $stmt_team->fetch(PDO::FETCH_ASSOC);

    if ($team) {
        $current_players_num = $team['players_num'];

        if ($current_players_num >= 9) {
            $error = "This team is already full. No more players can be added.";
        } else {
            // Insert the new player into the database
            $sql_insert = "INSERT INTO players (team_id, player_name) VALUES (:team_id, :player_name)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':team_id', $team_id);
            $stmt_insert->bindParam(':player_name', $player_name);
            $result_insert = $stmt_insert->execute();

            if ($result_insert) {
                // Increment the players_num attribute by 1
                $new_players_num = $current_players_num + 1;
                $sql_update = "UPDATE teams SET players_num = :new_players_num WHERE team_id = :team_id";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bindParam(':new_players_num', $new_players_num);
                $stmt_update->bindParam(':team_id', $team_id);
                $result_update = $stmt_update->execute();

                if ($result_update) {
                    $success = "Player successfully added to the team.";
                }
            }
        }
    }
}

if (isset($_POST['deleteteam'])) {
    $team_id = $_GET['team_id'];
    // Delete the players in the team from the database
    $sql_delete_players = "DELETE FROM players WHERE team_id = :team_id";
    $stmt_delete_players = $conn->prepare($sql_delete_players);
    $stmt_delete_players->bindParam(':team_id', $team_id);
    $result_delete_players = $stmt_delete_players->execute();

    // Delete the team from the database
    $sql_delete = "DELETE FROM teams WHERE team_id = :team_id";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bindParam(':team_id', $team_id);
    $result_delete = $stmt_delete->execute();

    if ($result_delete) {
        $success = "Team successfully deleted.";
    } else {
        $error = "Error deleting the team.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Team Details</title>
</head>

<body>
    <link rel="stylesheet" href="view.css">
    <div class="center-div">
        <div class="view-container">
            <p class="title1">Add/Delete Player</p>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <?php if (isset($success)) { ?>
                <p class="success"><?php echo $success; ?></p>
            <?php } ?>
            <form class="form" method="post">
                <div class="input-group">
                    <label for="playername">Player Name</label>
                    <input type="text" name="playername">
                </div>
                <button class="view" name="addplayer">Add Player</button>
                <button class="view" name="deleteteam">Delete Team</button>
                <a href="edit.php?team_id=<?php echo $team_id; ?>" style="text-decoration: none; width:85%" class="view">Edit Team</a>
            </form>
        </div>
    </div>
</body>



</html>

<?php
include("footer.html");
?>