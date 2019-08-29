<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Slider Search</title>
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>

        #sliderControlsContainer{
            background: #5F9EA0;
            color: white;
            text-align: center;
            width:380px;
            margin:15px;
            padding: 25px 25px 0 25px;
            float: left;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 10px 10px;
        }

        #sliderControlsContainer div{
            margin-bottom: 25px;
        }

        #sliderControlsContainer label{
            font-family: Arial;
            color:white;
            font-size: 16px;
            display: inline-block;
            width: 120px;
            text-align: center;
        }

        #sliderControlsContainer input[type=text]{
            color:#00BFFF;
            font-size: 13px;
            font-weight:bold;
        }

        #lists{

            float: left;
            width: 700px;
        }

        .songlist{
            text-align: center;

            color: #5561CB;
            font-family: 'Ubuntu', sans-serif;
            font-weight: bold;
            font-size: 25px;
        }
        .subtitle{
            font-family: 'Ubuntu', sans-serif;
            font-size:20px;
        }

    </style>
</head>

<body>

<fieldset id="sliderControlsContainer">

    <p class="songlist" align="center">&#9836; Slider Features Search &#9836; </p>
    <p class="subtitle" align="center">Adjust the slider bars!</p>


    <div>
        <label for="tempo">Tempo</label>
        <input type="text" name="nights" id="tempo" />
        <div class="slider" data-options='{"min": 12, "max": 252, "values": [12, 252], "step": 5}'></div>
    </div>

    <div>
        <label for="acousticness">Acousticness</label>
        <input type="text" name="stars" id="acous" />
        <div class="slider"></div>
    </div>

    <div>
        <label for="speechiness">Speechiness</label>
        <input type="text" name="price" id="speech" />
        <div class="slider" data-options='{"min": 0, "max": 1, "values": [0, 1], "step": 0.1}'></div>
    </div>

    <div>
        <label for="valence">Valence</label>
        <input type="text" name="nights" id="valence" />
        <div class="slider"></div>
    </div>

    <div>
        <label for="danceability">Danceability</label>
        <input type="text" name="nights" id="dance" />
        <div class="slider"></div>
    </div>

    <div>
        <label for="energy">Energy</label>
        <input type="text" name="nights" id="energy" />
        <div class="slider"></div>
    </div>

    <div>
        <label for="instrumentalness">Instrumentalness</label>
        <input type="text" name="nights" id="inst" />
        <div class="slider"></div>
    </div>

    <div>
        <label for="liveness">Liveness</label>
        <input type="text" name="nights" id="live" />
        <div class="slider"></div>
    </div>





</fieldset>
<div id="lists"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>

    function getFilterOpts(){
        var filterOpts = {},
            countries = [];

        $(".slider").each(function(){
            var slider = $(this).prev().attr("id"),
                value = $(this).slider("values");

            filterOpts[slider] = value;
        });


        filterOpts["countries"] = countries;

        return filterOpts;
    }


    function updateSliderInputs(){
        var allSliderValues = {};

        $(".slider").each(function(){
            var slider = $(this).prev().attr("id"),
                currentSliderValues = $(this).slider("values"),
                //unit = $(this).prev().data("unit"),
                newValue = currentSliderValues[0] +
                    " - " +
                    currentSliderValues[1];

            allSliderValues[slider] = currentSliderValues;
            $(this).prev().val(newValue);
        });

        return allSliderValues;
    }

    function getLists(){
        $.ajax({
            type: "POST",
            url: "submit.php",
            cache: false,
            data: {filterOpts: getFilterOpts()},
            success: function(data){
                $('#lists').html(data);
            }
        });
    }



    function handleFilterOptsChange(){
        updateSliderInputs();
        getLists();
    }

    $(".slider").each(function(){
        var defaultOpts = {
                range: true,
                min: 0,
                max: 1,
                step:0.1,
                values: [0, 1],
                change: handleFilterOptsChange
            },
            sliderOpts = $(this).data("options"),
            opts = $.extend(defaultOpts, sliderOpts);

        $(this).slider(opts);
    });

    $("input:checkbox").on("change", function(){
        handleFilterOptsChange();
    });

    handleFilterOptsChange();
</script>
</body>
</html>
