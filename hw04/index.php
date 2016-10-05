<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CIS371 - Homework 04</title>
        <link rel="stylesheet" href="style.css">
        <script src="preload.js"></script>
    </head>
    <body>
        <div class="topbar">
            <span class="brand">CIS371 - Homework 04</span>
        </div>
        <div class="container">
            <h1>Weather Reporting</h1>
            <p>Fill out the form below to look up weather data for the Grand Rapids region. Valid dates are from January, 1945 to August 1, 2007.</p>
            <form id="mainform" action="results.php" onsubmit="return checkForm()">
                <fieldset>
                    <legend>Date:</legend>
                    Year:<br>
                    <input type="number" name="y" value="1945"><br>
                    Month:<br>
                    <input type="number" name="m" value="1"><br>
                </fieldset>
                <fieldset>
                    <legend>Report:</legend>
                    Report Type:<br>
                    <input type="radio" name="r" value="1">Average<br>
                    <input type="radio" name="r" value="2" checked="true">List<br>
                    Temperature Type:<br>
                    <input type="radio" name="t" value="1">High<br>
                    <input type="radio" name="t" value="2" checked="true">Average<br>
                    <input type="radio" name="t" value="3">Low<br>
                </fieldset>
                <fieldset>
                    <input type="submit">
                </fieldset>
            </form>
            <div id="validationdata">
                
            </div>
        </div>
        <script src="postload.js"></script>
    </body>
</html>