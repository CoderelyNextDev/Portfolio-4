<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
    <nav class="navbar">
        <h1 class="logo">Frances<span>Bascon</span></h1>
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="primary-navigation">
            <span class="hamburger"></span>
        </button>
        <ul id="primary-navigation" class="nav-links">
            <li><a class="<?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Home</a></li>
            <li><a class="<?= ($current_page == 'skills.php') ? 'active' : '' ?>" href="skills.php">Skills</a></li>
            <li><a class="<?= ($current_page == 'projects.php') ? 'active' : '' ?>" href="projects.php">Projects</a></li>
            <li><a class="<?= ($current_page == 'experience.php') ? 'active' : '' ?>" href="experience.php">Experience</a></li>
            <li><a class="<?= ($current_page == 'resume.php') ? 'active' : '' ?>" href="resume.php">Resume</a></li>
            <li><a class="<?= ($current_page == 'about.php') ? 'active' : '' ?>" href="about.php">About Me</a></li>
            <li><a class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>" href="contact.php">Contact</a></li>
            <li><a target="_blank" href="adminDashboard/adminDash.php">Admin Dashboard</a></li>
        </ul>
    </nav>
</header>
