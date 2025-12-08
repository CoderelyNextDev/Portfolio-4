<?php require_once 'includes/connection.php'?>
<?php require_once 'includes/functions.php'?>
<?php require_once 'includes/head.php'?>
<?php include('includes/header.php')?>
  <section class="content">
    <h2>Resume</h2>
    <div class="resume-card">
      <h3>👤 Profile</h3>
      <div class="timeline">
        <div class="timeline-item"><p><strong>Name:</strong> Frances Baita Bascon</p></div>
        <div class="timeline-item"><p><strong>Age:</strong> 20 Years Old</p></div>
        <div class="timeline-item"><p><strong>Gender:</strong> Male</p></div>
        <div class="timeline-item"><p><strong>Civil Status:</strong> Single</p></div>
        <div class="timeline-item"><p><strong>Birthdate:</strong> September 25, 2005</p></div>
        <div class="timeline-item"><p><strong>Religion:</strong> Catholic</p></div>
        <div class="timeline-item"><p><strong>Citizenship:</strong> Filipino</p></div>
        <div class="timeline-item"><p><strong>Objective:</strong> To leverage my skills in IT and software development to contribute to innovative projects.</p></div>
      </div>
    </div>
    <div class="resume-card">
      <h3>🎓 Education</h3>
      <div class="timeline">
        <div class="timeline-item"><p><strong>ELEMENTARY @ NES (2015-2016)</strong> – Duran, Nabua Cam. Sur</p></div>
        <div class="timeline-item"><p><strong>HIGHSCHOOL @ SJAISS (2019-2020)</strong> – Topas Proper, Nabua</p></div>
        <div class="timeline-item"><p><strong>SENIOR HIGH @ SJAISS (2022-2023)</strong> – Topas Proper, Nabua</p></div>
        <div class="timeline-item">
          <p><strong>3rd YEAR @ CSPC – BSIT</strong></p>
          <p>Software development, multimedia, graphic design, web dev, cybersecurity.</p>
        </div>
      </div>
    </div>
    <div class="resume-card">
      <h3>💼 Experience</h3>
      <div class="timeline">

        <?php while ($row = mysqli_fetch_assoc($experience_result)) { ?>
          <div class="timeline-item">
            <p>
              <strong><?php echo $row['role']; ?></strong>, 
              <?php echo $row['company']; ?> 
              (<?php echo $row['start_date']; ?> 
              – 
              <?php echo $row['end_date'] ? $row['end_date'] : 'Present'; ?>)
            </p>
            <p><?php echo $row['description']; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="resume-card">
      <h3>🛠️ Skills</h3>
      <ul>
        <div class="timeline">
          <div class="timeline-item"><li><strong>PROGRAMMING: HTML, CSS, JS, PHP, Python, Java</strong></li></div>
          <div class="timeline-item"><li><strong>DATABASE MANAGEMENT: MYSQL</strong></li></div>
          <div class="timeline-item"><li><strong>CYBERSECURITY BASICS & ETHICAL HACKING</strong></li></div>
          <div class="timeline-item"><li><strong>RESPONSIVE WEB DESIGN</strong></li></div>
          <div class="timeline-item"><li><strong>TOOLS: VS CODE, LINUX, GITHUB, EMBARCADERO</strong></li></div>
        </div>
      </ul>
    </div>

    <a href="resume.pdf" class="btn-download" download>⬇ Download Resume (PDF)</a>

  </section>
<?php require_once 'includes/footer.php'?>