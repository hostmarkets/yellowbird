<?php
require __DIR__ . "/config/config.php";
require __DIR__ . "/config/function.php";
if (isset($_POST["ApplyNow"]) || isset($_POST["ApplyOnlineVisa"]) || isset($_POST["BookAnAppointment"]) || isset($_POST["sideBarForm"]) || isset($_POST["EnquiryNow"])) {
    $urlAddress = test_input($_POST["urlAddress"]);

    $ip = getUserIP();
    $form_name = test_input($_POST["form_name"]);
    $form_country = test_input($_POST["form_country"]);
    $form_phone = test_input($_POST["form_phone"]);
    $form_email = test_input($_POST["form_email"]);
    $sanitized_email = filter_var($form_email, FILTER_SANITIZE_EMAIL);
    $validate_email_to = validate_email($sanitized_email);
    $form_visa = test_input($_POST["form_visa"]);
    if (isset($_POST["ApplyNow"])) {
        $leadSource = "Apply Now";
    } elseif (isset($_POST["ApplyOnlineVisa"])) {
        $leadSource = "Apply Online Visa";
    } elseif (isset($_POST["BookAnAppointment"])) {
        $leadSource = "Book An Appointment";
    } elseif (isset($_POST["sideBarForm"])) {
        $leadSource = "Side Bar Form";
    } elseif (isset($_POST["EnquiryNow"])) {
        $leadSource = "Fixed Right Side Bar Form";
    }

    $utmSource = isset($_POST['utmSource']) ? $_POST['utmSource'] : "";
    $utmMedium = isset($_POST['utmMedium']) ? $_POST['utmMedium'] : "";
    $utmCampaign = isset($_POST['utmCampaign']) ? $_POST['utmCampaign'] : "";
    $gclid = isset($_POST['gclid']) ? $_POST['gclid'] : "";
    $date_time = date("Y-m-d H:i:s");
    $ValidPhone = is_numeric($form_phone);

    if (empty($form_name) || empty($form_country) || empty($form_phone) || empty($form_email) || empty($form_visa)) {
        $_SESSION['alert'] = '<div class="alert alert-warning">Please fill all required fields.</div>';
        header("Location: " . ROOT . "" . $urlAddress . "");
        exit();
    } elseif ($ValidPhone < 0) {
        $_SESSION['alert'] = '<div class="alert alert-warning">Please fill a valid phone number.</div>';
        header("Location: " . ROOT . "" . $urlAddress . "");
        exit();

    } elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['alert'] = '<div class="alert alert-warning">Please fill a valid email address.</div>';
        header("Location: " . ROOT . "" . $urlAddress . "");
        exit();

    } elseif ($validate_email_to === "FALSE") {
        $_SESSION['alert'] = '<div class="alert alert-warning">Please fill a valid email address.</div>';
        header("Location: " . ROOT . "" . $urlAddress . "");
        exit();

    } else {

        if ($form_country === "India") {
            if (validate_mobile($form_phone)) {
                $insert = "INSERT INTO `yb_leads` SET `name`='$form_name',`country`='$form_country',`phone`='$form_phone',`email`='$form_email',`visa_type`='$form_visa',`lead_source`='$leadSource',`utm_source`='$utmSource',`utm_medium`='$utmMedium',`utm_campaign`='$utmCampaign',`gclid`='$gclid',`ip_address`='$ip',`page_url`='$urlAddress',`creation_date_time`='$date_time'";
                if ($db->query($insert) === TRUE) {
                    $_SESSION['alert'] = '';
                    header("Location: " . ROOT . "/thank-you");
                    exit();
                } else {
                    $_SESSION['alert'] = '<div class="alert alert-danger">Database error. Please try after some times.</div>';
                    header("Location: " . ROOT . "" . $urlAddress . "");
                    exit();
                }


            } else {
                $_SESSION['alert'] = '<div class="alert alert-warning">Please fill a valid phone number.</div>';
                header("Location: " . ROOT . "" . $urlAddress . "");
                exit();
            }
        } else {
            $insert = "INSERT INTO `yb_leads` SET `name`='$form_name',`country`='$form_country',`phone`='$form_phone',`email`='$form_email',`visa_type`='$form_visa',`lead_source`='$leadSource',`utm_source`='$utmSource',`utm_medium`='$utmMedium',`utm_campaign`='$utmCampaign',`gclid`='$gclid',`ip_address`='$ip',`page_url`='$urlAddress',`creation_date_time`='$date_time'";
            if ($db->query($insert) === TRUE) {
                $_SESSION['alert'] = '';
                header("Location: " . ROOT . "/thank-you");
                exit();
            } else {
                $_SESSION['alert'] = '<div class="alert alert-danger">Database error. Please try after some times.</div>';
                header("Location: " . ROOT . "" . $urlAddress . "");
                exit();
            }
        }

    }
} elseif (isset($_POST["subscribe"])) {
    $email = test_input($_POST["email"]);
    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $validate_email_to = validate_email($sanitized_email);
    $urlAddress = $_POST["urlAddress"];
    $myIp = getUserIP();
    $date = date("Y-m-d H:i:s");
    $valid_date = date("d M, Y | h:i:s A", strtotime($date));
    if (empty($email)) {
        $_SESSION['alert'] = '<div class="alert alert-danger">Please fill a valid email address.</div>';
        header("Location: " . ROOT . "" . $urlAddress . "");
        exit();
    } else {
        $select_row = $db->query("SELECT `email_id` FROM `subscribers` WHERE `email_id`='$email' AND `status`='1' AND `sub_status`='2'");
        $num_rows = $select_row->num_rows;
        if ($num_rows > 0) {
            $_SESSION['alert'] = '<div class="alert alert-danger">Email-Id already exists.</div>';
            header("Location: " . ROOT . "" . $urlAddress . "");
            exit();
        } else {
            if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
                if ($validate_email_to === "TRUE") {
                    $db->query("INSERT INTO subscribers SET `email_id`='$email',`ip_address`='$myIp',`url_address`='$urlAddress',`date_time`='$date'");
                    $_SESSION['alert'] = '<div class="alert alert-success">You have successfully subscribed. Please check your email for verify.</div>';
                    header("Location: " . ROOT . "" . $urlAddress . "");
                    exit();
                } else {
                    $_SESSION['alert'] = '<div class="alert alert-danger">Please fill a valid email address.</div>';
                    header("Location: " . ROOT . "" . $urlAddress . "");
                    exit();
                }
            } else {
                $_SESSION['alert'] = '<div class="alert alert-danger">Please fill a valid email address.</div>';
                header("Location: " . ROOT . "" . $urlAddress . "");
                exit();
            }
        }
    }
}