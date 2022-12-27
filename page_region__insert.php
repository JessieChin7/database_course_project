<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Region</li>
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
                            <input type="text" class="form-control" id="region" name='region' placeholder="Enter Region">
                            <label for="nconst">Region</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="regionName" name='regionName' placeholder="Enter Region Name">
                            <label for="regionName">Region Name</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='Insert' id="submitButton" type="submit">Insert</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </br>
<?php
if (isset($_GET['Insert'])){
    try{
        $col1 = trim($_GET['region']);
        $col2 = trim($_GET['regionName']);
        $sql = "insert into region VALUES ('{$col1}','{$col2}');";
        $result = mysqli_query($conn, $sql);
        echo('
        <div class="alert alert-success" role="alert">
            successful insert a row into region
        </div>
        ');
    } catch (Exception $e){
        if (str_contains($e, 'Duplicate')){
            echo "<b>Insertion failed.</b> This region already exists.";
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