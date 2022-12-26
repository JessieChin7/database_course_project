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
            <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                            <input type="text" class="form-control" id="tconst" name='titleId' placeholder="Enter Title Id">
                            <label for="tconst">Title Id</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="ordering" name='ordering' placeholder="Enter Ordering">
                            <label for="ordering">Ordering</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='check' id="submitButton" type="submit">Check</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</br>

<?php
// try to get the right titleId

if (isset($_GET['check'])){
    $like_titleId = trim($_GET['titleId']);
    $like_ordering = trim($_GET['ordering']);
    $sql = "select * from title_akas where (titleId like '%{$like_titleId}%' and ordering='{$like_ordering}');";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck>1){
        echo "**Please Enter a specific titleId to continue**"."<br>";
    }

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
            $titleId = $row['titleId'];
            $ordering = $row['ordering'];
            $title = $row['title'];
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
                            <input type="text" class="form-control" id="titleId" name="col1" placeholder="Enter Title Id" value = '.$titleId.' readonly>
                            <label for="titleId">Title Id</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="ordering" name="col2" placeholder="Enter Ordering" value = '.$ordering.' readonly>>
                            <label for="ordering">Ordering</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="col3" placeholder="Title">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="region" name="col4" placeholder="Region">
                            <label for="region">Region</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" max="1" min="0" step="1" id="isOriginalTitle" name="col5" placeholder="Enter is Original Title or not (1 or 0)">
                            <label for="isOriginalTitle">is Original Title</label>
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
        $sql = "update title_akas set title='{$col3}',region='{$col4}',isOriginalTitle={$col5} where titleId='{$col1}' and ordering='{$col2}';";
        mysqli_query($conn, $sql);
        echo "successfully update a row from title_akas";
    } catch (Exception $e){
        if (str_contains($e, 'FOREIGN KEY (`region`) ')){
            echo "<b>Update failed.</b> This region doesn't exists. Please insert the new region to the region(region) table first to continue.";
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