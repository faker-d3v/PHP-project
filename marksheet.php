<?php
// including here seems the best practice in case I forget later
include "actions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marksheet Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_SERVER['PHP_SELF'] . '/../marksheet.css' ?>">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Student Marksheet Manager</h1>
            <a href="login.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Input Form</h2>
            </div>
            <div class="card-body">
                <form action="#" method="post" class="row g-3">
                    <div class="col-md-2">
                        <label for="id" class="form-label">ID: </label>
                        <input type="number" class="form-control" id="id" name="id" placeholder="ID">
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label">Name: </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="col-md-2">
                        <label for="dept" class="form-label">Dept: </label>
                        <input type="text" class="form-control" id="dept" name="dept" value="CSE" placeholder="Dept">
                    </div>
                    <div class="col-md-3">
                        <label for="course" class="form-label">Course: </label>
                        <input type="text" class="form-control" id="course" name="course" value="Internet programming" placeholder="Course">
                    </div>
                    <div class="col-md-2">
                        <label for="cgpa" class="form-label">CGPA:</label>
                        <input type="text" class="form-control" id="cgpa" name="cgpa" value="3.99" placeholder="CGPA">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
            // delete
            if (isset($_POST['delete_id'])) {
                delete($_POST['delete_id']);
            }

            // create
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $dept = $_POST['dept'] ?? '';
            $course = $_POST['course'] ?? '';
            $cgpa = $_POST['cgpa'] ?? '';

            if ($id > 0) {
                create($id, $name, $dept, $course, $cgpa);
            }
        ?>

        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Marksheet</h2>
                    <form class="d-flex" onsubmit="return false;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Dept</th>
                            <th>Course</th>
                            <th>CGPA</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = read();
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['Name'] . "</td>";
                                echo "<td>" . $row['Dept'] . "</td>";
                                echo "<td>" . $row['Course'] . "</td>";
                                echo "<td>" . $row['CGPA'] . "</td>";
                                echo "<td>
                                        <form action='". $_SERVER['PHP_SELF'] . "' method='post' class='d-inline'>
                                            <input type='hidden' name='delete_id' value='" . $row['ID'] . "'>
                                            <button type='submit' class='btn btn-danger btn-sm'>X</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const searchInput = document.querySelector('input[aria-label="Search"]');
        const tableBody = document.querySelector('.table tbody');
        const tableRows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function(event) {
            // 1. lower case the search input
            const searchTerm = event.target.value.toLowerCase();

            tableRows.forEach(function(row) {
                // 2. lower case the full row text
                const rowData = row.textContent.toLowerCase();

                // 3. css style.display:none if not matches
                if (rowData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
