<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <title>iDiscuss Forum</title>
  <style>
    body {
      background: black;
      min-height: 100vh; /* Ensures background covers full viewport */
      margin: 0;
      color: white; /* Ensures default text color is white */
    }
    .card {
      background-color: #121212; /* Dark card background */
      color: white; /* White text */
      box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2); /* White shadow */
      transition: transform 0.3s;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .bg-light {
      background-color: #222 !important; /* Light background changed to dark */
      color: white;
    }
    a {
      color: #00bcd4; /* Cyan links for contrast */
      text-decoration: none;
    }
    a:hover {
      color: #ff4081; /* Pink hover effect */
    }
  </style>
</head>

<body>
  <?php include 'partials/header.php'; ?>
  <?php include 'partials/dbconnect.php'; ?>
  <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $catname = $row['category_name'];
      $catdesc = $row['category_description'];
    }
  ?>

  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $th_title = $_POST['title'];
      $th_desc = $_POST['desc'];
      $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
              VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
              <strong>Success!</strong> Your discussion has been posted.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
  ?>

  <div class="container my-4">
    <div class="row">
      <div class="col-md-8">
        <div class="bg-light p-4 rounded shadow">
          <h1 class="display-5">Welcome to <?php echo $catname; ?> Forum!</h1>
          <p class="lead"> <?php echo $catdesc; ?> </p>
        </div>
      </div>
      
    </div>
  </div>

  <div class="container my-3">
    <h2>Start a Discussion</h2>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Describe Your Problem</label>
        <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <div class="container">
    <h2>Browse Questions</h2>
    <?php
      $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
      $result = mysqli_query($conn, $sql);
      $noResult = true;
      while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        echo '<div class="card my-3 shadow">
                <div class="card-body">
                  <h5 class="card-title"><a href="thread.php?threadid=' . $row['thread_id'] . '">' . $row['thread_title'] . '</a></h5>
                  <p class="card-text">' . $row['thread_desc'] . '</p>
                </div>
              </div>';
      }
      if ($noResult) {
        echo '<div class="alert alert-warning text-center">No discussions yet. Be the first to start one!</div>';
      }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
