<?php

function check_login($con)
{

    if(isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: login.php");
    die;
}

// function make_avatar($character)
// {
//     $path = 'avatar/' . time() . '.png';

//     $image = imagecreate(200,200);

//     $red = rand(0,255);

//     $green = rand(0,255);

//     $blue = rand(0,255);

//     imagecolorallocate($image, $red, $green, $blue);

//     $textcolor =  imagecolorallocate($image, 255, 255, 255);

//     imagettftext($image, 100, 0, 55, 150, $textcolor, 'font/arial.ttf', $character);

//     header('content-type: image/png');

//     imgpng($image, $path);

//     imagedestroy($image);

//     return $path;
// }