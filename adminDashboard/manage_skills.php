<?php include('includes/head.php'); ?>
<body>
    <?php include('includes/sidebar.php')?>
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2> Manage Skills</h2>
                <p>Add, edit, or remove your technical skills</p>
            </div>
            <div class="header-right">
                <div class="stat-badge">
                    <span class="badge-value"><?php echo $skills_count; ?></span>
                    <span class="badge-label">Total Skills</span>
                </div>
            </div>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <span class="alert-icon">✅</span>
                <span><?php echo $success_message; ?></span>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <span class="alert-icon">❌</span>
                <span><?php echo $error_message; ?></span>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        <?php endif; ?>

        <!-- Add/Edit Form -->
        <div class="form-card">
            <div class="form-header">
                <h3><?php echo $edit_skill ? 'Edit Skill' : 'Add New Skill'; ?></h3>
            </div>
            
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                <?php if ($edit_skill): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_skill['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title">Skill Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-control" 
                            placeholder="e.g., Web Development"
                            value="<?php echo $edit_skill ? htmlspecialchars($edit_skill['title']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon (Emoji)</label>
                        <input 
                            type="text" 
                            id="icon" 
                            name="icon" 
                            class="form-control" 
                            placeholder="e.g., 💻"
                            value="<?php echo $edit_skill ? htmlspecialchars($edit_skill['icon']) : ''; ?>"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control" 
                        rows="4" 
                        placeholder="Describe your skill and experience..."
                        required><?php echo $edit_skill ? htmlspecialchars($edit_skill['description']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="proficiency">Proficiency Level: <span id="proficiency-value"><?php echo $edit_skill ? $edit_skill['proficiency'] : 50; ?>%</span></label>
                    <input 
                        type="range" 
                        id="proficiency" 
                        name="proficiency" 
                        class="form-range" 
                        min="0" 
                        max="100" 
                        value="<?php echo $edit_skill ? $edit_skill['proficiency'] : 50; ?>"
                        oninput="document.getElementById('proficiency-value').textContent = this.value + '%'">
                    <div class="range-labels">
                        <span>Beginner</span>
                        <span>Intermediate</span>
                        <span>Expert</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-seconadary">
                        <?php echo $edit_skill ? ' Update Skill' : ' Add Skill'; ?>
                    </button>
                    <?php if ($edit_skill): ?>
                        <a href="manage_skills.php" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Skills List -->
        <div class="table-card">
            <div class="table-header">
                <h3> All Skills</h3>
            </div>

            <?php if ($skills_count > 0): ?>
                <div class="skills-grid">
                    <?php while ($skill = mysqli_fetch_assoc($skills_query)): ?>
                        <div class="skill-card">
                            <div class="skill-icon"><?php echo $skill['icon']; ?></div>
                            <div class="skill-content">
                                <h4><?php echo htmlspecialchars($skill['title']); ?></h4>
                                <p><?php echo htmlspecialchars($skill['description']); ?></p>
                                
                                <div class="skill-proficiency">
                                    <div class="proficiency-label">
                                        <span>Proficiency</span>
                                        <span class="proficiency-value"><?php echo $skill['proficiency']; ?>%</span>
                                    </div>
                                    <div class="proficiency-bar">
                                        <div class="proficiency-fill" style="width: <?php echo $skill['proficiency']; ?>%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="skill-actions">
                                <a href="manage_skills.php?edit=<?php echo $skill['id']; ?>" class="btn-icon btn-edit" title="Edit">
                                    ✏️
                                </a>
                                <a href="manage_skills.php?delete=<?php echo $skill['id']; ?>" 
                                   class="btn-icon btn-delete" 
                                   title="Delete"
                                   onclick="return confirm('Are you sure you want to delete this skill?')">
                                    🗑️
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>No Skills Added Yet</h3>
                    <p>Start adding your skills using the form above</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>

<?php mysqli_close($conn); ?>