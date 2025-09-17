<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet" />
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
            text-decoration: none;
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

        .pagination-gaming a {
            background: white;
            border: 1px solid #ddd;
            color: #3498db;
            margin: 0 3px;
            border-radius: 4px;
            padding: 8px 14px;
            font-weight: bold;
            text-decoration: none;
        }

        .pagination-gaming strong {
            background: #3498db;
            color: white;
            border: 1px solid #3498db;
            margin: 0 3px;
            border-radius: 4px;
            padding: 8px 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="main-container">
    <h2 class="main-title">
        <i class="fas fa-user-graduate gaming-icon"></i>
        STUDENTS LIST
        <i class="fas fa-school gaming-icon"></i>
    </h2>

    <!-- Search + Add/Back -->
    <form method="get" action="<?= site_url('students/index'); ?>" class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="search-container d-flex align-items-center">
            <div class="input-group">
                <input type="text" name="q"
                       class="form-control search-input"
                       placeholder="🔍 Search students by name or email..."
                       value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                <button class="btn btn-gaming" type="submit">
                    <i class="fas fa-search"></i> SEARCH
                </button>
            </div>
        </div>

        <?php if (!empty($_GET['q'])): ?>
            <a href="<?= site_url('students/index'); ?>" class="btn btn-secondary-gaming">
                <i class="fas fa-arrow-left"></i> BACK TO ALL STUDENTS
            </a>
        <?php else: ?>
            <a href="<?= site_url('students/create'); ?>" class="btn btn-gaming">
                <i class="fas fa-plus"></i> ADD STUDENT
            </a>
        <?php endif; ?>
    </form>

    <!-- Students Table -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag"></i> ID</th>
                    <th><i class="fas fa-user"></i> Firstname</th>
                    <th><i class="fas fa-user"></i> Lastname</th>
                    <th><i class="fas fa-envelope"></i> Email</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><span class="badge bg-primary"><?= htmlspecialchars($student['id']); ?></span></td>
                            <td><?= htmlspecialchars($student['first_name']); ?></td>
                            <td><?= htmlspecialchars($student['last_name']); ?></td>
                            <td><?= htmlspecialchars($student['email']); ?></td>
                            <td>
                                <a href="<?= site_url('students/update/'.$student['id']); ?>" class="update-btn">
                                    <i class="fas fa-edit"></i> Update
                                </a>
                                <a href="<?= site_url('students/delete/'.$student['id']); ?>" class="delete-btn ms-2" onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-results">
                            <i class="fas fa-search gaming-icon"></i>
                            No students found. Ready to add the first one?
                            <i class="fas fa-rocket gaming-icon"></i>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if (!empty($page)): ?>
        <div class="mt-4 d-flex justify-content-center pagination-gaming">
            <?= $page; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Button hover effects
        const buttons = document.querySelectorAll('.btn-gaming, .update-btn, .delete-btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.transform = 'translateY(-1px)';
            });
            button.addEventListener('mouseleave', () => {
                button.style.transform = 'translateY(0)';
            });
        });
    });
</script>

</body>
</html>
