<?php include_once 'includes/dbh.inc.php';?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>


<body class="bg-light">
<section class="py-3">
<div class="container px-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../database_project/index.php">Home</a></li>
            <li class="breadcrumb-item">Title Akas</li>
            <li class="breadcrumb-item active" aria-current="page">Query</li>
        </ol>
    </nav>
    
    <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Search by Original Name</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="original Name" name='searchName' placeholder="Enter original Name">
                            <label for="original Name">Original Name</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='submitName' id="submitButton" type="submit">Search</button></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Search by Title Id</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title Id" name='searchId' placeholder="Enter title Id">
                            <label for="title Id">Title Id</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='submitId' id="submitButton" type="submit">Search</button></div>
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

<?php
if (isset($_GET['submitName'])){
    $like = trim($_GET['searchName']);
    $sql = "select * from title_akas where title like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>titleId</th>';
        echo '<th>ordering</th>';
        echo '<th>title</th>';
        echo '<th>region</th>';
        echo '<th>isOriginalTitle</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$row['titleId'].'</td>';
            echo '<td>'.$row['ordering'].'</td>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['region'].'</td>';
            echo '<td>'.$row['isOriginalTitle'].'</td>';
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
if (isset($_GET['submitId'])){
    $like = trim($_GET['searchId']);
    $sql = "select * from title_akas where titleId like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>titleId</th>';
            echo '<th>ordering</th>';
            echo '<th>title</th>';
            echo '<th>region</th>';
            echo '<th>isOriginalTitle</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'.$row['titleId'].'</td>';
                echo '<td>'.$row['ordering'].'</td>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['region'].'</td>';
                echo '<td>'.$row['isOriginalTitle'].'</td>';
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
    $sql = 'select * from title_akas;';
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck>0){
        echo '<table class="table table-striped table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>titleId</th>';
            echo '<th>ordering</th>';
            echo '<th>title</th>';
            echo '<th>region</th>';
            echo '<th>isOriginalTitle</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                echo '<td>'.$row['titleId'].'</td>';
                echo '<td>'.$row['ordering'].'</td>';
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['region'].'</td>';
                echo '<td>'.$row['isOriginalTitle'].'</td>';
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

?>
</div>
</section>
</body>
</html>