<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>sample app</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
</head>
<body>
  <p>
    <?php
    echo "sample app";
    ?>
  </p>
  <p>
    <?php
    date_default_timezone_set('Asia/Tokyo');
    echo date("Y/m/d H:i:s");
    ?>
  </p>
  <ul>
    <li>
      <?php
      if (file_exists("samplefile1.txt")){
      ?>
      <a id="download" href="./download.php">download</a>
      <?php
      } else {
      ?>
      download
      <?php
      }
      ?>
    </li>
    <li>
      upload
    </li>
  </ul>
  <p>
    <a href="./reset.php">reset</a>
  </p>

  <script>
    $('#download').on('click', function() {
      setInterval(function () {
        if ($.cookie("downloaded")) {
          $.removeCookie("downloaded", { path: "/" });
          window.location.href = '/test.php';
        }
      }, 1000);
    });
  </script>
</body>
</html>
