<?php

require_once 'classes/register.php';
$re = new Register();

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register = $re->UpdateStudent($_POST, $_FILES,$id);
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
            <div class="col-md-7">
                <div class="card shadow">

                    <?php
                    if (isset($register)) {
                        ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>
                                <?= $register ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Update student</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-info float-right">Show student info</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $getStd = $re->getStdyId($id);
                        if ($getStd) {
                            while ($row = mysqli_fetch_assoc($getStd)) {
                                ?>

                                <form method="POST" enctype="multipart/form-data">
                                    <label for="">Name</label>
                                    <input type="text" placeholder="Enter your name" name="name" class="form-control"
                                        value="<?= $row['name']; ?>">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Enter your email" name="email" class="form-control"
                                        value="<?= $row['email']; ?>">
                                    <label for="">Phone</label>
                                    <input type="number" placeholder="Enter your number" name="phone" class="form-control"
                                        value="<?= $row['phone']; ?>">
                                    <label for="">Photo</label>
                                    <input type="file" placeholder="Enter your photo" name="photo" class="form-control">
                                    <img src="<?= $row['photo']; ?>" alt="" class="img-thumbnail" style="width:150px;">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control"><?= $row['address']; ?></textarea>
                                    <br>
                                    <input type="submit" value="Update Student" class="btn btn-success form-control">
                                </form>

                                <?php
                            }
                        }


                        ?>
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