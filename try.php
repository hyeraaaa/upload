<?php
// Database configuration
$host = 'localhost'; // or your database host
$db = 'image_uploads';
$user = 'root'; // your database username
$pass = ''; // your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the images from the database
$sql = "SELECT * FROM images ORDER BY upload_time DESC"; // You can change the order if needed
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="feed.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="form.php">Create</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="feed_section">
            <div class="container">
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class = "row justify-content-center align-items-center mb-3">';
                        echo '<div class = "post_container col-12 col-lg-6 bg-body-tertiary p-3">';
                        echo '<div class = "poster_info">';
                        echo '<p>Uploaded on: ' . htmlspecialchars($row['upload_time']) . '</p>';
                        echo '</div>';
                        echo '<div class = "post_description">';
                        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                        echo '</div>';
                        echo '<div class = "image-container">';
                        echo '<img class = "img-fluid w-100" src="uploads/' . htmlspecialchars($row['filename']) . '" alt="Image">';
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No images found.</p>';
                }
                ?>
            </div>
        </section>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>