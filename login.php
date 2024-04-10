<?php

require "db.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"]) || empty($_POST["password"])) {
    $error = "Please all fields";
  } elseif (!str_contains($_POST["email"], "@")) {
    $error = "Email format is incorrect. Try again";
  }else{
    $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $statement -> bindParam(":email", $_POST["email"]);
    $statement -> execute();  

    if ($statement->rowCount() == 0) {
      $error = "Invalid credentials. Try again";
    } else {
      $user = $statement->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($_POST["password"], $user["password"])) {
        $error = "Invalid credentials. Try again";
      } else {
        session_start();

        unset($user["password"]);

        $_SESSION["user"] = $user;
        
        header("Location: home.php");
      }
    }
  }
}

?>

<?php require "includes/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Log In</div>
        <div class="card-body">
          <?php if ($error) : ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form action="login.php" method="POST">

            <div class="mb-3 row">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="password" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "includes/footer.php" ?>
