<?php

/*
Graybyt3 - Ex-Blackhat | Ex Super Mod of Team_CC.
Now securing systems as a Senior Security Expert.
I hack servers for fun, patch them to torture you.

"My life is a lie, and i'm living in this only truth.- Graybyt3"

WARNING: This code is for educational and ethical purposes only.
I am not responsible for any misuse or illegal activities.

WARNING: Steal my code, and I'll call you Pappu — there's no worse shame in this world than being called Pappu.
#FuCk_Pappu
*/
$host = 'x.x.x.x'; /* Fill in with your host/ip*/
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mode = $_POST['mode'] ?? 'mass';

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    if ($mode == 'single') {
        $database = $_POST['database'];
        $user = $_POST['user'];
        $password = $_POST['password'];

        try {
            $connection = new mysqli($host, $user, $password, $database);

            if ($connection->connect_error) {
                echo "data: <div class='status-line'><p style='color:red; font-family: Roboto Flex, sans-serif; font-weight:bold;'>FAILED...: {$connection->connect_error}</p></div>\n\n";
            } else {
                echo "data: <div class='status-line'><p style='color:green; font-family: Roboto Flex, sans-serif; font-weight:bold;'>WORKING...</p></div>\n\n";
            }
        } catch (mysqli_sql_exception $e) {
            echo "data: <div class='status-line'><p style='color:red; font-family: Roboto Flex, sans-serif; font-weight:bold;'>FAILED...: {$e->getMessage()}</p></div>\n\n";
        } finally {
            if (isset($connection) && $connection instanceof mysqli) {
                $connection->close();
            }
        }
    } elseif ($mode == 'mass') {
        $config = $_POST['massConfig'];
        $lines = explode("\n", $config);

        foreach ($lines as $line) {
            $parts = explode('|', trim($line));
            if (count($parts) == 4) {
                [$host, $user, $password, $database] = $parts;
                try {
                    $connection = new mysqli($host, $user, $password, $database);

                    if ($connection->connect_error) {
                        echo "data: <div class='status-line'><p style='color:red; font-family: Roboto Flex, sans-serif; font-weight:bold;'>$host|$database: FAILED...</p></div>\n\n";
                    } else {
                        echo "data: <div class='status-line'><p style='color:green; font-family: Roboto Flex, sans-serif; font-weight:bold;'>$host|$database: WORKING...</p></div>\n\n";
                    }
                } catch (mysqli_sql_exception $e) {
                    echo "data: <div class='status-line'><p style='color:red; font-family: Roboto Flex, sans-serif; font-weight:bold;'>$host|$database: FAILED...: {$e->getMessage()}</p></div>\n\n";
                } finally {
                    if (isset($connection) && $connection instanceof mysqli) {
                        $connection->close();
                    }
                }
                ob_flush();
                flush();
            } else {
                echo "data: <div class='status-line'><p style='color:red; font-family: Roboto Flex, sans-serif; font-weight:bold;'>$line: Invalid format</p></div>\n\n";

                ob_flush();
                flush();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRAYBYTE-DB-CHECK</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Play:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Rubik+Vinyl&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: black;
            color: white;
            font-family: 'Play', sans-serif;
            overflow-y: scroll;
        }
        .container {
            text-align: center;
            padding: 40px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.5);
            max-width: 700px;
            width: 100%;
            margin: 40px auto;
        }
        h1 {
            font-family: 'Rubik Vinyl',  cursive;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
            font-weight: bold;
            text-transform: uppercase;
        }
        .form-group input, .form-group textarea, .form-group select {
            padding: 15px;
            width: 100%;
            max-width: 800px;
            border: 2px solid white;
            background-color: black;
            color: white;
            border-radius: 5px;
        }
        .button-group button {
            padding: 15px 30px;
            margin: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            font-weight: bold;
            font-family: 'Play', sans-serif;
            text-transform: uppercase;
        }
        .check {
            background-color: green;
            color: white;
        }
        .reload {
            background-color: red;
            color: white;
        }
        .status-line {
            border: 1px solid white;
            width: 700px;
            max-width: 90%;
            margin: 0 auto 15px auto;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="inner-container">
            <h1>GRAYBYTE DB STATUS CHECKER</h1>
            <form method="POST" onsubmit="return handleSubmit(event)">
                <div id="formContainer">
                    <div class="form-group">
                        <label for="mode">MODE :</label>
                        <select id="mode" name="mode" onchange="toggleMode(this.value)" required>
                            <option value="single">SINGLE CHECK</option>
                            <option value="mass" selected>MASS CHECK</option>
                        </select>
                    </div>
                    <div id="singleMode" style="display: none;">
                        <div class="form-group">
                            <label for="database">DATABASE:</label>
                            <input type="text" id="database" name="database">
                        </div>
                        <div class="form-group">
                            <label for="user">USER:</label>
                            <input type="text" id="user" name="user">
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD:</label>
                            <input type="text" id="password" name="password">
                        </div>
                    </div>
                    <div id="massMode">
                        <div class="form-group">
                            <label for="massConfig">MASS CHECK CONFIG</label> <br>(host|user|password|db)<br>
                            <textarea id="massConfig" name="massConfig" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="check">CHECK</button>
                        <button type="button" class="reload" onclick="location.reload()">RELOAD</button>
                    </div>
                </div>
            </form>
            <div id="statusContainer"></div>
        </div>
    </div>
    <script>
        function toggleMode(mode) {
            const singleMode = document.getElementById('singleMode');
            const massMode = document.getElementById('massMode');
            if (mode === 'single') {
                singleMode.style.display = 'block';
                massMode.style.display = 'none';
            } else {
                singleMode.style.display = 'none';
                massMode.style.display = 'block';
            }
        }

        function handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                const reader = response.body.getReader();
                const decoder = new TextDecoder("utf-8");
                const container = document.getElementById('statusContainer');
                container.innerHTML = "";

                function read() {
                    reader.read().then(({ done, value }) => {
                        if (done) {
                            return;
                        }
                        const text = decoder.decode(value);
                        text.split("\n").forEach(line => {
                            if (line.startsWith("data: ")) {
                                const cleanLine = line.replace("data: ", "").trim();
                                container.innerHTML += cleanLine + "<br>";
                            }
                        });
                        read();
                    });
                }
                read();
            });

            return false;
        }
    </script>
</body>
</html>
