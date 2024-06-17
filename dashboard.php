<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sih";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the survey2 table
$sqlOccupationEducation = "SELECT occupation, education, COUNT(*) AS count FROM survey2 GROUP BY occupation, education";
$resultOccupationEducation = $conn->query($sqlOccupationEducation);

if (!$resultOccupationEducation) {
    die("Query failed: " . $conn->error);
}

// Organize the data for Chart.js - Occupation vs Education
$dataOccupationEducation = [];
while ($rowOccupationEducation = $resultOccupationEducation->fetch_assoc()) {
    $occupationOE = $rowOccupationEducation['occupation'];
    $educationOE = $rowOccupationEducation['education'];
    $countOE = $rowOccupationEducation['count'];

    if (!isset($dataOccupationEducation[$occupationOE])) {
        $dataOccupationEducation[$occupationOE] = [];
    }

    $dataOccupationEducation[$occupationOE][$educationOE] = $countOE;
}

// Fetch data from the database (modify table name as needed)
$sqlStateWhsType = "SELECT state, whs_type, COUNT(*) AS count FROM survey1 GROUP BY state, whs_type";
$resultStateWhsType = $conn->query($sqlStateWhsType);

if (!$resultStateWhsType) {
    die("Query failed: " . $conn->error);
}

// Organize the data for Chart.js - State vs Types of Dam
$dataStateWhsType = [];
while ($rowStateWhsType = $resultStateWhsType->fetch_assoc()) {
    $stateSWT = $rowStateWhsType['state'];
    $whsTypeSWT = $rowStateWhsType['whs_type'];
    $countSWT = $rowStateWhsType['count'];

    if (!isset($dataStateWhsType[$stateSWT])) {
        $dataStateWhsType[$stateSWT] = [];
    }

    $dataStateWhsType[$stateSWT][$whsTypeSWT] = $countSWT;
}

// Fetch data from survey2 table for Caste Distribution
$sqlCasteDistribution = "SELECT caste, COUNT(*) as count FROM survey2 GROUP BY caste";
$resultCasteDistribution = $conn->query($sqlCasteDistribution);

// Process data for Chart.js - Caste Distribution
$dataCasteDistribution = [];
$totalPersonsCaste = 0;

while ($rowCasteDistribution = $resultCasteDistribution->fetch_assoc()) {
    $totalPersonsCaste += $rowCasteDistribution['count'];
    $dataCasteDistribution[$rowCasteDistribution['caste']] = $rowCasteDistribution['count'];
}

// Calculate percentages for Caste Distribution
$percentagesCaste = [];
foreach ($dataCasteDistribution as $keyCaste => $valueCaste) {
    $percentagesCaste[$keyCaste] = ($valueCaste / $totalPersonsCaste) * 100;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/@webpixels/css@1.0/dist/index.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .nav {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 4px;
            color: #f8faff;
            text-decoration: none;
        }

        .nav:hover {
            color: #ffffff;
            /* Set the hover color to your desired value */
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .total-family-members {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>

    <div class="image-container">
        <div class="image-item">
            <img src="img/1.png" alt="Image 1" style="height: auto; width: 63px;margin: 10px 0px 0px 20px;">
        </div>
        <div class="image-item">
            <img src="img/2.png" alt="Image 2" style="margin: 15px 0px 0px -200px;">
        </div>
        <div style="margin-left: -200px; margin-right: -50px;     text-align: center;
    padding-top: 10px;
    color: rgb(0, 92, 191);">
            <h1 style="font-size: 50px;color: rgb(0, 92, 191);text-align: center  ;    ">JalSaksham Portal</h1>
            <h2 style="font-size: 20px;color: rgb(35, 37, 38);text-align: center  ;text-decoration: underline;">जल से
                सशक्ति,
                समृद्धि की ओर
            </h2>
        </div>
        <div class="image-item" style="margin-right: -100px;">
            <img src="img/3.png" alt="Image 4" style="margin: 15px 100px 0px 60px;">
        </div>
        <div class="image-item" style="margin-top: -40px;margin-right:100px ;">
            <img src="img/4.png" alt="Image 4" style="margin: 15px 50px 0px 50px;">
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
        <div class="container-xl">
            <!-- Logo -->
            <!-- Navbar toggle -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Nav -->
                <div class="navbar-nav mx-lg-auto">
                    <a class="nav-item nav" href="#" aria-current="page"><ion-icon name="home-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>HOME</a>
                    <a class="nav-item nav" href="#about"><ion-icon name="people-sharp"
                            style="margin-right: 5px;margin-top:4px;"></ion-icon>ABOUT</a></a>
                    <a class="nav-item nav" href="#"><ion-icon name="receipt-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>REPORTS</a>
                    <a class="nav-item nav" href="#"><ion-icon name="people-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>DASHBOARD</a>
                    <a class="nav-item nav" href="rec.html"><ion-icon name="thumbs-up-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>RECOMMENDATION</a>
                    <a class="nav-item nav" href="#"><ion-icon name="chatbox-ellipses-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>FEEDBACK</a>
                    <a class="nav-item nav" href="#"><ion-icon name="call-sharp"
                            style="margin-right: 5px;margin-top: 4px;"></ion-icon>CONTACT US</a>
                </div>
                <!-- Right navigation -->
                <div class="navbar-nav ms-lg-4">
                    <a class="nav-item nav" href="login.php"><ion-icon name="log-in-outline"
                            style="margin-right: 10px;height: 20px;width: 20px;margin-bottom: -5px;"></ion-icon>LOGIN</a>
                </div>
                <!-- Action -->
                <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
                    <a href="signup.php" class="btn btn-sm btn-primary w-full w-lg-auto">
                        <ion-icon name="person-outline"
                            style="margin-right: 5px;margin-bottom: -2px;"></ion-icon>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="card">
        <div class="card-header" style="width:100%;heigth:2px; background-color:grey; ">
            <h2 style="text-align: center;">State wise WHS Distribution</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <!-- Adjust your chart container here -->
                    <canvas id="damChart" width="800" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="height:500px;width:701px;float:right;margin-top:-1px;">
        <div class="card-header" style="width:100%;heigth:10px; background-color:grey; ">
            <h2 style="text-align: center;">Caste wise Beneficiary</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <!-- Adjust your chart container here -->
                    <canvas id="casteChart" width="600" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="width: 800px;">
        <div class="card-header" style="width:100%;heigth:2px; background-color:grey; ">
            <h2 style="text-align: center;">Occupation vs Education</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <canvas id="occupationEducationChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div style=" 
            padding: 20px;
            margin: 20px;">
        <div class="class-header" style="width:100%;heigth:2px; background-color:grey; ">
            <h2 style="text-align: center;height:70px;padding-top:15px;border-radius:5px">SDG Goals - Percentage
                Increase</h2>
        </div>

        <canvas id="sdgGoalsChart" width="800" height="400"></canvas>
    </div>
    <div class="card" style="width: 800px; margin: 20px;">
        <div class="card-header">
            <h4 class="card-title">Survey Data</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <canvas id="surveyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-container">
        <h2>Dashboard</h2>
        <p class="total-family-members" style="margin-" >
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sih";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch the sum of family_members from the person table
            $sql = "SELECT SUM(family_members) AS total_family_members FROM person";
            $result = $conn->query($sql);

            // Check if the query was successful
            if ($result) {
                // Fetch the result as an associative array
                $row = $result->fetch_assoc();

                // Display the total family members on the dashboard
                echo "Total Beneficiary: " . $row["total_family_members"];
            } else {
                // Display an error message if the query fails
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
            ?>
        </p>
    </div>
    <script>
        var id = 0;
        // Initialize Chart.js data with initial survey data
        const chartData = {
            labels: [],
            datasets: [{
                label: 'Family Members',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }],
        };

        // Render chart using Chart.js
        const surveyCtx = document.getElementById('surveyChart').getContext('2d');
        const surveyChart = new Chart(surveyCtx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: { stacked: false },
                    y: { stacked: false, beginAtZero: true },
                },
            },
        });

        // Function to update chart data using AJAX
        function updateChartData() {
            // Fetch new data from the server (you need to implement this endpoint)
            // Example: Fetch data from a PHP script that queries the database
            fetch('getUpdatedData.php')
                .then(response => response.json())
                .then(newData => {
                    // Remove duplicates from labels
                    const uniqueLabels = [...new Set(newData.labels)];
                    console.log(newData);

                    // Update chart data and redraw
                    surveyChart.data.labels = uniqueLabels;
                    surveyChart.data.datasets[0].data = newData.data;
                    //  surveyChart.update();

                    var data = surveyChart.data.datasets[0].data;
                    data.push(newData.data);    // add the new value to the right
                    data.shift();
                    surveyChart.update();
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Update chart data every 5 seconds (adjust the interval as needed)
        setInterval(updateChartData, 5000);
    </script>
    <script>
        // Organized data from PHP for Dam Chart
        const damChartData = <?php echo json_encode($dataStateWhsType); ?>;

        // Extract labels (states) and datasets from the organized data
        const damLabels = Object.keys(damChartData);
        const damDatasets = Object.keys(damChartData[damLabels[0]]);

        // Prepare datasets for Chart.js
        const damChartDatasets = damDatasets.map(type => ({
            label: type,
            data: damLabels.map(state => damChartData[state][type] || 0),
            backgroundColor: getRandomColor(),
            borderColor: getRandomColor(),
            borderWidth: 1,
        }));

        // Render chart using Chart.js for Dam Chart
        const damCtx = document.getElementById('damChart').getContext('2d');
        new Chart(damCtx, {
            type: 'bar',
            data: {
                labels: damLabels,
                datasets: damChartDatasets,
            },
            options: {
                scales: {
                    x: { stacked: true },
                    y: { stacked: true },
                },
            },
        });

        // Organized data from PHP for Caste Chart
        const casteChartData = <?php echo json_encode(array_values($percentagesCaste)); ?>;
        const casteChartLabels = <?php echo json_encode(array_keys($percentagesCaste)); ?>;
        const casteChartColors = getRandomColors(casteChartLabels.length);

        // Render chart using Chart.js for Caste Chart
        const casteCtx = document.getElementById('casteChart').getContext('2d');
        new Chart(casteCtx, {
            type: 'pie',
            data: {
                labels: casteChartLabels,
                datasets: [{
                    data: casteChartData,
                    backgroundColor: casteChartColors,
                    borderColor: casteChartColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });

        // Organized data from PHP for Occupation vs Education Chart
        const occupationEducationChartData = <?php echo json_encode($dataOccupationEducation); ?>;
        const occupationEducationLabels = Object.keys(occupationEducationChartData);
        const educationLevels = Array.from(new Set(Object.values(occupationEducationChartData).flatMap(Object.keys)));

        // Prepare datasets for Chart.js - Occupation vs Education Chart
        const occupationEducationChartDatasets = occupationEducationLabels.map(occupation => ({
            label: occupation,
            data: educationLevels.map(education => {
                const totalCount = educationLevels.reduce((sum, edu) => sum + (occupationEducationChartData[occupation]?.[edu] || 0), 0);
                return ((occupationEducationChartData[occupation]?.[education] || 0) / totalCount) * 100;
            }),
            backgroundColor: getRandomColor(),
            borderColor: getRandomColor(),
            borderWidth: 1,
        }));

        // Render chart using Chart.js for Occupation vs Education Chart
        const occupationEducationCtx = document.getElementById('occupationEducationChart').getContext('2d');
        new Chart(occupationEducationCtx, {
            type: 'bar',
            data: {
                labels: educationLevels,
                datasets: occupationEducationChartDatasets,
            },
            options: {
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, ticks: { callback: value => `${value.toFixed(2)}%` } },
                },
            },
        });

        // Helper function to generate random colors
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Helper function to generate an array of random colors
        function getRandomColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }


        // Updated dummy data with additional SDG goals
        const sdgGoalsData = {
            'No Poverty': { '2021': 20, '2022': 30 },
            'Zero Hunger': { '2021': 15, '2022': 25 },
            'Good Health': { '2021': 10, '2022': 20 },
            'Gender Equality': { '2021': 5, '2022': 15 },
            'Clean Energy': { '2021': 25, '2022': 35 },
            'Economic Growth': { '2021': 18, '2022': 28 },
            'Industry, Innovation, and Infrastructure': { '2021': 12, '2022': 22 },
            'Reduced Inequality': { '2021': 8, '2022': 18 },
            'Responsible Consumption and Production': { '2021': 14, '2022': 24 },
            'Climate Action': { '2021': 30, '2022': 40 },
            'Partnerships for the Goals': { '2021': 10, '2022': 20 },
        };

        // Extract labels and data from the dummy data
        const sdgGoalsLabels = Object.keys(sdgGoalsData);
        const percentageIncrease2021 = sdgGoalsLabels.map(goal => sdgGoalsData[goal]['2021']);
        const percentageIncrease2022 = sdgGoalsLabels.map(goal => sdgGoalsData[goal]['2022']);

        // Render chart using Chart.js
        const ctx = document.getElementById('sdgGoalsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sdgGoalsLabels,
                datasets: [
                    {
                        label: 'Percentage Increase in 2021',
                        backgroundColor: 'teal',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        data: percentageIncrease2021,
                    },
                    {
                        label: 'Percentage Increase in 2022',
                        backgroundColor: 'pink',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        data: percentageIncrease2022,
                    },
                ],
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'SDG Goals',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage Increase (%)',
                        },
                    },
                },
            },
        });
    </script>

</body>

</html>