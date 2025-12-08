<?php require_once 'includes/connection.php'?>
<?php require_once 'includes/functions.php'?>
<?php require_once 'includes/head.php'?>
<?php include('includes/header.php')?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="adminDashboard/<?php echo $profile_picture; ?>" 
                 alt="<?php echo $full_name; ?>" 
                 class="profile-pic">
            <h2>Hi there, I'm <span><?php echo $full_name; ?></span></h2>
            <p class="typing-text" id="typing"></p>
            <a href="about.php" class="btn">Dive Into My World</a>
        </div>
        <div class="particle" style="top:20%; left:10%; animation-delay:0s;"></div>
        <div class="particle" style="top:40%; left:80%; animation-delay:2s;"></div>
        <div class="particle" style="top:70%; left:30%; animation-delay:4s;"></div>
        <div class="particle" style="top:60%; left:60%; animation-delay:6s;"></div>
    </section>
    <script>
        const texts = [
            "<?php echo addslashes($tagline); ?>",
            "<?php echo addslashes($about); ?>"
        ];
    </script>
<?php require_once 'includes/footer.php'?>

