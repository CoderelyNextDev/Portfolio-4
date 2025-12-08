<?php include('includes/head.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2>💼 Manage Experience</h2>
                <p>Add, edit, or remove your work experience</p>
            </div>
            <div class="header-right">
                <div class="stat-badge">
                    <span class="badge-value"><?php echo $experience_count; ?></span>
                    <span class="badge-label">Total Records</span>
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
                <h3><?php echo $edit_experience ? 'Edit Experience' : ' Add New Experience'; ?></h3>
            </div>
            
            <form method="POST" action="manage_experience.php">
                <?php if ($edit_experience): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_experience['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="role">Job Role / Position</label>
                        <input 
                            type="text" 
                            id="role" 
                            name="role" 
                            class="form-control" 
                            placeholder="e.g., Frontend Developer"
                            value="<?php echo $edit_experience ? htmlspecialchars($edit_experience['role']) : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="company">Company / Organization</label>
                        <input 
                            type="text" 
                            id="company" 
                            name="company" 
                            class="form-control" 
                            placeholder="e.g., Tech Corp Inc."
                            value="<?php echo $edit_experience ? htmlspecialchars($edit_experience['company']) : ''; ?>"
                            required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input 
                            type="date" 
                            id="start_date" 
                            name="start_date" 
                            class="form-control" 
                            value="<?php echo $edit_experience ? $edit_experience['start_date'] : ''; ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">
                            End Date
                            <span class="label-hint">(Leave empty if currently working)</span>
                        </label>
                        <input 
                            type="date" 
                            id="end_date" 
                            name="end_date" 
                            class="form-control" 
                            value="<?php echo $edit_experience && $edit_experience['end_date'] ? $edit_experience['end_date'] : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Job Description & Responsibilities</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control" 
                        rows="5" 
                        placeholder="Describe your role, responsibilities, and achievements..."
                        required><?php echo $edit_experience ? htmlspecialchars($edit_experience['description']) : ''; ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">
                        <?php echo $edit_experience ? 'Update Experience' : 'Add Experience'; ?>
                    </button>
                    <?php if ($edit_experience): ?>
                        <a href="manage_experience.php" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Experience Timeline -->
        <div class="table-card">
            <div class="table-header">
                <h3> Work Experience Timeline</h3>
            </div>

            <?php if ($experience_count > 0): ?>
                <div class="timeline">
                    <?php while ($exp = mysqli_fetch_assoc($experience_query)): ?>
                        <div class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="timeline-title">
                                        <h4><?php echo htmlspecialchars($exp['role']); ?></h4>
                                        <span class="company-badge">
                                             <?php echo htmlspecialchars($exp['company']); ?>
                                        </span>
                                    </div>
                                    <div class="timeline-date">
                                        <?php 
                                            $start = date('M Y', strtotime($exp['start_date']));
                                            $end = $exp['end_date'] ? date('M Y', strtotime($exp['end_date'])) : 'Present';
                                            echo $start . ' - ' . $end;
                                            
                                            // Calculate duration
                                            $start_date = new DateTime($exp['start_date']);
                                            $end_date = $exp['end_date'] ? new DateTime($exp['end_date']) : new DateTime();
                                            $interval = $start_date->diff($end_date);
                                            $duration = '';
                                            if ($interval->y > 0) {
                                                $duration .= $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
                                            }
                                            if ($interval->m > 0) {
                                                $duration .= ($duration ? ', ' : '') . $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
                                            }
                                            if ($duration) {
                                                echo '<span class="duration">(' . $duration . ')</span>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="timeline-description">
                                    <?php echo nl2br(htmlspecialchars($exp['description'])); ?>
                                </div>

                                <?php if (!$exp['end_date']): ?>
                                    <span class="current-badge">Currently Working</span>
                                <?php endif; ?>

                                <div class="timeline-actions">
                                    <a href="manage_experience.php?edit=<?php echo $exp['id']; ?>" class="btn-icon btn-edit" title="Edit">
                                        ✏️
                                    </a>
                                    <a href="manage_experience.php?delete=<?php echo $exp['id']; ?>" 
                                       class="btn-icon btn-delete" 
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this experience?')">
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
                    <h3>No Experience Added Yet</h3>
                    <p>Start adding your work experience using the form above</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>

<?php mysqli_close($conn); ?>