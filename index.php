<?php
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
	 $pdo = new PDO($dsn, $user, $pass, $options);
	 echo("Verbonden met: " . $db);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$series = $pdo->prepare('SELECT * FROM series');
$series->execute();

$movies = $pdo->prepare('SELECT * FROM movies');
$movies->execute();


function echoSeries($series)
{
    while ($row = $series->fetch(PDO::FETCH_OBJ))
    {
        echo 
        '<tr> ' . 
            '<td>' . $row->title . '</td>' . 
            '<td>' . $row->rating . '</td>' . 
        '</tr>';
    }
}

function echoMovies($movies)
{
    while ($row = $movies->fetch(PDO::FETCH_OBJ))
    {
        echo 
        '<tr>' . 
            '<td>' . $row->title . '</td>' .
            '<td>' . $row->duur . '</td>' .
        '</tr>';
    }
}


?>
<h2>Welkom op Netland</h2>
<table> 
<h3>Series</h3>
    <tr>
        <th>Titel</th>
        <th>Rating</th>
    </tr>
<?php echoSeries($series);?>
</table>

<br>
<br>

<table> 
<h3>Movies</h3>
    <tr>
        <th>Titel</th>
        <th>Duur</th>
    </tr>
<?php echoMovies($movies);?>
</table>