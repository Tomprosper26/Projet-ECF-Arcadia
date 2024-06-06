<?php require "components/header.php"; ?>
<div class="bg-green py-4">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-olive pb-2">Qui Sommes-nous?</h2>
        <p class="col-md-7 col-sm-9 col-xl-7 text-center fs-4 font-roboto text-white">Fondée en 1960, Arcadia est un Parc Zoologique avec plus de <?= $animalcount ?> animaux répartis dans <?= $habitatcount ?> habitats.<br>
            Nos animaux sont notre fiertée et leur bien-être est notre prioritée.</p>
    </div>
    <!-- <div class="row justify-content-center mt-4">
        <div class="col-md-7 col-sm-9 col-xl-6">
            <div id="carouselExampleAutoplaying" class="carousel slide shadow-lg" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="medias/présentation_zoo_1.jpg" class="w-100 rounded" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="medias/présentation_zoo_2.jpg" class="w-100 rounded" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="medias/présentation_zoo_3.jpg" class="w-100 rounded" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<div class="bg-green">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-olive">Découvrez nos Habitats</h2>
    </div>
    <div class="row justify-content-center pt-3">
        <?php foreach ($habitats as $habitat) : ?>
            <?php $image = $images[($habitat['id'] - 1)] ?>
            <div class="col-md-3 col-sm-12 d-flex justify-content-center align-items-center flex-column pt-md-0 pt-sm-3">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($image) ?>" class="rounded shadow-lg border border-3 border-white" style="width: 12rem; height:9rem" alt="image représentant la <?= $habitat['nom'] ?>">
                <h5 class="text-center font-rounded fs-3 text-olive pt-3"><?= $habitat['nom'] ?></h5>
                <p class="text-center font-rounded fs-4 text-brown pt-3"><?= $habitat['description'] ?></p>
            </div>
        <?php endforeach ?>
    </div>
    <div class="d-flex justify-content-center pb-4">
        <a class="btn btn-primary border-0 shadow-lg font-roboto" href="/habitats" style="background-color: #98B06F;">
            Voir tous les Habitats
        </a>
    </div>
</div>

<div class="bg-white">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Les Services du Parc</h2>
    </div>
    <div class="row d-flex justify-content-evenly mt-4">
        <?php foreach ($services as $service) : ?>
            <div class="card p-0 col-md-6 col-sm-12 col-lg-3 shadow-lg" style="width: 20rem;">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($service['image']) ?>" class="card-img-top img-fluid" style="width: 20rem; height:17rem" alt="image de <?= $service['nom'] ?>">
                <div class="card-body">
                    <h3 class="card-title font-rounded fs-5"><p class="text-brown"><?= $service['nom'] ?><p></h3>
                    <p class="card-text font-roboto text-green mb-5"><?= $service['description'] ?><br> Prix : <?php echo ($service['prix'])? $service['prix']." €" : "Gratuit" ?></p>
                    <a href="/services" class="btn btn-primary border-0 shadow-lg position-absolute bottom-0 mb-3" style="background-color: #3A5743;">En savoir plus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require "components/footer.php"; ?>