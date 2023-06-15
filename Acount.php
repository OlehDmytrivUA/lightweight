<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: Log-in.php");
}else{
  if(!isset($_POST["update"])){
  $hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "lightweight";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

// Витягування даних з таблиці measurements за полем user_id
$selectMeasurementsSql = "SELECT * FROM measurements WHERE user_id = ?";
$stmt = mysqli_stmt_init($conn);
$prepareStmt = mysqli_stmt_prepare($stmt, $selectMeasurementsSql);
if ($prepareStmt) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["user"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $measurements = mysqli_fetch_assoc($result);

    // Запис значень в окремі змінні
    $biceps = $measurements['biceps'];
    $forearms = $measurements['forearms'];
    $chest = $measurements['chest'];
    $waist = $measurements['waist'];
    $thighs = $measurements['thighs'];
    $calves = $measurements['calves'];
    $weight = $measurements['weight'];
    $height = $measurements['height'];
    $squat = $measurements['squat'];
    $bench_press = $measurements['bench_press'];
    $dead_lift = $measurements['dead_lift'];
}
}

}

if(isset($_POST["update"])){
  $biceps = $_POST['biceps'];
  $forearms = $_POST['forearms'];
  $chest = $_POST['chest'];
  $waist = $_POST['waist'];
  $thighs = $_POST['thighs'];
  $calves = $_POST['calves'];
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $squat = $_POST['squat'];
  $bench_press = $_POST['bench_press'];
  $dead_lift = $_POST['dead_lift'];

  $hostName = "localhost";
  $dbUser = "root";
  $dbPassword = "";
  $dbName = "lightweight";
  $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
  if (!$conn) {
      die("Something went wrong;");
  }
  $updateMeasurementsSql = "UPDATE measurements SET biceps = ?, forearms = ?, chest = ?, waist = ?, thighs = ?, calves = ?, weight = ?, height = ?, squat = ?, bench_press = ?, dead_lift = ? WHERE user_id = ?";
  $stmt = mysqli_stmt_init($conn);
  $prepareStmt = mysqli_stmt_prepare($stmt, $updateMeasurementsSql);
  if ($prepareStmt) {
      mysqli_stmt_bind_param($stmt, "iiiiiiiiiiii", $biceps, $forearms, $chest, $waist, $thighs, $calves, $weight, $height, $squat, $bench_press, $dead_lift, $_SESSION["user"]);
      mysqli_stmt_execute($stmt);
      echo "<div class='alert alert-success'>Measurements updated successfully.</div>";
  } else {
      die("Something went wrong");
  }
}
$userId = $_SESSION["user"]; 

// Підключення до бази даних
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "lightweight";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

// Отримання ім'я та прізвище користувача
$sql = "SELECT name, surname FROM users WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$surname = $row['surname'];

mysqli_close($conn);
?>







<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== Logo ===============-->
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
    <link rel="stylesheet" href="assets/css/Acount.css" />

    <title>Light Weight</title>
  </head>
  <body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
      <nav class="nav conteiner">
        <a href="index.html" class="nav__logo"
          ><img src="assets/img/logo-nav.png" alt="logo" />Light Weight
        </a>

        <div class="nav__link">
          <a href="Log-out.php" class="button nav__button"> Log-out</i></a>
        </div>
      </nav>
    </header>
    
    <!--==================== Main body ====================-->
    <form action="Acount.php" method="post">
    <section class="Day section" id="Day1">
      <div class="container">
        <div class="section__data">
        <h2 class="section__title">Hi <?php echo $name . " " . $surname; ?></h2>
          <h1 class="section__subtitle">Body Measurements <i class="ri-pencil-ruler-line"></i></h1>
        </div>
        
        <div class="exercise__container grid">
          <article class="exercise__card">
              

            <h3 class="exercise__title">Biceps</h3>
            <input type="number" placeholder="cm" name="biceps" class="Measurements" value="<?php echo $biceps; ?>">
          </article>

          <article class="exercise__card">
            

            <h3 class="exercise__title">Forearms</h3>

            <input type="number" placeholder="cm" name="forearms" class="Measurements" value="<?php echo $forearms; ?>">
          </article>

          <article class="exercise__card">
             

            <h3 class="exercise__title">Chest</h3>

            <input type="number" placeholder="cm" name="chest" class="Measurements" value="<?php echo $chest; ?>">

          </article>

          <article class="exercise__card">
              
         

            <h3 class="exercise__title">Waist</h3>

            <input type="number" placeholder="cm" name="waist" class="Measurements" value="<?php echo $waist; ?>">

          </article>
        </div>
      </div>
        
        <div class="exercise__container grid">
          <article class="exercise__card">
             

            <h3 class="exercise__title">Thighs</h3>

            <input type="number" placeholder="cm" name="thighs" class="Measurements" value="<?php echo $thighs; ?>">
          </article>

          <article class="exercise__card">
              

            <h3 class="exercise__title">Calves</h3>

            <input type="number" placeholder="cm" name="calves" class="Measurements" value="<?php echo $calves; ?>">

          </article>

          <article class="exercise__card">


            <h3 class="exercise__title">Height</h3>

            <input type="number" placeholder="cm" name="height" class="Measurements" value="<?php echo $height; ?>">

          </article>

          <article class="exercise__card">
              

            <h3 class="exercise__title" >Weight</h3>

            <input type="number" placeholder="kg" name="weight" class="Measurements" value="<?php echo $weight; ?>">
          </article>
        </div>
        
      </div>
      
    </section>

    <section class="Day section" id="Day1">
      <div class="container">
        <div class="section__data">
          <h2 class="section__subtitle"></h2>
          <h1 class="section__subtitle">Basic exercises <i class="ri-walk-line"></i></h1>
        </div>

        <div class="exercise__container grid">
          <article class="exercise__card">
              

            <h3 class="exercise__title">Squat</h3>
            <input type="number" placeholder="kg" name="squat" class="Measurements" value="<?php echo $squat; ?>">
          </article>

          <article class="exercise__card">
            

            <h3 class="exercise__title">Bench Press</h3>

            <input type="number" placeholder="kg" name="bench_press" class="Measurements" value="<?php echo $bench_press; ?>">
          </article>

          <article class="exercise__card">
             

            <h3 class="exercise__title">Dead Lift</h3>

            <input type="number" placeholder="kg" name="dead_lift" class="Measurements" value="<?php echo $dead_lift; ?>">

          </article>
          <input type="submit" class="button button__flex" value="update" name="update">
        </div>
      </div>
    </section>
    </form>

    

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

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
  </body>
</html>
