<?php
require_once '../config/config.php';
if (isset($_POST['newcategory'])) {
    $newcategory = $_POST['newcategory']; /** Fetching Values from URL */
    /** Only allow letters, numbers, and dashes */
    $cat_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($newcategory));
    /** Replace multiple dashes with one dash */
    $cat_url = preg_replace('/-+/', '-', $cat_url);
    if (substr($cat_url, -1) === '-') { /** Remove - from end */
        $cat_url = substr($cat_url, 0, -1);
    }
    if (substr($cat_url, 0, 1) === '-') { /** Remove - from start */
        $cat_url = substr($cat_url, 1);
    }
    $exists = $db->query("SELECT * FROM yb_category WHERE cat_name='$newcategory'");
    $exists_num = $exists->num_rows;
    if ($exists_num > 0) {
        echo "Category already exists";
    } else {
        $query = $db->query("INSERT INTO yb_category SET cat_name='$newcategory',cat_seo_url='$cat_url'");
        $queryy = $db->query("SELECT * FROM yb_category WHERE cat_status='publish'");
        echo "<select multiple class='form-control' name='cat_id'>";
        foreach ($queryy as $row) {
            $i = $row['cat_name'];
            $ii = $row['id'];
            if ($i == $newcategory) {
                echo "<option value=" . $ii . " selected>" . $i . "</option>";
            } else {
                echo "<option value=" . $ii . ">" . $i . "</option>";
            }
        }
        echo "</select>";
        $db->close();
    }
} elseif (isset($_POST['newautho'])) {
    $newautho = $_POST['newautho']; /** Fetching Values from URL */
    /** Only allow letters, numbers, and dashes */
    $autho_url = preg_replace('/([^a-zA-Z0-9\-]+)/', '-', strtolower($newautho));
    /** Replace multiple dashes with one dash */
    $autho_url = preg_replace('/-+/', '-', $autho_url);
    if (substr($autho_url, -1) === '-') { /** Remove - from end */
        $autho_url = substr($autho_url, 0, -1);
    }
    if (substr($autho_url, 0, 1) === '-') { /** Remove - from start */
        $autho_url = substr($autho_url, 1);
    }
    $autho_exists = $db->query("SELECT * FROM author WHERE autho_name='$newautho'");
    $autho_exists_num = $autho_exists->num_rows;
    if ($autho_exists_num > 0) {
        echo "Author already exists";
    } else {
        $query = $db->query("INSERT INTO author SET autho_name='$newautho',autho_seo_url='$autho_url'");
        $queryy = $db->query("SELECT * FROM author WHERE autho_status='publish'");
        echo "<select multiple class='form-control' name='autho_id'>";
        foreach ($queryy as $row) {
            $i = $row['autho_name'];
            $ii = $row['id'];
            if ($i == $newautho) {
                echo "<option value=" . $ii . " selected>" . $i . "</option>";
            } else {
                echo "<option value=" . $ii . ">" . $i . "</option>";
            }
        }
        echo "</select>";
        $db->close();
    }
}
?>