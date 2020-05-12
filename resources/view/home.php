<h1>Home</h1>

<a href="/about">About</a>
<a href="/contact">Contact</a>
<a href="/sair">Sair</a>

<table>
    <thead>
        <tr>
            <th>nome imagem</th>
            <th>titulo</th>
            <th>resumo</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($key['colunas'] as $k): ?>
            <tr>
                <td><?= $k['nome_imagem'] ?></td>
                <td><?= $k['titulo'] ?></td>
                <td><?= $k['resumo'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
echo $key['setas'];
