<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Trends Visualization</title>
    <!-- Include necessary CSS/JS files for your chosen JavaScript charting library -->
    <!-- For example, if you're using Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Weather Trends Visualization</h1>
    <canvas id="weatherChart" width="800" height="400"></canvas>

    <script>
        // JavaScript code to create and populate the chart
        // You can use the $weatherData variable passed from the controller to populate the chart data
        // Example:
        var ctx = document.getElementById('weatherChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $weatherData->pluck('hour') !!}, // Assuming 'hour' is the column containing the hour values
                datasets: [
                    {
                        label: 'Relative Humidity',
                        data: {!! $weatherData->pluck('relative_humidity') !!}, // Assuming 'relative_humidity' is the column containing RH values
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    // Repeat similar blocks for other parameters (Temperature Average, Wind Speed, Precipitation Amount, Pressure Average)
                ]
            },
            options: {
                // Configure chart options as needed
            }
        });
    </script>
</body>
</html>
