<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link rel="stylesheet" href="<?=base_url();?>/public/style.css">
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
<style>
   

</style>

</body>
</html>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Information</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

  

  <nav class="bg-gradient-to-r from-green-600 to-cyan-400 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-white tracking-wide">Students Information</h1>
      
      <a href="<?=site_url('users/create')?>"
         class="inline-flex items-center gap-2 bg-white text-green-600 font-semibold px-4 py-2 rounded-full shadow-md transition-all duration-300 hover:bg-green-50 hover:scale-105">
        <i class="fa-solid fa-user-plus"></i> Create Record
      </a>
    </div>
  </nav>

  

  <div class="max-w-6xl mx-auto mt-8 px-4">
    <div class="bg-white shadow-2xl rounded-2xl p-6 border border-gray-200">


  
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

  
  <div class="overflow-x-auto rounded-xl border border-gray-200 shadow">
    <table class="w-full text-center border-collapse">
      <thead>
        <tr class="bg-gradient-to-r from-green-600 to-cyan-400 text-white text-sm uppercase tracking-wide">
          <th class="py-3 px-4">ID</th>
          <th class="py-3 px-4">Lastname</th>
          <th class="py-3 px-4">Firstname</th>
          <th class="py-3 px-4">Middlename</th>
          <th class="py-3 px-4">Email</th>
          <th class="py-3 px-4">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-700 text-sm">
        <?php if(!empty($users)): ?>
          <?php foreach(html_escape($users) as $user): ?>
            <tr class="hover:bg-green-50 transition duration-200 border-b border-gray-200">
              <td class="py-3 px-4 font-semibold text-gray-800"><?=($user['id']);?></td>
              <td class="py-3 px-4"><?=($user['lname']);?></td>
              <td class="py-3 px-4"><?=($user['fname']);?></td>
              <td class="py-3 px-4"><?=($user['mname']);?></td>
              <td class="py-3 px-4">
                <span class="bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full">
                  <?=($user['email']);?>
                </span>
              </td>
              <td class="py-3 px-4 flex justify-center gap-3">
                
                <a href="<?=site_url('users/update/'.$user['id']);?>"
                   class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg shadow transition-all duration-300">
                  <i class="fa-solid fa-pen-to-square"></i> Update
                </a>
                
                <a href="<?=site_url('users/delete/'.$user['id']);?>"
                   onclick="return confirm('Are you sure you want to delete this record?');"
                   class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow transition-all duration-300">
                  <i class="fa-solid fa-trash"></i> Delete
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="py-4 text-gray-500">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  
  <div class="mt-4 flex justify-center">
    <?=$page ?? ''?>
  </div>

</div>

  </div>

</body>

