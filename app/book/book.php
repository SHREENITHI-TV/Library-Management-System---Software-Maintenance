<?php
require_once __DIR__ . '/../../dbconnect.php';
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<div class="container">
    <br>
    <h1>Manage Books</h1>

    <input class="form-control" id="search_text" name="search_text" type="text" placeholder="Search..">
    <br>

    <a href="add-book.php" class="btn btn-primary btn-lg">Add Book</a>
    <br>
    <br>
    <div class="btn-group" role="group" aria-label="Tabs">
  <button type="button" id="tabActive" class="btn btn-primary btn-sm">Active</button>
  <button type="button" id="tabDeleted" class="btn btn-outline-primary btn-sm">Deleted</button>
</div>
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

        var currentTab = 'active'; // default

function updateTabButtons() {
    if (currentTab === 'active') {
        $('#tabActive').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#tabDeleted').removeClass('btn-primary').addClass('btn-outline-primary');
    } else {
        $('#tabDeleted').removeClass('btn-outline-primary').addClass('btn-primary');
        $('#tabActive').removeClass('btn-primary').addClass('btn-outline-primary');
    }
}

function load_data(query) {
    $.ajax({
        url: "manage-book.php",
        method: "post",
        data: {
            query: query,
            tab: currentTab
        },
        success: function(data) {
            $('#result').html(data);
        }
    });
}

$(document).ready(function() {
    // initial render
    updateTabButtons();
    load_data();

    // search box
    $('#search_text').keyup(function() {
        var search = $(this).val();
        if (search != '') {
            load_data(search);
        } else {
            load_data();
        }
    });

    // tab buttons
    $('#tabActive').on('click', function() {
        currentTab = 'active';
        updateTabButtons();
        load_data($('#search_text').val());
    });
    $('#tabDeleted').on('click', function() {
        currentTab = 'deleted';
        updateTabButtons();
        load_data($('#search_text').val());
    });
});


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

