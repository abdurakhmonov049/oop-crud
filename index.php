<?php
require 'classes/register.php';
$re = new Register();

if (isset($_GET['delid'])) {
    $id = base64_decode($_GET['delid']);
    $delStudent = $re->delStudent($id);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">

                    <?php
                    if (isset($delStudent)) {
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>
                                <?= $delStudent ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>All students info</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="addstd.php" class="btn btn-info float-right">Add Student</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Photo</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $allstd = $re->allStudent();
                            if ($allstd) {
                                while ($row = mysqli_fetch_assoc($allstd)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row['name']; ?>
                                        </td>
                                        <td>
                                            <?= $row['email']; ?>
                                        </td>
                                        <td>
                                            <?= $row['phone']; ?>
                                        </td>
                                        <td><img style="width:100px;" src="<?= $row['photo']; ?>" alt=""></td>
                                        <td>
                                            <?= $row['address']; ?>
                                        </td>

                                        <td>
                                            <a href="edit.php?id=<?= base64_encode($row['id']); ?>"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="?delid=<?= base64_encode($row['id']); ?>" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sere to delete')">Delete</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }

                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>