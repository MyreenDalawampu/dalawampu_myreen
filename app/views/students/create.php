<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background: #f5f9fc;
    margin: 0;
    padding: 20px;
    color: #333;
}

.main-container {
    background: #fff;
    max-width: 1000px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.main-title {
    font-size: 2rem;
    font-weight: bold;
    color: #3498db;
    text-align: center;
    margin-bottom: 30px;
}

.search-input {
    width: 100%;
    max-width: 300px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-right: 10px;
}

.btn-gaming, .btn-secondary-gaming {
    background: #3498db;
    color: white;
    padding: 10px 20px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-gaming:hover {
    background: #2980b9;
}

.btn-secondary-gaming {
    background: transparent;
    color: #3498db;
    border: 2px solid #3498db;
}

.btn-secondary-gaming:hover {
    background: #3498db;
    color: white;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #e0e0e0;
    padding: 14px 10px;
    text-align: center;
}

th {
    background: #3498db;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9rem;
}

tbody tr:nth-child(even) {
    background: #f8f8f8;
}

tbody tr:hover {
    background: #eef6fc;
}

a.update-btn, a.delete-btn {
    font-weight: 600;
    padding: 6px 12px;
    font-size: 0.9rem;
    border-radius: 6px;
    text-decoration: none;
}

a.update-btn {
    background: #27ae60;
    color: white;
}

a.update-btn:hover {
    background: #1e874b;
}

a.delete-btn {
    background: #e74c3c;
    color: white;
    margin-left: 6px;
}

a.delete-btn:hover {
    background: #c0392b;
}

.no-results {
    text-align: center;
    color: #888;
    padding: 40px 0;
    font-size: 1.1rem;
}

.pagination-gaming .page-item .page-link {
    background: white;
    border: 1px solid #ddd;
    color: #3498db;
    margin: 0 3px;
    border-radius: 4px;
    padding: 8px 14px;
    font-weight: bold;
}

.pagination-gaming .page-item.active .page-link {
    background: #3498db;
    color: white;
    border-color: #3498db;
}

.pagination-gaming .page-item.disabled .page-link {
    color: #ccc;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Create Student</h1>

        <form method="post" action="<?= site_url('students/create') ?>">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <button type="submit">Save</button>
        </form>

    </div>
</body>
</html>
