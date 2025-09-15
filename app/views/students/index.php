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
        :root {
            --primary-cyan: #00d4ff;
            --secondary-purple: #8b5cf6;
            --accent-green: #10b981;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --border-color: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }

        .main-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
        }

        .main-title {
            font-family: 'Orbitron', monospace;
            font-weight: 700;
            font-size: 2rem;
            color: var(--primary-cyan);
            text-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .search-input {
            background: var(--dark-bg);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            min-width: 300px;
        }

        .search-input:focus {
            border-color: var(--primary-cyan);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
            background: var(--dark-bg);
            color: var(--text-primary);
        }

        .search-input::placeholder {
            color: var(--text-secondary);
        }

        .btn-gaming {
            background: linear-gradient(135deg, var(--primary-cyan), var(--secondary-purple));
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px 24px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-gaming:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 212, 255, 0.3);
            color: white;
        }

        .btn-secondary-gaming {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
            border-radius: 12px;
            padding: 10px 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-secondary-gaming:hover {
            border-color: var(--primary-cyan);
            color: var(--primary-cyan);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-align: center;
        }

        th, td {
            padding: 16px 12px;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background: var(--card-bg);
            color: var(--primary-cyan);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--primary-cyan);
        }

        tbody tr:hover {
            background: rgba(0, 212, 255, 0.05);
            cursor: default;
        }

        a.update-btn, a.delete-btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 6px 12px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        a.update-btn {
            background: var(--accent-green);
            color: white;
        }

        a.update-btn:hover {
            background: #059669;
            color: white;
            text-decoration: none;
        }

        a.delete-btn {
            background: #ef4444;
            color: white;
        }

        a.delete-btn:hover {
            background: #dc2626;
            color: white;
            text-decoration: none;
        }

        .no-results {
            color: var(--text-secondary);
            font-size: 1.1rem;
            text-align: center;
            padding: 40px 20px;
        }

        .pagination-gaming .page-item .page-link {
            background: var(--dark-bg);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 8px;
            margin: 0 2px;
            padding: 10px 14px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .pagination-gaming .page-item .page-link:hover {
            background: var(--primary-cyan);
            border-color: var(--primary-cyan);
            color: white;
        }

        .pagination-gaming .page-item.active .page-link {
            background: var(--primary-cyan);
            border-color: var(--primary-cyan);
            color: white;
        }

        .pagination-gaming .page-item.disabled .page-link {
            background: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-secondary);
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .main-title {
                font-size: 1.5rem;
            }

            .search-input {
                min-width: 100%;
                margin-bottom: 1rem;
            }
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
    <form method="get" action="<?= site_url('students/view'); ?>" class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
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
            <a href="<?= site_url('students/view'); ?>" class="btn btn-secondary-gaming">
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
                                <a href="<?= site_url('students/delete/'.$student['id']); ?>" class="delete-btn ms-2">
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
        <nav class="mt-4">
            <ul class="pagination pagination-gaming justify-content-center">
                <?= $page; ?>
            </ul>
        </nav>
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

        // Table row hover effects
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.borderLeft = '3px solid var(--primary-cyan)';
            });
            row.addEventListener('mouseleave', () => {
                row.style.borderLeft = 'none';
            });
        });
    });
</script>

</body>
</html>
