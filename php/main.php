<h2>PHP System Information</h2>
<table>
<thead>
    <tr>
        <th>Method</th>
        <th>Result</th>
    </tr>
</thead>

<tbody>
    <tr>
        <td>PHP Version</td>
        <td><?php echo phpversion()."<br>"; ?></td>
    </tr>

    <tr>
        <td>Operating System</td>
        <td><?php echo PHP_OS."<br>"; ?></td>
    <tr>
        <td>Host name</td>
        <td><?php echo gethostname()."<br>"; ?></td>
    </tr>

    <tr>
        <td>Version Install</td>
        <td><?php echo php_uname(v)."<br>"; ?></td>
    </tr>

    <tr>
        <td>Machine Type</td>
        <td><?php echo php_uname(m)."<br>"; ?></td>
    </tr>
</tbody>
</table>

<h2>PHP Dynamic Table</h2>
<table class="table2">
<?php



$i = 1;
$j = 1;
$value = 1;

while ($i <= 5) {
    echo "<tr>";
    while ($j <= 5) {
	echo "<td>".$value."</td>";
        $value = $value + 1;
	    $j = $j + 1;
    }
        echo "</tr>";
        $i = $i + 1;
        $j = 1;
    }

?>

</table>




