<section class="container my-5">
    <h2><?= $filme->nome ?></h2>
    <ul class="list-group">
        <li class="list-group-item" style="color: black;"><strong>Nº episódio:</strong> <?= $filme->numero_episodio ?>
        </li>
        <li class="list-group-item" style="color: black;"><strong>Sinopse:</strong> <?= $filme->sinopse ?></li>
        <li class="list-group-item" style="color: black;"><strong>Data de lançamento:</strong>
            <?= $filme->data_lancamento ?></li>
        <li class="list-group-item" style="color: black;"><strong>Diretor(a):</strong> <?= $filme->diretor ?></li>
        <li class="list-group-item" style="color: black;"><strong>Produtor(es):</strong> <?= $filme->produtores ?></li>
        <li class="list-group-item" style="color: black;"><strong>Personagens:</strong>
            <?= implode(', ', $filme->personagens) ?></li>
        <li class="list-group-item" style="color: black;"><strong>Idade do filme:</strong> <?= $filme->idade_filme ?>
        </li>
    </ul>
    <a href="index.php" class="btn btn-warning mt-3">Voltar ao catálogo</a>
</section>