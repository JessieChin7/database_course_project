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
            <li class="breadcrumb-item active" aria-current="page">Delete</li>
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
                    <div class="d-grid"><button class="btn btn-primary btn-lg" name='submit' id="submitButton" type="submit">Search</button></div>
                </div>
            </div>
        </div>
    </div>
    </form>
</br>
<?php
if (isset($_GET['submit'])){
    $like = trim($_GET['tconst']);
    $sql = "select * from title where tconst like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck==1){
        $row = mysqli_fetch_assoc($result);
        $tconst = $row['tconst'];
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
        echo '</tbody>';
        echo '</table>';
        echo ('
        <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8 ">
                <div class="card mb-5 mb-xl-0 bg-dark">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-white mb-0">Delete this row with boxs below?</p>
                        </div>
                        <div class="form mb-3" >
                            <select class="form-control form-select" name="delete_tconst" readonly>
                                <option>'.$tconst.'</option>
                            </select>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name="delete" id="submitButton" type="submit">Delete</button></div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        ');
    
    }else if ($resultCheck>1){
        echo "**Please Enter a specific tconst to continue**"."<br>";
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
}

if (isset($_GET['delete'])){
    try{
        $col = trim($_GET['delete_tconst']);
        $sql = "delete from title where tconst='{$col}';";
        mysqli_query($conn, $sql);
        echo "successfully delete a row from title";
    } catch (Exception $e){
        echo $e;
    }
} 
?>
</div>
</section>
</body>
</html>