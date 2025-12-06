<?php 
    $current_page = basename($_SERVER['PHP_SELF']); 
?>
<aside class="sidebar">
    <div class="logo">
        <h1>Admin</h1>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="adminDash.php" 
               class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                <span class="nav-icon">🏠</span>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_skills.php" 
               class="nav-link <?= ($current_page == 'manage_skills.php') ? 'active' : '' ?>">
                <span class="nav-icon">🛠️</span>
                <span>Skills</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="personal_info.php" 
               class="nav-link <?= ($current_page == 'personal_info.php') ? 'active' : '' ?>">
                <span class="nav-icon">💻</span>
                <span>Personal Info</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_experience.php" 
               class="nav-link <?= ($current_page == 'manage_experience.php') ? 'active' : '' ?>">
                <span class="nav-icon">💼</span>
                <span>Experience</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_projects.php" 
               class="nav-link <?= ($current_page == 'manage_projects.php') ? 'active' : '' ?>">
                <span class="nav-icon">🚀</span>
                <span>Projects</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_messages.php" 
               class="nav-link <?= ($current_page == 'manage_messages.php') ? 'active' : '' ?>">
                <span class="nav-icon">✉️</span>
                <span>Messages</span>
            </a>
        </li>
    </ul>
</aside>
