<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Ratings</li>
            <li class="breadcrumb-item active" aria-current="page">Insert</li>
        </ol>
    </nav>

    <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Please input the following informations</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nconst" name='tconst' placeholder="Enter nconst">
                            <label for="nconst">nconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min='0' max='10' step='0.1' id="averageRating" name='averageRating' placeholder="Enter Average Rating">
                            <label for="averageRating">Average Rating</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min='0' step='1' id="numVotes" name='numVotes' placeholder="Enter Num Votes">
                            <label for="numVotes">Num Votes</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='Insert' id="submitButton" type="submit">Insert</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
if (isset($_GET['Insert'])){
    try{
        $col1 = trim($_GET['tconst']);
        $col2 = trim($_GET['averageRating']);
        $col3 = trim($_GET['numVotes']);
        $sql = "insert into ratings VALUES ('{$col1}',{$col2},{$col3});";
        $result = mysqli_query($conn, $sql);
        echo "successful insert a row into ratings";
    } catch (Exception $e){
        if (str_contains($e, 'Duplicate')){
            echo "<b>Insertion failed.</b> This region already exists.";
        } else if (str_contains($e, 'FOREIGN KEY (`tconst`)')){
            echo "<b>Insertion failed.</b> This tconst doesn't exists. Please insert the new tconst to the title table first to continue.";
        } else {
            echo $e;
        }
    }   
}
?>
</div>
</section>
</body>
</html>