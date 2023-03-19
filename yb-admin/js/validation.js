$(document).ready(function () {
    $('#postTitle').on('input', function () {
        postTitle();
    });
    $('#metaTitle').on('input', function () {
        metaTitle();
    });
    $('#metaDesc').on('input', function () {
        metaDesc();
    });

    $('#publish').click(function () {


        if (!postTitle() && !metaTitle() && !metaDesc()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field.</div>`);
        } else if (!postTitle() || !metaTitle() || !metaDesc()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field.</div>`);
            console.log("er");
        } else {
            console.log("ok");
            $("#message").html("");
            var form = $('#newPost')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "post-action.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#publish').html('<i class="fa fa-solid fa-spinner fa-spin"></i>');
                    $('#publish').attr("disabled", true);
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#publish').html('Publish');
                        $('#publish').attr("disabled", false);
                    }, 200);
                }
            });
        }
        $('html, body').animate({
            scrollTop: $("#scrollTop").offset().top
        }, 100);
    });

    $('#update').click(function () {


        if (!postTitle() && !metaTitle() && !metaDesc()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field.</div>`);
        } else if (!postTitle() || !metaTitle() || !metaDesc()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field.</div>`);
            console.log("er");
        } else {
            console.log("ok");
            $("#message").html("");
            var form = $('#updatePost')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "post-update-action.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                beforeSend: function () {
                    $('#update').html('<i class="fa fa-solid fa-spinner fa-spin"></i>');
                    $('#update').attr("disabled", true);
                },

                success: function (data) {
                    $('#message').html(data);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#update').html('Update');
                        $('#update').attr("disabled", false);
                    }, 200);
                }
            });
        }
        $('html, body').animate({
            scrollTop: $("#scrollTop").offset().top
        }, 100);
    });
});


function postTitle() {
    var postTitle = $('#postTitle').val();
    if (postTitle == "") {
        $('#postTitleErr').html('required field');
        return false;
    } else {
        $('#postTitleErr').html('');
        return true;
    }
}

function metaTitle() {
    var metaTitle = $('#metaTitle').val();
    if (metaTitle == "") {
        $('#metaTitleErr').html('required field');
        return false;
    } else {
        $('#metaTitleErr').html('');
        return true;
    }
}

function metaDesc() {
    var metaDesc = $('#metaDesc').val();
    if (metaDesc == "") {
        $('#metaDescErr').html('required field');
        return false;
    } else {
        $('#metaDescErr').html('');
        return true;
    }
}