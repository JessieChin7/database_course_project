<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-dark ">
<main class="flex-shrink-0">
    <!-- <div class="jumbotron text-center">
    <h1>IMDB Database System</h1>
    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing
    responsive, mobile-first projects on the web.</p> -->
<header class="bg-dark py-3">
            <div class="container px-12">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-center">
                            <h1 class="display-5 fw-bolder text-white mb-2">IMDB Database System
                            </h1>
                            <p class="lead fw-normal text-white-50 mb-4">Provide quickly query, insert, delete and update actions on IMDB database.
                                An effective and efficient Web interface for you. </p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-center">
                                <!-- <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Get Started</a> -->
                                <a class="btn btn-outline-light btn-lg px-4" href="https://www.imdb.com/interfaces/">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5"
                            src="https://dummyimage.com/600x400/343a40/6c757d" alt="..." /></div> -->
                </div>
            </div>
</header>

<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <div class="text-center">
            <h2 class="fw-bolder">Our team</h2>
            <p class="lead fw-normal text-muted mb-5">111-1 Database Management Group 13</p>
        </div>
        <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
            <div class="col mb-5 mb-5 mb-xl-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="assets/1.jpg" alt="..." />
                    <h5 class="fw-bolder">陳鵬仁</h5>
                    <div class="fst text-muted">數學三 B09201013</div>
                </div>
            </div>
            <div class="col mb-5 mb-5 mb-xl-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="assets/2.png" alt="..." />
                    <h5 class="fw-bolder">簡詩汶</h5>
                    <div class="fst text-muted">物理四 B08202005</div>
                </div>
            </div>
            <div class="col mb-5 mb-5 mb-sm-0">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="assets/3.png" alt="..." />
                    <h5 class="fw-bolder">秦孝媛</h5>
                    <div class="fst text-muted">心理四 B08207054</div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="text-center">
                    <img class="img-fluid rounded-circle mb-4 px-4" src="assets/4.png" alt="..." />
                    <h5 class="fw-bolder">韓潔明</h5>
                    <div class="fst text-muted">交換學生 T11101301</div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>
</body>
</html>
