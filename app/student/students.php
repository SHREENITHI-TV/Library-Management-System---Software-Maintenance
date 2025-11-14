<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<div class="container">
    <br>
    <h1>Student Accounts</h1>
    <input class="form-control" id="search_text" name="search_text" type="text" placeholder="Search..">
    <br>
    <a href="add-student.php" class="btn btn-primary btn-lg">Add Student</a>
    <br><br>
    <div id="result"></div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        function load_data(query = '') {
            $.ajax({
                url: "manage-student.php",
                method: "post",
                data: { query: query },
                success: function(data) {
                    $('#result').html(data);
                },
                error: function(xhr, status, err) {
                    $('#result').html(
                        '<div class="alert alert-danger">Error loading data: ' + err + '</div>'
                    );
                }
            });
        }

        // initial load
        load_data();

        // search
        $('#search_text').keyup(function() {
            const search = $(this).val();
            load_data(search);
        });
    });
</script>

<?php
include('../../format/footer.php');
?>
