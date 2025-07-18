<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Discussion Thread</title>
    <style>
      body {
        background-color: #121212;
        color: white;
      }
      .thread-container {
        background: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.1);
      }
      .comment-box {
        background: rgba(0, 0, 0, 0.6);
        padding: 15px;
        border-radius: 8px;
      }
      .media img {
        border-radius: 50%;
      }
      .btn-primary {
        background-color: #007bff;
        border: none;
      }
      .btn-primary:hover {
        background-color: #0056b3;
      }
      .welcome-box {
        background: rgba(0, 0, 0, 0.8);
        padding: 20px;
        border-radius: 10px;
        text-align: left;
        width: 60%;
        margin: 20px 0;
      }
      .marquee {
        overflow: hidden;
        white-space: nowrap;
        display: block;
        width: 100%;
        color: #ffc107;
        font-size: 1.2rem;
      }
      .text-muted {
        color: white !important;
      }
      h2, .fw-bold {
        color: #007bff;
      }
    </style>
  </head>
  <body>
    <?php include 'partials/header.php'; ?>
    <?php include 'partials/dbconnect.php'; ?>

    <?php
      $id = $_GET['threadid'];
      $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
      }
    ?>

    <div class="container my-4">
      <div class="welcome-box">
        <h2> Welcome to <?php echo $title; ?> Forum!</h2>
        <p class="lead"> <?php echo $desc; ?> </p>
      </div>

      <div class="thread-container mt-4">
        <h2 class='mb-3'><i class="fas fa-comment-dots"></i> Start a discussion</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
          <div class="mb-3">
            <label for="comment" class="form-label">Type Your Comment</label>
            <textarea class="form-control text-white bg-dark" id="comment" name="comment" rows="3"></textarea>
            <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-paper-plane"></i> Post</button>
          </div>
        </form>
      </div>

      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $comment = $_POST['comment'];
          $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
                  VALUES ('$comment', '$id', '0', current_timestamp());";
          $result = mysqli_query($conn, $sql);
          echo '<div class="alert alert-success mt-3">Comment added successfully!</div>';
        }
      ?>

      <div class="thread-container mt-4">
        <h2><i class="fas fa-comments"></i> Comments</h2>
        <?php
          $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
          $result = mysqli_query($conn, $sql);
          $noResult = true;
          while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            echo '<div class="media my-3 comment-box">'
                . '<img src="Images/user.pn.png" width="54px" class="mr-3" alt="User">'
                . '<div class="media-body">'
                . '<p class="fw-bold my-0">Anonymous User <span class="text-muted">at ' . $comment_time . '</span></p>'
                . $content . '</div></div>';
          }
          if ($noResult) {
            echo '<div class="alert alert-primary">Be the first to comment!</div>';
          }
        ?>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
