<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'category';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$query = $db->query("SELECT * FROM `yb_category` WHERE `id`='$id'");
if ($query->num_rows > 0) {
    $fetch = $query->fetch_assoc();
    $catImg = $fetch['cat_img'];
    if (!empty($catImg)) {
        if (file_exists("../uploads/cat-images/" . $catImg)) {
            $catImg = "../uploads/cat-images/" . $catImg;
        } else {
            $catImg = "../images/yellowbird-logo.webp";
        }
    } else {
        $catImg = "../images/yellowbird-logo.webp";
    }

} else {
    $catImg = "../images/yellowbird-logo.webp";
}
?>



<div class="container-fluid">
    <div class="row">
        <?php include 'inc/nav-left.php'; ?>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <?php if (isset($_GET['id'])) {
                        echo 'Edit';
                    } else {
                        echo 'Add';
                    } ?> Category
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form name="catForm" id="catForm" action="cat-action.php" enctype="multipart/form-data"
                        method="post">


                        <div class="mb-3">

                            <input type="text" class="form-control" id="cat_name" name="cat_name"
                                value="<?php echo @$fetch['cat_name']; ?>" placeholder="Name*" required>
                        </div>

                        <div class="mb-3">

                            <textarea name="cat_descp" id="postContent" cols="30"
                                rows="10"><?php echo @$fetch['cat_descp']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" name="cat_img" id="photo" accept="image/*"
                                onchange="loadFile(event)">
                            <div class="text-danger">Browse only .jpg /.JPEG /.png /.PNG /.webp image.</div>
                            <img id="output" src="<?php echo $catImg; ?>" class="img-fluid" />
                        </div>

                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center"
                            class="mt-3 mb-3">
                            <span style="font-size: 24px; background-color: #F3F5F6; padding: 0 10px;">
                                SEO Meta Tags
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="metaTitle" class="col-form-label">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" name="metaTitle"
                                value="<?php echo @$fetch['cat_meta_title']; ?>">
                            <span class="error" id="metaTitleErr"> </span>
                        </div>
                        <div class="form-group">
                            <label for="metaDesc" class="col-form-label">Meta Description</label>
                            <textarea name="metaDesc" id="metaDesc" cols="30" rows="3"
                                class="form-control"><?php echo @$fetch['cat_meta_descp']; ?></textarea>
                            <span class="error" id="metaDescErr"> </span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="metaKeywords" class="col-form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="metaKeywords" name="metaKeywords"
                                data-role="tagsinput" value="<?php echo @$fetch['cat_meta_keyword']; ?>">
                        </div>

                        <div class="mb-3">
                            <?php if (isset($_GET['id'])) { ?>
                                <input type="submit" name="submit" id="submit" value="Update"
                                    class="btn btn-success btn-block"
                                    onClick="return confirm('Are you sure want to update ?')" />
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            <?php } else { ?>
                                <input type="submit" name="submit" id="submit" value="Submit"
                                    class="btn btn-primary btn-block"
                                    onClick="return confirm('Are you sure want to submit ?')" />
                            <?php } ?>

                            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `yb_category` ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['cat_name']; ?>
                                    </td>

                                    <td><a href="categories.php?id=<?php echo $rowFetch['id']; ?>&action=edit"
                                            class="btn btn-primary btn-sm"
                                            onClick="return confirm('Are you sure want to edit ?')"><i
                                                class="fa fa-pencil"></i> Edit</a>
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