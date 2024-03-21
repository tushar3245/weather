<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Statistics</title>
</head>
<body>
    <h1>Weather Statistics</h1>
    <h2>Average Values</h2>
    <ul>
        <li>Relative Humidity: {{ $averageRH }}</li>
        <li>Temperature Average: {{ $averageTA }}</li>
        <li>Wind Speed: {{ $averageWS }}</li>
        <li>Precipitation Amount: {{ $averagePRA }}</li>
        <li>Pressure Average: {{ $averagePA }}</li>
    </ul>

    <h2>Minimum Values</h2>
    <ul>
        <li>Relative Humidity: {{ $minValues->min_rh }}</li>
        <li>Temperature Average: {{ $minValues->min_ta }}</li>
        <li>Wind Speed: {{ $minValues->min_ws }}</li>
        <li>Precipitation Amount: {{ $minValues->min_pra }}</li>
        <li>Pressure Average: {{ $minValues->min_pa }}</li>
    </ul>

    <h2>Maximum Values</h2>
    <ul>
        <li>Relative Humidity: {{ $maxValues->max_rh }}</li>
        <li>Temperature Average: {{ $maxValues->max_ta }}</li>
        <li>Wind Speed: {{ $maxValues->max_ws }}</li>
        <li>Precipitation Amount: {{ $maxValues->max_pra }}</li>
        <li>Pressure Average: {{ $maxValues->max_pa }}</li>
    </ul>

    <h2>Median Values</h2>
    <ul>
        <li>Relative Humidity: {{ $medianValues->median_rh }}</li>
        <li>Temperature Average: {{ $medianValues->median_ta }}</li>
        <li>Wind Speed: {{ $medianValues->median_ws }}</li>
        <li>Precipitation Amount: {{ $medianValues->median_pra }}</li>
        <li>Pressure Average: {{ $medianValues->median_pa }}</li>
    </ul>

    <h2>Hour with Highest Values</h2>
    <p>Hour: {{ $hourWithHighestValues->hour }}</p>
    <ul>
        <li>Relative Humidity: {{ $hourWithHighestValues->max_rh }}</li>
        <li>Temperature Average: {{ $hourWithHighestValues->max_ta }}</li>
        <li>Wind Speed: {{ $hourWithHighestValues->max_ws }}</li>
        <li>Precipitation Amount: {{ $hourWithHighestValues->max_pra }}</li>
        <li>Pressure Average: {{ $hourWithHighestValues->max_pa }}</li>
    </ul>
</body>
</html>
