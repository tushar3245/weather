<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherObservation;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class WeatherController extends Controller
{


    public function showUploadForm()
    {
        return view ('weather.upload');
    }

   
    public function uploadCSV(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);
    
        // Process the uploaded CSV file
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
    
            // Create a CSV reader instance
            $csv = Reader::createFromPath($file->getPathname(), 'r');
            $csv->setHeaderOffset(0);
    
            // Iterate over each row and insert data into the database
            foreach ($csv as $row) {
                // Extract data from the current row
                $time = Carbon::parse($row['Time'])->format('Y-m-d H:i:s');
                $parameterName = $row['ParameterName'];
                $parameterValue = $row['ParameterValue'];
    
                // Check if parameterValue is 'NaN' or not numeric
                if ($parameterValue === 'NaN' || !is_numeric($parameterValue)) {
                    continue; // Skip this row if parameterValue is 'NaN' or not numeric
                }
    
                // Create a new WeatherObservation instance and insert data into the database
                WeatherObservation::create([
                    'date_time' => $time,
                    'parameter_name' => $parameterName,
                    'parameter_value' => $parameterValue,
                    // Add other fields as needed
                ]);
            }
    
            // Provide feedback to the user
            return redirect()->back()->with('success', 'CSV file uploaded and data inserted into the database.');
        }
    
        // Return an error response if no file was uploaded
        return redirect()->back()->with('error', 'No CSV file uploaded.');
    }
    public function calculateAverages()
    {
        // Calculate average values for each weather parameter
        $averageRH = WeatherObservation::avg('relative_humidity');
        $averageTA = WeatherObservation::avg('temperature_average');
        $averageWS = WeatherObservation::avg('wind_speed');
        $averagePRA = WeatherObservation::avg('precipitation_amount');
        $averagePA = WeatherObservation::avg('pressure_average');

        // Calculate min, max, and median values for each weather parameter
        $minValues = WeatherObservation::selectRaw('MIN(relative_humidity) AS min_rh, MIN(temperature_average) AS min_ta, MIN(wind_speed) AS min_ws, MIN(precipitation_amount) AS min_pra, MIN(pressure_average) AS min_pa')->first();
        $maxValues = WeatherObservation::selectRaw('MAX(relative_humidity) AS max_rh, MAX(temperature_average) AS max_ta, MAX(wind_speed) AS max_ws, MAX(precipitation_amount) AS max_pra, MAX(pressure_average) AS max_pa')->first();
        $medianValues = WeatherObservation::selectRaw('percentile_cont(0.5) WITHIN GROUP (ORDER BY relative_humidity) AS median_rh, percentile_cont(0.5) WITHIN GROUP (ORDER BY temperature_average) AS median_ta, percentile_cont(0.5) WITHIN GROUP (ORDER BY wind_speed) AS median_ws, percentile_cont(0.5) WITHIN GROUP (ORDER BY precipitation_amount) AS median_pra, percentile_cont(0.5) WITHIN GROUP (ORDER BY pressure_average) AS median_pa')->first();

        // Find the hour with the highest value for each parameter
        $hourWithHighestValues = WeatherObservation::selectRaw('hour, MAX(relative_humidity) AS max_rh, MAX(temperature_average) AS max_ta, MAX(wind_speed) AS max_ws, MAX(precipitation_amount) AS max_pra, MAX(pressure_average) AS max_pa')
            ->groupBy('hour')
            ->orderBy('max_rh', 'desc')
            ->orderBy('max_ta', 'desc')
            ->orderBy('max_ws', 'desc')
            ->orderBy('max_pra', 'desc')
            ->orderBy('max_pa', 'desc')
            ->first();

        return view('weather.index', [
            'averageRH' => $averageRH,
            'averageTA' => $averageTA,
            'averageWS' => $averageWS,
            'averagePRA' => $averagePRA,
            'averagePA' => $averagePA,
            'minValues' => $minValues,
            'maxValues' => $maxValues,
            'medianValues' => $medianValues,
            'hourWithHighestValues' => $hourWithHighestValues,
        ]);
    }

    public function visualizeTrends()
    {
        // Fetch weather data to visualize trends
        $weatherData = WeatherObservation::all();

        // You can pass $weatherData to your view and use a JavaScript charting library like Chart.js to visualize trends
        return view('weather.visualize', ['weatherData' => $weatherData]);
    }
}

