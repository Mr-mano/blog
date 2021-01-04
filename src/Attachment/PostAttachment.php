<?php
namespace App\Attachment;

use App\Model\Post;
use Intervention\Image\ImageManager;

class PostAttachment {

    const DIRECTORY = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts';

    public static function upload(Post $post)
    {
        $image = $post->getImage();
        //si champs vide ou si image que l'on ne modifie pas, on ne fait rien
        if (empty($image) || $post->shouldUpload() === false){
            return;
        }
        $directory = self::DIRECTORY;
        if(\file_exists($directory) === false){
            mkdir($directory, 0777, true);
        }
        //dd($post);
        if(!empty($post->getOldImage())){
            $formats = ['small', 'large'];
        foreach($formats as $format){
        $oldFile = $directory . DIRECTORY_SEPARATOR . $post->getOldImage() . '_' . $format;
            if (file_exists($oldFile)){
                unlink($oldFile);
            }
        }

        }
        $filename = uniqid("", true);
        //librairie image manager
        $manager = new ImageManager(['driver' => 'gd']);
        $manager
        ->make($image)
        ->resize(250, null, function ($constraint) {
            $constraint->aspectRatio();
        }) //redimentionne
        ->save($directory . DIRECTORY_SEPARATOR . $filename . '_small.jpg'); //sauvegarde
        $manager
        ->make($image)
        ->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        }) //redimentionne
        ->save($directory . DIRECTORY_SEPARATOR . $filename . '_large.jpg'); //sauvegarde
        //fin librairie 
        
        $post->setImage($filename);
    }

        public static function detach(Post $post) //suppression
        {
            if(!empty($post->getImage())){
                $formats = ['small', 'large'];
            foreach($formats as $format){
                $file = self::DIRECTORY . DIRECTORY_SEPARATOR . $post->getImage() . '_' . $format . '.jpg';
                    if (file_exists($file)){
                        unlink($file);
                    }
                }
            }
        }

}
