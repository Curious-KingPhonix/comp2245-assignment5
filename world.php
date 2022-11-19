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
$search=strip_tags($_GET['search']);
$sql_results;
$sql_results = $conn->query("SELECT * FROM $table WHERE name LIKE '$search%';");
$sql_results = $sql_results->fetchAll(PDO::FETCH_ASSOC);
?>
<caption>Search by <?=$table;?></caption>
<table>
  <style>
    table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
    table-layout: fixed;
}  
table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: .35em;
  }
  
  table th,
  table td {
    padding: .625em;
    text-align: center;
  }
  
  table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
  }
  </style>
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