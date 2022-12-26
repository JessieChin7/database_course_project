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
            <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='check' id="submitButton" type="submit">Check</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
<?php
// try to get the right nconst

if (isset($_GET['check'])){
    $like = trim($_GET['nconst']);
    $profession = $_GET['profession'];
    $sql = "select * from {$profession} where nconst like '%{$like}%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck>1){
        echo "**Please Enter a specific nconst to continue**"."<br>";
    }

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
            $nconst = $row['nconst'];
            echo '<tr>';
            echo '<td>'.$row['nconst'].'</td>';
            echo '<td>'.$row['primaryName'].'</td>';
            echo '</tr>';
        }
        echo '</tr>';
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
                            <input type="text" class="form-control" id="nconst" name="col1" placeholder="Enter nconst" value = '.$nconst .' readonly>
                            <label for="nconst">nconst</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="primaryName" name="col2" placeholder="Enter primaryName">
                            <label for="primaryName">Primary Name</label>
                        </div>
                        <div class="form mb-3" >
                            <select class="form-control form-select" name="profession_option" readonly>
                                <option>'.$profession.'</option>
                            </select>
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
        $profession = $_GET['profession_option'];
        $sql = "update {$profession} set primaryName='{$col2}' where nconst='{$col1}';";
        mysqli_query($conn, $sql);
        echo "successfully update a row from {$profession}";
    } catch (Exception $e){
        echo $e;
    }
}

?>
</div>
</section>
</body>
</html>