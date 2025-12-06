<?php

    $sql = "SELECT * FROM personal_info LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);


    $full_name = $info['full_name'] ?? "Your Name";
    $tagline = $info['tagline'] ?? "IT Student";
    $about = $info['about_summary'] ?? "Welcome to my portfolio!";
    $profile_picture = $info['profile_picture_url'] ?? "images/default_profile.png";

    // skills
    $sql = "SELECT * FROM skills ORDER BY id ASC";
    $skills_result = mysqli_query($conn, $sql);

    // Fetch projects
    $query = "SELECT * FROM projects ORDER BY id DESC";
    $projects_result = mysqli_query($conn, $query);

    // experience
    $exp_sql = "SELECT * FROM experience ORDER BY start_date DESC";
    $exp_result = mysqli_query($conn, $exp_sql);


?>