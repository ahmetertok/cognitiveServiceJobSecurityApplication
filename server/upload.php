<?php
header("Access-Control-Allow-Origin: *");
if (isset($_POST['image'])) {
  $data = $_POST['image'];
  $image = explode(',', $data)[1];
  $decodedImage = base64_decode($image);

  // Dosyayı sunucuda kaydet
  $fileName = uniqid() . '.jpg';
  file_put_contents('/var/www/html/images/' . $fileName, $decodedImage);

  // Dosya URL'sini döndür
  $fileUrl = 'http://13.70.197.37/images/' . $fileName;
  echo $fileUrl;
}
?>
