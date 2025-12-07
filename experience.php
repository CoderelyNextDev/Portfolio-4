<?php require_once 'includes/connection.php'?>
<?php require_once 'includes/functions.php'?>
<?php require_once 'includes/head.php'?>
<?php include('includes/header.php')?>

<section class="content">
  <h2>Work Experience</h2>
  
  <?php if (mysqli_num_rows($experience_result) > 0): ?>
    <div class="timeline timeline-enhanced">
      <?php while ($exp = mysqli_fetch_assoc($experience_result)): ?>
        <div class="timeline-item timeline-item-enhanced">
          <div class="timeline-marker timeline-marker-enhanced"></div>
          
          <div class="timeline-content timeline-content-enhanced">
            <div class="timeline-header-enhanced">
              <h3><?php echo htmlspecialchars($exp['role']); ?></h3>
              <span class="company-badge-enhanced">
                 <?php echo htmlspecialchars($exp['company']); ?>
              </span>
            </div>

            <!-- Timeline Date -->
            <div class="timeline-date-enhanced">
              <?php 
                $start = date('M Y', strtotime($exp['start_date']));
                $end = $exp['end_date'] ? date('M Y', strtotime($exp['end_date'])) : 'Present';
                echo '📅 ' . $start . ' - ' . $end;
                
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
                  echo ' <span class="duration-badge">(' . $duration . ')</span>';
                }
              ?>
            </div>

            <?php if (!$exp['end_date']): ?>
              <span class="current-badge-enhanced">⚡ Currently Working</span>
            <?php endif; ?>

            <div class="timeline-description-enhanced">
              <?php echo nl2br(htmlspecialchars($exp['description'])); ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="empty-state-enhanced">
      <div class="empty-icon">💼</div>
      <h3>No Experience Listed Yet</h3>
      <p>Check back soon for work experience updates</p>
    </div>
  <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>