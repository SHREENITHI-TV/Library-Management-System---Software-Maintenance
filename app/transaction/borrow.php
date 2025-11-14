<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<div class="container">
    <br>
    <h1>Borrowed Books</h1>

    <input class="form-control" id="search_text" name="search_text" type="text" placeholder="Search..">
    <br>

    <a href="add-borrow.php" class="btn btn-primary btn-lg">Check Out</a>
    <br>
    <br>
    <div id="result">
        <table class="table table-bordered table-striped" id="table-data">

        </table>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        load_data();

        function load_data(query) {
            $.ajax({
                url: "manage-borrow.php",
                method: "post",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>
<?php
include('../../format/footer.php'); ?>