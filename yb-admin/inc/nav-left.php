<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'dashboard') {
                    echo 'active';
                } ?>" aria-current="page" href="dashboard.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($postType == 'page') {
                    echo 'active';
                } ?>" href="edit.php?post_type=page">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Pages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($postType == 'blog') {
                    echo 'active';
                } ?>" href="edit.php?post_type=blog">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Blogs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($postType == 'news') {
                    echo 'active';
                } ?>" href="edit.php?post_type=news">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    News
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'leads') {
                    echo 'active';
                } ?>" href="leads.php">
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                    Leads
                </a>
            </li>

            <h4 class="h4 nav-link mb-0"><span>Settings</span></h4>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'banner') {
                    echo 'active';
                } ?>" href="banners.php">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Banners
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'menu') {
                    echo 'active';
                } ?>" href="menus.php">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Menus
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'category') {
                    echo 'active';
                } ?>" href="categories.php">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'author') {
                    echo 'active';
                } ?>" href="authors.php">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    Authors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($page == 'user') {
                    echo 'active';
                } ?>" href="users.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Users
                </a>
            </li>
        </ul>

    </div>
</nav>