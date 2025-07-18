<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>LupusConnect - Categories</title>
    <style>
      body {
        background: url('Images/backgroundLUpusconnect.jpg');
        background-size: cover;
        animation: moveBackground 20s linear infinite;
      }
      @keyframes moveBackground {
        0% { background-position: 0% 0%; }
        50% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
      }
      .card {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
      }
      .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
      }
      .btn-primary {
        transition: background 0.3s, transform 0.2s;
      }
      .btn-primary:hover {
        background: #ff758c;
        transform: scale(1.1);
      }
      .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInAnimation 0.8s ease-out forwards;
      }
      .footer {
        background: black;
        color: white;
        padding: 15px;
        text-align: center;
        width: 100%;
        
        bottom: 0;
        left: 0;
      }
      @keyframes fadeInAnimation {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body>
    <?php include 'partials/header.php';?>
    <?php include 'partials/dbconnect.php';?>

    <div class="container my-3">
    <h1 class="text-white fade-in">Lupus Care Community</h1>
    <p class="text-white fade-in">Your go-to space for sharing experiences, asking questions, and finding support in your lupus journey..</p>
      <!-- <h3 class=" text-white fade-in">Browse Categories</h3> -->
      <div class="row">
        <?php
          $category_images = [
              'Technology' => 'Images/LupusSymptoms.jpeg',
              'Health' => 'Images/LupusHcqs.jpeg',
              'Education' => 'Images/LupusSymptoms.jpeg',
              'Science' => 'Images/LupusSymptoms.jpeg',
          ];

         
          
          $sql = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            
            $image_url = isset($category_images[$cat]) ? $category_images[$cat] :" ";

          
            
            echo '<div class="col-md-4 fade-in">
                    <div class="card my-2" style="width: 18rem;">
               
                      <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.'" class="text-white">'.$cat.'</a></h5>
                        <p class="card-text">'.$desc.'</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View dicussions</a>
                      </div>
                    </div>
                  </div>';
          }
        ?>
      </div>
    </div>

    <footer class="footer">
      &copy; 2025 LupusChat. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
