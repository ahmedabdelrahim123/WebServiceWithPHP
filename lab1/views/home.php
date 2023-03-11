<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
        <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
select city
</button>
    <ul class="dropdown-menu">
        <?php 
            $egy = getCities();
            foreach($egy as $city){
                ?>
                <li><a class="dropdown-item" href="?lon=<?php echo $city["coord"]["lon"]?>&lat=<?php echo $city["coord"]["lat"]?>"><?php echo $city["name"]?> </a></li>
               <?php  
            }
        ?>
        
    </ul>
    

    </div>
    <?php
        $weath = getWeather();
    ?>

    <div>
        <h1><?php echo $weath["name"] ?> </h1>
        <b><?php echo $weath["main"]["temp"] ?> </b>
        <b><?php echo $weath["weather"][0]["description"] ?> </b>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>