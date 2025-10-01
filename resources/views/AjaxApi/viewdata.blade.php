<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>State Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">
        <!-- Add State Form -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Add Student</h1>
                    </div>
                    <form id="form" enctype="multipart/form-data" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="card-title">Student Details</h5>

                                    <div class="form-group row mb-3">
                                        <label class="col-lg-3 col-form-label">Student Name</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter student name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-3 col-form-label">Email</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-lg-3 col-form-label">City</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="city"
                                                placeholder="Enter city" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Student List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="result">

                                <!-- More rows can be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            loadTableData();
            function loadTableData() {
            $.ajax({
                method: 'GET',
                url: 'http://localhost/laravelajaxapi/viewdataApi.php',
                success: function(response) {
                    console.log(response.data);
                    var result = response.data;
                    var op = "";
                    var sno = '1';
                    $.each(result, function(index, row) {
                        op += "<tr>";
                        op += "<td>" + sno++ + "</td>";
                        op += "<td>" + row.name + "</td>";
                        op += "<td>" + row.email + "</td>";
                        op += "<td>" + row.city + "</td>";
                        op += "<td>" + "edit" + "</td>";
                        op += "<td>" + "delete" + "</td>";
                        op += "<tr>";
                    });
                    $("#result").html(op);
                },
                error: function(error) {
                    console.log('error is:', error);
                }
            });
        }

            $('#form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: 'http://localhost/laravelajaxapi/adddata.php',
                    data: formData,
                    success: function(response) {
                        console.log("add data:",response);
                            if (response.status === "true") {
                            alert("User added successfully!");
                            $("#form")[0].reset();
                            loadTableData();
                        } else { 
                            alert("Failed to add user.");
                        }
                    },
                    error: function(error) {
                        console.error("Error adding user:", error);
                    }
                });
            });
        });
    </script>

</body>

</html>
