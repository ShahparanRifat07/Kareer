<?php
session_start()
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #fcde67;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div class="container">

        <div class="card bg-dark mt-3 mb-3">
            <!-- Carousel wrapper -->
            <div id="carouselDarkVariant" class="carousel slide carousel-fade carousel-dark" data-mdb-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="1" aria-label="Slide 1"></button>
                    <button data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="2" aria-label="Slide 1"></button>
                </div>

                <!-- Inner -->
                <div class="carousel-inner">
                    <!-- Single item -->
                    <div class="carousel-item active">
                        <img height="400px" src="https://imgv3.fotor.com/images/homepage-feature-card/Fotor-AI-photo-enhancement-tool.jpg" class="d-block w-100" alt="Motorbike Smoke" />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                    </div>

                    <!-- Single item -->
                    <div class="carousel-item">
                        <img height="400px" src="https://www.befunky.com/images/prismic/2aa87dc8-3720-4385-9cc2-b8f9be5aac1d_landing-photo-to-art-img-4-before.png?auto=webp&format=jpg&width=863" class="d-block w-100" alt="Mountaintop" />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>

                    <!-- Single item -->
                    <div class="carousel-item">
                        <img height="400px" src="https://twilio-cms-prod.s3.amazonaws.com/original_images/django-dark.png" class="d-block w-100" alt="Woman Reading a Book" />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                    </div>
                </div>
                <!-- Inner -->

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselDarkVariant" data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselDarkVariant" data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- Carousel wrapper -->
        </div>

    </div>



    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>