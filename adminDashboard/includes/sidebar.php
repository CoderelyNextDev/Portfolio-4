<?php 
    $current_page = basename($_SERVER['PHP_SELF']); 
?>
<style>
.sidebar-toggle {
    position: fixed;
    top: 20px;
    left: 20px;
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, var(--danger) 0%, var(--primary) 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    z-index: 1001;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0;
    transition: all 0.3s ease;
}

.sidebar-toggle:hover {
    transform: scale(1.05);
}

.sidebar-toggle:active {
    transform: scale(0.95);
}

/* Hamburger Lines */
.sidebar-toggle span {
    display: block;
    width: 22px;
    height: 2.5px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s ease;
}
body.sidebar-open .sidebar-toggle span:nth-child(1) {
    transform: rotate(45deg) translate(6px, 6px);
}

body.sidebar-open .sidebar-toggle span:nth-child(2) {
    opacity: 0;
}

body.sidebar-open .sidebar-toggle span:nth-child(3) {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Sidebar Overlay */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.sidebar-overlay.active {
    opacity: 1;
    visibility: visible;
}

@media (max-width: 768px) {
    .sidebar-toggle {
        display: flex;
    }
}


@media (max-width: 480px) {
    .sidebar-toggle {
        width: 40px;
        height: 40px;
        top: 15px;
        left: 15px;
    }

    .sidebar-toggle span {
        width: 20px;
        height: 2px;
    }
}
</style>

<button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
    <span></span>
    <span></span>
    <span></span>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="logo">
        <h1>Admin</h1>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="adminDash.php" 
               class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_skills.php" 
               class="nav-link <?= ($current_page == 'manage_skills.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Skills</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="personal_info.php" 
               class="nav-link <?= ($current_page == 'personal_info.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Personal Info</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_experience.php" 
               class="nav-link <?= ($current_page == 'manage_experience.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Experience</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_projects.php" 
               class="nav-link <?= ($current_page == 'manage_projects.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Projects</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="manage_messages.php" 
               class="nav-link <?= ($current_page == 'manage_messages.php') ? 'active' : '' ?>">
                <span class="nav-icon"></span>
                <span>Messages</span>
            </a>
        </li>
    </ul>
</aside>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');


    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
        document.body.classList.toggle('sidebar-open');
    });

        sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    });

  
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.classList.remove('sidebar-open');
            }
        });
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
    });
});
</script>