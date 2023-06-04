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
        <form method ="get">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <select name="sort_alphabet" class="form-select" >
                        <option disabled selected>Open this select menu</option>
                            <option value="a-z" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == 'a-z' ){echo "selected"; } ?>>A-Z(ascending order)</option>
                            <option value="z-a" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == 'z-a' ){echo "selected"; } ?>>Z-A(decending order)</option>
                            
                        </select>
                        <button type="submit" class="btn btn-primary" id="basic-addon2">Sort</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row d-flex justify-content-center g-4 destination-section">
            <?php

            $sort_option ="";
            if(isset($_GET['sort_alphabet'])){
                if($_GET['sort_alphabet'] == "a-z"){
                    $sort_option ="ASC";
                    
                }
                elseif($_GET['sort_alphabet'] == "z-a"){
                    $sort_option = "DESC";
                }

            }
            $sql = "SELECT * FROM `package` order by title $sort_option";
            $result = mysqli_query($con, $sql);
                
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-4 col-md-6 fadeffect">
                    <div class="package-card-beta">
                        <div class="package-thumb">
                            <a href="tour-details.php?id=<?php echo $row['id']; ?>">
                                <img src="admin/uploads/<?php echo $row['file']; ?>" alt="">
                            </a>
                            <p class="card-lavel">
                                <i class="bi bi-clock"></i> <span>
                                    <?php echo $row['days']; ?>
                                </span>
                            </p>
                        </div>
                        <div class="package-card-body">
                            <h3 class="p-card-title">
                                <a href="tour-details.php?id=<?php echo $row['id']; ?>">
                                    <?php echo $row['title']; ?>
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
       
    </div>
</div>

<?php
require_once 'footer.php';
?>
