<?php

require_once 'header.php';
?>

<div class="breadcrumb breadcrumb-style-one">
    <div class="container">
        <div class="col-lg-12 text-center">
            <h2 class="breadcrumb-title">Destination</h2>
            <ul class="d-flex justify-content-center breadcrumb-items">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Destination</li>
            </ul>
        </div>
    </div>
</div>

<div class="guide-area guide-style-one pt-110 pb-110">
    <div class="container">
        <div class="row d-flex justify-content-center g-4 destination-section">
            <?php
            $limit = 3;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM `package` ORDER BY `id` DESC LIMIT {$offset},{$limit}";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-4 col-md-6 fadeffect">
                    <div class="package-card-beta">
                        <div class="package-thumb">
                            <a href="tour-details.php?id=<?php echo $row['id']; ?>"><img
                                    src="admin/uploads/<?php echo $row['file']; ?>" alt=""></a>
                            <p class="card-lavel">
                                <i class="bi bi-clock"></i> <span>
                                    <?php echo $row['days']; ?>
                                </span>
                            </p>
                        </div>
                        <div class="package-card-body">
                            <h3 class="p-card-title"><a href="tour-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
                        </div>
                    </div>
                </div>
            <?php } ?>




        </div>
        <div class="row">
            <div class="col-lg-12">
                <nav>
                    <?php
                    $paginationSql = "SELECT * FROM `package`";
                    $pagiResult = mysqli_query($con, $paginationSql);

                    if (mysqli_num_rows($pagiResult) > 0) {
                        $totalRecords = mysqli_num_rows($pagiResult);
                        // $limit = 6;
                        $totalPage = ceil($totalRecords / $limit);
                        echo '<ul class="pagination pagination-style-one justify-content-center pt-50">';
                        if($page >1){
                            echo '<li class="page-item page-arrow"><a class="page-link" href="destination.php?page='.($page -1).'"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>';
                        }
                        for ($i = 1; $i <= $totalPage; $i++) {
                            if ($i == $page) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }

                            echo ' <li class="page-item ' . $active . '"><a class="page-link" href="destination.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if($totalPage > $page){
                        echo '<li class="page-item page-arrow"><a class="page-link" href="destination.php?page='.($page + 1).'">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </a></li>';
                    }
                        echo "</ul>";
                    }
                    ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>