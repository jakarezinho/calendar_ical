<?php
function array_random($array, $amount = 1)
{
    $keys = array_rand($array, $amount);

    if ($amount == 1) {
        return $array[$keys];
    }

    $results = [];
    foreach ($keys as $key) {
        $results[] = $array[$key];
    }

    return $results;
}

function avatar_tipe($genre)
{
    $cor_cabelo = array_random(['Black', 'Blonde', 'Red', 'Auburn']);
    $camisa = array_random(['GraphicShirt', 'ShirtVNeck', 'Overall']);
    $oculos = array_random(['Kurt', 'Round', 'Wayfarers', 'Blank']);
    if ($genre == 'senhor') {
        $cabelo_m = array_random(['ShortHairShortFlat', 'ShortHairFrizzle', 'Eyepatch', 'ShortHairShortCurly']);
        $barba = array_random(['BeardLight', 'MoustacheFancy']);
        return 'https://avataaars.io/?avatarStyle=Circle&topType=' . $cabelo_m . '&accessoriesType=' . $oculos . '&hairColor=Banck&facialHairType=' . $barba . '&clotheType=ShirtVNeck&clotheColor=Gray01&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light';
    }elseif($genre == 'senhora')
    {
        $cabelo_w = array_random(['LongHairMiaWallace', 'LongHairStraight', 'LongHairFroBand', 'LongHairFrida']);
      return 'https://avataaars.io/?avatarStyle=Circle&topType=' . $cabelo_w . '&accessoriesType=' . $oculos . '&hairColor=' . $cor_cabelo . '&facialHairType=Blank&clotheType=' . $camisa . '&clotheColor=Gray01&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>whatsapp</title>
</head>
<style>
    body {
        text-align: center;
    }

    .avatar {
        width: 80px;
        height: 80px;
    }
</style>

<body>
    <h2>link whatsapp</h2>

    <p><a href="https://wa.me/351969467784?text=hello bem vindo  quero falar">call my</a></p>
    <p> homen<br> <img class="avatar" src='<?= avatar_tipe('senhor') ?>' /></p>
    <p> senhora<br><img class="avatar" src='<?= avatar_tipe('senhora'); ?>' />
        <p> homen<br><img class="avatar" src='<?= avatar_tipe('senhor') ?>' />'
</body>

</html>