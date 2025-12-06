<?php include('includes/head.php'); ?>
  <?php include('includes/sidebar.php'); ?>
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2>⚙️ Personal Information</h2>
                <p>Update your personal details and profile information</p>
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

        <!-- Profile Preview Card -->
        <div class="preview-card">
            <div class="preview-header">
                <h3>📸 Profile Preview</h3>
            </div>
            <div class="preview-content">
                <div class="preview-avatar">
                    <?php if ($personal_info['profile_picture_url']): ?>
                        <img src="<?php echo htmlspecialchars($personal_info['profile_picture_url']); ?>" 
                             alt="Profile Picture"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="avatar-placeholder" style="display: none;">
                            <?php echo strtoupper(substr($personal_info['full_name'], 0, 1)); ?>
                        </div>
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <?php echo strtoupper(substr($personal_info['full_name'], 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="preview-info">
                    <h2><?php echo htmlspecialchars($personal_info['full_name']); ?></h2>
                    <p class="preview-tagline"><?php echo htmlspecialchars($personal_info['tagline']); ?></p>
                    <div class="preview-contacts">
                        <span class="contact-item">
                            📧 <?php echo htmlspecialchars($personal_info['email']); ?>
                        </span>
                        <?php if ($personal_info['phone_number']): ?>
                            <span class="contact-item">
                                📱 <?php echo htmlspecialchars($personal_info['phone_number']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="form-card">
            <div class="form-header">
                <h3>✏️ Edit Personal Information</h3>
                <p class="form-subtitle">All changes are saved to your portfolio</p>
            </div>
            
            <form method="POST" action="personal_info.php">
                <div class="form-section">
                    <h4 class="section-title">👤 Basic Information</h4>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="full_name">Full Name *</label>
                            <input 
                                type="text" 
                                id="full_name" 
                                name="full_name" 
                                class="form-control" 
                                placeholder="John Doe"
                                value="<?php echo htmlspecialchars($personal_info['full_name']); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="tagline">Tagline / Job Title</label>
                            <input 
                                type="text" 
                                id="tagline" 
                                name="tagline" 
                                class="form-control" 
                                placeholder="Full-Stack Web Developer"
                                value="<?php echo htmlspecialchars($personal_info['tagline']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">📞 Contact Details</h4>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control" 
                                placeholder="john@example.com"
                                value="<?php echo htmlspecialchars($personal_info['email']); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input 
                                type="text" 
                                id="phone_number" 
                                name="phone_number" 
                                class="form-control" 
                                placeholder="09123456789"
                                value="<?php echo htmlspecialchars($personal_info['phone_number']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">📝 About Section</h4>
                    
                    <div class="form-group">
                        <label for="about_summary">About / Summary</label>
                        <textarea 
                            id="about_summary" 
                            name="about_summary" 
                            class="form-control" 
                            rows="5" 
                            placeholder="Write a brief introduction about yourself, your skills, and what you do..."><?php echo htmlspecialchars($personal_info['about_summary']); ?></textarea>
                        <span class="char-count" id="char-count">
                            <?php echo strlen($personal_info['about_summary']); ?> characters
                        </span>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">🖼️ Profile Picture</h4>
                    
                    <div class="form-group">
                        <label for="profile_picture_url">Profile Picture URL</label>
                        <input 
                            type="text" 
                            id="profile_picture_url" 
                            name="profile_picture_url" 
                            class="form-control" 
                            placeholder="images/profile.jpg or https://example.com/photo.jpg"
                            value="<?php echo htmlspecialchars($personal_info['profile_picture_url']); ?>">
                        <span class="field-hint">
                            💡 Tip: Upload your image to the "images" folder or use a direct URL
                        </span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Save Changes
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        ↺ Reset Form
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Notice -->
        <div class="info-notice">
            <div class="notice-icon">ℹ️</div>
            <div class="notice-content">
                <h4>About This Page</h4>
                <p>This page manages your personal information that appears throughout your portfolio website. You can only edit this information - no adding or deleting records.</p>
            </div>
        </div>
    </main>

    <script>
        // Character counter for about summary
        const aboutTextarea = document.getElementById('about_summary');
        const charCount = document.getElementById('char-count');
        
        aboutTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length + ' characters';
        });
    </script>
</body>
</html>

<?php mysqli_close($conn); ?>