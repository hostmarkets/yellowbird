<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'dashboard';
?>



<div class="container-fluid">
    <div class="row">
        <?php include 'inc/nav-left.php'; ?>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <a href="edit.php?post_type=page" class="btn btn-primary text-left">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php
                                    $selectPageQuery = $db->query("SELECT `id` FROM `yb_posts` WHERE `post_type`='page'");
                                    echo $selectPageQuery->num_rows;
                                    ?>
                                </h4>
                                <p class="card-text">Pages</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <a href="edit.php?post_type=blog" class="btn btn-success text-left">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php
                                    $selectPageQuery = $db->query("SELECT `id` FROM `yb_posts` WHERE `post_type`='blog'");
                                    echo $selectPageQuery->num_rows;
                                    ?>
                                </h4>
                                <p class="card-text">Blogs</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <a href="edit.php?post_type=news" class="btn btn-info text-left">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?php
                                    $selectPageQuery = $db->query("SELECT `id` FROM `yb_posts` WHERE `post_type`='news'");
                                    echo $selectPageQuery->num_rows;
                                    ?>
                                </h4>
                                <p class="card-text">News</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>




        </main>
    </div>
</div>

<?php include 'inc/footer.php'; ?>