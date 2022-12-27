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
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
    </nav>
    <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <!-- <h1 class="fw-bolder">Search by Primary Name</h1> -->
                            <p class="lead fw-normal text-muted mb-0">Search by tconst</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tconst" name='tconst' placeholder="Enter tconst">
                            <label for="tconst">tconst</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='check' id="submitButton" type="submit">Check</button></div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
    </br>



<?php
// try to get the right nconst

if (isset($_GET['check'])){
    $like = trim($_GET['tconst']);
    $sql = "select * from ratings where tconst like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck>1){
        echo('
        <div class="alert alert-warning" role="alert">
        Please Enter a specific tconst to continue
        </div>
        ');
    }

    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>tconst</th>';
        echo '<th>averageRating</th>';
        echo '<th>numVotes</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)){
            $tconst = $row['tconst'];
            echo '<tr>';
            echo '<td>'.$row['tconst'].'</td>';
            echo '<td>'.$row['averageRating'].'</td>';
            echo '<td>'.$row['numVotes'].'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

    } else{
        echo('
        <div class="alert alert-warning" role="alert">
            No matching results
        </div>
        ');
    }
    if ($resultCheck==1){
        echo ('
        <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8 ">
                <div class="card mb-5 mb-xl-0 bg-dark">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-white mb-0">Please update this row with boxs below</p>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nconst" name="col1" placeholder="Enter tconst" value = '.$tconst.' readonly>
                            <label for="nconst">nconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min="0" max="10" step="0.1" id="averageRating" name="col2" placeholder="Enter Average Rating">
                            <label for="averageRating">Average Rating</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min="0" step="1" id="numVotes" name="col3" placeholder="Enter Num Votes">
                            <label for="numVotes">Num Votes</label>
                        </div>
                       
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name="update" id="submitButton" type="submit">Update</button></div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        ');
    }
}

// update process
if (isset($_GET['update'])){
    try{
        $col1 = trim($_GET['col1']);
        $col2 = floatval($_GET['col2']);
        $col3 = intval($_GET['col3']);
        $sql = "update ratings set averageRating={$col2},numVotes={$col3} where tconst='{$col1}';";
        mysqli_query($conn, $sql);
        echo('
        <div class="alert alert-success" role="alert">
            successful update a row from ratings
        </div>
        ');
    } catch (Exception $e){
        echo $e;
    }
}

?>
</div>
</section>
</body>
</html>