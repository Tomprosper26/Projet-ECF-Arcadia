<?php require "components/header.php"; ?>

<div class="bg-olive mb-3 pb-2">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Les Services du Parc</h2>
    </div>
    <div class="d-md-none">
        <div class="row justify-content-center my-4 col-12">
            <?php foreach ($services as $service) : ?>
                <div class="card p-0 col-md-6 col-sm-12 col-lg-3 mt-sm-3 border-0" style="width: 20rem;">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($service['image']) ?>" class="card-img-top img-fluid" style="width: 20rem; height:17rem" alt="image de <?= $service['nom'] ?>">
                    <div class="card-body">
                        <h3 class="card-title font-rounded fs-5">
                            <p class="text-brown"><?= $service['nom'] ?><p>
                        </h3>
                        <p class="card-text font-roboto text-green mb-5"><?= $service['description'] ?><br> Prix : <?php echo ($service['prix']) ? $service['prix'] . " €" : "Gratuit" ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="d-sm-none d-md-block">
        <div class="row justify-content-center my-5">
            <?php foreach ($services as $service) : ?>
                <div class="card mb-3 p-0 border-0 shadow-lg" style="max-width: 1000px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($service['image']) ?>" class="card-img-top img-fluid rounded" style="width: 20rem; height:17rem" alt="image de <?= $service['nom'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-rounded"><p class="text-green fs-3"><?= $service['nom'] ?></p></h5>
                                <p class="card-text font-roboto text-green"><?= $service['description'] ?></p>
                                <p class="card-text text-green">Prix : <?php echo ($service['prix']) ? $service['prix'] . " €" : "Gratuit" ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php require "components/footer.php"; ?>