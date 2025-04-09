<?php

function uploadImage($file, $pathName, $subFolder = '')
{
    $image = null;
    if (isset($file)) {
        $tmp_dir = $file['tmp_name'];
        $img_name = strtolower($file['name']);
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = explode('.', $img_name);
        $final_name = strtotime('now') . $file['name'];
        if (!is_dir($_SERVER['DOCUMENT_ROOT']) . $pathName . $subFolder) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . $pathName . $subFolder, 0777, true);
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . $pathName . $subFolder . '/' . $final_name;

        if (!in_array(end($ext), $extensions)) {
            echo 'Image Invalide';
            exit;
        }


        if (move_uploaded_file($tmp_dir, $path)) {
            $image = $final_name;
        } else {
            echo 'Erreur lors du téléchargement de l\'image';
            exit;
        }
    }

    return $image;
}

function removeOldImage($image, $oldImage, $pathName)
{
    if ($image == null) {
        $image = $oldImage;
    } elseif ($image !== $oldImage) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $pathName . $oldImage);
    }
}
