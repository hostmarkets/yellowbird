<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'author';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$query = $db->query("SELECT * FROM `author` WHERE `id`='$id'");
if ($query->num_rows > 0) {
    $fetch = $query->fetch_assoc();
    $authoImg = $fetch['autho_img'];
    if (!empty($authoImg)) {
        if (file_exists("../uploads/autho-images/" . $authoImg)) {
            $authoImg = "../uploads/autho-images/" . $authoImg;
        } else {
            $authoImg = "../images/yellowbird-logo.webp";
        }
    } else {
        $authoImg = "../images/yellowbird-logo.webp";
    }

} else {
    $authoImg = "../images/yellowbird-logo.webp";
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
                    } ?> Author
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form name="authoForm" id="authoForm" action="autho-action.php" enctype="multipart/form-data"
                        method="post">


                        <div class="mb-3">

                            <input type="text" class="form-control" id="autho_name" name="autho_name"
                                value="<?php echo @$fetch['autho_name']; ?>" placeholder="Name*" required>
                        </div>

                        <div class="mb-3">

                            <input type="text" class="form-control" id="autho_desgn" name="autho_desgn"
                                value="<?php echo @$fetch['autho_desgn']; ?>" placeholder="Designation*" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="autho_profile" id="autho_profile" cols="30" rows="5"
                                placeholder="author profile"
                                class="form-control"><?php echo @$fetch['autho_profile']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" name="autho_img" id="photo" accept="image/*"
                                onchange="loadFile(event)">
                            <div class="text-danger">Browse only .jpg /.JPEG /.png /.PNG /.webp image.</div>
                            <img id="output" src="<?php echo $authoImg; ?>" class="img-fluid" />
                        </div>

                        <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center"
                            class="mt-3 mb-3">
                            <span style="font-size: 24px; background-color: #F3F5F6; padding: 0 10px;">
                                Author Social Links
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="autho_email" name="autho_email"
                                value="<?php echo @$fetch['autho_email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="col-form-label">LinkedIn</label>
                            <input type="text" class="form-control" id="autho_linkedin" name="autho_linkedin"
                                value="<?php echo @$fetch['autho_linkedin']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="col-form-label">Twitter</label>
                            <input type="text" class="form-control" id="autho_twitter" name="autho_twitter"
                                value="<?php echo @$fetch['autho_twitter']; ?>">
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
                                <th>Author Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `author` ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['autho_name']; ?>
                                    </td>

                                    <td><a href="authors.php?id=<?php echo $rowFetch['id']; ?>&action=edit"
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