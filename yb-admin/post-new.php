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

        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="scrollTop">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New
                    <?php echo ucwords($postType); ?>
                </h1>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="message">
                        <?php if (!empty($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } ?>
                    </div>
                    <form name="newPost" id="newPost" enctype="multipart/form-data" method="post"
                        action="post-action.php">
                        <div class="row mb-3">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="postTitle" class="col-form-label">Title</label>
                                    <input type="text" class="form-control" id="postTitle" name="postTitle">
                                    <span class="error" id="postTitleErr"> </span>
                                </div>
                                <div class="mt-2">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Permalink:
                                                <?php echo ROOT; ?>/
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="permaLink" name="permaLink">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="postContent" class="col-form-label">Description</label>
                                    <textarea name="postContent" id="postContent" cols="30" rows="10"></textarea>
                                </div>
                                <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center"
                                    class="mt-3 mb-3">
                                    <span style="font-size: 24px; background-color: #F3F5F6; padding: 0 10px;">
                                        SEO Meta Tags
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="metaTitle" class="col-form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="metaTitle" name="metaTitle">
                                    <span class="error" id="metaTitleErr"> </span>
                                </div>
                                <div class="form-group">
                                    <label for="metaDesc" class="col-form-label">Meta Description</label>
                                    <textarea name="metaDesc" id="metaDesc" cols="30" rows="3"
                                        class="form-control"></textarea>
                                    <span class="error" id="metaDescErr"> </span>
                                </div>
                                <div class="form-group">
                                    <label for="metaKeywords" class="col-form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="metaKeywords" name="metaKeywords"
                                        data-role="tagsinput">
                                </div>
                                <fieldset class="row mb-3 mt-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Meta Index</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check pull-left mr-3">
                                            <input class="form-check-input" type="radio" name="metaIndex"
                                                id="metaIndexyes" value="yes" checked>
                                            <label class="form-check-label" for="metaIndexyes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check pull-left">
                                            <input class="form-check-input" type="radio" name="metaIndex"
                                                id="metaIndexno" value="no">
                                            <label class="form-check-label" for="metaIndexno">
                                                No
                                            </label>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Meta Follow</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check pull-left mr-3">
                                            <input class="form-check-input" type="radio" name="metaFollow"
                                                id="metaFollowyes" value="yes" checked>
                                            <label class="form-check-label" for="metaFollowyes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check pull-left">
                                            <input class="form-check-input" type="radio" name="metaFollow"
                                                id="metaFollowno" value="no">
                                            <label class="form-check-label" for="metaFollowno">
                                                No
                                            </label>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Sitemap</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check pull-left mr-3">
                                            <input class="form-check-input" type="radio" name="sitemap" id="sitemapyes"
                                                value="yes" checked>
                                            <label class="form-check-label" for="sitemapyes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check pull-left">
                                            <input class="form-check-input" type="radio" name="sitemap" id="sitemapno"
                                                value="no">
                                            <label class="form-check-label" for="sitemapno">
                                                No
                                            </label>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-5">
                                <?php if ($postType == 'blog' || $postType == 'news') { ?>
                                    <div class="form-group">
                                        <label for="cat" class="col-form-label">Category</label>
                                        <div id="thanks"></div>
                                        <?php
                                        $datac = $db->query("SELECT * FROM yb_category WHERE cat_status='publish'");
                                        $num_rows = $datac->num_rows;
                                        if ($num_rows > 0) {
                                            ?>
                                            <select class="form-control" name="cat_id" id="ends">
                                                <option value="">--Select--</option>
                                                <?php
                                                while ($valuec = $datac->fetch_object()) {
                                                    ?>
                                                    <option value="<?php echo $valuec->id; ?>">
                                                        <?php echo $valuec->cat_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                        <a class="category-add-new" data-bs-toggle="collapse" aria-expanded="false"
                                            aria-controls="collapsecategory" href="#collapsecategory">+ Add New Category</a>
                                        <div id="collapsecategory" class="collapse mt-2">
                                            <form id="catform" name="catform">
                                                <input class="form-control" style="margin: 0 0 1em;" name="newcategory"
                                                    id="newcategory">
                                                <input type="button" name="add-new-category" id="add-new-category"
                                                    value="Add New Category" class="btn btn-secondary btn-newcategory" />
                                                <div id="exists" class="text-danger" style="margin: 7px;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="autho" class="col-form-label">Author</label>
                                        <div id="autho_thanks"></div>
                                        <?php
                                        $datac = $db->query("SELECT * FROM author WHERE autho_status='publish'");
                                        $num_rows = $datac->num_rows;
                                        if ($num_rows > 0) {
                                            ?>
                                            <select class="form-control" name="autho_id" id="autho_ends">
                                                <option value="">--Select--</option>
                                                <?php
                                                while ($valuec = $datac->fetch_object()) {
                                                    ?>
                                                    <option value="<?php echo $valuec->id; ?>">
                                                        <?php echo $valuec->autho_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>
                                        <a class="autho-add-new" data-bs-toggle="collapse" aria-expanded="false"
                                            aria-controls="collapseautho" href="#collapseautho">+ Add New Author</a>
                                        <div id="collapseautho" class="collapse mt-2">
                                            <form id="authoform" name="authoform">
                                                <input class="form-control" style="margin: 0 0 1em;" name="newautho"
                                                    id="newautho">
                                                <input type="button" name="add-new-autho" id="add-new-autho"
                                                    value="Add New Author" class="btn btn-secondary btn-newautho" />
                                                <div id="autho_exists" class="text-danger" style="margin: 7px;">
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                <?php } ?>
                                <div class="form-group">
                                    <label for="featuredImage" class="col-form-label">Featured Image</label>
                                    <input type="file" class="form-control" name="featuredImage" id="featuredImage"
                                        accept="image/*" onchange="loadFile(event)">
                                    <span class="help-block text-danger">Browse only .jpg /.JPEG /.png /.PNG
                                        / .webp image</span>
                                    <img id="output" src="https://placehold.co/1200x628" class="img-fluid" />
                                </div>
                                <div class="form-group">
                                    <label for="altText" class="col-form-label">Alt Text</label>
                                    <input type="text" class="form-control" name="altText" id="altText"
                                        placeholder="Featured Image Alt text">
                                </div>
                                <div class="form-group">
                                    <label for="altText" class="col-form-label">Sort Order</label>
                                    <input type="number" class="form-control" name="sortOrder" id="sortOrder" value="0">
                                </div>
                                <div class="form-group mt-3">

                                    <input type="submit" class="btn btn-primary btn-block" name="submit" id="submit"
                                        value="Publish" onClick="return confirm('Are you sure want to publish ?')">
                                    <input type="hidden" name="postType" value="<?php echo $postType; ?>">
                                </div>

                            </div>
                        </div>



                    </form>
                </div>
            </div>




        </main>
    </div>
</div>

<?php include 'inc/footer.php'; ?>