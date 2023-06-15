<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== FAVICON ===============-->
    <link
      rel="shortcut icon"
      href="assets/img/logo-nav.png"
      type="image/x-icon"
    />

    <!--=============== REMIXICON ===============-->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/Sing-up.css" />

    <title>Light Weight</title>
  </head>
  <body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
      <nav class="nav conteiner">
        <a href="index.html" class="nav__logo"
          ><img src="assets/img/logo-nav.png" alt="logo" />Light Weight
        </a>
      </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
          <div class="home__container conteiner grid">
            <div class="home__data">
              <h2 class="home__subtitle">Sing-up</h2>
              <form action="Sing-up.php" method="post" class="Sing-up__form" id="Sing-up-form">

              <?php
                if(isset($_POST["sing-up"])){
                  $name = $_POST['name'];
                  $surname = $_POST['surname'];
                  $email = $_POST['email'];
                  $password = $_POST['password'];
              
                  $errors = array();
              
                  if(empty($name) OR empty($surname) OR empty($email) OR empty($password)){
                      array_push($errors,"Fill in all fields, please");
                  }
                  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                      array_push($errors,"Email is not valid");
                  }
              
                  $hostName = "localhost";
                  $dbUser = "root";
                  $dbPassword = "";
                  $dbName = "lightweight";
                  $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
                  if (!$conn) {
                      die("Something went wrong;");
                  }
              
                  $sql = "SELECT * FROM users WHERE email = '$email'";
                  $result = mysqli_query($conn, $sql);
                  $rowCount = mysqli_num_rows($result);
                  if ($rowCount > 0) {
                      array_push($errors,"Email already exists!");
                  }
              
                  if (count($errors) > 0) {
                      foreach ($errors as  $error) {
                          echo "<div class='alert alert-danger'>$error</div>";
                      }
                  } else {
                      // Insert user into 'users' table
                      $insertUserSql = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";
                      $stmt = mysqli_stmt_init($conn);
                      $prepareStmt = mysqli_stmt_prepare($stmt, $insertUserSql);
                      if ($prepareStmt) {
                          mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $password);
                          mysqli_stmt_execute($stmt);
                          echo "<div class='alert alert-success'>You are registered successfully.</div>";
              
                          // Get the user ID of the inserted user
                          $userId = mysqli_insert_id($conn);
              
                          // Insert default measurements for the user into 'measurements' table
                          $insertMeasurementsSql = "INSERT INTO measurements (user_id, biceps, 
                          forearms, chest, waist, thighs, calves, weight, height, squat, 
                          bench_press, dead_lift) VALUES (?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
                          $stmt = mysqli_stmt_init($conn);
                          $prepareStmt = mysqli_stmt_prepare($stmt, $insertMeasurementsSql);
                          if ($prepareStmt) {
                              mysqli_stmt_bind_param($stmt, "i", $userId);
                              mysqli_stmt_execute($stmt);
                          }
                          session_start();
                          $_SESSION["user"] = $userId;
                          header("Location: Acount.php");
                          die();
                      } else {
                          die("Something went wrong");
                      }
                  }
              }
              ?>


                <div class="Sing-up__box">
                    <input
                      type="text"
                      placeholder="Name"
                      class="name__input"
                      id="name-input"
                      name="name"
                    />
                  </div>

                  <div class="Sing-up__box">
                    <input
                      type="text"
                      placeholder="Surname"
                      class="surname__input"
                      id="surname-input"
                      name="surname"
                    />
                  </div>

                <div class="Sing-up__box">
                  <input
                    type="text"
                    placeholder="Email"
                    class="email__input"
                    id="email-input"
                    name="email"
                  />
                </div>
    
                <div class="Sing-up__box">
                  <input
                    type="text"   
                    placeholder="Password"
                    class="password__input"
                    id="password-input"
                    name="password"
                  />
                </div>
              <!--<a href="Log-in_or_create_acount.html" class="button button__flex" >
                  Sing-up </i>
                </a>-->
                <!--<input type="submit" class="button button__flex" value="Send" >-->
                <input type="submit" name="sing-up" class="button button__flex" value="Send" >
                <!--<button onclick="submitForm()" class="button button__flex">Send</button>-->
              </form>
            </div>
  
            
            
  
          </div>
        </section>

    <!--==================== FOOTER ====================-->
    <section class="footer">
      <div class="social">
        <a href="#"><i class="ri-instagram-line"></i></a>
        <a href="#"><i class="ri-twitter-line"></i></a>
        <a href="#"><i class="ri-facebook-line"></i></a>
        <a href="#"><i class="ri-tiktok-line"></i></a>
      </div>
      <p class="copyright">Light Weight @ 2023</p>
    </section>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="Assets/js/scrollreveal.min.js"></script>

    <!--=============== EMAIL JS ===============-->

    <!--=============== MAIN JS ===============-->
    <script src="Assets/js/main.js"></script>
  </body>
</html>
