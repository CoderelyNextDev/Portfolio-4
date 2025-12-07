<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $skills_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM skills"))['count'];
    $exp_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM experience"))['count'];
    $projects_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM projects"))['count'];
    $messages_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages"))['count'];
    $unread_messages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = FALSE"))['count'];

    // Fetch recent activities
    $recent_messages = mysqli_query($conn, "SELECT name, email, sent_at FROM contact_messages ORDER BY sent_at DESC LIMIT 5");
    $recent_projects = mysqli_query($conn, "SELECT title, date_completed FROM projects ORDER BY date_completed DESC LIMIT 3");

    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $delete_sql = "DELETE FROM skills WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            $success_message = "Skill deleted successfully!";
        } else {
            $error_message = "Error deleting skill: " . mysqli_error($conn);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['icon'])) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $icon = mysqli_real_escape_string($conn, $_POST['icon']);
        $proficiency = intval($_POST['proficiency']);
        
        if ($id > 0) {
            $sql = "UPDATE skills SET title='$title', description='$description', icon='$icon', proficiency=$proficiency WHERE id=$id";
            $message = "Skill updated successfully!";
        } else {
            $sql = "INSERT INTO skills (title, description, icon, proficiency) VALUES ('$title', '$description', '$icon', $proficiency)";
            $message = "Skill added successfully!";
            header("Location: manage_skills.php");
        }
        
        if (mysqli_query($conn, $sql)) {
            $success_message = $message;
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    }

    $skills_query = mysqli_query($conn, "SELECT * FROM skills ORDER BY id DESC");
    $skills_count = mysqli_num_rows($skills_query);

    $edit_skill = null;
    if (isset($_GET['edit'])) {
        $edit_id = intval($_GET['edit']);
        $edit_result = mysqli_query($conn, "SELECT * FROM skills WHERE id = $edit_id");
        $edit_skill = mysqli_fetch_assoc($edit_result);
    }

    // Experience
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $delete_sql = "DELETE FROM experience WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            $success_message = "Experience deleted successfully!";
        } else {
            $error_message = "Error deleting experience: " . mysqli_error($conn);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['role'])) {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = !empty($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : NULL;
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        if ($id > 0) {
            // Update
            $end_date_sql = $end_date ? "'$end_date'" : "NULL";
            $sql = "UPDATE experience SET role='$role', company='$company', start_date='$start_date', end_date=$end_date_sql, description='$description' WHERE id=$id";
            $message = "Experience updated successfully!";
            
        } else {
            // Insert
            $end_date_sql = $end_date ? "'$end_date'" : "NULL";
            $sql = "INSERT INTO experience (role, company, start_date, end_date, description) VALUES ('$role', '$company', '$start_date', $end_date_sql, '$description')";
            $message = "Experience added successfully!";
             header("Location: manage_experience.php");
        }
        
        if (mysqli_query($conn, $sql)) {
            $success_message = $message;
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    }


    $experience_query = mysqli_query($conn, "SELECT * FROM experience ORDER BY start_date DESC, id DESC");
    $experience_count = mysqli_num_rows($experience_query);


    $edit_experience = null;
    if (isset($_GET['edit'])) {
        $edit_id = intval($_GET['edit']);
        $edit_result = mysqli_query($conn, "SELECT * FROM experience WHERE id = $edit_id");
        $edit_experience = mysqli_fetch_assoc($edit_result);
    }

    // Projects
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $delete_sql = "DELETE FROM projects WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            $success_message = "Project deleted successfully!";
        } else {
            $error_message = "Error deleting project: " . mysqli_error($conn);
        }
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['link_url'])) {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $link_url = mysqli_real_escape_string($conn, $_POST['link_url']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date_completed = !empty($_POST['date_completed']) ? mysqli_real_escape_string($conn, $_POST['date_completed']) : NULL;
    
    // Get existing image path if updating
    $existing_image = '';
    if ($id > 0) {
        $result = mysqli_query($conn, "SELECT image_path FROM projects WHERE id=$id");
        $row = mysqli_fetch_assoc($result);
        $existing_image = $row['image_path'] ?? '';
    }
    $image_path = $existing_image;
    
    // Handle image upload
    if (isset($_FILES['project_image']) && $_FILES['project_image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = $_FILES['project_image']['type'];
        $file_size = $_FILES['project_image']['size'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        if (in_array($file_type, $allowed_types)) {
            if ($file_size <= $max_size) {
                // Create upload directory if it doesn't exist
                $upload_dir = 'assets/img/projects/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                // Generate unique filename
                $file_extension = pathinfo($_FILES['project_image']['name'], PATHINFO_EXTENSION);
                $safe_title = preg_replace('/[^a-z0-9]+/', '-', strtolower($title));
                $safe_title = trim($safe_title, '-');
                $new_filename = 'project_' . $safe_title . '_' . time() . '.' . $file_extension;
                $upload_path = $upload_dir . $new_filename;
                
                // Upload file
                if (move_uploaded_file($_FILES['project_image']['tmp_name'], $upload_path)) {
                    // Delete old image if exists and is in assets/img/projects/
                    if ($existing_image && file_exists($existing_image) && strpos($existing_image, 'assets/img/projects/') === 0) {
                        unlink($existing_image);
                    }
                    
                    $image_path = $upload_path;
                } else {
                    $error_message = "Error uploading file. Please check folder permissions.";
                }
            } else {
                $error_message = "File size exceeds 5MB limit.";
            }
        } else {
            $error_message = "Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.";
        }
    }
    // If using URL/path input instead
    elseif (!empty($_POST['image_path'])) {
        $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
    }
    
    // Update or insert into database
    if (!isset($error_message) || empty($error_message)) {
        $date_sql = $date_completed ? "'$date_completed'" : "NULL";
        
        if ($id > 0) {
            // Update existing project
            $sql = "UPDATE projects SET 
                    title='$title', 
                    description='$description', 
                    image_path='$image_path', 
                    link_url='$link_url', 
                    category='$category', 
                    date_completed=$date_sql 
                    WHERE id=$id";
            $message = "Project updated successfully!";
        } else {
            // Insert new project
            $sql = "INSERT INTO projects (title, description, image_path, link_url, category, date_completed) 
                    VALUES ('$title', '$description', '$image_path', '$link_url', '$category', $date_sql)";
            $message = "Project added successfully!";
        }
        
        if (mysqli_query($conn, $sql)) {
            $success_message = $message;
            // Redirect to clear form after adding new project
            if ($id == 0) {
                header("Location: manage_projects.php?success=1");
                exit();
            }
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    }
}

    $projects_query = mysqli_query($conn, "SELECT * FROM projects ORDER BY date_completed DESC, id DESC");
    $projects_count = mysqli_num_rows($projects_query);

    $edit_project = null;
    if (isset($_GET['edit'])) {
        $edit_id = intval($_GET['edit']);
        $edit_result = mysqli_query($conn, "SELECT * FROM projects WHERE id = $edit_id");
        $edit_project = mysqli_fetch_assoc($edit_result);
    }

    // Contact
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $delete_sql = "DELETE FROM contact_messages WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            $success_message = "Message deleted successfully!";
        } else {
            $error_message = "Error deleting message: " . mysqli_error($conn);
        }
    }

    if (isset($_GET['read'])) {
        $id = intval($_GET['read']);
        $read_sql = "UPDATE contact_messages SET is_read = TRUE WHERE id = $id";
        if (mysqli_query($conn, $read_sql)) {
            $success_message = "Message marked as read!";
        } else {
            $error_message = "Error updating message: " . mysqli_error($conn);
        }
    }

    if (isset($_GET['read_all'])) {
        $read_all_sql = "UPDATE contact_messages SET is_read = TRUE WHERE is_read = FALSE";
        if (mysqli_query($conn, $read_all_sql)) {
            $success_message = "All messages marked as read!";
        } else {
            $error_message = "Error updating messages: " . mysqli_error($conn);
        }
    }

    $total_messages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages"))['count'];
    $unread_messages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = FALSE"))['count'];

    $messages_query = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY sent_at DESC");

    // personal info
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tagline'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $tagline = mysqli_real_escape_string($conn, $_POST['tagline']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $about_summary = mysqli_real_escape_string($conn, $_POST['about_summary']);
    
   
    $profile_picture_url = $personal_info['profile_picture_url'] ?? '';
 
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_size = $_FILES['profile_picture']['size'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        if (in_array($file_type, $allowed_types)) {
            if ($file_size <= $max_size) {
               
                $upload_dir = 'assets/img/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
             
                $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
                $new_filename = 'profile_' . time() . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $new_filename;
                
                // Upload file
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                    
                    if ($profile_picture_url && file_exists($profile_picture_url) && strpos($profile_picture_url, 'assets/img/') === 0) {
                        unlink($profile_picture_url);
                    }
                    
              
                    $profile_picture_url = $upload_path;
                    $success_message = "Profile picture uploaded successfully!";
                } else {
                    $error_message = "Error uploading file. Please check folder permissions.";
                }
            } else {
                $error_message = "File size exceeds 5MB limit.";
            }
        } else {
            $error_message = "Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.";
        }
    }
  
    elseif (!empty($_POST['profile_picture_url']) && $_POST['profile_picture_url'] !== $profile_picture_url) {
        $profile_picture_url = mysqli_real_escape_string($conn, $_POST['profile_picture_url']);
    }
 
    // Update database
    if (!isset($error_message) || empty($error_message)) {
        $sql = "UPDATE personal_info SET 
                full_name='$full_name', 
                tagline='$tagline', 
                email='$email', 
                phone_number='$phone_number', 
                about_summary='$about_summary', 
                profile_picture_url='$profile_picture_url' 
                WHERE id=1";
        
        if (mysqli_query($conn, $sql)) {
            if (!isset($success_message)) {
                $success_message = "Personal information updated successfully!";
            }
            // Refresh data
            $info_result = mysqli_query($conn, "SELECT * FROM personal_info WHERE id=1");
            $personal_info = mysqli_fetch_assoc($info_result);
        } else {
            $error_message = "Error updating information: " . mysqli_error($conn);
        }
    }
}

    // Fetch personal info (always fetch the first record)
    $info_result = mysqli_query($conn, "SELECT * FROM personal_info WHERE id=1");
    $personal_info = mysqli_fetch_assoc($info_result);

    // If no record exists, create a default one
    if (!$personal_info) {
        mysqli_query($conn, "INSERT INTO personal_info (full_name, tagline, email, phone_number, about_summary, profile_picture_url) 
                            VALUES ('Your Name', 'Your Tagline', 'your@email.com', '', '', '')");
        $info_result = mysqli_query($conn, "SELECT * FROM personal_info WHERE id=1");
        $personal_info = mysqli_fetch_assoc($info_result);
    }
    ?>