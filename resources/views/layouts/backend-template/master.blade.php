<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punya Louie</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('backend-template/assets/images/logos/logo-aset.png') }}" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('backend-template/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Responsive layout untuk sidebar */
        .app-topstrip {
            position: fixed !important;
            width: 100% !important;
            top: 0 !important;
            z-index: 10000 !important;
            background: linear-gradient(135deg, #1a2a3a 0%, #0f1e2e 100%) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .left-sidebar {
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            height: 100% !important;
            width: 260px !important;
            background: #ffffff !important;
            z-index: 9999 !important;
            transition: transform 0.3s ease-in-out !important;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1) !important;
            overflow-y: auto !important;
        }

        .body-wrapper {
            margin-left: 260px !important;
            padding-top: 64px !important;
            transition: margin 0.3s ease-in-out !important;
            background: #f8f9fa !important;
            min-height: 100vh !important;
        }

        .sidebar-nav .sidebar-item .sidebar-link {
            display: flex !important;
            align-items: center !important;
            gap: 0.75rem !important;
            padding: 12px 20px !important;
            margin: 8px 12px !important;
            border-radius: 8px !important;
            transition: all 0.2s ease !important;
            color: #4a5568 !important;
            font-weight: 500 !important;
        }

        .sidebar-nav .sidebar-item .sidebar-link:hover {
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%) !important;
            color: #667eea !important;
            transform: translateX(4px) !important;
        }

        /* Desktop: sidebar selalu visible */
        @media (min-width: 993px) {
            .left-sidebar {
                transform: translateX(0) !important;
            }

            .body-wrapper {
                margin-left: 260px !important;
            }

            .sidebar-toggle-btn {
                display: none !important;
            }
        }

        /* Mobile/Tablet: sidebar bisa di-toggle */
        @media (max-width: 992px) {
            .left-sidebar {
                transform: translateX(-100%) !important;
            }

            .left-sidebar.show {
                transform: translateX(0) !important;
            }

            .body-wrapper {
                margin-left: 0 !important;
                padding-top: 64px !important;
            }

            .sidebar-overlay {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                background: rgba(0, 0, 0, 0.5) !important;
                z-index: 9998 !important;
                display: none !important;
                animation: fadeIn 0.2s ease !important;
            }

            .sidebar-overlay.show {
                display: block !important;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        }

        /* Enhancement visual */
        .brand-logo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border-bottom: 1px solid #e8eef7 !important;
            padding: 16px 20px !important;
            font-weight: 600 !important;
            font-size: 16px !important;
        }

        .close-btn {
            cursor: pointer !important;
            padding: 4px 8px !important;
            border-radius: 4px !important;
            transition: all 0.2s ease !important;
            color: white !important;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            transform: scale(1.1) !important;
        }

        .nav-small-cap {
            padding: 20px 15px 10px !important;
            font-weight: 600 !important;
            color: #667eea !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .sidebar-nav .sidebar-item.selected>.sidebar-link,
        .sidebar-nav .sidebar-item .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4) !important;
        }

        .sidebar-nav .sidebar-item .sidebar-link.active i {
            color: white !important;
        }

        /* Icon sidebar untuk mobile */
        .sidebar-toggle-btn {
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.05) !important;
        }

        /* Topbar enhancements */
        .app-topstrip .text-white {
            font-weight: 600 !important;
            font-size: 18px !important;
            letter-spacing: 0.5px !important;
        }

        .app-topstrip .btn {
            border-radius: 6px !important;
            font-weight: 600 !important;
            transition: all 0.2s ease !important;
        }

        .app-topstrip .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }

        /* Scrollbar styling */
        .left-sidebar::-webkit-scrollbar {
            width: 6px !important;
        }

        .left-sidebar::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }

        .left-sidebar::-webkit-scrollbar-thumb {
            background: #667eea !important;
            border-radius: 3px !important;
        }

        .left-sidebar::-webkit-scrollbar-thumb:hover {
            background: #764ba2 !important;
        }
    </style>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- ================= TOPBAR ================= -->

        <div class="app-topstrip bg-dark py-3 px-3 w-100 d-flex align-items-center justify-content-between">
            <a href="#" class="d-flex align-items-center">
                <img src="{{ asset('backend-template/assets/images/logos/logo-aset.png') }}" alt="Logo" width="45">
            </a>

            <!-- Hamburger button untuk mobile -->
            <button id="sidebar-toggle" class="btn btn-light d-lg-none sidebar-toggle-btn" type="button">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="d-flex align-items-center gap-3">
                <h5 class="text-white mb-0">Dashboard gudang desa</h5>

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- ================= SIDEBAR ================= -->
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between px-3 py-2">
                    <span class="fw-bold">MENU</span>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer">
                        <i class="ti ti-x"></i>
                    </div>
                </div>

                <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                    <ul id="sidebarnav">

                        <li class="nav-small-cap">
                            <span class="hide-menu">Home</span>
                        </li>



                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('food*') ? 'active' : '' }}"
                                href="{{ route('food.index') }}">
                                <i class="ti ti-book"></i>
                                <span class="hide-menu">food</span>
                            </a>
                        </li>



                        </li>


                    </ul>
                </nav>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="body-wrapper">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>

    </div>

    <!-- ================= JS ================= -->
    <script src="{{ asset('backend-template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend-template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend-template/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend-template/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('backend-template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('backend-template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend-template/assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <!-- Sidebar overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.left-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const closeBtn = document.querySelector('.close-btn');

            // Toggle sidebar visibility
            function toggleSidebar(e) {
                if (e) e.preventDefault();

                if (!sidebar) {
                    console.warn('Sidebar not found');
                    return;
                }

                const isHidden = sidebar.style.transform === 'translateX(-100%)' ||
                    !sidebar.classList.contains('show');

                if (isHidden) {
                    sidebar.classList.add('show');
                    if (overlay) overlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } else {
                    sidebar.classList.remove('show');
                    if (overlay) overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }

            // Close sidebar
            function closeSidebar() {
                if (sidebar) {
                    sidebar.classList.remove('show');
                }
                if (overlay) {
                    overlay.classList.remove('show');
                }
                document.body.style.overflow = '';
            }

            // Attach toggle button click
            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }

            // Close button click
            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
            }

            // Overlay click to close
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar when clicking links (mobile only)
            document.querySelectorAll('.sidebar-nav a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 992) {
                        closeSidebar();
                    }
                });
            });

            // Reset on window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth > 992) {
                    closeSidebar();
                }
            });

            // Make toggle available globally
            window.toggleSidebar = toggleSidebar;
        });
    </script>

</body>

</html>
