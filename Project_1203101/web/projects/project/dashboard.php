<?php
session_start();
include("post.php");
include("header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>

</head>

<body>
    <link rel="stylesheet" href="dashboard.css">
    <h1>Teams Table</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Team name</th>
                    <th>Skill of the team</th>
                    <th>Number of players</th>
                    <th>Game Day</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM teams";
                $stmt = $conn->query($sql);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td><a href="view.php?team_id=' . $row["team_id"] . '">' . $row["team_name"] . '</a></td>';
                        echo '<td>' . $row["team_skill"] . '</td>';
                        echo '<td>' . $row["players_num"] . '</td>';
                        echo '<td>' . $row["game_date"] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No teams found.</td></tr>';
                }

                ?>
            </tbody>
        </table>
    </div>
    <!-- <input type="submit" id="addteam" name="addteam" Add Team> -->
    <a href="new.php" style="text-decoration: none;">
        <button id="addteam">Add Team</button>
    </a>
</body>

</html>


<?php
$email = $_SESSION["username"];
$pass = $_SESSION["password"];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


include("footer.html");
?>