<?php

include('../config/connectDb.php');

$email = $password = $firstname = $lastname = $confirmPassword = '';
$errors = array('email'=>'', 'password'=>'', 'firstname'=>'', 'lastname'=>'', 'confirmPass'=>'');

if(isset($_POST['submit'])){
    // Email validation
    if(empty($_POST['email'])){
        $errors['email'] = 'E-mail is required! <br />';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'E-mail must be a valid email address';
        }
    }

    // Password validation
    if(empty($_POST['password'])){
        $errors['password'] = 'Password is required! <br />';
    } else {
        $password = $_POST['password'];
        if(!preg_match('/^\S+$/', $password)){
            $errors['password'] = 'Password must not contain any spaces!';
        } 
        if(strlen($password) < 8){
            $errors['password'] = 'Password must be at least 8 characters long';
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors['password'] = 'Password must contain at least one number';
        }
        if ($password != $_POST['confirmPassword']) {
            $errors['confirmPass'] = 'Passwords do not match!';
        }
    }

    // First name validation
    if(empty($_POST['firstname'])){
        $errors['firstname'] = 'First name is required';
    } else {
        $firstname = $_POST['firstname'];
        if(!preg_match('/^[^0-9!@#$%^&*()_+=[\]{}|\\,.?: -]+$/', $firstname)){
            $errors['firstname'] = 'First name must not contain numbers and special characters';
        }
    }

    // Last name validation
    if(empty($_POST['lastname'])){
        $errors['lastname'] = 'Last name is required';
    } else {
        $lastname = $_POST['lastname'];
        if(!preg_match('/^[^0-9!@#$%^&*()_+=[\]{}|\\,.?: -]+$/', $lastname)){
            $errors['lastname'] = 'Last name must not contain numbers and special characters';
        }
    }

    if(empty($errors['email']) && empty($errors['password']) && empty($errors['firstname']) && empty($errors['lastname'])){
        // Check for duplicate email
        $query = "SELECT * FROM user_accounts WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){
            $errors['email'] = 'Email already exists';
        } else {
            // Insert the record
            $sql = "INSERT INTO user_accounts(email, passWord, firstName, lastName) VALUES(?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt, "ssss", $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['firstname'], $_POST['lastname']);
                if(mysqli_stmt_execute($stmt)){
                    header('Location: ./login-page.php');
                    exit(); // Exit to prevent further execution
                } else {
                    echo 'query error' . mysqli_stmt_error($stmt);
                }
            } else {
                echo 'query error' . mysqli_error($conn);
            }
        }
    } else {
         echo 'Error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register-Page - Elementary Active Spider</title>
    <meta
      property="og:title"
      content="Register-Page - Elementary Active Spider"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
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
      <link href="../CSS/register-page.css" rel="stylesheet" />

      <div class="register-page-container">
        <header data-role="Header" class="register-page-header">
          <a href="index.php" class="register-page-navlink Heading" style="text-decoration: none;">
            Web Name
          </a>
          <div class="register-page-nav"></div>
          <div class="register-page-btn-group">
            <nav
              class="navigation-guest-nav navigation-guest-root-class-name14"
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
            <a href="../AccPages/login-page.php" class="register-page-login button">
              Login
            </a>
            <a href="../AccPages/register-page.php" class="register-page-register button">
              Register
            </a>
          </div>
        </header>
        <div class="container d-flex justify-content-center align-items-center min-vh-100 w75">
          <div class="row border rounded-5 p-3 bg-white shadow box-area">
          <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #90EE90;">
              <div class="featured-image mb-3">
               <img src="../img/1.png" class="img-fluid" style="width: 250px;">
              </div>
              <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Promote Products.</p>
              <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Be one of our farmers on this platform.</small>
          </div> 
          <div class="col-md-6 right-box">
             <form class="row align-items-center" method="post" action="signUp.php">
                   <div class="header-text mb-2">
                        <h2>Hello!</h2>
                        <p>Sign Up to start promoting your products.</p>
                   </div>
                   <div class="input-group mb-1">
                       <input type="text" class="form-control form-control-lg bg-light fs-6 rounded" placeholder="First Name" name="firstname" autocomplete="off">
                   </div>
                   <div class="row">
                   <small class="text-red mb-2 " style=" color:red"><?php echo $errors['firstname'] ?></small>
                   </div>
                   <div class="input-group mb-1">
                       <input type="text" class="form-control form-control-lg bg-light fs-6 rounded" placeholder="Last Name" name="lastname">
                   </div>
                   <div class="row">
                   <small class="text-red mb-2 " style=" color:red"><?php echo $errors['lastname'] ?></small>
                   </div>
                   <div class="input-group mb-1">
                       <input type="text" class="form-control form-control-lg bg-light fs-6 rounded" placeholder="Email" name="email">
                   </div>
                   <div class="row">
                   <small class="text-red mb-2 " style=" color:red"><?php echo $errors['email'] ?></small>
                   </div>
                   <div class="input-group mb-1">
                       <input type="password" class="form-control form-control-lg bg-light fs-6 rounded" placeholder="Password" name="password">
                   </div>
                   <div class="row">
                   <small class="text-red mb-2 " style=" color:red"><?php echo $errors['password'] ?></small>
                   </div>
                   <div class="input-group mb-1">
                       <input type="password" class="form-control form-control-lg bg-light fs-6 rounded" placeholder="Confirm Password" name="confirmPassword">
                   </div>
                   <div class="row">
                   <small class="text-red mb-2 " style=" color:red"><?php echo $errors['confirmPass'] ?></small>
                   </div>
                   
                   <div class="input-group mb-3">
                       <button class="btn btn-lg w-100 fs-6" style="background-color: #90EE90;" name="submit" >Sign Up</button>
                   </div>
                   <div class="row">
                       <small><a href="./login-page.php" style="color: blue;">Already have an account?</a></small>
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
