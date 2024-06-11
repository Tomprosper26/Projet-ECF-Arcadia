<?php require "components/header.php"; ?>

<div class="bg-olive py-3">
    <div class="row justify-content-center mb-5">
        <h2 class="text-center fs-1 font-rounded text-green pt-3">Découvrez Tous nos Habitats</h2>
    </div>
    <div class="p-0">
        <?php foreach ($habitats as $habitat) : ?>
            <a class="btn p-0 d-flex justify-content-center pb-0 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $habitat['id'] ?>" aria-expanded="true">
                <div class="card p-0 border-0 shadow-lg col-xl-6 col-md-8 col-sm-6 m-0" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-4 p-0">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($habitatImages[$habitat['id']]) ?>" class="card-img-top img-fluid rounded" style="width: 100%; height:100%" alt="image représentant la <?= $habitat['nom'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-rounded text-center">
                                    <p class="text-green fs-3"><?= $habitat['nom'] ?></p>
                                </h5>
                                <p class="card-text font-roboto text-green fs-4 text-center"><?= $habitat['description'] ?></p>
                                <p class="card-text font-roboto text-green fs-5 text-center mb-5">Principales Caractéristiques :<br><?= $habitat['commentaire_habitat'] ?></p>
                                <div class="d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="d-flex justify-content-center my-0 py-0 mb-4 p-0 ">
                <div class="collapse col-xl-6 col-md-8 col-sm-6 p-0" id="<?= $habitat['id'] ?>">
                    <div class="card card-body p-0 border border-0 rounded" style="background-color: #393424;">
                        <div class="d-flex justify-content-evenly row rounded py-3">
                            <?php foreach ($animaldetails as $animal) : ?>
                                <?php if ($habitat['id'] == $animal['habitat_id']) : ?>
                                    <div class="card p-0 col-md-3 col-sm-8 mt-2 mb-2 border border-0 shadow-lg">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($animal['image']) ?>" class="card-img-top" alt="image de <?= $animal['label'] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><?= $animal['prenom'] ?></h5>
                                            <p class="card-text text-center">santé : <?= $animal['etat'] ?></p>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary border border-0" style="background-color: #393424;" data-bs-toggle="modal" data-bs-target="#<?= $animal['prenom'] ?>">
                                                    Voir les détails
                                                </button>
                                            </div>
                                            <div class="modal fade" id="<?= $animal['prenom'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="modal-body">
                                                                <div class="card p-0 mt-2 mb-2 border border-0 shadow-lg">
                                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($animal['image']) ?>" class="card-img-top" alt="image de <?= $animal['label'] ?>">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-center p-0"><?= $animal['prenom'] ?></h5>
                                                                        <p class="card-text text-center p-0">santé : <?= $animal['etat'] ?></p>
                                                                        <p class="card-text text-center p-0">race : <?= $animal['label'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="container row justify-content-center p-3">
                                                            <button type="button" class="btn btn-secondary col-3" data-bs-dismiss="modal">fermé</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require "components/footer.php"; ?>