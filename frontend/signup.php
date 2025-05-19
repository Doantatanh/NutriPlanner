<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head> -->

<?php
    include 'Components/header.php'
?>

<body>
    <div class="container-signup mx-auto ">
        <div class="d-flex wraper">
            <div class="w-1">
                <img src="../assets/images/diet.jpg" class="img-fluid" alt="Ảnh mô tả">
            </div>
            <div class="w-2 p-3">
                <form>
                    <div class="mb-3 d-flex">
                        <div class="col me-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="fname-signup">
                        </div>
                        <div class="col">
                            <label class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lname-signup">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email-signup">
                    </div>
                    <div class="mb-5 d-flex">
                        <div class="col me-3">
                            <label class="form-label">Passwork:</label>
                            <input type="text" class="form-control" id="passwork-signup">
                        </div>
                        <div class="col">
                            <label class="form-label">Comfirm Passwork:</label>
                            <input type="text" class="form-control" id="cpasswork">
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="col">
                            <button type="submit" class="btn btn-orange">Log In</button>
                        </div>
                        <div class="col">
                            <p class="mt-2">Already have an account?
                                <a href="">Log in here</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    include 'Components/footer.php'
?>

<!-- </body>

</html> -->