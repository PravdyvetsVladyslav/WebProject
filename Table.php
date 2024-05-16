<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faceit Stats</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000000;
        }

        th, td {
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .edit-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .reset-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Faceit Stats</h1>
    <table id="statsTable">
        <tr>
            <th>
                Level
                <button class="edit-btn" onclick="sortTable(0)">✎</button>
            </th>
            <th>
                K/D
                <button class="edit-btn" onclick="sortTable(1)">✎</button>
            </th>
            <th>
                K/R
                <button class="edit-btn" onclick="sortTable(2)">✎</button>
            </th>
            <th>
                Elo
                <button class="edit-btn" onclick="sortTable(3)">✎</button>
            </th>
            <th>
                Headshot %
                <button class="edit-btn" onclick="sortTable(4)">✎</button>
            </th>
            <th>
                MVP
                <button class="edit-btn" onclick="sortTable(5)">✎</button>
            </th>
        </tr>
        <?php
        function generateElo($level) {
            switch ($level) {
                case 1:
                    return rand(100, 800);
                case 10:
                    return rand(2000, 2500);
                default:
                    return rand(100 * $level + 10, 150 * $level + 50);
            }
        }

        // Генерація випадкових даних для таблиці
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>" . rand(0, 3) . "." . rand(0, 99) . "</td>";
            echo "<td>" . rand(0, 3) . "." . rand(0, 99) . "</td>";
            echo "<td>" . generateElo($i) . "</td>";
            echo "<td>" . rand(20, 50) . "%</td>";
            echo "<td>" . rand(0, 50) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <button class="reset-btn" onclick="resetTable()">Скинути сортування</button>
</div>

<script>
    var originalOrder = [];

    // Збереження первинного порядку рядків
    var table = document.getElementById("statsTable");
    var rows = table.rows;
    for (var i = 1; i < rows.length; i++) {
        originalOrder.push(rows[i]);
    }

    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("statsTable");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = parseFloat(rows[i].getElementsByTagName("td")[columnIndex].innerText);
                y = parseFloat(rows[i + 1].getElementsByTagName("td")[columnIndex].innerText);
                if (x > y) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    function resetTable() {
        var table = document.getElementById("statsTable");
        var tbody = table.getElementsByTagName('tbody')[0];
        // Відновлення первинного порядку рядків
        originalOrder.forEach(function(row) {
            tbody.appendChild(row);
        });
    }
</script>
</body>
</html>
