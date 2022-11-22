
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ooplogin";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['rating_value'])) {



  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }



  $rating_value = $_POST['rating_value'];
  $userName = $_POST['userName'];
  $userMessage = $_POST['userMessage'];
  $now = time();
  $prod_id = $_POST['prod_id'];
  $prod_slug = $_POST['prod_slug'];

  $sql = "INSERT INTO reviews (name, rating, message, datetime,prod_id,prod_slug)
VALUES ('$userName', '$rating_value', '$userMessage', '$now','$prod_id','$prod_slug')";





  if (mysqli_query($conn, $sql)) {
    echo "New Review Added Successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}



if (isset($_POST['action'])) {
  $avgRatings = 0;
  $avgUserRatings = 0;
  $totalReviews = 0;
  $totalRatings5 = 0;
  $totalRatings4 = 0;
  $totalRatings3 = 0;
  $totalRatings2 = 0;
  $totalRatings1 = 0;
  $ratingsList = array();
  $totalRatings_avg = 0;
  //$sql = "SELECT * FROM reviews ORDER BY id DESC";
  // "SELECT c.id as cid, c.prod_id, c.prod_qty, c.size, p.id as pid, p.name, p.image, p.price FROM carts c, products p
  // WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC ";


  $sql = "SELECT reviews.prod_id,reviews.name,reviews.rating,reviews.message,reviews.datetime,reviews.prod_slug, products.id, products.slug  FROM reviews,products WHERE reviews.prod_id=products.id AND reviews.prod_slug=products.slug ORDER BY reviews.id DESC";
  $result = mysqli_query($conn, $sql);


  while ($row = mysqli_fetch_assoc($result)) {


    $ratingsList[] = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'rating' => $row['rating'],
      'message' => $row['message'],
      'datetime' => date('l jS \of F Y h:i:s A', $row['datetime']),
      'prod_id' => $row['prod_id'],


    );
    if ($row['rating'] == '5') {
      $totalRatings5++;
    }
    if ($row['rating'] == '4') {
      $totalRatings4++;
    }
    if ($row['rating'] == '3') {
      $totalRatings3++;
    }
    if ($row['rating'] == '2') {
      $totalRatings2++;
    }
    if ($row['rating'] == '1') {
      $totalRatings1++;
    }
    $totalReviews++;
    $totalRatings_avg = $totalRatings_avg + intval($row['rating']);
  }

  $avgUserRatings = $totalRatings_avg / $totalReviews;

  $output = array(
    'avgUserRatings' => number_format($avgUserRatings, 1),
    'totalReviews' => $totalReviews,
    'totalRatings5' => $totalRatings5,
    'totalRatings4' => $totalRatings4,
    'totalRatings3' => $totalRatings3,
    'totalRatings2' => $totalRatings2,
    'totalRatings1' => $totalRatings1,
    'ratingsList' => $ratingsList
  );

  echo json_encode($output);
}



?>
