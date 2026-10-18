<?php
$fp = fopen('employees.csv', 'r') or die('employees.csv not found');
echo '<table border="1" cellpadding="8" style="border-collapse:collapse">';
$first = true;
while (($row = fgetcsv($fp)) !== false) {
    echo '<tr>';
    foreach ($row as $cell) echo ($first ? '<th>' : '<td>') . htmlspecialchars($cell) . ($first ? '</th>' : '</td>');
    echo '</tr>'; $first = false;
}
echo '</table>'; fclose($fp);
