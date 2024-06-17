<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Survey Common</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
    font-family: 'Georgia', sans-serif;
    background-color: #f8f9fa;
    margin: 20px;
}

#survey-container {
    max-width: 1000px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

fieldset {
    border: 2px solid #3498db;
    border-radius: 10px;
    padding: 20px;
    width: 48%; /* Adjust as needed */
    box-sizing: border-box;
    margin-bottom: 20px;
    transition: border-color 0.3s ease-in-out;
    text-align: center; /* Center align the text */
}

fieldset:hover {
    border-color: #2980b9;
}

legend {
    font-size: 1.5em;
    font-weight: bold;
    color: #3498db;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

.box {
    width: calc(100% - 20px);
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.button-container {
    margin-top: 20px;
    text-align: center;
    width: 100%;
}

.button-container button {
    margin: 0 10px;
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.button-container button:hover {
    background-color: #2980b9;
}

/* Media query for responsiveness */
@media (max-width: 768px) {
    fieldset {
        width: 100%;
    }
}





    </style>
</head>

<body>
    <div id="survey-container">
        <form action="process_S4.php" method="post" >
            <!-- Farmer Section -->
            <fieldset>
                <legend>FARMER:</legend>
                <label>Crop Type (Name): <input type="text" name="farmer_crop_type" class="box"></label>
                <label>Crop area (Hectare): <input type="text" name="farmer_crop_area" class="box"></label>
                <label>Crop yield (kg/hectare): <input type="text" name="farmer_crop_yield" class="box"></label>
                <label>Crop frequency (per year): <input type="text" name="farmer_crop_frequency" class="box"></label>
                <label>Crop Rate (INR/quintal): <input type="text" name="farmer_crop_rate" class="box"></label>
                <label>Income per hectare (INR/hectare): <input type="text" name="farmer_income_per_hectare" class="box"></label>
            </fieldset>

            <!-- Fisherman Section -->
            <fieldset>
                <legend>FISHERMAN:</legend>
                <label>Fish Type (Name): <input type="text" name="fisherman_fish_type" class="box"></label>
                <label>Catch Volume (kg): <input type="text" name="fisherman_catch_volume" class="box"></label>
                <label>Average Fish Size (kg): <input type="text" name="fisherman_avg_fish_size" class="box"></label>
                <label>Discard Rate [%]: <input type="text" name="fisherman_discard_rate" class="box"></label>
                <label>Fishing Equipments Cost (INR): <input type="text" name="fisherman_equipments_cost" class="box"></label>
                <label>Income per Activity (INR): <input type="text" name="fisherman_income_per_activity" class="box"></label>
            </fieldset>

            <!-- Poultry Section -->
            <fieldset>
                <legend>POULTRY:</legend>
                <label>Chicken Breed (Name): <input type="text" name="poultry_chicken_breed" class="box"></label>
                <label>Poultry Flock Size: <input type="text" name="poultry_flock_size" class="box"></label>
                <label>Feed Conversion Ratio: <input type="text" name="poultry_feed_conversion_ratio" class="box"></label>
                <label>Input Cost (INR): <input type="text" name="poultry_input_cost" class="box"></label>
                <label>Poultry Product Sales: <input type="text" name="poultry_product_sales" class="box"></label>
                <label>Income per Activity (INR/kg): <input type="text" name="poultry_income_per_activity" class="box"></label>
            </fieldset>

            <!-- Dairy Section -->
            <fieldset>
                <legend>DAIRY:</legend>
                <label>Cattle Type (Name): <input type="text" name="dairy_cattle_type" class="box"></label>
                <label>Milk Production per Cattle (ltrs): <input type="text" name="dairy_milk_production_per_cattle" class="box"></label>
                <label>Number of Milking Animals: <input type="text" name="dairy_number_of_milking_animals" class="box"></label>
                <label>Feed Costs: <input type="text" name="dairy_feed_costs" class="box"></label>
                <label>Milk Price (INR/ltr): <input type="text" name="dairy_milk_price" class="box"></label>
                <label>Income per Activity (INR): <input type="text" name="dairy_income_per_activity" class="box"></label>
            </fieldset>

            <!-- Aquatic Plants Section -->
            <fieldset>
                <legend>AQUATIC PLANTS:</legend>
                <label>Yield Type (Name): <input type="text" name="aquatic_plants_yield_type" class="box"></label>
                <label>Harvested Area (Hectares): <input type="text" name="aquatic_plants_harvested_area" class="box"></label>
                <label>Yield per Area (tons/hectare): <input type="text" name="aquatic_plants_yield_per_area" class="box"></label>
                <label>Frequency of Harvest (number of harvest per year): <input type="text" name="aquatic_plants_harvest_frequency" class="box"></label>
                <label>Operating Costs: <input type="text" name="aquatic_plants_operating_costs" class="box"></label>
                <label>Income per hectare (INR/hectare): <input type="text" name="aquatic_plants_income_per_hectare" class="box"></label>
            </fieldset>

            <!-- Small Scale Industry Section -->
            <fieldset>
                <legend>SMALL SCALE INDUSTRY:</legend>
                <label>Industry Type (Name): <input type="text" name="industry_industry_type" class="box"></label>
                <label>Average Income per Unit: <input type="text" name="industry_average_income_per_unit" class="box"></label>
                <label>Total Revenue (number of harvest per year): <input type="text" name="industry_total_revenue" class="box"></label>
                <label>Operating Costs: <input type="text" name="industry_operating_costs" class="box"></label>
                <label>Profit Margin (percentage[%]): <input type="text" name="industry_profit_margin" class="box"></label>
                <label>Income per Activity (INR): <input type="text" name="industry_income_per_activity" class="box"></label>
            </fieldset>

            <div class="button-container row">
                <div class="col-md-6 text-left" style="margin-left: 400px;">
                    <button type="submit" onclick="redirectPage()" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
    
    function redirectPage() {
            let temp = window.localStorage.getItem('ColorObj')
            let colourState = JSON.parse(temp)
            colourState.s4 = true
            window.localStorage.setItem('ColorObj', JSON.stringify(colourState))
        }

  </script>
</body>

</html>
