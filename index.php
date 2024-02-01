<?php
    require 'header.php';
    require 'oeuvres.php';
?>

<?php
    try{
        $artworksBDD = new PDO('mysql:host=projet_4_Php_db;dbname=coursPhp;charset=utf8mb4', 'root', 'root');
    }catch (Exception $e){
        die('Erreur: ' . $e->getMessage());
    }
?>
<?php
    $artworkStatement = $artworksBDD->prepare('SELECT * FROM Oeuvres');
    $artworkStatement->execute();
    $artworks = $artworkStatement->fetchAll();
?>

<div id="liste-oeuvres">
    <?php foreach($artworks as $artwork): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $artwork['artwork_id'] ?>">
                <img src="<?= $artwork['photo_link'] ?>" alt="<?= $artwork['artwork_name'] ?>">
                <h2><?= $artwork['artwork_name'] ?></h2>
                <p class="description"><?= $artwork['author_name'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
