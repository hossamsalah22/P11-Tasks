<?php

class uploadImage
{
    private $image;
    private $directory;
    private const maxUploadSize = 10 ** 6;
    private const allowedExtensions = ['png', 'jpg', 'jpeg'];

    function __construct($image,$directory)
    {
        $this->image = $image;
        $this->directory = $directory;
    }

    public function sizeValidation()
    {
        $errors = [];
        if ($this->image['size'] > self::maxUploadSize) {
            $errors['imageSize'] = "<div class= 'alert alert-danger'> Image Size Too Large, Max Size is: " . self::maxUploadSize / (10 ** 6) . " MB</div>";
        }
        return $errors;
    }

    public function getExtension()
    {
        return pathinfo($this->image['name'], PATHINFO_EXTENSION);
    }

    public function extensionValidation()
    {
        $errors = [];
        $imageExtension = $this->getExtension();
        if (!in_array($imageExtension, self::allowedExtensions)) {
            $msg = "<div class= 'alert alert-danger'> Image Extension not allowed, Allowed Extensions : ";
            foreach (self::allowedExtensions as  $value) {
                $msg .= $value . ' , ';
            }
            $msg .= "</div>";
            $errors['imageExtension'] = $msg;
        }
        return $errors;
    }

    public function uploadPhoto()
    {
        $photoName = time() . '-' . $_SESSION['user']->id . '.' . $this->getExtension();
        $fullPath = $this->directory . $photoName;
        $movePhoto = move_uploaded_file($this->image['tmp_name'], $fullPath);
        return $movePhoto ? $photoName : FALSE;
    }
}
