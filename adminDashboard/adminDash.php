<?php include('includes/head.php')?>
    <?php include('includes/sidebar.php')?>
    <main class="main-content">
        <div class="header">
            <div class="header-left">
                <h2>Welcome Admin</h2>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-value"><?php echo $skills_count; ?></div>
                        <div class="stat-label">Total Skills</div>
                    </div>
                    <div class="stat-icon">💻</div>
                </div>
                <div class="stat-footer">
                    <a href="manage_skills.php" class="btn-manage">Manage Skills →</a>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-header">
                    <div>
                        <div class="stat-value"><?php echo $exp_count; ?></div>
                        <div class="stat-label">Experience Records</div>
                    </div>
                    <div class="stat-icon">💼</div>
                </div>
                <div class="stat-footer">
                    <a href="manage_experience.php" class="btn-manage">Manage Experience →</a>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-header">
                    <div>
                        <div class="stat-value"><?php echo $projects_count; ?></div>
                        <div class="stat-label">Total Projects</div>
                    </div>
                    <div class="stat-icon">🚀</div>
                </div>
                <div class="stat-footer">
                    <a href="manage_projects.php" class="btn-manage">Manage Projects →</a>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-header">
                    <div>
                        <div class="stat-value"><?php echo $messages_count; ?></div>
                        <div class="stat-label">Contact Messages</div>
                    </div>
                    <div class="stat-icon">✉️</div>
                </div>
                <div class="stat-footer">
                    <a href="manage_messages.php" class="btn-manage">View Messages →</a>
                    <?php if ($unread_messages > 0): ?>
                        <span style="color: var(--danger); font-weight: 600; font-size: 0.875rem;">
                            <?php echo $unread_messages; ?> New
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php mysqli_close($conn); ?>