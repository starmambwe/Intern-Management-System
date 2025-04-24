<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Intern Management System</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        rel="icon"
        href="assets/img/kaiadmin/favicon.ico"
        type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo url('/'); ?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo url('/'); ?>/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="<?php echo url('/'); ?>/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo url('/'); ?>/assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img
                            src="assets/img/kaiadmin/logo_light.svg"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <ul class="nav nav-secondary">
                            @if (auth()->user())
                            <li class="nav-item">
                                <a onclick="loadPageIntoElement('admin.dashboard', 'mainContainer')">
                                    <i class="fas fa-home"></i>
                                    <p>Admin Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a onclick="loadPageIntoElement('admin.manageUsers', 'mainContainer')">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Manage Users & Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a onclick="loadPageIntoElement('admin.manageProjects', 'mainContainer')">
                                    <i class="fas fa-tasks"></i>
                                    <p>Manage Projects</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a onclick="loadPageIntoElement('admin.projectAssignments', 'mainContainer')">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Project Assignments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a onclick="loadPageIntoElement('admin.viewReports', 'mainContainer')">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>View Reports</p>
                                </a>
                            </li>

                            <!-- Supervisor API Requests -->
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#supervisor-api-requests">
                                    <i class="fas fa-cogs"></i>
                                    <p>Supervisor API Requests</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="supervisor-api-requests">
                                    <ul class="nav nav-collapse">
                                        <!-- Manage Assigned Projects -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.assignedProjects', 'mainContainer')">
                                                <span class="sub-item">Manage Assigned Projects</span>
                                            </a>
                                        </li>
                                        <!-- Create Tasks Under Projects -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.createTasks', 'mainContainer')">
                                                <span class="sub-item">Create Tasks Under Projects</span>
                                            </a>
                                        </li>
                                        <!-- Assign Tasks to Interns -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.assignTasks', 'mainContainer')">
                                                <span class="sub-item">Assign Tasks to Interns</span>
                                            </a>
                                        </li>
                                        <!-- Track Intern Progress -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.internProgress', 'mainContainer')">
                                                <span class="sub-item">Track Intern Progress</span>
                                            </a>
                                        </li>
                                        <!-- Approve/Reject Intern Reports -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.approveRejectReports', 'mainContainer')">
                                                <span class="sub-item">Approve/Reject Intern Reports</span>
                                            </a>
                                        </li>
                                        <!-- Submit Feedback for Tasks/Projects -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.feedback', 'mainContainer')">
                                                <span class="sub-item">Submit Feedback for Tasks/Projects</span>
                                            </a>
                                        </li>
                                        <!-- View Attendance of Interns -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.attendance', 'mainContainer')">
                                                <span class="sub-item">View Attendance of Interns</span>
                                            </a>
                                        </li>
                                        <!-- Monitor Project Progress -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.projectProgress', 'mainContainer')">
                                                <span class="sub-item">Monitor Project Progress</span>
                                            </a>
                                        </li>
                                        <!-- Receive Notifications (Task Submissions, Deadlines) -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.notifications', 'mainContainer')">
                                                <span class="sub-item">Receive Notifications</span>
                                            </a>
                                        </li>
                                        <!-- Review Time Tracked on Tasks -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.timeTrack', 'mainContainer')">
                                                <span class="sub-item">Review Time Tracked on Tasks</span>
                                            </a>
                                        </li>
                                        <!-- Participate in Comment Threads for Tasks -->
                                        <li>
                                            <a onclick="loadPageIntoElement('supervisor.comments', 'mainContainer')">
                                                <span class="sub-item">Participate in Comment Threads</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Intern API Requests -->
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#intern-api-requests">
                                    <i class="fas fa-cogs"></i>
                                    <p>Intern API Requests</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="intern-api-requests">
                                    <ul class="nav nav-collapse">
                                        <!-- View Assigned Projects and Tasks -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.projectsAndTasks', 'mainContainer')">
                                                <span class="sub-item">Projects and Tasks</span>
                                            </a>
                                        </li>
                                        <!-- Work on Tasks and Submit Reports -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.reports', 'mainContainer')">
                                                <span class="sub-item">Task(s) Report(s) Submission</span>
                                            </a>
                                        </li>
                                        <!-- Mark Daily Attendance -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.attendance', 'mainContainer')">
                                                <span class="sub-item">Mark Daily Attendance</span>
                                            </a>
                                        </li>
                                        <!-- Request Help Within a Project -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.help', 'mainContainer')">
                                                <span class="sub-item">Request Help Within a Project</span>
                                            </a>
                                        </li>
                                        <!-- Track Personal Progress on Tasks and Projects -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.progress', 'mainContainer')">
                                                <span class="sub-item">Personal Progress</span>
                                            </a>
                                        </li>
                                        <!-- Receive Notifications (New Tasks, Feedback, Deadlines) -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.notifications', 'mainContainer')">
                                                <span class="sub-item">Notifications</span>
                                            </a>
                                        </li>
                                        <!-- Log Time Spent on Tasks -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.timeLogs', 'mainContainer')">
                                                <span class="sub-item">Time Spent on Tasks</span>
                                            </a>
                                        </li>
                                        <!-- Participate in Comment Threads for Tasks -->
                                        <li>
                                            <a onclick="loadPageIntoElement('intern.comments', 'mainContainer')">
                                                <span class="sub-item">Participate in Comment Threads</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Authentications -->
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#authentications">
                                    <i class="fas fa-user-lock"></i>
                                    <p>Authentications</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="authentications">
                                    <ul class="nav nav-collapse">
                                        <!-- Login -->
                                        <li>
                                            <a onclick="loadPageIntoElement('views/admin/login.html', 'mainContainer')">
                                                <span class="sub-item">Login</span>
                                            </a>
                                        </li>
                                        <!-- Register -->
                                        <li>
                                            <a onclick="loadPageIntoElement('views/admin/register.html', 'mainContainer')">
                                                <span class="sub-item">Register</span>
                                            </a>
                                        </li>
                                        <!-- Forgot Password -->
                                        <li>
                                            <a onclick="loadPageIntoElement('views/admin/forgotPassword.html', 'mainContainer')">
                                                <span class="sub-item">Forgot Password</span>
                                            </a>
                                        </li>
                                        <!-- Reset Password -->
                                        <li>
                                            <a onclick="loadPageIntoElement('views/admin/resetPassword.html', 'mainContainer')">
                                                <span class="sub-item">Reset Password</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- End of Dashboard Section Edits -->


                            <!-- Sidebar Components -->

                            <li class="nav-item">
                                <a href="javascript:void(0);" id="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>Log Out</p>
                                </a>
                            </li>

                            <!-- Other Menu Items -->
                            <li class="nav-item">
                                <a href="../../documentation/index.html">
                                    <i class="fas fa-file"></i>
                                    <p>Documentation</p>
                                    <span class="badge badge-secondary">1</span>
                                </a>
                            </li>

                            @else
                            <li class="nav-item">
                                <a href="../../documentation/index.html">
                                    <i class="fas fa-file"></i>
                                    <p>Log In</p>
                                    <!-- <span class="badge badge-secondary">1</span> -->
                                </a>
                            </li>


                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Sidebar Edits -->
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img
                                src="assets/img/kaiadmin/logo_light.svg"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input
                                    type="text"
                                    placeholder="Search ..."
                                    class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li
                                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                placeholder="Search ..."
                                                class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messageDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul
                                    class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div
                                            class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/jm_denis.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/chadengle.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/mlane.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/talha.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="notifDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a>
                                <ul
                                    class="dropdown-menu notif-box animated fadeIn"
                                    aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have 4 new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> New user registered </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-success">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/profile2.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Reza send messages to you
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-danger">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> Farrah liked Admin </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a
                                    class="dropdown-toggle profile-pic"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img
                                            src="assets/img/profile.jpg"
                                            alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Hizrian</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img
                                                        src="assets/img/profile.jpg"
                                                        alt="image profile"
                                                        class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>Hizrian</h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a
                                                        href="profile.html"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container" id="mainContainer">
                @yield('content')
            </div>


            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>
                    <div>
                        Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="selected changeLogoHeaderColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="white"></button>
                            <br />
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="dark2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red"></button>
                            <button
                                type="button"
                                class="selected changeTopBarColor"
                                data-color="white"></button>
                            <br />
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="white"></button>
                            <button
                                type="button"
                                class="selected changeSideBarColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="<?php echo url('/'); ?>/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?php echo url('/'); ?>/assets/js/core/popper.min.js"></script>
    <script src="<?php echo url('/'); ?>/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?php echo url('/'); ?>/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo url('/'); ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?php echo url('/'); ?>/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?php echo url('/'); ?>/assets/js/setting-demo.js"></script>
    <script src="<?php echo url('/'); ?>/assets/js/demo.js"></script>
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });

        function loadPageIntoElement(viewUrl, elementId) {
            $('#' + elementId).html(`<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
            <i class="fas fa-spinner fa-spin fa-3x mb-3"></i>
            <div class="h5">Loading...</div>
        </div>
    </div>`);
            $.ajax({
                url: "{{route('loadPageIntoElement')}}", // Wrap the route in quotes to pass it as a string
                method: 'GET',
                data: {
                    viewUrl: viewUrl
                },
                success: function(response) {
                    $('#' + elementId).html(response);
                    // --- INIT ASSIGN SUPERVISORS TAB IF PRESENT (MARKER CHECK) ---
                    if ($('#' + elementId + ' #assignSupervisorsMarker').length && typeof window.initAssignSupervisorsTabs === 'function') {
                        try {
                            window.initAssignSupervisorsTabs();
                        } catch (e) {
                            console.warn('initAssignSupervisorsTabs error:', e);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading page:', error);
                    $('#' + elementId).html('<p>Error loading content.</p>');
                }
            });
        }

        $(document).ready(function() {
            $('#logout-btn').click(function() {
                $.ajax({
                    url: "{{ route('auth.logout') }}", // Logout route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}" // CSRF protection
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = "{{ url('/login') }}"; // Redirect to login after logout
                        }
                    },
                    error: function() {
                        alert('Logout failed! Try again.');
                    }
                });
            });
        });
    </script>
</body>



</html>