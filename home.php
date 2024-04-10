<?php
require "db.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  return;
}

$contacts = $conn->query("SELECT * FROM contacts");

?>

<?php require "includes/header.php" ?>

<div class="container pt-4 p-3">
  <div class="row">

    <?php if ($contacts->rowCount() == 0) : ?>
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No contacts saved yet</p>
          <a href="add.php">Add One!</a>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($contacts as $contact) :
      $name = $contact["name"];
      $cell = $contact["phone_number"];
    ?>
      <div class="col-md-4 mb-3">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title text-capitalize"> <?= $name ?> </h3>
            <p class="m-2"><?= $cell ?></p>
            <a href="edit.php?id=<?= $contact["id"] ?>" class="btn btn-secondary mb-2">Edit Contact</a>
            <a href="delete.php?id=<?= $contact["id"] ?>" class="btn btn-danger mb-2">Delete Contact</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>

<?php require "includes/footer.php" ?>
