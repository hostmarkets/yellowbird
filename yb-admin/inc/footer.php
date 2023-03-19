<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#featuredImage').change(function () {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(jpg|jpeg|png|PNG|webp)$");
            if (!(regex.test(val))) {
                $(this).val('');
                alert('Please select correct file format ( jpg|jpeg|png|PNG|webp )');
            }
        });
    });
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<!-- Tags Input -->
<script src="js/bootstrap-tagsinput.js"></script>
<script>
    $(document).ready(function () {
        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#postContent').summernote({
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact',
                'Tahoma', 'Times New Roman', 'Verdana', 'Roboto', 'Montserrat'
            ],
            fontNamesIgnoreCheck: ['Montserrat'],
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 20000);
</script>

<script>
    $("#permaLink").keyup(function () {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^\/a-zA-Z0-9]+/g, '-');
        $("#permaLink").val(Text);
    });
</script>

<?php if (!isset($_GET['action'])) { ?>
    <script>
        $("#postTitle").keyup(function () {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\/a-zA-Z0-9]+/g, '-');
            $("#permaLink").val(Text);
        });
    </script>
<?php } ?>

<!-- add new category -->
<script>
    $(document).ready(function () {
        $('.btn-newcategory').click(function (e) {
            e.preventDefault();
            var newcategory = $('#newcategory').val();
            if (newcategory == '') {
                $('#newcategory').val("");
                $('#newcategory').focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "jquery-ajax-post.php",
                    data: "newcategory=" + newcategory,
                    success: function (data) {
                        if (data == "Category already exists") {
                            $("#exists").html(data);
                            $("#exists").show();
                        } else {
                            $("#thanks").html(data);
                            $("#ends").hide();
                            $("#exists").hide();
                            $('#newcategory').val("");
                        }
                    }
                });
            }
            return false;
        });
    });
</script>

<!-- add new author -->
<script>
    $(document).ready(function () {
        $('.btn-newautho').click(function (e) {
            e.preventDefault();
            var newautho = $('#newautho').val();
            if (newcategory == '') {
                $('#newautho').val("");
                $('#newautho').focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "jquery-ajax-post.php",
                    data: "newautho=" + newautho,
                    success: function (data) {
                        if (data == "Author already exists") {
                            $("#autho_exists").html(data);
                            $("#autho_exists").show();
                        } else {
                            $("#autho_thanks").html(data);
                            $("#autho_ends").hide();
                            $("#autho_exists").hide();
                            $('#newautho').val("");
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
</body>

</html>
<?php
$db->close();
$_SESSION['alert'] = "0";