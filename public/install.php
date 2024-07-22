<?php

require __DIR__ . "/../settings.php";

require __DIR__ . "/../functions.php";

require __DIR__ . "/../autoloader.php";

$loader = new Psr4Autoloader();
$loader->register();

$loader->addNamespace('Psr', "../vendor/Psr");

$loader->addNamespace('MongoDB', '../vendor/MongoDB');
require __DIR__ . "/../vendor/MongoDB/functions.php";

$loader->addNamespace('Symfony', '../vendor/Symfony');
$loader->addNamespace('MirazMac', '../vendor/MirazMac');

$dotenv_file = PANDA_ROOT . '/.env';

$writer = new \MirazMac\DotEnv\Writer($dotenv_file);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panda CMS Installation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
        .bs-stepper-pane {
            display: none !important;
        }

        .dstepper-none {
            display: none !important;
        }

        .dstepper-block.active {
            display: block !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3 border-bottom">
            <h1>Welcome to Panda CMS</h1>
        </header>


        <div id="stepper" class="bs-stepper vertical pt-4">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-vl-1">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger1" aria-controls="test-vl-1">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Choose Database</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-vl-2">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger2" aria-controls="test-vl-2">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Environment variables</span>
                    </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-vl-3">
                    <button type="button" class="step-trigger" role="tab" id="stepper4trigger3" aria-controls="test-vl-3">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Confirm</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content container">

                <div id="test-vl-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger1">
                    <h2>Choose Database</h2>
                    <div class="form-group row mt-4">
                        <label for="mongodb" class="col-3">MongoDB</label>
                        <input type="checkbox" class="form-control col-3" id="mongodb" name="mongodb">
                    </div>
                    <div class="form-group row">
                        <label for="mysql" class="col-3">MySQL</label>
                        <input type="checkbox" class="form-control col-3" id="mysql" name="mysql">
                    </div>
                    <button class="btn btn-primary" id="next1">Next</button>

                </div>
                <div id="test-vl-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger2">
                    <div class="form-group">
                        <label for="envvar">
                            <h2>Set environment variables</h2>
                        </label>
                        <textarea rows="10" cols="200" type="text" class="form-control" id="envvar"></textarea>
                    </div>
                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                </div>
                <div id="test-vl-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepper4trigger3">
                    <button class="btn btn-primary mt-5" onclick="stepper.previous()">Previous</button>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </div>

            </div>
        </div>
    </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script>
        var stepper;

        document.addEventListener("DOMContentLoaded", function() {
            stepper = new Stepper(document.querySelector('#stepper'));
        })

        $("#next1").click(function() {


            const mongodb = $("#mongodb").is(":checked");
            const mysql = $("#mysql").is(":checked");

            if (mongodb) {
                $("#envvar").val(`DB_TYPE=mongodb
MONGO_URI=`)
            } else if (mysql) {
                $("#envvar").val(`DB_TYPE=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=panda_cms
DB_USERNAME=
DB_PASSWORD=
`)
            } else {
                alert("Please select a database");
                return;
            }

            stepper.next();

        });
    </script>
</body>

</html>