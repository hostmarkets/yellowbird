<?php
include '../config/config.php';
if (isset($_SESSION['yb'])) {
    header("location: dashboard.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="yellowbird">
    <title>Log In | Yellowbird</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../images/yellowbird-logo.webp">
    <link rel="icon" type="image/png" href="../images/yellowbird-logo.webp" sizes="32x32">
    <link rel="icon" type="image/png" href="../images/yellowbird-logo.webp" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body style="background-color: #eee;">
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-xl-6">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="../images/yellowbird-logo.webp" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">We are The Yellowbird Team</h4>


                                    </div>
                                    <div id="message">
                                        <?php if (!empty($_SESSION['alert'])) {
                                            echo $_SESSION['alert'];
                                        } ?>
                                    </div>

                                    <form name="login" class="login" id="login" method="post" action="login-action.php">
                                        <p>Please login to your Admin Panel</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Username</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Email address" />

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" />

                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">

                                            <input class="btn btn-primary btn-block mb-3" type="submit" name="submit"
                                                value="Log in">

                                        </div>



                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 20000);
</script>

</html>
<?php
$db->close();
$_SESSION['alert'] = '0';
?>