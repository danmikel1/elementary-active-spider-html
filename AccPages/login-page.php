<?php
include('../config/connectDb.php');
$email = $password = '';
$errors = array('email'=>'', 'password'=>'');

if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $errors['email'] = 'E-mail is required! <br />';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'E-mail must be a valid email address';
        }
    }

    if(empty($_POST['password'])){
        $errors['password'] = 'Password is required! <br />';
    } else {
        $password = $_POST['password'];
        if(!preg_match('/^\S+$/', $password)){
            $errors['password'] = 'Password must not contain any spaces!';
        }
        if(strlen($password) < 8){
            $errors['password'] = 'Password must be at least 8 characters ';
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors['password'] = 'Password must contain at least one number';
        }
    }
    
    if(empty($errors['email']) && empty($errors['password'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT email, passWord, firstName FROM user_accounts WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
       
        if($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['passWord'])){
                session_start();
                $_SESSION['firstName'] = $row['firstName'];
                header('Location: ../index.php');
                exit();
            } else {
                $errors['password'] = 'Invalid e-mail or password';
            }
        } else {
            $errors['password'] = 'Invalid e-mail or password';;
        }
    } else {
        echo 'Error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login-Page - Elementary Active Spider</title>
    <meta property="og:title" content="Login-Page - Elementary Active Spider" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://unpkg.com/animate.css@4.1.1/animate.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/@teleporthq/teleport-custom-scripts/dist/style.css"
    />
  </head>
  <body>
    <link rel="stylesheet" href="../CSS/style.css" />
    <div>
      <link href="../CSS/login-page.css" rel="stylesheet" />

      <div class="login-page-container">
        <header data-role="Header" class="login-page-header">
          <a href="index.html" class="login-page-navlink Heading">Web Name</a>
          <div class="login-page-nav"></div>
          <div class="login-page-btn-group">
            <nav
              class="navigation-guest-nav navigation-guest-root-class-name13"
            >
              <a
                href="farms-guest.html"
                class="navigation-guest-navlink button"
              >
                <span>Farms</span>
              </a>
              <a
                href="products-guest.html"
                class="navigation-guest-navlink1 button"
              >
                <span>Products</span>
              </a>
            </nav>
            <a href="../AccPages/login-page.php" class="login-page-login button">Login</a>
            <a href="../AccPages/register-page.php" class="login-page-register button">
              Register
            </a>
          </div>
        </header>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
          <div class="row border rounded-5 p-3 bg-white shadow box-area">
              <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #90EE90;">
                  <div class="featured-image mb-3">
                      <img src="../img/1.png" class="img-fluid" style="width: 250px;">
                  </div>
                 <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Promote Products.</p>
                 <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Be one of our farmers on this platform.</small>
              </div> 
              <div class="col-md-6 right-box">
                  <form class="row align-items-center" method="post" action="login.php" autocomplete="off">
                      <div class="header-text mb-4">
                           <h2>Hello,Again</h2>
                           <p>We are happy to have you back.</p>
                      </div>
                      <div class="input-group mb-1">
                          <input type="text" class="form-control form-control-lg bg-light fs-6 rounded" name="email" value="<?php echo htmlspecialchars($email)?>" placeholder="Email address">
                      </div>
                      <div class="row">
                          <small class="text-red mb-2 " style=" color:red"><?php echo $errors['email'] ?></small>
                      </div>
                      <div class="input-group mb-1">
                          <input type="password" class="form-control form-control-lg bg-light fs-6 rounded" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password)?>">  
                      </div>
                      <div class="row">
                          <small class="text-red mb-2" style=" color:red"><?php echo $errors['password'] ?></small>
                          </div>
                      <div class="input-group mb-3">
                          <button class="btn btn-lg  w-100 fs-6" name="submit" style="background-color: #90EE90;">Login</button>
                      </div>
                      <div class="row">
                          <small style="color: blue;">Don't have account? <a href="./register-page.php">Sign Up</a></small>
                      </div>
                      </form>
              </div> 
          </div>
      </div>
      </div>
    </div>
     
    <script
      defer=""
      src="https://unpkg.com/@teleporthq/teleport-custom-scripts"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
