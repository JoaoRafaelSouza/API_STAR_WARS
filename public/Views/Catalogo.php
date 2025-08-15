<section class="container my-5">
    <h2 class="text-center mb-4">Catálogo de Filmes</h2>
    <div class="row">
        <?php foreach ($filmes as $f): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm" style="background-color: #ffffff;">
                    <div class="card-body">
                        <h5 class="card-title  text-dark"><?= $f->nome ?></h5>
                        <p class=" text-dark">Data de lançamento: <?= date('d/m/Y', strtotime($f->data_lancamento)) ?></p>
                        <a href="index.php?rota=detalhes&id=<?= $f->id ?>" class="btn btn-primary">Ver
                            Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>