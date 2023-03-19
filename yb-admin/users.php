<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'user';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$query = $db->query("SELECT * FROM `user` WHERE `id`='$id'");
if ($query->num_rows > 0) {
    $fetch = $query->fetch_assoc();
    $userType = $fetch['user_type'];
    $name = $fetch['user_name'];
    $email = $fetch['user_email'];
    $password = $fetch['user_vpwd'];
    $userPic = $fetch['user_pic'];
    if (!empty($userPic)) {
        if (file_exists("../uploads/user-images/" . $userPic)) {
            $userPic = "../uploads/user-images/" . $userPic;
        } else {
            $userPic = "../images/yellowbird-logo.webp";
        }
    } else {
        $userPic = "../images/yellowbird-logo.webp";
    }

}
$userPic = "../images/yellowbird-logo.webp";
?>



<div class="container-fluid">
    <div class="row">
        <?php include 'inc/nav-left.php'; ?>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">All users
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <form name="userForm" id="userForm" action="user-action.php" enctype="multipart/form-data"
                        method="post">

                        <fieldset class="row mb-3 mt-3">
                            <legend class="col-form-label col-sm-4 pt-0">User Type</legend>
                            <div class="col-sm-8">
                                <div class="form-check pull-left mr-3">
                                    <input class="form-check-input" type="radio" name="user_type" id="user_typeadmin"
                                        value="1" <?php if (@$userType == '1') {
                                            echo 'checked';
                                        } ?>>
                                    <label class="form-check-label" for="user_typeadmin">
                                        Admin
                                    </label>
                                </div>
                                <div class="form-check pull-left">
                                    <input class="form-check-input" type="radio" name="user_type" id="user_typeuser"
                                        value="2" <?php if (@$userType == '2') {
                                            echo 'checked';
                                        } elseif (@$userType == '') {
                                            echo 'checked';
                                        } ?>>
                                    <label class="form-check-label" for="user_typeuser">
                                        User
                                    </label>
                                </div>

                            </div>
                        </fieldset>
                        <div class="mb-3">

                            <input type="text" class="form-control" id="name" name="name" value="<?php echo @$name; ?>"
                                placeholder="Name*" required>
                        </div>
                        <div class="mb-3">

                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo @$email; ?>" placeholder="Email-Id*" required>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="user_pic" id="photo" accept="image/*"
                                onchange="loadFile(event)">
                            <div class="text-danger">Browse only .jpg /.JPEG /.png /.PNG /.webp image.</div>
                            <img id="output" src="<?php echo $userPic; ?>" class="img-fluid" />
                        </div>
                        <div class="mb-3">

                            <input type="text" class="form-control" id="password" name="password"
                                value="<?php echo @$password; ?>" placeholder="Password*" required>
                        </div>
                        <div class="mb-3">
                            <?php if (isset($_GET['id'])) { ?>
                                <input type="submit" name="submit" id="submit" value="Update"
                                    class="btn btn-success btn-block"
                                    onClick="return confirm('Are you sure want to update ?')" />
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            <?php } else { ?>
                                <input type="submit" name="submit" id="submit" value="Add" class="btn btn-primary btn-block"
                                    onClick="return confirm('Are you sure want to add ?')" />
                            <?php } ?>

                            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </div>
                    </form>
                </div>
                <div class="col-lg-8">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date/Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `user` WHERE `user_type`='2' ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                $userType = $rowFetch['user_type'];
                                $userStatus = $rowFetch['user_status'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['user_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['user_email']; ?>
                                    </td>
                                    <td>
                                        <?php if ($userType == '1') {
                                            echo 'Admin';
                                        } else {
                                            echo 'User';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($userStatus == '1') {
                                            echo '<span class="badge bg-success">Active</span>';
                                        } else {
                                            echo '<span class="badge bg-secondary">In-active</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['user_date_time']; ?>
                                    </td>
                                    <td><a href="users.php?id=<?php echo $rowFetch['id']; ?>&action=edit"
                                            class="btn btn-primary btn-sm"
                                            onClick="return confirm('Are you sure want to edit ?')"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <?php if ($userStatus == '2') { ?>
                                            <a href="user-action.php?id=<?php echo $rowFetch['id']; ?>&action=enable"
                                                class="btn btn-info btn-sm"
                                                onClick="return confirm('Are you sure want to enable ?')"><i
                                                    class="fa fa-refresh"></i> Enable</a>
                                            <a href="user-action.php?id=<?php echo $rowFetch['id']; ?>&action=delete"
                                                class="btn btn-danger btn-sm"
                                                onClick="return confirm('Are you sure want to delete ?')"><i
                                                    class="fa fa-remove"></i> Delete</a>
                                        <?php } else { ?>
                                            <a href="user-action.php?id=<?php echo $rowFetch['id']; ?>&action=disable"
                                                class="btn btn-warning btn-sm"
                                                onClick="return confirm('Are you sure want to disable ?')"><i
                                                    class="fa fa-ban"></i> Disable</a>
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