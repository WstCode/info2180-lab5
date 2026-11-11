<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

/*Exercise 3 Code
$country = isset($_GET['country']) ? trim($_GET['country']) : '';

$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->execute([':country' => '%' . $country . '%']);
*/

/*Exercise 4 Code*/
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = isset($_GET['country']) ? trim($_GET['country']) : '';

$stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state
                        FROM countries
                        WHERE name LIKE :country");
$stmt->execute([':country' => '%' . $country . '%']);
/*End of E4 Code*/

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (count($results) === 0): /*E4 table Code*/?>
  <p>No countries found.</p>
<?php else: ?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name'] ?? ''); ?></td>
      <td><?= htmlspecialchars($row['continent'] ?? ''); ?></td>
      <td><?= htmlspecialchars($row['independence_year'] ?? ''); ?></td>
      <td><?= htmlspecialchars($row['head_of_state'] ?? ''); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>

<!--
<ul>
<?php foreach ($results as $row): /*Initial Code*/?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
-->