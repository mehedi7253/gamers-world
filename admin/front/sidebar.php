<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <br/>

    <li class="nav-item">
        <a class="nav-link" href="manage_users.php">
            <i class="fas fa-users" style="color: #007bff;"></i>
            <span>Manage Users</span></a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars" style="color: yellow"></i>
            <span> Manage Category</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="add_category.php"><i class="fas fa-user-plus" style="color: #007bff"></i> Add Category</a>
            <a class="dropdown-item" href="manage_category.php"><i class="fa fa-edit text-danger"></i> Manage Category</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-dollar-sign" style="color: yellow"></i>
            <span> Payment</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="manage_event.php"><i class="fas fa-dollar-sign" style="color: #007bff"></i> Total Event Payment</a>
            <a class="dropdown-item" href="give_payment.php"><i class="fas fa-dollar-sign"></i> Share Payment</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="manage_post.php">
            <i class="fas fa-newspaper" style="color: #e4606d"></i>
            <span>Manage Post</span></a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-newspaper" style="color: #007bff"></i>
            <span> About US</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="about_us.php"><i class="fas fa-user-plus" style="color: #007bff"></i> Add About US</a>
            <a class="dropdown-item" href="manage_about_us.php"><i class="fa fa-edit text-danger"></i> Manage About US</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="public_msg.php">
            <i class="fas fa-envelope-open" style="color: #6f42c1"></i>
            <span>Public Message</span></a>
    </li>

</ul>