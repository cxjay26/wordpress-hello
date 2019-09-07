<?php
namespace Rigo\Controller;

use Rigo\Types\Course;
use Rigo\Types\Book;
use Rigo\Types\Location;
use Rigo\Types\Comment;


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
    // public function createCommentss($data){
    //     $post_arr = array(
    //         "post_title" => $data["post_title"],
    //         "post_content" => $data["post_content"],
    //         "post_type" => "location",
    //         "post_status" => "publish",
    //         "post_author" => get_current_user_id(),
    //         "meta_input" => array(
    //             "location_address" => $data["location_address"],
    //             "location_menu" => $data["location_menu"],
    //             "location_description" => $data["location_description"],
    //             "location_review" => $data["location_review"],
    //             "location_hours" => $data["location_hours"],
    //             "location_" => $data["location_"],
    //             "category" => $data["category"],
    //             "image_01" => $data["image_01"]
    //             ),

    //         );

    //    wp_insert_post($post_arr, $wp_error=true);

    //     return ["post added successfully"];
    // }

    public function createBook($data){
        $post_arr = array(
            "post_title" => $data["post_title"],
            "post_content" => $data["post_content"],
            "post_type" => "book",
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                "title" => $data["title"],
                "author" => $data["author"]
               // "product_price" => $data["product_price"],
                //"product_description" => $data["product_description"],
               // "category" => $data["category"],
              //  "image_01" => $data["image_01"]
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
            public function getDraftLocations(){
                // Define Arguments
                $args = array(
                    'post_type' => 'location',
                );
                // Run Query Using get_posts
                $posts = get_posts($args);
                // loop posts and expose acf fields
                foreach ($posts as $key => $post) {
                        $posts[$key]->acf = get_fields($post->ID);
                }
                return $posts;
            }
            public function getDraftComments(){
                // Define Arguments
                $args = array(
                    'post_type' => 'comment',
                    'numberposts' => -1
                );
                // Run Query Using get_posts
                $posts = get_posts($args);
                // loop posts and expose acf fields
                foreach ($posts as $key => $post) {
                        $posts[$key]->acf = get_fields($post->ID);
                }
                return $posts;
            }
            public function createComment($data){
                    $post_arr = array(
                        "post_title" => $data["post_title"],
                        "post_content" => "",
                        "post_type" => "comment",
                        "post_status" => "publish",
                        "post_author" => get_current_user_id(),
                    );
                    $post = wp_insert_post($post_arr, $wp_error=true);

                    $comment=$data["comment"];
                    $bar_id=$data["bar_id"];
                    update_field("comment",$comment,$post);
                    update_field("bar_id",$bar_id,$post);
                    return ["post added successfully"];
                }
            public function getDraftUsers(){
                // Define Arguments
                $args = array(
                    'post_type' => 'user',
                );
                // Run Query Using get_posts
                $posts = get_posts($args);
                // loop posts and expose acf fields
                foreach ($posts as $key => $post) {
                        $posts[$key]->acf = get_fields($post->ID);
                }
                return $posts;
            }
}
?>