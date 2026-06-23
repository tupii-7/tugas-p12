<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan') - Sistem Manajemen Perpustakaan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #ec4899;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #0ea5e9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 20px;
            color: white !important;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: white !important;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            padding: 20px 0;
            position: sticky;
            top: 0;
        }

        .sidebar .nav-link {
            color: #475569;
            padding: 12px 20px;
            margin: 5px 0;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #f1f5f9;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .sidebar .nav-link i {
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            padding: 30px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-bottom: none;
            font-weight: 600;
        }

        /* Stat Card */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 10px 0;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            font-weight: 600;
            border-radius: 4px;
        }

        /* Buttons */
        .btn-custom {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item {
            color: #64748b;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px;
        }

        .table tbody td {
            padding: 12px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
            gap: 5px;
        }

        .page-link {
            color: var(--primary-color);
            border-color: #e2e8f0;
            border-radius: 4px;
        }

        .page-link:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid #e2e8f0;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
            margin-top: 40px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                padding: 15px;
            }

            .stat-number {
                font-size: 24px;
            }

            .stat-icon {
                font-size: 24px;
            }
        }

        /* Book Card */
        .book-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .book-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .book-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            line-height: 1.4;
            flex: 1;
        }

        .book-info {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .book-footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Search Form */
        .search-form {
            margin-bottom: 20px;
        }

        .search-input {
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .filter-label {
            font-weight: 600;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state-icon {
            font-size: 60px;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .empty-state-title {
            font-size: 20px;
            color: #475569;
            margin-bottom: 10px;
        }

        .empty-state-text {
            color: #94a3b8;
            margin-bottom: 20px;
        }
    </style>

    @yield('css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-book"></i> Perpustakaan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar col-lg-2">
            <div class="nav flex-column">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <i class="bi bi-graph-up"></i> Dashboard
                </a>
                <a class="nav-link {{ request()->is('buku*') ? 'active' : '' }}" href="/buku">
                    <i class="bi bi-book"></i> Buku
                </a>
                <a class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}" href="/anggota">
                    <i class="bi bi-people"></i> Anggota
                </a>
                <hr class="my-3" style="opacity: 0.1;">
                <div style="padding: 0 20px; color: #94a3b8; font-size: 12px;">
                    QUICK ACTIONS
                </div>
                <a class="nav-link" href="/buku">
                    <i class="bi bi-plus-circle"></i> Kelola Buku
                </a>
                <a class="nav-link" href="/anggota">
                    <i class="bi bi-plus-circle"></i> Kelola Anggota
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content col-lg-10">
            @yield('breadcrumb')
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 Sistem Manajemen Perpustakaan. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('js')
</body>
</html>
