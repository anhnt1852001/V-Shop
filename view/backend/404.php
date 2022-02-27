<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@900&display=swap" rel="stylesheet">
<style>
  html,
  body {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
  }

  .go_back {
    background-color: #E2623F;
    border-radius: 15px;
    outline: none;
    border: none;
    width: 160px;
    height: 40px;
    position: absolute;
    top: 55%;
    right: 25%;
  }

  .go_back>a {
    text-decoration: none;
    font-size: 1.2rem;
    color: white;
    font-family: 'Sansita Swashed', cursive;
  }

  h3 {
    position: absolute;
    font-family: 'Sansita Swashed', cursive;
    top: 24%;
    right: 27%;
    font-weight: 800;
    color: #EF8B80;
    text-shadow: 5px 5px 10px #EF8B80;
  }

  .error {
    position: absolute;
    font-family: 'Sansita Swashed', cursive;
    top: 30%;
    right: 20%;
    font-size: 1.3rem;
    font-weight: 600;
    color: #EF8B80;
  }
</style>
</head>

<body>
  <button class="go_back"><a href="<?= BASE_URL ?>/?module=backend">Go Back</a></button>
  <h3>Whoops!</h3>
  <p class="error">
    <?php echo $_GET['error'] ?>
  </p>
  <img src="https://f22-zpc.zdn.vn/1773910261553658409/184aac3d10f1e1afb8e0.jpg" width="100%" alt="">