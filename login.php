<?php
    include 'Components/header.php'
?>
<hr>
    <div class="login">
        <div class="container-login mx-auto ">
            <div class="d-flex wraper">
                <div class="w-1">
                    <img src="../assets/images/diet.jpg" class="img-fluid" alt="Ảnh mô tả">
                </div>
                <div class="w-2 p-3">
                    <form class="form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email-login">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Password:</label>
                            <input type="text" class="form-control" id="password-login">
                        </div>
                        <p class="mt-2">Don't have an account? <a href=""> Register here</a></p>
                        <button type="submit" class="btn btn-orange">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'Components/footer.php'
?>
<!-- </body>

</html> -->