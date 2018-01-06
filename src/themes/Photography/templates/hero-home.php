<?php /* Template Name: Hero Home */ ?>
<?php wp_enqueue_style( 
    'home' , 
    get_template_directory_uri() . '/assets/css/home.css' , 
    array('theme'), 
    filemtime(get_template_directory() . '/assets/css/home.css') 
    ); 
?>
<?php get_header(); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('http://lorempixel.com/1920/1096/nature/1/')">
                <div class="carousel-caption hero">
                    <div class="container pb-4 pb-lg-3">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-lg-3 text-center p-1">
                                <img src="assets/img/profile2.jpg" class="profile-img img-thumbnail rounded-circle"/>
                            </div>
                            <div class="col-sm-12 col-lg-6 photo-text p-1 d-none d-lg-block">
                                    Ut eu ante lacus. Vestibulum egestas blandit massa, sit amet pretium libero. Sed rhoncus orci vel viverra lacinia. Cras pharetra, odio in sagittis dignissim, dui nisi molestie orci, nec molestie diam libero sit amet est. Aliquam volutpat turpis duis.                                    
                            </div>
                            <div class="col-sm-12 col-lg-3 photo-text p-1">
                                    <b>NIKON D5500</b>
                                    <br />
                                    f/2.8 1/250 85mm ISO 1600
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('http://lorempixel.com/1920/1096/nature/2/')">
                <div class="carousel-caption hero">
                    <div class="container pb-4 pb-lg-3">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-lg-3 text-center p-1">
                                <img src="assets/img/profile2.jpg" class="profile-img img-thumbnail rounded-circle"/>
                            </div>
                            <div class="col-sm-12 col-lg-6 photo-text p-1 d-none d-lg-block">
                                    Ut eu ante lacus. Vestibulum egestas blandit massa, sit amet pretium libero. Sed rhoncus orci vel viverra lacinia. Cras pharetra, odio in sagittis dignissim, dui nisi molestie orci, nec molestie diam libero sit amet est. Aliquam volutpat turpis duis.                                    
                            </div>
                            <div class="col-sm-12 col-lg-3 photo-text p-1">
                                    <b>NIKON D5500</b>
                                    <br />
                                    f/2.8 1/250 85mm ISO 1600
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item portrait" style="background-image: url('http://lorempixel.com/1096/1920/nature/3/')">
                <div class="carousel-caption hero">
                    <div class="container pb-4 pb-lg-3">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-lg-3 text-center p-1">
                                <img src="assets/img/profile.png" class="profile-img img-thumbnail rounded-circle"/>
                            </div>
                            <div class="col-sm-12 col-lg-6 photo-text p-1 d-none d-lg-block">
                                    Ut eu ante lacus. Vestibulum egestas blandit massa, sit amet pretium libero. Sed rhoncus orci vel viverra lacinia. Cras pharetra, odio in sagittis dignissim, dui nisi molestie orci, nec molestie diam libero sit amet est. Aliquam volutpat turpis duis.                                    
                            </div>
                            <div class="col-sm-12 col-lg-3 photo-text p-1">
                                    <b>NIKON D5500</b>
                                    <br />
                                    f/2.8 1/250 85mm ISO 1600
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>  
<?php get_footer(); ?>