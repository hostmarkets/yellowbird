<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'banner';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$query = $db->query("SELECT * FROM `yb_banners` WHERE `id`='$id'");
if ($query->num_rows > 0) {
    $fetch = $query->fetch_assoc();
    $banImg = $fetch['ban_img'];
    if (!empty($banImg)) {
        if (file_exists("../uploads/ban-images/" . $banImg)) {
            $banImg = "../uploads/ban-images/" . $banImg;
        } else {
            $banImg = "https://placehold.co/1920x800";
        }
    } else {
        $banImg = "https://placehold.co/1920x800";
    }

} else {
    $banImg = "https://placehold.co/1920x800";
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
                    } ?> Banner
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form name="banForm" id="banForm" action="ban-action.php" enctype="multipart/form-data"
                        method="post">





                        <div class="mb-3">

                            <input type="text" class="form-control" id="ban_name" name="ban_name"
                                value="<?php echo @$fetch['ban_name']; ?>" placeholder="Banner Name">
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="ban_img" id="photo" accept="image/*"
                                onchange="loadFile(event)">
                            <div class="text-danger">Browse only .jpg /.JPEG /.png /.PNG /.webp image.</div>
                            <img id="output" src="<?php echo $banImg; ?>" class="img-fluid" />
                        </div>
                        <div class="mb-3">

                            <input type="text" class="form-control" id="ban_link" name="ban_link"
                                value="<?php echo @$fetch['ban_link']; ?>" placeholder="Banner Link">
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
                                <th>Banner Name</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `yb_banners` ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                $banStatus = $rowFetch['ban_status'];
                                $ban_img = $rowFetch['ban_img'];
                                if (!empty($ban_img)) {
                                    if (file_exists("../uploads/ban-images/" . $ban_img)) {
                                        $ban_img = "../uploads/ban-images/" . $ban_img;
                                    } else {
                                        $ban_img = "https://placehold.co/1920x800";
                                    }
                                } else {
                                    $ban_img = "https://placehold.co/1920x800";
                                }


                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['ban_name']; ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo $ban_img; ?>" class="img-fluid"
                                            alt="<?php echo $rowFetch['ban_name']; ?>" style="width:150px;">
                                    </td>

                                    <td><a href="banners.php?id=<?php echo $rowFetch['id']; ?>&action=edit"
                                            class="btn btn-primary btn-sm"
                                            onClick="return confirm('Are you sure want to edit ?')"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <?php if ($banStatus == 'trash') { ?>
                                            <a href="ban-action.php?id=<?php echo $rowFetch['id']; ?>&action=restore"
                                                class="btn btn-info btn-sm"
                                                onClick="return confirm('Are you sure want to restore ?')"><i
                                                    class="fa fa-refresh"></i> Restore</a>
                                            <a href="ban-action.php?id=<?php echo $rowFetch['id']; ?>&action=delete"
                                                class="btn btn-danger btn-sm"
                                                onClick="return confirm('Are you sure want to delete ?')"><i
                                                    class="fa fa-remove"></i> Delete</a>
                                        <?php } else { ?>
                                            <a href="ban-action.php?id=<?php echo $rowFetch['id']; ?>&action=trash"
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