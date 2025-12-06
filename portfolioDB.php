<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS portfolio_db";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

mysqli_select_db($conn, "portfolio_db");

$tables_sql = array(

    // Personal Info Table (NEW)
    "CREATE TABLE IF NOT EXISTS personal_info (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(150) NOT NULL,
        tagline VARCHAR(255) NULL,
        email VARCHAR(150) NOT NULL,
        phone_number VARCHAR(50) NULL,
        about_summary TEXT NULL,
        profile_picture_url VARCHAR(255) NULL
    )",

    "CREATE TABLE IF NOT EXISTS skills (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        icon VARCHAR(50) NOT NULL,
        proficiency INT(3) NOT NULL DEFAULT 50
    )",

    "CREATE TABLE IF NOT EXISTS experience (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        role VARCHAR(150) NOT NULL,
        company VARCHAR(150) NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NULL,
        description TEXT NOT NULL
    )",

    "CREATE TABLE IF NOT EXISTS projects (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image_path VARCHAR(255) NULL,
        link_url VARCHAR(255) NULL,
        category VARCHAR(100) NULL,
        date_completed DATE NULL
    )",

    "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(150) NOT NULL,
        message TEXT NOT NULL,
        sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        is_read BOOLEAN DEFAULT FALSE
    )"
);

foreach ($tables_sql as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
}

$personal_sql = "INSERT IGNORE INTO personal_info 
(full_name, tagline, email, phone_number, about_summary, profile_picture_url)
VALUES (
    'Frances Baita Bascon',
    'Full-Stack Web Developer',
    'youremail@example.com',
    '09123456789',
    'I am a passionate developer who builds clean, responsive, and dynamic web applications.',
    'assets/img/profile.png'
)";

if (mysqli_query($conn, $personal_sql)) {
    echo "Sample personal info inserted<br>";
}

$skills_sql = "INSERT INTO skills (icon, title, description) VALUES
('💻', 'Programming', 'Experienced in HTML, CSS, JavaScript, PHP, Python, and Java. I create dynamic websites, interactive applications, and efficient backend systems.'),

('🗄️', 'Databases', 'Knowledgeable in MySQL and MongoDB for structured and unstructured data. I design schemas, write queries, and integrate databases into web apps.'),

('🌐', 'Web Development', 'Specializing in responsive websites and REST API integration. I build mobile-first, user-friendly designs that adapt to all devices.'),

('🔐', 'Cybersecurity', 'Understanding of network security basics and ethical hacking. I focus on securing systems, identifying vulnerabilities, and applying best practices.'),

('⚙️', 'Tools', 'Proficient in Git for version control, VS Code for coding, and Linux for managing servers and system environments effectively.')";
mysqli_query($conn, $skills_sql);

$exp_sql = "INSERT IGNORE INTO experience (role, company, start_date, end_date, description) VALUES
    ('Intern – IT Support', 'RyuTech Company', '2024-01-01', '2024-06-30', 'Assisted with troubleshooting.'),
    ('Freelance Graphic Designer', 'Self-Employed', '2023-05-01', NULL, 'Designing posters, tarpaulins, etc.')";

mysqli_query($conn, $exp_sql);

$projects_sql = "INSERT IGNORE INTO projects (title, description, image_path, link_url, category, date_completed) VALUES
    ('Student Management System', 'Web app for student records.', 'images/student-system.png', '#', 'Web App', '2025-01-15'),
    ('Portfolio Website', 'My personal portfolio.', 'images/portfolio.png', '#', 'Website', '2024-12-20'),
    ('E-Commerce Website', 'Shopping platform.', 'images/ecommerce.png', '#', 'Web Development', '2024-11-30')";
mysqli_query($conn, $projects_sql);

mysqli_close($conn);

echo "<h2>Setup Complete!</h2>";
echo "<p>Database and tables have been created successfully.</p>";
echo "<a href='index.php'>Go to Home Page</a>";
?>
