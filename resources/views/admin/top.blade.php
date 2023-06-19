<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>House For Rent ADMIN</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('public/admin/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('public/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/vendor/bootstrap/css/chat-modal.css') }}" rel="stylesheet">

    {{-- <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js "></script> --}}

    <!-- Template Main CSS File -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/rte_theme_default.css') }}" rel="stylesheet">
    <script src="{{ asset('public/admin/sweatalert/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/admin/sweatalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>


    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('/')}}" class="logo d-flex align-items-center">
                <img src="{{ asset('public/admin/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">House For Rent</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown">
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" style="">
                        <li class="dropdown-header" id="new-msg">

                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <div class="" id="chat-msg">
                        </div>



                    </ul><!-- End Messages Dropdown Items -->
                </li>

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" id="adminpic" href="#"
                        data-bs-toggle="dropdown">
                        
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{url('logout')}}">
                                <i class="bi bi-box-arrow-right" style="color: red;font-weight:700;"></i>
                                <span style="color: red;font-weight:700;">Sign Out</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-heading">
                Apps
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ url('/') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-heading">
                Management
            </li>


            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                        href="#" aria-expanded="false">
                        <i class="bi bi-image-fill"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                        <li>
                            <a href="{{ url('admin/active-posts') }}">
                                <i class="bi bi-circle"></i><span>Active Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/pending-posts') }}" id="pendingAds">
                                <i class="bi bi-circle"></i><span>Pending Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/expired-posts') }}" id="pendingAds">
                                <i class="bi bi-circle"></i><span>Expired Posts</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#members-nav" data-bs-toggle="collapse"
                        href="#" aria-expanded="false">
                        <i class="bi bi-person"></i><span>Members</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="members-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                        <li>
                            <a href="{{ url('admin/admins') }}">
                                <i class="bi bi-circle"></i><span>Admins</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/owners') }}">
                                <i class="bi bi-circle"></i><span>House Owners</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/renters') }}">
                                <i class="bi bi-circle"></i><span>Renters</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{url('admin/comments')}}">
                        <i class="bi bi-cash-coin"></i>
                        <span>Comments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{url('admin/transactions')}}">
                        <i class="bi bi-cash-coin"></i>
                        <span>Transactions</span>
                    </a>
                </li>
                <li class="nav-heading">
                    Personal Settings
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{url('admin/profile')}}">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{url('logout')}}">
                        <i class="bi bi-gear"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </ul>
    </aside>

<script>
    $(document).ready(function(){
        $.get("{{url('admin/fetch-admin-pic')}}",function(res){
            $('#adminpic').html(`
                <img class="u-picture" src="{{ asset('public/img/profile-pic/${res.user_picture}') }}" alt="Profile"
                    class="rounded-circle" style="width:38px; height:auto;">
                <span class="d-none d-md-block u-name dropdown-toggle ps-2">${res.user_name}</span>
            `);
        });
    });
</script>