<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
/**
 * If we're searching by country then do {
 *  print table with - "Country Name, Continent,Independence Year, Head of State"
 * } else
 * if we're searching by city then do {
 *  If city can be found in country then {
 *  print out all the countries in that city 
 * }
 * } else
 * print "No results"
 */
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$table=$_GET['table'];
$search=strip_tags($_GET['search']) . '%';
if(empty($search)) $search = "_%";
$sql_results;
if($table == 'countries') $sql_results = $conn->query("SELECT * FROM $table WHERE name LIKE '$search';");
elseif($table =='cities')$sql_results = $conn->query("SELECT * FROM $table WHERE district LIKE '$search';");
$sql_results = $sql_results->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if(!empty($sql_results)): ?>
<html>
<?php if($table == 'countries'): ?>
<table>
<caption>Search by <?=$table;?></caption>
<thead>
  <tr>
    <td>Country Name</td>
    <td>Continent</td>
    <td>Independence Year</td>
    <td>Head of State</td>
  </tr>
</thead>
<tbody>
  <?php foreach ($sql_results as $row): ?>
  <tr>
    <td><?=$row['name']?></td>
    <td><?=$row['continent']?></td>
    <td><?=$row['independence_year']?></td>
    <td><?=$row['head_of_state']?></td>
  </tr>
  <?php endforeach;?>
</tbody>
</table>
<?php else: ?>
  <table>
<caption>Search by <?=$table;?></caption>
<thead>
  <tr>
    <td>City Name</td>
    <td>Country Code</td>
    <td>District</td>
    <td>Population</td>
  </tr>
</thead>
<tbody>
  <?php foreach ($sql_results as $row): ?>
  <tr>
    <td><?=$row['name']?></td>
    <td><?=$row['country_code']?></td>
    <td><?=$row['district']?></td>
    <td><?=$row['population']?></td>
  </tr>
  <?php endforeach;?>
</tbody>
</table>
<?php endif;?>
</html>
<?php else:?>
<h1 style="align-self:center;">No Results</h1>
<?php endif;?>