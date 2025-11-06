<?= $header; ?>

<style>
  /* 🎨 Estilos generales */
  body {
    background-color: #fff8f6;
  }

  h2, h4 {
    font-family: 'Poppins', sans-serif;
  }

  /* 🌈 Tarjetas de restaurantes */
  .card {
    border: none;
    border-radius: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
  }

  /* 🔍 Filtro */
  .filter-section {
    background: linear-gradient(90deg, #dc3545, #ff6b6b);
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 50px;
    color: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }

  .filter-select {
    border-radius: 10px;
    padding: 10px;
    font-size: 1.1rem;
    border: none;
    width: 100%;
    box-shadow: 0 3px 5px rgba(0,0,0,0.1);
  }

  /* 🧭 Enlaces de navegación */
  .category-title {
    scroll-margin-top: 120px;
  }

  hr {
    border: 1px solid #dc3545;
    width: 80px;
    margin-top: 5px;
    margin-bottom: 25px;
  }

  .text-danger {
    color: #dc3545 !important;
  }
</style>

<div class="container py-5">
  <h2 class="text-center mb-4 text-danger"><b>Directorio Gastronómico - Ruta del Sabor Chincha</b></h2>
  <p class="text-center text-muted mb-5">Explora los mejores restaurantes de la provincia organizados por categoría.</p>

  <?php
  $categorias = [
    "Comida Oriental" => [
      ["nombre" => "OISHI Sushi Bar", "direccion" => "Plaza de Armas #586 - Chincha Alta - Perú", "numero" => "+51 960 484 656"],
      ["nombre" => "Continental Chifa", "direccion" => "Calle Lima #483 - Chincha Alta - Perú", "numero" => "+51 981 215 380"],
      ["nombre" => "Chifa Kin Wa", "direccion" => "Av. Santo Domingo #198 - Chincha Alta - Perú", "numero" => "+51 961 489 194"],
      ["nombre" => "Chifa América Sur", "direccion" => "Av. Luis Gálvez Chipoco #215 - Chincha Alta - Perú", "numero" => "+51 997 553 638"],
      ["nombre" => "Chifa El Dragón", "direccion" => "Tupac Amaru #123 - Chincha Alta - Perú", "numero" => "+51 906 137 336"],
      ["nombre" => "Chifa Oriental", "direccion" => "Calle Lima #451 - Chincha Alta - Perú", "numero" => "Desconocido"],
    ],

    "Pescados y Mariscos" => [
      ["nombre" => "El Punto Marino", "direccion" => "Jr. Sebastián Barranca 551 Pueblo Nuevo - Chincha Alta - Perú", "numero" => "+51 978 085 372"],
      ["nombre" => "Restaurant Patiño", "direccion" => "Pam. Sur Km. 197 - Chincha Alta - Perú", "numero" => "+51 954 900 901"],
      ["nombre" => "Mi Jato", "direccion" => "1702 Chincha Alta - Perú", "numero" => "+51 901 224 186"],
      ["nombre" => "Mar De Chincha", "direccion" => "BOULEVARD 325. AV SAN MARTIN 325 - Chincha Alta - Perú", "numero" => "+51 914 811 829"],
      ["nombre" => "Cevichería Ñarry's", "direccion" => "Av. Grocio Prado - Pueblo Nuevo - Chincha Alta - Perú", "numero" => "+51 918 374 672"],
      ["nombre" => "El Señor Pescado", "direccion" => "Santo Domingo 300 - Chincha Alta - Perú", "numero" => "+51 991 898 887"],
      ["nombre" => "El Huarique de Tote", "direccion" => "Óscar R. Benavides #1446 - Chincha Alta - Perú", "numero" => "+51 957 537 692"],
    ],

    "Parrillas y Carnes" => [
      ["nombre" => "El Olivar", "direccion" => "AV. 28 de Julio 619 - 702 Grocio Prado - Chincha", "numero" => "+51 949 254 416"],
      ["nombre" => "Corte Taurino", "direccion" => "AV. 28 de Julio 613 - 702 Grocio Prado - Chincha", "numero" => "+51 972 449 181"],
      ["nombre" => "Parrillas La Bajada", "direccion" => "Calle Gerardo Sotelo #238 - Chincha Alta - Chincha", "numero" => "+51 979 634 130"],
      ["nombre" => "La Parrichela", "direccion" => "AV. Víctor Andrés Belaúnde #301 - Pueblo Nuevo - Chincha", "numero" => "+51 987 737 121"],
    ],

    "Hamburgueserías" => [
      ["nombre" => "Susy", "direccion" => "Calle 28 de julio 201", "numero" => "+51 902 676 374"],
      ["nombre" => "Sandwichería Willy", "direccion" => "Plaza de Armas Chincha Alta - Perú", "numero" => "+51 972 733 265"],
      ["nombre" => "La Granja Azul", "direccion" => "Calle Lima 490 - Chincha Alta", "numero" => "+51 907 721 362"],
    ],

    "Comida Criolla" => [
      ["nombre" => "Regional Express", "direccion" => "Panamericana Sur Km 199 #321 - Chincha Alta - Perú", "numero" => "+51 960 680 549"],
      ["nombre" => "Boulevard 325", "direccion" => "Av. San Martín 325 - Chincha Alta - Perú", "numero" => "+51 979 701 618"],
      ["nombre" => "Chanfainita el Torito", "direccion" => "Av. Luis Massaro (frente al colegio comercio)", "numero" => "+51 978 213 227"],
      ["nombre" => "Gato Negro", "direccion" => "Av. Grocio Prado 572 - Chincha Alta - Perú", "numero" => "+51 960 859 107"],
      ["nombre" => "El Batan", "direccion" => "Km. 198.5 Carretera Panamericana Sur Chincha Alta 11702", "numero" => "+51 981 495 314"],
    ],

    "Pizzerías" => [
      ["nombre" => "Don Giusseppi", "direccion" => "Plaza de armas #124 - Chincha Alta - Perú", "numero" => "Desconocido"],
      ["nombre" => "Happy Pizza", "direccion" => "Calle Grau 325, Chincha Alta - Perú", "numero" => "+51 955 173 437"],
      ["nombre" => "La Julita", "direccion" => "Artemio Molina #110 - Chincha Alta - Perú", "numero" => "+51 950 167 906"],
      ["nombre" => "Punto Pizza Perú", "direccion" => "Jiron Los Angeles #218 - Chincha Alta - Perú", "numero" => "Desconocido"],
      ["nombre" => "Choripizza", "direccion" => "AV. Fátima #214 - Chincha Alta - Perú", "numero" => "+51 933 377 119"],
      ["nombre" => "Napo Pizzas", "direccion" => "AV. Fátima #146 - Chincha Alta - Perú", "numero" => "+51 943 689 312"],
    ],

    "Pollerías" => [
      ["nombre" => "Markis", "direccion" => "Calle Plaza de Armas N°524 Chincha Alta - Perú", "numero" => "+51 942 970 786"],
      ["nombre" => "Naoki", "direccion" => "Calle Sto. Domingo 172 11702 Chincha Alta - Perú", "numero" => "+51 946 101 827"],
      ["nombre" => "Willy's", "direccion" => "Plaza de Armas 300 Chincha Alta - Perú", "numero" => "+51 923 362 205"],
      ["nombre" => "D' Pochito", "direccion" => "Av. Víctor Andrés Belaunde #677 - Pueblo Nuevo - Perú", "numero" => "+51 926 804 557"],
      ["nombre" => "Talón Rajao", "direccion" => "Calle Grau 513, Chincha Alta - Perú", "numero" => "+51 990 033 777"],
      ["nombre" => "Mi Balay", "direccion" => "Av. Melchorita - Grocio Prado 512", "numero" => "+51 952 090 603"],
      ["nombre" => "Brig Par", "direccion" => "Calle Jorge Chávez 398 - Chincha Alta - Perú", "numero" => "Desconocido"],
      ["nombre" => "Pollo a la Brasa a leña y Carbón", "direccion" => "Calle Santo Domingo 214 - Chincha Alta", "numero" => "+51 994 127 794"],
      ["nombre" => "Chicharronería Lorena I & II", "direccion" => "Av. Mariscal Benavides Nro. 1030 - Chincha Alta - Perú", "numero" => "+51 912 889 889"],
    ],

    "Café & Pastelería" => [
      ["nombre" => "Batancito", "direccion" => "Calle Miguel Grau Nro. 253 - Chincha Alta - Perú", "numero" => "+51 979 956 344"],
      ["nombre" => "Las Delicias", "direccion" => "Prolongación Colón #718 - Chincha Alta - Perú", "numero" => "+51 972 113 681"],
      ["nombre" => "Nestarez", "direccion" => "AV. Grocio Prado #608 - Pueblo Nuevo - Perú", "numero" => ""],
      ["nombre" => "Pasatel y Café", "direccion" => "AV. Fátima #206 - Chincha Alta - Perú", "numero" => ""],
      ["nombre" => "Pastelería Dely'z", "direccion" => "AV. Oscar Benavides #804 - Chincha Alta - Perú", "numero" => ""],
      ["nombre" => "Raicez", "direccion" => "AV. Fátima #198 - Chincha Alta - Perú", "numero" => "+51 961 709 052"],
      ["nombre" => "Deleite Café", "direccion" => "Giron San Martin de Porres #542 - Chincha Alta - Perú", "numero" => ""],
      ["nombre" => "Luga Luga", "direccion" => "AV. Luis Masarro #202 - Chincha Alta - Perú", "numero" => "+51 941 568 740"],
    ],

    "Huariques y otros" => [
      ["nombre" => "El Sótano", "direccion" => "Calle el Carmen #123 - Chincha Alta - Perú", "numero" => "+51 924 632 897"],
      ["nombre" => "Kprichos Argentinos", "direccion" => "Calle Los Ángeles #201 - Chincha Alta - Perú", "numero" => "+51 989 773 599"],
      ["nombre" => "Toro Negro", "direccion" => "Av Pedro Moreno S/N Chincha Alta (frente al campo deportivo el golazo)", "numero" => "+51 982 518 794"],
      ["nombre" => "Terraza 7", "direccion" => "Calle Lima #219 - Chincha Alta - Perú", "numero" => "+51 989 773 599"],
      ["nombre" => "Kero 2.0", "direccion" => "Calle Lima #580 - Chincha Alta - Perú", "numero" => "+51 976 549 273"],
    ]
  ];
  ?>

  <?php foreach ($categorias as $nombre => $lugares): ?>
    <div class="mb-5">
      <h4 class="text-danger"><i class="fa-solid fa-utensils me-2"></i><b><?= $nombre ?></b></h4>
      <hr>
      <div class="row">
        <?php foreach ($lugares as $r): ?>
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title text-dark"><b><?= esc($r['nombre']) ?></b></h5>
                <p class="card-text mb-1"><i class="fa fa-map-marker-alt text-danger me-1"></i> <?= esc($r['direccion']) ?></p>
                <p class="card-text"><i class="fa fa-phone text-success me-1"></i> <?= esc($r['numero']) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?= $footer; ?>