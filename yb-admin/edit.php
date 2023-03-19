<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$postType = isset($_GET['post_type']) ? $_GET['post_type'] : '';
?>



<div class="container-fluid">
    <div class="row">
        <?php include 'inc/nav-left.php'; ?>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">All
                    <?php echo ucwords($postType); ?> <a class="btn btn-dark btn-sm"
                        href="post-new.php?post_type=<?php echo $postType; ?>">Add
                        New</a>
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Date/Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM yb_posts WHERE post_type='$postType' ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                $postStatus = $rowFetch['post_status'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['post_title']; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo ROOT . '/' . $rowFetch['post_title_seo_url']; ?>"
                                            target="_blank"> <?php echo ROOT . '/' . $rowFetch['post_title_seo_url']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['post_date_time']; ?>
                                    </td>
                                    <td><a href="post.php?id=<?php echo $rowFetch['id']; ?>&post_type=<?php echo $rowFetch['post_type']; ?>&action=edit"
                                            class="btn btn-primary btn-sm"
                                            onClick="return confirm('Are you sure want to edit ?')"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <?php if ($postStatus == 'trash') { ?>
                                            <a href="post-action.php?id=<?php echo $rowFetch['id']; ?>&post_type=<?php echo $rowFetch['post_type']; ?>&action=restore"
                                                class="btn btn-info btn-sm"
                                                onClick="return confirm('Are you sure want to restore ?')"><i
                                                    class="fa fa-refresh"></i> Restore</a>
                                            <a href="post-action.php?id=<?php echo $rowFetch['id']; ?>&post_type=<?php echo $rowFetch['post_type']; ?>&action=delete"
                                                class="btn btn-danger btn-sm"
                                                onClick="return confirm('Are you sure want to delete ?')"><i
                                                    class="fa fa-remove"></i> Delete</a>
                                        <?php } else { ?>
                                            <a href="post-action.php?id=<?php echo $rowFetch['id']; ?>&post_type=<?php echo $rowFetch['post_type']; ?>&action=trash"
                                                class="btn btn-warning btn-sm"
                                                onClick="return confirm('Are you sure want to trash ?')"><i
                                                    class="fa fa-trash"></i> Trash</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>




        </main>
    </div>
</div>

<?php include 'inc/footer.php'; ?>