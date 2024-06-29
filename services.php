<!--Design a main page listing all available services.
Use a card-list view to display each service's name and a brief description.
Implement functionality to:
Fetch all service data from the tbl_services table upon page load.
Display each service in a visually appealing card format.-->

<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header('Location: index.php');
    exit;
}

include 'dbconnect.php';
$sqlloadservices = "SELECT * FROM tbl_services";
$stmt = $conn->prepare($sqlloadservices);
$stmt->execute();
$results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$results_per_pages = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_pages;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlloadservices);
$stmt->execute();

$number_of_results = $stmt->rowCount();
$number_of_pages = ceil($number_of_results / $results_per_pages);
$sqlloadservices = $sqlloadservices . " LIMIT " . $page_first_result . ',' . $results_per_pages;
$stmt = $conn->prepare($sqlloadservices);
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matthew H's Clinic User Page</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .service-card:hover {
            background-color: #f8f9fa;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);

            transition: background-color 0.3s, box-shadow 0.3s;
        }
    </style>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="main.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4 ms-4">Matthew H's Clinic</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="main.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="services.php" class="nav-link active" aria-current="page">Services</a></li>
            <li class="nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#modal1" class="nav-link">About</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
    </header>
    <div class="container">
        <div class="col-md-12">
            <div>
                <h2>Services</h2>
                <p>View all of the services that are provided by Matthew H's Clinic.</p>
                <P>Click on any service to learn more.</P>

                <div class="row">
                    <?php foreach ($rows as $row) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3 service-card" data-bs-toggle="modal" data-bs-target="#serviceModal<?php echo $row['service_id']; ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title"><?php echo $row['service_name']; ?></h5>
                                            <p class="card-text"><?php echo $row['service_short_description']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Matthew H's Clinic © 2024</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This web app is a demo system owned by Matthew H's Clinic.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($rows as $row) { ?>
        <div class="modal fade" id="serviceModal<?php echo $row['service_id']; ?>" tabindex="-1" aria-labelledby="serviceModalLabel<?php echo $row['service_id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceModalLabel<?php echo $row['service_id']; ?>"><?php echo $row['service_name']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="card-img-top mb-2" src="assets/img/private/<?php echo $row['service_image_location']; ?>" alt="Service Image">
                        <p><b>Description:</b> <?php echo $row['service_description']; ?></p>
                        <p><b>Price: </b>RM <?php echo $row['service_price']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
