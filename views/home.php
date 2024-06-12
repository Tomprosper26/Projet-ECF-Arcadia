<?php require "components/header.php"; ?>

<div class="bg-green py-4">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-olive pb-2">Qui Sommes-nous?</h2>
        <p class="col-md-7 col-sm-9 col-xl-7 text-center fs-4 font-roboto text-white">Fondée en 1960, Arcadia est un Parc Zoologique avec plus de <?= $animalcount ?> animaux répartis dans <?= $habitatcount ?> habitats.<br>
            Nos animaux sont notre fiertée et leur bien-être est notre prioritée.</p>
    </div>
</div>
<div class="bg-green">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-olive">Découvrez nos Habitats</h2>
    </div>
    <div class="row justify-content-center pt-3">
        <?php foreach ($habitats as $habitat) : ?>
            <?php $image = $images[($habitat['id'] - 1)] ?>
            <div class="col-md-6 col-sm-12 col-xl-3 d-flex justify-content-center align-items-center flex-column pt-md-0 pt-sm-3">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image) ?>" class="rounded shadow-lg mb-3" style="width: 15rem; height:12rem" alt="image représentant la <?= $habitat['nom'] ?>">
                <h5 class="text-center font-rounded fs-3 text-olive pt-3"><?= $habitat['nom'] ?></h5>
                <p class="text-center font-rounded fs-4 text-brown"><?= $habitat['description'] ?></p>
            </div>
        <?php endforeach ?>
    </div>
    <div class="d-flex justify-content-center pb-4">
        <a class="btn btn-primary border-0 shadow-lg mt-3 mb-2" href="/habitats" style="background-color: #98B06F;">
            <h3 class="text-center pt-2 fs-4 font-roboto">Voir tous les Habitats</h3>
        </a>
    </div>
</div>

<div class="bg-white mb-3 pb-2">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Les Services du Parc</h2>
    </div>
    <div class="row d-flex justify-content-evenly my-4">
        <?php foreach ($services as $service) : ?>
            <div class="card p-0 col-md-6 col-sm-12 col-lg-3 mt-sm-3 shadow-lg" style="width: 20rem;">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($service['image']) ?>" class="card-img-top img-fluid" style="width: 20rem; height:17rem" alt="image de <?= $service['nom'] ?>">
                <div class="card-body">
                    <h3 class="card-title font-rounded fs-5">
                        <p class="text-brown"><?= $service['nom'] ?>
                        <p>
                    </h3>
                    <p class="card-text font-roboto text-green mb-5"><?= $service['description'] ?><br> Prix : <?php echo ($service['prix']) ? $service['prix'] . " €" : "Gratuit" ?></p>
                    <a href="/services" class="btn btn-primary border-0 shadow-lg position-absolute bottom-0 mb-3" style="background-color: #3A5743;">En savoir plus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<div class="bg-olive mt-3 pt-3 row justify-content-center">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Les Avis de nos visteurs</h2>
    </div>
    <div class="row col-md-6 col-sm-10 col-xl-4 d-flex justify-content-evenly py-3">
        <ol class="list-group">
            <?php foreach ($avis as $avi) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?= $avi['pseudo'] ?></div>
                        <?= $avi['commentaire'] ?>
                    </div>
                </li>
            <?php endforeach ?>
        </ol>
    </div> 
    <div class="d-flex justify-content-center">
        <a href="/avis" class="btn btn-primary border-0 shadow-lg mb-4" style="background-color: #3A5743;">Laissez-nous votre Avis</a>
    </div>
</div>

<?php require "components/footer.php"; ?>