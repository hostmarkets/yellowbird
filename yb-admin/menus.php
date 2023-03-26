<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
$page = 'menu';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$query = $db->query("SELECT * FROM `menus` WHERE `id`='$id'");
if ($query->num_rows > 0) {
    $fetch = $query->fetch_assoc();
    $menu_position = $fetch['menu_position'];
    $footermenu = $fetch['footermenu'];
    $post_id = $fetch['post_id'];

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
                    } ?> Menu
                </h1>

            </div>
            <div id="message">
                <?php if (!empty($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                } ?>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form name="menuForm" id="menuForm" action="menu-action.php" enctype="multipart/form-data"
                        method="post">





                        <div class="mb-3">
                            <select class="form-control" name="menu_position" id="menu_position" required>
                                <option value="" selected>--Select Position--</option>
                                <option value="1" <?php if (@$menu_position == "1") {
                                    echo "selected";
                                } ?>>Header</option>
                                <option value="2" <?php if (@$menu_position == "2") {
                                    echo "selected";
                                } ?>>Footer</option>

                            </select>
                        </div>
                        <?php if (isset($_GET['id'])) { ?>
                            <div class="mb-3" <?php if (@$menu_position == "1") { ?>style="display:none;" <?php } ?>
                                id="section">
                            <?php } else { ?>
                                <div class="mb-3" style="display:none;" id="section">

                                <?php } ?>
                                <select class="form-control" name="footermenu" id="footermenu">
                                    <option value="" selected>--Select Section--</option>
                                    <option value="footer1" <?php if (@$footermenu == "footer1") {
                                        echo "selected";
                                    } ?>>Footer
                                        1</option>
                                    <option value="footer2" <?php if (@$footermenu == "footer2") {
                                        echo "selected";
                                    } ?>>Footer
                                        2</option>
                                    <option value="footer3" <?php if (@$footermenu == "footer3") {
                                        echo "selected";
                                    } ?>>Footer
                                        3</option>
                                    <option value="footer4" <?php if (@$footermenu == "footer4") {
                                        echo "selected";
                                    } ?>>Footer
                                        4</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="pagemenu" id="pagemenu">
                                    <option value="" selected>--Select Pages/Posts--</option>
                                    <?php
                                    $select_page_menu = $db->query("SELECT * FROM `yb_posts` WHERE `post_status`='publish' AND `post_type`!='faq' ORDER BY `post_title`");
                                    foreach ($select_page_menu as $select_page_menu_row) {
                                        $page_id = $select_page_menu_row["id"];
                                        ?>
                                        <option value="<?php echo $select_page_menu_row["id"]; ?>" <?php if (@$post_id == $page_id) {
                                               echo "selected";
                                           } ?>><?php echo $select_page_menu_row["post_title"]; ?></option>
                                    <?php } ?>
                                </select>


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
                                <th><input type="checkbox" name="check[]" id="checkAl"></th>
                                <th>Items</th>
                                <th>Position</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `menus` ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {
                                $id = $rowFetch['id'];
                                $post_id = $rowFetch['post_id'];
                                $menu_position = $rowFetch['menu_position'];

                                if ($menu_position == "1") {
                                    $menu_position = "Header";
                                } elseif ($menu_position == "2") {
                                    $menu_position = "Footer";
                                } else {
                                    $menu_position = "NA";
                                }
                                $get_post_query = $db->query("SELECT * FROM yb_posts WHERE id='$post_id' ORDER BY `sort_order`");
                                $get_menu_item = $get_post_query->fetch_object();
                                $post_title = $get_menu_item->post_title;


                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $id; ?>">
                                    </td>
                                    <td>
                                        <?php echo $post_title; ?>
                                    </td>
                                    <td>
                                        <?php echo $menu_position; ?>
                                    </td>

                                    <td><a href="menus.php?id=<?php echo $id; ?>&action=edit" class="btn btn-primary btn-sm"
                                            onClick="return confirm('Are you sure want to edit ?')"><i
                                                class="fa fa-pencil"></i> Edit</a> <a
                                            href="menu-action.php?id=<?php echo $id; ?>&action=delete"
                                            class="btn btn-danger btn-sm"
                                            onClick="return confirm('Are you sure want to delete ?')"><i
                                                class="fa fa-remove"></i> Delete</a>

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