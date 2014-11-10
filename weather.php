<?php
// The Weather class
require_once 'WeatherForecast.class.php';

// Defines the API key provided to register his candidacy
$weather = new WeatherForecast('7c72a861ad98a9662907132ea224c');

// Defines the name of the city, the country and the number of days of forecast (between 1 and 5)
$weather->setRequest('New York', 'United States Of America', 1);

// Defines the US unit of measurement
$weather->setUSMetric(true);

// Defines the display of the error message on failure
//$weather->setDisplayError(false);    
?>
<html> 
    <head>
    <title>Weather Forecast</title>
    <link rel="stylesheet" href="screen.css" media="screen" />
    </head>
    <body>
        <?php
        // API call
        $response = $weather->getLocalWeather();

        if ($weather::$has_response) {
            ?>

            <h1><?php echo $response->locality; ?></h1>

            <h2>The Weather Today at <?php echo $response->weather_now['weatherTime']; ?></h2>

            <div class="weather_now">
                <span style="float:right;"><img src="<?php echo $response->weather_now['weatherIcon']; ?>" /></span>
                <strong>DESCRIPTION:</strong> <?php echo $response->weather_now['weatherDesc']; ?><br />
                <strong>TEMPERATURE:</strong> <?php echo $response->weather_now['weatherTemp']; ?><br />
                <strong>WIND SPEED:</strong> <?php echo $response->weather_now['windSpeed']; ?><br />
                <strong>PRECIPITATION:</strong> <?php echo $response->weather_now['precipitation']; ?><br />
                <strong>HUMIDITY:</strong> <?php echo $response->weather_now['humidity']; ?><br />
                <strong>VISIBILITY:</strong> <?php echo $response->weather_now['visibility']; ?><br />
                <strong>PRESSURE:</strong> <?php echo $response->weather_now['pressure']; ?><br />
                <strong>CLOUD COVER:</strong> <?php echo $response->weather_now['cloudcover']; ?><br />
            </div>

            <h3>Weather Forecast</h3>

            <?php
            foreach ($response->weather_forecast as $weather) {
                ?>
                <div class="weather_forecast">
                    <div class="block block1">
                        <span class="icon"><img src="<?php echo $weather['weatherIcon']; ?>" /></span>
                    </div>
                    <div class="block block2">
                        <span class="wday"><?php echo $weather['weatherDay']; ?></span>
                        <span class="date"><?php echo $weather['weatherDate']; ?> </span>
                        <span class="desc"><?php echo $weather['weatherDesc']; ?></span>
                        <span class="wind">Wind: <?php echo $weather['windDirection']; ?> at <?php echo $weather['windSpeed']; ?></span>
                    </div>
                    <div class="block block3">
                        <span class="tmax"><?php echo $weather['tempMax']; ?></span>
                        <span class="tmin"><?php echo $weather['tempMin']; ?></span>
                    </div>
                </div>
                <?php
            }
            ?>
        <?php } ?>
    </body>
</html>