<!DOCTYPE html>
<html>
<head>
  <title>Login | Aplikasi Penggajian</title>
  <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/js/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="container">
  <div class="text-center">
    <div class="img">
      <img src="<?php echo base_url(); ?>assets/img/login1.svg" width="450" >
    </div>
    </div>
    <div class="login-content">
      <form class="user" method="POST" action="<?php echo base_url('welcome') ?>">
        <div class="text-center">
            <br>
        <h1 class="h4 text-gray-900 mb-4">APLIKASI PENGGAJIAN <br> <b>PT. GLORY OFFSET PRESS</b></h1>
        <?php echo $this->session->flashdata('pesan')?>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div" style="margin-left: 260px; width: 55%">
                 <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username..." name="username" required>
                 </div>
              </div>
              <br>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div" style="margin-left: 260px; width: 55%">
                 <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password..." name="password"  required>                     
                 </div>
                 <br>
              </div>
              <input type="submit" class="btn btn-info" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>
</html>
