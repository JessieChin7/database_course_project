<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>

<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Professions</li>
            <li class="breadcrumb-item active" aria-current="page">Query</li>
        </ol>
    </nav>

    <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Search by Primary Name and Professions</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primary Name" name='search' placeholder="Enter primary Name">
                            <label for="primary Name">Primary Name</label>
                        </div>
                        <!-- <div class="d-grid"><button class="btn btn-primary btn-lg" name='submit' id="submitButton" type="submit">Search</button></div> -->
                        <div class="form mb-3" >
                            <select class="form-control form-select" name="profession">
                                <option>actor</option>
                                <option>animation_department</option>
                                <option>cinematographer</option>
                                <option>director</option>
                                <option>editor</option>
                                <option>producer</option>
                                <option>writer</option>
                            </select>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='submit' id="submitButton" type="submit">Search</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-5 justify-content-center py-3">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="d-grid"><button class="btn btn-info btn-lg" name='getall' id="submitButton" type="submit">Get All</button></div>
                </div>
            </div>
        </div>
    </form>
    </br>
    <!-- <form class="form-inline">
    <div class="form-group">
        <label class="control-label col-sm-4">Primary Name:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name='search' placeholder="Enter primary name">

            <select class="selectpicker" multiple title="Choose one of the following...">
                <option>actor</option>
                <option>animation_department</option>
                <option>cinematographer</option>
                <option>director</option>
                <option>editor</option>
                <option>producer</option>
                <option>writer</option>
            </select>

        </div>
    </div>
    </form> -->




<?php
if (isset($_GET['submit'])){
    $profession = $_GET['profession'];
    $like = trim($_GET['search']);
    $sql = "select * from {$profession} where primaryName like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>nconst</th>';
        echo '<th>primaryName</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$row['nconst'].'</td>';
            echo '<td>'.$row['primaryName'].'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

    } else {
        echo('
        <div class="alert alert-warning" role="alert">
            No matching results
        </div>
        ');
    }
}

if (isset($_GET['getall'])){
    $profession = $_GET['profession'];
    $sql = "select * from {$profession};";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>nconst</th>';
        echo '<th>primaryName</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$row['nconst'].'</td>';
            echo '<td>'.$row['primaryName'].'</td>';
            echo '</tr>';
        }
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    } else {
        echo('
        <div class="alert alert-warning" role="alert">
            No matching results
        </div>
        ');
    }
}

?>

</div>
</section>
</body>
</html>