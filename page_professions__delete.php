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
            <li class="breadcrumb-item active" aria-current="page">Delete</li>
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
                            <input type="text" class="form-control" id="nconst" name='searchId' placeholder="Enter nconst">
                            <label for="nconst">nconst</label>
                        </div>
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
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='submitId' id="submitButton" type="submit">Search</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </br>


<?php
if (isset($_GET['submitId'])){
    $like = trim($_GET['searchId']);
    $profession = $_GET['profession'];
    $sql = "select * from {$profession} where nconst like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck==1){
        $row = mysqli_fetch_assoc($result);
        $nconst = $row['nconst'];
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>nconst</th>';
        echo '<th>primaryName</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>'.$row['nconst'].'</td>';
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
                            <select class="form-control form-select" name="delete_const" readonly>
                                <option>'.$nconst.'</option>
                            </select>
                        </div>
                        <div class="form mb-3" >
                            <select class="form-control form-select" name="delete_table" readonly>
                                <option>'.$profession.'</option>
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
        echo('
        <div class="alert alert-warning" role="alert">
        Please Enter a specific nconst to continue
        </div>
        ');
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
    }   else{
        echo "No matching results";
    }
}

if (isset($_GET['delete'])){
    try{
        $d_profession = trim($_GET['delete_table']);
        $col = trim($_GET['delete_const']);
        $sql = "delete from {$d_profession} where nconst='{$col}';";
        mysqli_query($conn, $sql);
        echo('
        <div class="alert alert-success" role="alert">
            successfully delete a row from '.$d_profession.'
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