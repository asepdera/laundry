<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/icon.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="formWrapper">
        <div class="gambar">
            <img src="<?= base_url() ?>assets/gambar/jeremy-sallee-lgrM1t4rxWQ-unsplash.jpg" alt="">
        </div>
        <form action="<?= site_url('prosesLogin') ?>" method="post">
            <div class="judul">
                <h2>Login</h2>
            </div>
            <div class="inputBox">
                <input type="text" name="user" autocomplete="off" onfocus="pokus(this)" required onblur="tidakPokus(this)">
                <span label="Username"></span>
            </div>
            <div class="inputBox">
                <input type="password" name="pass" onfocus="pokus(this)" onblur="tidakPokus(this)" required>
                <span label="Password"></span>
            </div>
            <input type="submit" value="Login" class="btnSubmit">
        </form>
    </div>
    <!-- <script src="<?= base_url() ?>assets/js/jquery.js"></script> -->
    <script>
        const pokus = (elment) => {
            elment.classList.add('focus')
        }
        const tidakPokus = (elment) => {
            if (elment.value == '')
                elment.classList.remove('focus')
        }
    </script>
    <!-- <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script> -->
</body>

</html>