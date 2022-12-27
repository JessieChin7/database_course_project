<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Title</li>
            <li class="breadcrumb-item active" aria-current="page">Insert</li>
        </ol>

        <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Please input the following informations</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tconst" name='tconst' placeholder="Enter tconst">
                            <label for="tconst">tconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="titleType" name='titleType' placeholder="Enter Title Type">
                            <label for="titleType">Title Type</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryTitle" name='primaryTitle' placeholder="Enter Primary Title">
                            <label for="primaryTitle">Primary Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="originalTitle" name='originalTitle' placeholder="Enter Original Title">
                            <label for="originalTitle">Original Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" max='1' min='0' step='1' id="isAdult" name='isAdult' placeholder="Enter is Adult or not(1 or 0)">
                            <label for="isAdult">is Adult</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min='0' step='1' id="startYear" name='startYear' placeholder="Enter Start Year">
                            <label for="startYear">Start Year</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="genres" name='genres' placeholder="Enter Genres">
                            <label for="genres">Genres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryName" name='primaryName' placeholder="Enter Primary Name">
                            <label for="primaryName">Primary Name</label>
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
        $col1 = trim($_GET['tconst']);
        $col2 = trim($_GET['titleType']);
        $col3 = trim($_GET['primaryTitle']);
        $col4 = trim($_GET['originalTitle']);
        $col5 = intval($_GET['isAdult']);
        $col6 = intval($_GET['startYear']);
        $col7 = trim($_GET['genres']);
        $col8 = trim($_GET['primaryName']);
        $sql = "INSERT INTO title VALUES ('{$col1}','{$col2}','{$col3}','{$col4}',{$col5},{$col6},'{$col7}','{$col8}');";
        $result = mysqli_query($conn, $sql);
        echo('
            <div class="alert alert-success" role="alert">
                successful insert a row into title
            </div>
        ');
    } catch (Exception $e){
        if (str_contains($e, 'Duplicate')){
            echo "<b>Insertion failed.</b> This tconst already exists.";
        } else if (str_contains($e, 'FOREIGN KEY (`primaryName`)')){
            echo "<b>Insertion failed.</b> This primaryName doesn't exists. Please insert the new primaryName to the name table first to continue.";
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