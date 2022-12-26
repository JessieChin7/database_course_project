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
            <li class="breadcrumb-item active" aria-current="page">Delete</li>
        </ol>

        <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Search by Title Id and Ordering</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tconst" name='tconst' placeholder="Enter Title Id">
                            <label for="tconst">Title Id</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="ordering" name='ordering' placeholder="Enter Ordering">
                            <label for="ordering">Ordering</label>
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
    $ordering = trim($_GET['ordering']);
    $sql = "select * from title_akas where (titleId like '%{$like}%' and ordering='{$ordering}');";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck==1){
        $row = mysqli_fetch_assoc($result);
        $tconst = $row['titleId'];
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
        echo '<tr>';
        echo '<td>'.$row['titleId'].'</td>';
        echo '<td>'.$row['ordering'].'</td>';
        echo '<td>'.$row['title'].'</td>';
        echo '<td>'.$row['region'].'</td>';
        echo '<td>'.$row['isOriginalTitle'].'</td>';
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
    } else{
        echo "No matching results";
    }
}

if (isset($_GET['delete'])){
    try{
        $col = trim($_GET['delete_tconst']);
        $sql = "delete from title_akas where titleId='{$col}';";
        mysqli_query($conn, $sql);
        echo "successfully delete a row from title_akas";
    } catch (Exception $e){
        echo $e;
    }
} 
?>
</div>
</body>
</html>