<?php

// ---------------------------------------------------------------------------------------------------------------------
// Here comes your script for loading from the database.
// ---------------------------------------------------------------------------------------------------------------------

$currentItem = "";
$reviewsNumber = [];

// Connection to database
$connection = mysqli_connect("localhost", "root", "", "craigs_database");
if (!$connection)  die("Connection failed: " . mysqli_connect_error());

mysqli_set_charset($connection, "utf8");

// Select all data from "items"
$queryData = mysqli_query( $connection, "SELECT * FROM items WHERE id = " . $_POST['id'] );
$data = mysqli_fetch_all( $queryData, MYSQLI_ASSOC );

/*
// Select all data from "gallery"
$queryGallery = mysqli_query( $connection, "SELECT image FROM gallery WHERE item_id = " . $_POST['id'] );
$gallery = mysqli_fetch_all( $queryGallery, MYSQLI_ASSOC );

// Select all data from "reviews"
$queryReviews = mysqli_query( $connection, "SELECT * FROM reviews WHERE item_id = " . $_POST['id'] );
$reviews = mysqli_fetch_all( $queryReviews, MYSQLI_ASSOC );
array_push( $reviewsNumber, count($reviews ) );
*/

$currentItem = $data[0];

mysqli_close($connection);

// End of example //////////////////////////////////////////////////////////////////////////////////////////////////////

// Infobox HTML code

echo
'<a href="'. $currentItem['url'] .'">';
    if( $currentItem['featured'] == 1 ){
        echo
            '<div class="ribbon-featured"><i class="fa fa-thumbs-up"></i></div>';
    }
    echo
    '<div class="infobox" data-id="'. $currentItem['id'] .'">
        <div class="image-wrapper">';
            if( !empty($currentItem['type']) ){
                echo
                '<div class="tag type">'. $currentItem['type'] .'</div>';
            }
            echo
            '<h3>';
                if( !empty($currentItem['category']) ){
                    echo
                        '<span class="tag category">'. $currentItem['category'] .'</span>';
                }
                if( !empty($currentItem['title']) ){
                    echo
                        '<span>'. $currentItem['title'] .'</span>';
                }
            echo
            '</h3>';

            if( !empty($currentItem['price']) ){
                echo
                    '<div class="price">';
                    if( !empty($currentItem['price_appendix']) ){
                        echo
                            '<span class="appendix">'. $currentItem['price_appendix'] .'</span>';
                    }
                    echo
                        '<span>$'. $currentItem['price'] .'</span>';
                echo
                '</div>';
            }

            if( !empty($currentItem["image"]) ){
                echo
                    '<div class="image" style="background-image: url('. $currentItem["image"] .')"></div>';
            }
            echo
            '</div>
        </div>
    </div>
</a>';

/*
'<div class="item infobox" data-id="'. $currentItem['id'] .'">
    <a href="'. $currentItem['url'] .'">
        <div class="description">';

            // Category ------------------------------------------------------------------------------------------------

            if( !empty($currentItem['category']) ){
                echo
                    '<div class="label label-default">'. $currentItem['category'] .'</div>';
            }

            // Title ---------------------------------------------------------------------------------------------------

            if( !empty($currentItem['title']) ){
                echo
                    '<h3>'. $currentItem['title'] .'</h3>';
            }

            // Location ------------------------------------------------------------------------------------------------

            if( !empty($currentItem['location']) ){
                echo
                    '<h4>'. $currentItem['location'] .'</h4>';
            }
            echo

        '</div>
        <!--end description-->';

        // Image thumbnail -------------------------------------------------------------------------

        if( !empty($currentItem["image"]) ){
            echo
            '<div class="image" style="background-image: url('. $currentItem["image"] .')"></div>';
        }
        else {
            echo
            '<div class="image" style="background-image: url(assets/img/items/default.png)"></div>';
        }

        echo
        '<!--end image-->
    </a>';
if( !empty( $currentItem['rating'] ) ){
    echo
    '<div class="rating-passive">';
        for($i=0; $i < 5; $i++){
            if( $i < $currentItem['rating'] ){
                echo '<span class="stars"><figure class="active fa fa-star"></figure></span>';
            }
            else {
                echo '<span class="stars"><figure class="fa fa-star"></figure></span>';
            }
        }
        echo
        '<span class="reviews">'. count($reviews) .'</span>
    </div>';
}
echo
    '<div class="controls-more">
        <ul>
            <li><a href="#">Add to favorites</a></li>
            <li><a href="#">Add to watchlist</a></li>
        </ul>
    </div>
    <!--end controls-more-->

</div>
<!--end item-->';
*/