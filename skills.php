<?php require_once 'includes/connection.php'?>
<?php require_once 'includes/functions.php'?>
<?php require_once 'includes/head.php'?>
<?php include('includes/header.php')?>
  <section class="content">
    <h2>My Skills</h2>
    <div class="skills-grid">
     
      <?php while ($row = mysqli_fetch_assoc($skills_result)) { ?>
        <div class="skill-card">
          <h3><span><?php echo $row['icon']; ?></span> <?php echo $row['title']; ?></h3>
          <p><?php echo $row['description']; ?></p>
        </div>
      <?php } ?>

    </div>
  </section>
<?php require_once 'includes/footer.php'?>