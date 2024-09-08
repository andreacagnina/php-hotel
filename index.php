<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$filteredHotels = $hotels;

if (isset($_GET['parking']) && $_GET['parking'] !== '') {
    $tempHotels = [];

    foreach ($hotels as $hotel) {
        if ($_GET['parking'] == $hotel['parking']) {
            $tempHotels[] = $hotel;
        }
    }
    $filteredHotels = $tempHotels;
}
if (isset($_GET['vote']) && $_GET['vote'] !== '') {
    $tempHotels = [];

    foreach ($filteredHotels as $hotel) {
        if ($_GET['vote'] <= $hotel['vote']) {
            $tempHotels[] = $hotel;
        }
    }
    $filteredHotels = $tempHotels;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Hotel</title>
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content my-5">
                        <form action="./index.php" method="get">
                            <div class="row">
                                <div class="col-4">
                                    <select name="parking" id="parking" class="form-select">
                                        <option value="">Mostra tutti</option>
                                        <option value="0" <?php echo (isset($_GET['parking']) && $_GET['parking'] == 0) ? 'selected' : ''; ?>>No</option>
                                        <option value="1" <?php echo (isset($_GET['parking']) && $_GET['parking'] == 1) ? 'selected' : ''; ?>>Si</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="vote" placeholder="Voto" class="form-control" value="<?php echo $_GET['vote'] ?? '' ?>">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Cerca</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="content text-center">
                        <table class="table table-hover caption-top">
                            <caption>List of Hotels:</caption>
                            <thead>
                                <tr class="table-success">
                                    <?php foreach ($hotels[0] as $index => $x) { ?>
                                        <th scope="col">
                                            <?php echo ucfirst(str_replace('_', ' ', $index,)) ?>
                                        <?php }  ?>
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($filteredHotels as $hotel) { ?>
                                        <td>
                                            <?php echo $hotel['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $hotel['description'] ?>
                                        </td>

                                        <td class="fw-bold <?php echo $hotel['parking'] ? 'text-success' : 'text-danger' ?>">
                                            <?php echo $hotel['parking'] ? 'Incluso' : 'Non Incluso' ?>
                                        </td>

                                        <td>
                                            <?php echo $hotel['vote'] ?> <span>⭐</span>
                                        </td>

                                        <td>
                                            <?php echo $hotel['distance_to_center'] ?> Km
                                        </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- **Bonus:**
    1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
    2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
    NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
    Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.  -->

</body>

</html>