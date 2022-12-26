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
            <li class="breadcrumb-item active" aria-current="page">Insert</li>
        </ol>

        <form class="form-inline">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card mb-5 mb-xl-0">
                    <div class="card-body p-5">
                        <div class="text-left mb-3">
                            <p class="lead fw-normal text-muted mb-0">Please input the following informations</p>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="titleId" name='titleId' placeholder="Enter Title Id">
                            <label for="titleId">Title Id</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="ordering" name='ordering' placeholder="Enter Ordering">
                            <label for="ordering">Ordering</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name='title' placeholder="Title">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="region" name='region' placeholder="Region">
                            <label for="region">Region</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" max='1' min='0' step='1' id="isOriginalTitle" name='isOriginalTitle' placeholder="Enter is Original Title or not (1 or 0)">
                            <label for="isOriginalTitle">is Original Title</label>
                        </div>
        
                        <div class="d-grid"><button class="btn btn-primary btn-lg" name='Insert' id="submitButton" type="submit">Insert</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</br>

<?php
if (isset($_GET['Insert'])){
    try{
        $col1 = trim($_GET['titleId']);
        $col2 = trim($_GET['ordering']);
        $col3 = trim($_GET['title']);
        $col4 = trim($_GET['region']);
        $col5 = intval($_GET['isOriginalTitle']);
        $sql = "INSERT INTO title_akas VALUES ('{$col1}','{$col2}','{$col3}','{$col4}',{$col5});";
        $result = mysqli_query($conn, $sql);
        echo "successful insert a row into title_akas";
    } catch (Exception $e){
        if (str_contains($e, 'Duplicate')){
            echo "<b>Insertion failed.</b> This titleId already exists.";
        } else if (str_contains($e, 'FOREIGN KEY (`titleId`)')){
            echo "<b>Insertion failed.</b> This titleId doesn't exists. Please insert the new titleId to the title(tconst) table first to continue.";
        } else if (str_contains($e, 'FOREIGN KEY (`region`)')){
            echo "<b>Insertion failed.</b> This region doesn't exists. Please insert the new region to the region table first to continue.";
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