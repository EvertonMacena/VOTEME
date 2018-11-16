<?php

namespace Fpin\Image;

class Cloudinary {

    const CLOUD_NAME = "dknfjrsyq";
    const API_KEY = 7166665385234651;
    const API_SECRET = "LtLa0mdIc_0wxdBazlxkrwObXWQ";
    const CLOUDINARY_URL="CLOUDINARY_URL=cloudinary://166665385234651:LtLa0mdIc_0wxdBazlxkrwObXWQ@dknfjrsyq";

    public function __construct(){

        \Cloudinary :: config ( array (
                                    " cloud_name " => Cloudinary::CLOUD_NAME ,
                                    " api_key " => Cloudinary::API_KEY ,
                                    " api_secret " => Cloudinary::API_SECRET
        ));

    }

    public function uploadPhoto($file){

        $response = \Cloudinary\Uploader::upload($file);

        return $response['url'];

    }

}