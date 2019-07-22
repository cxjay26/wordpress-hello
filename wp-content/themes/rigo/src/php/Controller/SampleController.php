<?php
namespace Rigo\Controller;

use Rigo\Types\Course;
use Rigo\Types\Book;
use Rigo\Types\Location;

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
    public function getDraftLocations(){
        $query = Location::all([ 'status' => 'draft' ]);
        return $query->posts;
    }
    public function createLocations($data){
        $post_arr = array(
            "post_title" => $data["post_title"],
            "post_content" => $data["post_content"],
            "post_type" => "location",
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                "location_address" => $data["location_address"],
                "location_menu" => $data["location_menu"],
                "location_description" => $data["location_description"],
                "location_review" => $data["location_review"],
                "location_hours" => $data["location_hours"],
                "location_" => $data["location_"],
                "category" => $data["category"],
                "image_01" => $data["image_01"]
                ),

            );

       wp_insert_post($post_arr, $wp_error=true);

        return ["post added successfully"];
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
                        // $query->post->image = get_field("image",$query->post->ID);
                    }
                }
                return $query->posts;
            }
}

?>