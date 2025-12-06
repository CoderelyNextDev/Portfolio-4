<?php include('includes/head.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2>🚀 Manage Projects</h2>
                <p>Showcase your portfolio projects and achievements</p>
            </div>
            <div class="header-right">
                <div class="stat-badge">
                    <span class="badge-value"><?php echo $projects_count; ?></span>
                    <span class="badge-label">Total Projects</span>
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
                <h3><?php echo $edit_project ? '✏️ Edit Project' : '➕ Add New Project'; ?></h3>
            </div>
            
            <form method="POST" action="manage_projects.php">
                <?php if ($edit_project): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_project['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-control" 
                            placeholder="e.g., E-Commerce Platform"
                            value="<?php echo $edit_project ? htmlspecialchars($edit_project['title']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <input 
                            type="text" 
                            id="category" 
                            name="category" 
                            class="form-control" 
                            placeholder="e.g., Web Development, Mobile App"
                            value="<?php echo $edit_project ? htmlspecialchars($edit_project['category']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Project Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control" 
                        rows="4" 
                        placeholder="Describe the project, technologies used, and your role..."
                        required><?php echo $edit_project ? htmlspecialchars($edit_project['description']) : ''; ?></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="image_path">Image Path</label>
                        <input 
                            type="text" 
                            id="image_path" 
                            name="image_path" 
                            class="form-control" 
                            placeholder="e.g., images/project-name.jpg"
                            value="<?php echo $edit_project ? htmlspecialchars($edit_project['image_path']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="link_url">Project Link / URL</label>
                        <input 
                            type="url" 
                            id="link_url" 
                            name="link_url" 
                            class="form-control" 
                            placeholder="https://example.com"
                            value="<?php echo $edit_project ? htmlspecialchars($edit_project['link_url']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_completed">
                        Completion Date
                        <span class="label-hint">(Leave empty if in progress)</span>
                    </label>
                    <input 
                        type="date" 
                        id="date_completed" 
                        name="date_completed" 
                        class="form-control" 
                        value="<?php echo $edit_project && $edit_project['date_completed'] ? $edit_project['date_completed'] : ''; ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $edit_project ? '💾 Update Project' : '➕ Add Project'; ?>
                    </button>
                    <?php if ($edit_project): ?>
                        <a href="manage_projects.php" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Projects Grid -->
        <div class="table-card">
            <div class="table-header">
                <h3>📋 All Projects</h3>
            </div>

            <?php if ($projects_count > 0): ?>
                <div class="projects-grid">
                    <?php while ($project = mysqli_fetch_assoc($projects_query)): ?>
                        <div class="project-card">
                            <div class="project-image">
                                <?php if ($project['image_path']): ?>
                                    <img src="<?php echo htmlspecialchars($project['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($project['title']); ?>"
                                         onerror="this.src='https://via.placeholder.com/400x250/6366f1/ffffff?text=<?php echo urlencode($project['title']); ?>'">
                                <?php else: ?>
                                    <div class="project-placeholder">
                                        <span>🚀</span>
                                        <p>No Image</p>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($project['category']): ?>
                                    <span class="category-badge">
                                        <?php echo htmlspecialchars($project['category']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="project-content">
                                <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                                <p class="project-description">
                                    <?php echo htmlspecialchars($project['description']); ?>
                                </p>

                                <div class="project-meta">
                                    <?php if ($project['date_completed']): ?>
                                        <span class="meta-item">
                                            📅 <?php echo date('M d, Y', strtotime($project['date_completed'])); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="meta-item in-progress">
                                            ⚡ In Progress
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($project['link_url'] && $project['link_url'] != '#'): ?>
                                        <a href="<?php echo htmlspecialchars($project['link_url']); ?>" 
                                           target="_blank" 
                                           class="meta-link">
                                            🔗 View Project
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="project-actions">
                                    <a href="manage_projects.php?edit=<?php echo $project['id']; ?>" 
                                       class="btn-icon btn-edit" 
                                       title="Edit">
                                        ✏️
                                    </a>
                                    <a href="manage_projects.php?delete=<?php echo $project['id']; ?>" 
                                       class="btn-icon btn-delete" 
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this project?')">
                                        🗑️
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>No Projects Added Yet</h3>
                    <p>Start showcasing your work by adding projects above</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

   
</body>
</html>

<?php mysqli_close($conn); ?>