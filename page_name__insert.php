<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Name</li>
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
                            <input type="text" class="form-control" id="nconst" name='nconst' placeholder="Enter nconst">
                            <label for="nconst">nconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryName" name='primaryName' placeholder="Enter primaryName">
                            <label for="primaryName">Primary Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="birthYear" name='birthYear' placeholder="Enter Birth Year">
                            <label for="birthYear">Birth Year</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="deathYear" name='deathYear' placeholder="Enter Death Year">
                            <label for="deathYear">Death Year</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="knownForTitles" name='knownForTitles' placeholder="Enter knownForTitles">
                            <label for="knownForTitles">Known For Titles</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='Insert' id="submitButton" type="submit">Insert</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php
if (isset($_GET['Insert'])){
    try{
        $col1 = trim($_GET['nconst']);
        $col2 = trim($_GET['primaryName']);
        $col3 = intval($_GET['birthYear']);
        $col4 = intval($_GET['deathYear']);
        $col5 = trim($_GET['knownForTitles']);
        $sql = "insert into name VALUES ('{$col1}','{$col2}',{$col3},{$col4},'{$col5}');";
        // echo "$sql";
        $result = mysqli_query($conn, $sql);
        // echo "$result";
        echo "successful insert a row into name";
    } catch (Exception $e){
        if (str_contains($e, 'Duplicate')){
            echo "<b>Insertion failed.</b> This nconst already exists.";
        } else if (str_contains($e, 'FOREIGN KEY (`knownForTitles`)')){
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