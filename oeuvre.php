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
    $artworkStatement = $artworksBDD -> prepare('SELECT * FROM Oeuvres');
    $artworkStatement->execute();
    $artworks = $artworkStatement->fetchAll();
?>
<?php
    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    $displayArtwork = null;

    // On parcourt les oeuvres du tableau afin de rechercher celle qui a l'id précisé dans l'URL
    foreach($artworks as $artwork) {
        // intval permet de transformer l'id de l'URL en un nombre (exemple : "2" devient 2)
        if($artwork['artwork_id'] === intval($_GET['id'])) {
	        $displayArtwork = $artwork;
            break; // On stoppe le foreach si on a trouvé l'oeuvre
        }
    }

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(is_null($artworks)) {
        header('Location: index.php');
    }
?>
<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $displayArtwork['photo_link'] ?>" alt="<?= $displayArtwork['artwork_name'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $displayArtwork['artwork_name'] ?></h1>
        <p class="description"><?= $displayArtwork['author_name'] ?></p>
        <p class="description-complete">
             <?= $displayArtwork['artwork_description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
