<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
</head>
<style>
  .price-paragraph {
    text-align: right;
    padding-top: 5px;
  }

  .img-fluid {
    width: 300px;
    height: 195px;
  }

  .card-title {
    margin-top: 10px;
    margin-bottom: -10px;
  }

  .card {
    width: 300px;
    height: 450px;
  }

  .card-footer {
    background-color: gainsboro;
  }

  .page-header {
    background-color: black;
    color: white;
    vertical-align: middle;
  }

  .jumbotron {
    margin-top: 25px;
  }
</style>

<body>
  <div class="container-fluid page-header">
    <div class="container page-header">
      <p style="text-align: left;display: inline;font-size: 20px;"><b>Hotels</b></p>
      <span style="float: right;">
        <p style="text-align: right;word-spacing: 30px;"><b>Home</b> About Services Contact</p>
      </span>
    </div>
  </div>

  <div class="jumbotron container text-center">
    <h1>Tokyo hotels</h1>
    <p>Book a hotel in Tokyo today!</p>
    <button type="button" class="btn btn-primary">Book a hotel</button>
  </div>

  <form action="tokyo-hotels.php" method="get">
  <div class="container">
    <?php
    $index = -1;
    if(isset($_GET["index"])){
      $index = $_GET["index"];
    }
    //Data about each hotel
    $images = array("asakusa-view-hotel.jpg", "hamacho-hotel-tokyo.jpg", "hilton-tokyo-hotel.jpg", "park-hotel-tokyo.jpg", "skinjuku-granbell-hotel.jpg");
    $titles = array("Asakusa View Hotel", "Hamacho Hotel Tokyo", "Hilton Tokyo Hotel", "Park Hotel Tokyo", "Shinjuku Granbell Hotel");
    $descriptons = array(
      "In addition to city and resort hotel booking, Asakusa View Hotel offers a wide variety of services such as wedding and event planning.",
      "Close to both long established famous stores and state of the art leisure spots, Tokyo's Nihonbashi Hamacho combines the elegance of Edo with a friendly downtown atmosphere.",
      "Offering free access to its indoor pool, sauna and fitness center, Hilton Tokyo Hotel overlooks Shinjuku Central Park and the Shinjuku Skyscraper District.",
      "Featuring stunning views of Tokyo and a convenient location just steps from Shiodome Subway Station, Park Hotel Tokyo offers stylish accommodations.",
      "Granbell Hotel offers modern and stylish guest rooms with unique design concepts.");
      
      //Creating a card for each hotel
      for($i = 0; $i < 5; $i++)
      {
        //If current card is first in the row (there are 3 cards in a row)
        if($i % 3 == 0)
        {
            echo '<div class="row text-center">';
        }

        echo '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="card">';
        echo '<img src="tokyo-hotels/', $images[$i], '" class="img-fluid" />';
        echo '<h5 class="card-title">', $titles[$i], '</h5>';
        echo '<div class="card-body">
        <p>';
        echo $descriptons[$i];
        echo '</p>
        </div>
        <div class="card-footer">
          <div class="button text-center">';
        echo '<button name="index" type="submit" value="', $i, '" class="btn btn-primary">';
        
        //If user pressed the Price button for this card
        if($i == $index)
        {
          $conn = new mysqli("localhost", "root", "", "hotels");
          $sql = "SELECT price FROM hotel WHERE id=" . $i;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $price = $row["price"];
            }
          } else {
            echo "0 results";
          }
          $conn->close();
          echo $price . "$";
        }
        
        //If user didn't press the Price button for this card
        else
        {
          echo 'Price';
        }

        echo '</button></div>
        </div>
        </div>
        </div>';

        //If current card is last in the row
        if($i % 3 == 2)
        {
           echo '</div></br></br>';
        }
      }
    ?>
  </div>
  </form>

</body>

</html>