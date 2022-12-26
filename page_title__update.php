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
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>

    <form class="form-inline">
    <div class="row gx-5 justify-content-center">
        <div class="col-lg-12 col-xl-8">
            <div class="card mb-5 mb-xl-0">
                <div class="card-body p-5">
                    <div class="text-left mb-3">
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
// try to get the right tconst

if (isset($_GET['check'])){
    $like = trim($_GET['tconst']);
    $sql = "select * from title where tconst like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
   
    if ($resultCheck>1){
        echo "**Please Enter a specific tconst to continue**"."<br>";
    }

    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>tconst</th>';
        echo '<th>titleType</th>';
        echo '<th>primaryTitle</th>';
        echo '<th>originalTitle</th>';
        echo '<th>isAdult</th>';
        echo '<th>startYear</th>';
        echo '<th>genres</th>';
        echo '<th>primaryName</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)){
            $tconst = $row['tconst'];
            echo '<tr>';
            echo '<td>'.$row['tconst'].'</td>';
            echo '<td>'.$row['titleType'].'</td>';
            echo '<td>'.$row['primaryTitle'].'</td>';
            echo '<td>'.$row['originalTitle'].'</td>';
            echo '<td>'.$row['isAdult'].'</td>';
            echo '<td>'.$row['startYear'].'</td>';
            echo '<td>'.$row['genres'].'</td>';
            echo '<td>'.$row['primaryName'].'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else{
        echo "No matching results";
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
                            <input type="text" class="form-control" id="tconst" name="col1" placeholder="Enter tconst" value = '.$tconst.' readonly>
                            <label for="tconst">tconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="titleType" name="col2" placeholder="Enter Title Type">
                            <label for="titleType">Title Type</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryTitle" name="col3" placeholder="Enter Primary Title">
                            <label for="primaryTitle">Primary Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="originalTitle" name="col4" placeholder="Enter Original Title">
                            <label for="originalTitle">Original Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" max="1" min="0" step="1" id="isAdult" name="col5" placeholder="Enter is Adult or not(1 or 0)">
                            <label for="isAdult">is Adult</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" min="0" step="1" id="startYear" name="col6" placeholder="Enter Start Year">
                            <label for="startYear">Start Year</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="genres" name="col7" placeholder="Enter Genres">
                            <label for="genres">Genres</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryName" name="col8" placeholder="Enter Primary Name">
                            <label for="primaryName">Primary Name</label>
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
        $col2 = trim($_GET['col2']);
        $col3 = trim($_GET['col3']);
        $col4 = trim($_GET['col4']);
        $col5 = intval($_GET['col5']);
        $col6 = intval($_GET['col6']);
        $col7 = trim($_GET['col7']);
        $col8 = trim($_GET['col8']);
        $sql = "update title set titleType='{$col2}',primaryTitle='{$col3}',originalTitle='{$col4}',isAdult={$col5},startYear={$col6},genres='{$col7}',primaryName='{$col8}' where tconst='{$col1}';";
        mysqli_query($conn, $sql);
        echo "successfully update a row from title";
    } catch (Exception $e){
        if (str_contains($e, 'FOREIGN KEY (`primaryName`) ')){
            echo "<b>Update failed.</b> This primaryName doesn't exists. Please insert the new primaryName to the name(nconst) table first to continue.";
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