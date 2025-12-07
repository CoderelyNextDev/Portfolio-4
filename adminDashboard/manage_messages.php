<?php include('includes/head.php'); ?>
   <?php include('includes/sidebar.php'); ?>
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2>✉️ Manage Messages</h2>
                <p>View and manage contact form submissions</p>
            </div>
            <div class="header-right">
                <div class="stat-badge unread">
                    <span class="badge-value"><?php echo $unread_messages; ?></span>
                    <span class="badge-label">Unread</span>
                </div>
                <div class="stat-badge">
                    <span class="badge-value"><?php echo $total_messages; ?></span>
                    <span class="badge-label">Total</span>
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

        <!-- Actions Bar -->
        <?php if ($unread_messages > 0): ?>
            <div class="actions-bar">
                <a href="manage_messages.php?read_all=1" class="btn btn-primary" onclick="return confirm('Mark all messages as read?')">
                    ✓ Mark All as Read
                </a>
            </div>
        <?php endif; ?>

        <!-- Messages List -->
        <div class="table-card">
            <div class="table-header">
                <h3>All Messages</h3>
            </div>

            <?php if ($total_messages > 0): ?>
                <div class="messages-list">
                    <?php while ($message = mysqli_fetch_assoc($messages_query)): ?>
                        <div class="message-item <?php echo !$message['is_read'] ? 'unread' : ''; ?>">
                            <div class="message-header">
                                <div class="message-sender">
                                    <div class="sender-avatar">
                                        <?php echo strtoupper(substr($message['name'], 0, 1)); ?>
                                    </div>
                                    <div class="sender-info">
                                        <h4><?php echo htmlspecialchars($message['name']); ?></h4>
                                        <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="sender-email">
                                            📧 <?php echo htmlspecialchars($message['email']); ?>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="message-meta">
                                    <span class="message-time">
                                        <?php 
                                            $time = strtotime($message['sent_at']);
                                            $now = time();
                                            $diff = $now - $time;
                                            
                                            if ($diff < 3600) {
                                                echo floor($diff / 60) . ' min ago';
                                            } elseif ($diff < 86400) {
                                                echo floor($diff / 3600) . ' hours ago';
                                            } elseif ($diff < 604800) {
                                                echo floor($diff / 86400) . ' days ago';
                                            } else {
                                                echo date('M d, Y • h:i A', $time);
                                            }
                                        ?>
                                    </span>
                                    
                                    <?php if (!$message['is_read']): ?>
                                        <span class="unread-badge">New</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="message-content">
                                <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                            </div>

                            <div class="message-actions">
                                <?php if (!$message['is_read']): ?>
                                    <a href="manage_messages.php?read=<?php echo $message['id']; ?>" 
                                       class="btn-action btn-read" 
                                       title="Mark as Read">
                                        <span class="action-icon">✓</span>
                                        <span class="action-text">Mark as Read</span>
                                    </a>
                                <?php else: ?>
                                    <span class="btn-action disabled">
                                        <span class="action-icon">✓</span>
                                        <span class="action-text">Read</span>
                                    </span>
                                <?php endif; ?>
                                <a href="manage_messages.php?delete=<?php echo $message['id']; ?>" 
                                   class="btn-action btn-delete-msg" 
                                   title="Delete Message"
                                   onclick="return confirm('Are you sure you want to delete this message?')">
                                    <span class="action-icon">🗑️</span>
                                    <span class="action-text">Delete</span>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>No Messages Yet</h3>
                    <p>When visitors contact you through your portfolio, their messages will appear here</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <style>
     
    </style>
</body>
</html>

<?php mysqli_close($conn); ?>