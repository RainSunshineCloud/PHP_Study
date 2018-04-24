<?php
phpinfo();
// require './vendor/autoload.php';

// use Endroid\QrCode\ErrorCorrectionLevel;
// use Endroid\QrCode\LabelAlignment;
// use Endroid\QrCode\QrCode;
// use Endroid\QrCode\Response\QrCodeResponse;


// $qrCode = new QrCode('Life is too short to be generating QR codes');
// $qrCode->setSize(300);

// $qrCode->setWriterByName('png');
// $qrCode->setMargin(10);
// $qrCode->setEncoding('UTF-8');
// $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
// $qrCode->setForegroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
// $qrCode->setBackgroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
// $qrCode->setLabel('Scan the code', 16, './vendor/endroid/qrcode/assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
// $qrCode->setLogoPath('./vendor/endroid/qrcode/assets/images/symfony.png');
// $qrCode->setLogoWidth(150);
// $qrCode->setRoundBlockSize(true);
// $qrCode->setValidateResult(false);


// $qrCode->writeFile(__DIR__.'/qrcode.jpg');
// header('Content-Type: '.$qrCode->getContentType());
// echo $qrCode->writeString();