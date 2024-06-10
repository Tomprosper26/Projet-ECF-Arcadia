<?php require "components/header.php"; ?>

<div class="bg-olive mb-3 pb-2">
    <div class="row justify-content-center">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Découvrez Tous nos Habitats</h2>
    </div>

    <div class="row justify-content-center my-5">
        <?php foreach ($habitats as $habitat) : ?>
            <div class="card mb-3 p-0 border-0 shadow-lg" style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($habitatImages[$habitat['id']]) ?>" class="card-img-top img-fluid" style="width: 20rem; height:17rem" alt="image de <?= $service['nom'] ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title font-rounded"><p class="text-green fs-3"><?= $habitat['nom'] ?></p></h5>
                            <p class="card-text font-roboto text-green"><?= $habitat['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


<?php require "components/footer.php"; ?>