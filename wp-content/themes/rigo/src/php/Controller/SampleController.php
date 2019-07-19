<?php
namespace Rigo\Controller;

use Rigo\Types\Course;
use Rigo\Types\Book;

class SampleController{

    public function getHomeData(){
        return [
            'name' => 'Rigoberto'
        ];
    }

    public function getDraftCourses(){
        $query = Course::all([ 'status' => 'draft' ]);
        return $query->posts;
    }

        public function getDraftBooks(){
        // $query = Book::all([ 'status' => 'draft' ]);
        // return $query->posts;
                $query = Book::all();
                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post();
                        //Include the Meta Tags and Values
                        $query->post->meta_keys = get_post_meta($query->post->ID);
                        // $query->post->image = wp_get_attachment_image_src(get_field("image",$query->post->ID))[0];
                    }
                }
                return $query->posts;
            }

        public function createBook($data){
            $message = "thanks for submitting "+$data["name"];
            return $message;
    }

}
?>