<?php
session_start();
include("post.php");
include("header.php");

?>



<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <Style>*{
    margin: 0;
    padding: 0;
    }
    .about-us{
    height: 140vh;
    width: 100%;
    padding: 100px 0;
    background: #ddd;
    }
    .pic{
    height: auto;
    width: 302px;
    }
    .about{
    width: 1130px;
    max-width: 85%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-around;
    }
    .text{
    width: 540px;
    }
    .text h2{
    font-size: 90px;
    font-weight: 600;
    margin-bottom: 10px;
    }
    .text h5{
    font-size: 22px;
    font-weight: 500;
    margin-bottom: 20px;
    }
    .text p{
    font-size: 18px;
    line-height: 25px;
    letter-spacing: 1px;
    }
    .data{
    margin-top: 30px;
    }
    .back{
    font-size: 18px;
    background: #4070f4;
    color: #fff;
    text-decoration: none;
    border: none;
    padding: 8px 25px;
    border-radius: 6px;
    transition: 0.5s;
    }
    .hire:hover{
    background: #000;
    border: 1px solid #4070f4;
    }
    </Style>
    <title> An About Us </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="about-us">
        <div class="about">
            <img src="images\letter-w.png" class="pic">
            <div class="text">
                <h2>About Us</h2>
                <p>Webbrotech Co is a leading technology company specializing in web development and software solutions.
                    With a dedicated team of skilled professionals, 
                    we strive to deliver innovative and cutting-edge solutions to our clients. 
                    One of our recent projects is the development of a team management system, 
                    which offers a comprehensive platform for organizing and managing teams effectively. 
                    This system allows users to create and manage teams, assign skill levels to teams, 
                    track the number of players, and schedule game days. It provides a user-friendly 
                    interface and ensures seamless collaboration among team members. Looking ahead, 
                    Webbrotech Co aims to further enhance this project by introducing advanced features 
                    such as real-time communication, player statistics, and automated scheduling. 
                    We are committed to delivering exceptional solutions that empower organizations 
                    and drive success in the ever-evolving digital landscape.</p>
                <div class="data">
                    <a href="dashboard.php" class="back">Back to dashboard</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>


<?php
include("footer.html");
?>