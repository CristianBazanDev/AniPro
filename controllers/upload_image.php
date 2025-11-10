<?php

function uploadProfilePicture($file, $user_id) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    $file_type = $file['type'];
    
    if (!in_array($file_type, $allowed_types)) {
        return false;
    }

    $max_size = 5 * 1024 * 1024; 
    if ($file['size'] > $max_size) {
        return false;
    }

    $upload_dir = __DIR__ . '/../public/assets/img/profile_pictures/';
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    
    $filename = $user_id . '.' . $extension;
    $filepath = $upload_dir . $filename;

    $existing_files = glob($upload_dir . $user_id . '.*');
    foreach ($existing_files as $existing_file) {
        if (is_file($existing_file)) {
            unlink($existing_file);
        }
    }

    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return './public/assets/img/profile_pictures/' . $filename;
    }

    return false;
}
?>

