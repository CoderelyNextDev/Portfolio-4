<?php require_once 'includes/connection.php'?>
<?php require_once 'includes/functions.php'?>
<?php require_once 'includes/head.php'?>
<?php include('includes/header.php')?>
<section class="content">
  <h2>Projects</h2>
  <div class="projects-grid">
    <?php while ($project = mysqli_fetch_assoc($projects_result)) : ?>
      <div class="project-card" onclick="openModal('modal<?= $project['id'] ?>')">
        <h3><?= htmlspecialchars($project['title']) ?></h3>
        <p><?= htmlspecialchars($project['description']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php 
mysqli_data_seek($projects_result, 0);
?>
<?php while ($project = mysqli_fetch_assoc($projects_result)) : ?>
  <div id="modal<?= $project['id'] ?>" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modal<?= $project['id'] ?>')">&times;</span>
      <h3><?= htmlspecialchars($project['title']) ?></h3>

      <img src="uploads/<?= htmlspecialchars($project['image']) ?>" 
           alt="<?= htmlspecialchars($project['title']) ?>">

      <p><?= htmlspecialchars($project['description']) ?></p>
    </div>
  </div>
<?php endwhile; ?>
<?php require_once 'includes/footer.php'; ?>
