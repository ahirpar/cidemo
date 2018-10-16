<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }

            #myInput {
                background-image: url('https://www.w3schools.com/css/searchicon.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
                width: 100%;
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                border: 1px solid #ddd;
                margin-bottom: 12px;
            }

            #myTable {
                border-collapse: collapse;
                width: 100%;
                border: 1px solid #ddd;
                font-size: 18px;
            }

            #myTable th, #myTable td {
                text-align: left;
                padding: 12px;
            }

            #myTable tr {
                border-bottom: 1px solid #ddd;
            }

            #myTable tr.header, #myTable tr:hover {
                background-color: #f1f1f1;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->

    </head>
    <body>

        <div class="col-sm-5">

            <form action="<?php echo base_url(); ?>prod_cat/insert" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="varName">Category Name</label>
                    <input type="text" class="form-control" name="varName" id="varName" required="">
                </div>
                <input type="hidden" id="eid" name="eid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm-5" style="text-align:center">
            <h5>Category Lists</h5>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

            <table id="myTable">
                <tr class="header">
                    <th style="width:70%;">Name</th>
                    <th style="width:15%;">Edit</th>
                    <th style="width:15%;">Delete</th>
                </tr>
                <?php foreach ($getProdData as $row) { ?>
                    <tr id="datas<?php echo $row['int_id']; ?>">
                        <td><?php echo $row['varName']; ?></td>
                        <td><a href="javascript:;" style="text-decoration: none;" onclick="return getEditData(<?php echo $row['int_id']; ?>)">Edit</a></td>
                        <td><a href="javascript:;" style="text-decoration: none;" onclick="return deleteData(<?php echo $row['int_id']; ?>)">Delete</a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </body>
</html>

<script>
    function deleteData(id) {
        document.getElementById("datas"+id).style.display = "none";
        $.ajax({
            url: '<?php echo base_url(); ?>prod_cat/delete',
            data: ({int_id: id}),
            type: 'post',
            success: function (data) {
            }
        });
    }
    function getEditData(id) {
        $.ajax({
            url: '<?php echo base_url(); ?>prod_cat/getEditData',
            data: ({int_id: id}),
            type: 'post',
            success: function (data) {
                response = jQuery.parseJSON(data);
                document.getElementById("varName").value = response.varName
                document.getElementById("eid").value = response.int_id
            }
        });
    }
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>