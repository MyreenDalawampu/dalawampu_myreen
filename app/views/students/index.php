<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link rel="stylesheet" href="<?=base_url();?>public/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: left; 
            color: #333;
            font-size: 2.5em; 
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        a.update-btn {
            color: #3498db; 
            text-decoration: none;
            font-weight: bold;
        }

        a.update-btn:hover {
            text-decoration: underline;
        }

        a.delete-btn {
            color: #e74c3c; 
            text-decoration: none;
            font-weight: bold;
        }

        a.delete-btn:hover {
            text-decoration: underline;
        }

        .create-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #2ecc71; 
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .create-btn:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
    

    <!-- Search Bar -->
  <form method="get" action="<?=site_url()?>" class="mb-4 flex justify-end">
    <input 
      type="text" 
      name="q" 
      value="<?=html_escape($_GET['q'] ?? '')?>" 
      placeholder="Search student..." 
      class="px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500 w-64">
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-r-lg shadow transition-all duration-300">
      <i class="fa fa-search"></i>
    </button>
  </form>

    <div class="container">
        <div class="header">
            <h1 class="text-4xl font-bold text-left">Students List</h1>
            <a class="create-btn" href="<?=site_url('students/create');?>">Create Record</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach(html_escape($students) as $student): ?>
                <tr>
                    <td><?= $student['id']; ?></td>
                    <td><?= $student['first_name']; ?></td>
                    <td><?= $student['last_name']; ?></td>
                    <td><?= $student['email']; ?></td>
                    <td>
                        <a class="update-btn" href="<?= site_url('students/update/'.$student['id']); ?>">Update</a> | 
                        <a class="delete-btn" href="<?= site_url('students/delete/'.$student['id']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <!-- Pagination -->
<div class="mt-4 flex justify-center">
  <div class="pagination flex space-x-2">
      <?=$page ?? ''?>
  </div>
</div>

</div>


</style>

</body>
</html>
