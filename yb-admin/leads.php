<?php
include '../config/config.php';
include 'inc/common-info.php';
include 'inc/header.php';
include 'inc/nav-top.php';
?>



<div class="container-fluid">
    <div class="row">
        <?php include 'inc/nav-left.php'; ?>

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">All Leads
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
                                <th>Name</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Visa Type</th>
                                <th>Lead Source</th>
                                <th>Page URL</th>
                                <th>Date/Time</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectQuery = "SELECT * FROM `yb_leads` ORDER BY id DESC";
                            $rowQuery = mysqli_query($db, $selectQuery);
                            while ($rowFetch = mysqli_fetch_assoc($rowQuery)) {

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $rowFetch['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['country']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['phone']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['visa_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['lead_source']; ?>
                                    </td>
                                    <td>
                                        <?php echo ROOT . $rowFetch['page_url']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['creation_date_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $rowFetch['ip_address']; ?>
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