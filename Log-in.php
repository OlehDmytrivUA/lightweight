<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: Acount.php");
}
?>
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
      <link rel="stylesheet" href="assets/css/Log-in.css" />

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
                <form action="Log-in.php" method="post" class="log-in__form" id="log-in-form">
                <h2 class="home__subtitle">Log-in</h2>

                <?php
                if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $hostName = "localhost";
                $dbUser = "root";
                $dbPassword = "";
                $dbName = "lightweight";
                $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
                if (!$conn) {
                    die("Something went wrong;");
                }

                $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    session_start();
                    $_SESSION["user"] = $user["user_id"];
                    header("Location: Acount.php");
                    die();
                }else{
                echo "<div class='alert alert-danger'>Email or password does not match, try again</div>";
                }
                }
                ?>

                  <div class="log-in__box">
                    <input
                      type="text"
                      placeholder="Email"
                      class="email__input"
                      id="email-input"
                      name="email"
                    />
                  </div>
      
                  <div class="log-in__box">
                    <input
                      type="text"
                      placeholder="Password"
                      class="password__input"
                      id="password-input"
                      name="password"
                    />
                  </div>
                  <input type="submit" class="button button__flex" value="log-in" name="login">
                  <p class="sing-up__description"> <a href="Sing-up.php" class="sing-up">Sing-up</a> <br> if you don`t have an acount</p>
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
      <script src="assets/js/main.js"></script>
    </body>
  </html>
