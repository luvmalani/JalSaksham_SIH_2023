<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDG Goals</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="card" style="width: 800px; margin: 20px;float:right;">
    <div class="card-header">
        <h4 class="card-title" style="background-color:grey;height:30px;width:800px">UNCCD Goals Progress (2021-2022)</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <canvas id="unccdChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card" style="width: 800px; margin: 20px;">
    <div class="card-header" style="background-color:grey;height:30px;width:800px" >
        <h4 class="card-title">UNFCCC Goals Progress (2021-2022)</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <canvas id="unfcccChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Dummy data for UNCCD goals
    const unccdGoalsData = {
        "No Poverty": { 2021: 30, 2022: 50 },
        "Sustainable Land Management": { 2021: 50, 2022: 70 },
        "Rehabilitation and Restoration of Degraded Ecosystems": { 2021: 20, 2022: 40 },
        "Mitigation and Adaptation to Climate Change": { 2021: 40, 2022: 60 },
        "Awareness Raising and Advocacy": { 2021: 25, 2022: 45 },
        "Mobilisation of Resources": { 2021: 35, 2022: 55 }
    };

    // Dummy data for UNFCCC goals
    const unfcccGoalsData = {
        "Mitigation of Climate Change": { 2021: 40, 2022: 60 },
        "Adaptation to Climate Change": { 2021: 35, 2022: 55 },
        "Capacity Building and Technology Transfer": { 2021: 25, 2022: 45 }
    };

    // Extract labels for Chart.js
    const unccdGoalLabels = Object.keys(unccdGoalsData);
    const unfcccGoalLabels = Object.keys(unfcccGoalsData);

    // Prepare datasets for Chart.js
    const datasetsUnccd = [
        {
            label: '2021',
            data: unccdGoalLabels.map(goal => unccdGoalsData[goal][2021]),
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
        },
        {
            label: '2022',
            data: unccdGoalLabels.map(goal => unccdGoalsData[goal][2022]),
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
        },
    ];

    const datasetsUnfccc = [
        {
            label: '2021',
            data: unfcccGoalLabels.map(goal => unfcccGoalsData[goal][2021]),
            backgroundColor: 'rgba(255, 206, 86, 0.5)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1,
        },
        {
            label: '2022',
            data: unfcccGoalLabels.map(goal => unfcccGoalsData[goal][2022]),
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
        },
    ];

    // Render chart using Chart.js for UNCCD Goals
    const unccdCtx = document.getElementById('unccdChart').getContext('2d');
    new Chart(unccdCtx, {
        type: 'bar',
        data: {
            labels: unccdGoalLabels,
            datasets: datasetsUnccd,
        },
        options: {
            scales: {
                x: { stacked: false },
                y: { stacked: false, beginAtZero: true, max: 100 },
            },
            plugins: {
                legend: { position: 'top' },
            },
        },
    });

    // Render chart using Chart.js for UNFCCC Goals
    const unfcccCtx = document.getElementById('unfcccChart').getContext('2d');
    new Chart(unfcccCtx, {
        type: 'bar',
        data: {
            labels: unfcccGoalLabels,
            datasets: datasetsUnfccc,
        },
        options: {
            scales: {
                x: { stacked: false },
                y: { stacked: false, beginAtZero: true, max: 100 },
            },
            plugins: {
                legend: { position: 'top' },
            },
        },
    });
</script>

</body>

</html>
