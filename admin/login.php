<?php 
//Jalankan dulu session
session_start();

//jika sudah login maka masuk ke tampil.php
if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
  } 

//buat koneksi terlebihdahlu
include 'koneksi.php';

//kondisi jika tombol login di tekan user

if (isset($_POST["login"])) {
    
  $username = $_POST["username"];
  $password = $_POST["password"];


  $result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

// cek username
  if (mysqli_num_rows($result) === 1) {
    
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])){
      
//SET SESSION
  $_SESSION["login"]=true;

      header("location:index.php");
    exit;
  }

  } 

  $error = true;

}

 ?>

<!DOCTYPE html>
<html>
<head>
  <title>FORM LOGIN</title>
  
</head>

<body>

  <?php if( isset($error)): ?>
    <p> username / Password Anda Salah, Silahkan Coba Lagi..!</p>
  <?php endif; ?>

  
  <div class="form_login">
        <p id="judul_login"> Login </p>
        
        <form action="" method="post">
            <label for="username">Username</label><br>
            <input class="username" type="text" name="username" placeholder="Isi Username"><br><br>
            <label for="passsword">Password </label><br>
            <input class="username" type="password" name="password" placeholder="Isi Password"><br><br>
            
            <input class="submit" type="submit" name="login" value="Login"><br>
        
        </form>
        
        <div id="under_login">Belum mempunyai akun? Silahkan <a href="register.php">Registrasi</a>
            </div>
    </div>
    <style media="screen">
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        body{
            background: #c2c4c2;
        }
        .form_login{
            width: 30%;
            height: 400px;
            background: white;
            margin: 5% auto;  
            text-align: center;
}
        form{
            padding: 20px;
        }
        #judul_login{
            width: 100%;
            height: 40px;
            background: #50a8a9;
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 23px;
            margin-bottom: 30px;
        }
        
        .username{
            width: 350px;
            height: 35px;
        }
        .username:focus{
            font-size: 20px;
            background: #dfdfdf;
        }
        .submit{
            width: 350px;
            height: 40px;
            background: #49af49;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: white;
        }
        .submit:hover{
            background: #41b741;
        }
        #under_login{
            padding: 20px;
            
        }
        .error{
            color: red;
        }
        a{
            width: 80px;
            height: 40px;
            background: #50a8a9;
            text-decoration: none;
            padding: 5px;
            color: white;
            font-size:14px;
            border-radius: 3px;
        }
    </style>
</body>
</html>