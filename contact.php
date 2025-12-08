<?php 
    require_once 'includes/connection.php';
    require_once 'includes/functions.php';


    $sql = "SELECT * FROM personal_info LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($result);

    $full_name = $info['full_name'] ?? "Your Name";
    $email = $info['email'] ?? "your@email.com";
    $phone = $info['phone_number'] ?? "+63 912 345 6789";
    $tagline = $info['tagline'] ?? "IT Student";


    $form_submitted = false;
    $form_error = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_message'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $sender_email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        
        $insert_sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$sender_email', '$message')";
        
        if (mysqli_query($conn, $insert_sql)) {
            $form_submitted = true;
        } else {
            $form_error = true;
        }
    }

    require_once 'includes/head.php';
    include('includes/header.php');
?>

<section class="content">
    <h2>Contact Me</h2>
    
    <?php if ($form_error): ?>
        <div class="error-message">
            <span class="error-icon">❌</span>
            <div>
                <strong>Error Sending Message</strong>
                <p>Something went wrong. Please try again or contact me directly via email.</p>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="contact-container">
        <!-- Contact Info -->
        <div class="contact-info">
            <h3>Let's Connect!</h3>
            <p>If you'd like to collaborate, ask a question, or just say hi, here are my details:</p>
            <ul>
                <li>
                    
                    <div>
                        <strong>Email</strong>
                        <a href="mailto:<?php echo htmlspecialchars($email); ?>">
                            <?php echo htmlspecialchars($email); ?>
                        </a>
                    </div>
                </li>
                <?php if ($phone): ?>
                <li>
                   
                    <div>
                        <strong>Phone</strong>
                        <a href="tel:<?php echo htmlspecialchars($phone); ?>">
                            <?php echo htmlspecialchars($phone); ?>
                        </a>
                    </div>
                </li>
                <?php endif; ?>
                <li>
                    
                    <div>
                        <strong>Role</strong>
                        <span><?php echo htmlspecialchars($tagline); ?></span>
                    </div>
                </li>
            </ul>
            
            <div class="social-links">
                <a href="#" class="social-link" title="LinkedIn">
                    <span>🔗</span> LinkedIn
                </a>
                <a href="#" class="social-link" title="GitHub">
                    <span>💻</span> GitHub
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <form class="contact-form" id="contactForm" method="POST" action="">
            <h3>Send Me a Message</h3>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Your Name" 
                required>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Your Email" 
                required>
            <textarea 
                id="message" 
                name="message" 
                rows="5" 
                placeholder="Your Message" 
                required></textarea>
            <button type="submit" name="submit_message">Send Message</button>
        </form>
    </div>
</section>
<?php require_once 'includes/footer.php'?>