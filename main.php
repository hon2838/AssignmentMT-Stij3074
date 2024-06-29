<?php
    session_start();
    if (!isset($_SESSION['email'])&&!isset($_SESSION['password'])) {
        header('Location: index.php');
        exit;
    }

    include 'dbconnect.php';
    $sqlloadpatients = "SELECT * FROM tbl_users";
    $stmt = $conn->prepare($sqlloadpatients);
    $stmt->execute();
    $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows=$stmt->fetchAll();

    if (isset($_GET['submit']) && $_GET['submit'] == 'delete') {
      $id = $_GET['id'];
      try {
        $sqldeletepatient = "DELETE FROM tbl_users WHERE u_id = ?";
        $stmt = $conn->prepare($sqldeletepatient);
        $stmt->execute([$id]);
        echo "<script>alert('Patient deleted successfully.');</script>";
        echo "<script>window.location.href='main.php';</script>";
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
  }

    if (isset($_GET['search_query']) && isset($_GET['search_option'])) {
      $search_query = $_GET['search_query'];
      $search_option = $_GET['search_option'];

      if ($search_option == 'name') {
        $sqlloadpatients = "SELECT * FROM tbl_users WHERE u_Name LIKE ?";
        $stmt = $conn->prepare($sqlloadpatients);
        $stmt->execute(['%'.$search_query.'%']);
        $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows=$stmt->fetchAll();
      } else if ($search_option == 'email') {
        $sqlloadpatients = "SELECT * FROM tbl_users WHERE u_email LIKE ?";
        $stmt = $conn->prepare($sqlloadpatients);
        $stmt->execute(['%'.$search_query.'%']);
        $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows=$stmt->fetchAll();
      }

      if (count($rows) == 0) {
        echo "<script>alert('No results found.');</script>";
        echo "<script>window.location.href='main.php';</script>";
      }
    }

    $results_per_pages = 10;
    if (isset($_GET['pageno'])) {
        $pageno = (int)$_GET['pageno'];
        $page_first_result = ($pageno - 1) * $results_per_pages;
    } else {
        $pageno = 1;
        $page_first_result = 0;
    }   
    
    $stmt = $conn->prepare($sqlloadpatients);
    $stmt->execute();
    
    $number_of_results = $stmt->rowCount();
    $number_of_pages = ceil($number_of_results / $results_per_pages);
    $sqlloadpatients = $sqlloadpatients . " LIMIT " . $page_first_result . ',' . $results_per_pages;
    $stmt = $conn->prepare($sqlloadpatients);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows=$stmt->fetchAll();
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
</head>

<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="main.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <span class="fs-4 ms-4">Matthew H's Clinic</span>
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="main.php" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#modal1" class="nav-link">About</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
    </ul>
</header>

        <div class="container mb-2">
            <div class="row">
              <div>
                <h2>Welcome to Matthew H's Clinic</h2>
                <p>Matthew H's Clinic is a web application that helps you manage your clinic. You can use this application to manage your patients, appointments, and more.</p>   
              </div>
            </div>
        </div>

        <div class="container ">
            <div class="row">
              <div>
                <h2>Patients</h2>
                <table class="table table-striped table-bordered table-hover d-none d-md-block">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rows as $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['u_id']; ?></th>
                            <td><?php echo $row['u_Name']; ?></td>
                            <td><?php echo $row['u_email']; ?></td>
                            <td><?php echo $row['u_PhoneNum']; ?></td>
                            <td><?php echo $row['u_Address']; ?></td>
                            <td>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal<?php echo $row['u_id']; ?>">View Details</button>
                              <a href="main.php?submit=delete&id=<?php echo $row['u_id']; ?>" onclick="return confirm('Are you sure you want to delete this patient?');" class="btn btn-primary">Delete</a>
                            </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>

                
                    <div class="row d-block d-sm-block d-md-none">
                      <?php foreach ($rows as $row) { ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $row['u_id']; ?></h5>
                                <p class="card-text"><?php echo $row['u_Name']; ?></p>
                              </div>
                            </div>
                        </div>
                      <?php } ?>
                    </div>
              </div>
            </div>
        </div>
        
        
        <div class="d-flex justify-content-center">
            <?php
              for ($page=1;$page<=$number_of_pages;$page++) {
                echo '<a href="main.php?pageno=' . $page . '" class="btn btn-primary">' . $page . '</a>';
              }
            ?>
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
            <div class="modal fade" id="patientModal<?php echo $row['u_id']; ?>" tabindex="-1" aria-labelledby="patientModalLabel<?php echo $row['p_id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="patientModalLabel<?php echo $row['u_id']; ?>">Your Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><b>Your ID:</b> <?php echo $row['u_id']; ?></p>
                            <p><b>Name:</b> <?php echo $row['u_Name']; ?></p>
                            <p><b>Email:</b> <?php echo $row['u_email']; ?></p>
                            <p><b>Phone:</b> <?php echo $row['u_PhoneNum']; ?></p>
                            <p><b>Address:</b> <?php echo $row['u_Address']; ?></p>>
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
