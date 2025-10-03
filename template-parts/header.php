<!DOCTYPE html>

<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta charset="UTF-8" />
    <title><?php
		if(isset($judul_page)) {
			echo $judul_page;
		}
	?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <!-- <link rel="stylesheet" href="stylesheets/style.css"> -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/superfish.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body>
    <div id="page">
        <header class="d-flex flex-wrap justify-content-center p-3 m-1 border-bottom">
            <?php $user_role = get_role(); ?>
            <?php if($user_role == 'admin'): ?>
            <a href="index.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4"><b>SPK PERBANDINGAN SAW & TOPSIS</b></span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active active m-1" aria-current="page" href="list-user.php">List
                        User</a></li>

                <li class="nav-item"><a class="nav-link active m-1" href="list-kriteria.php">List
                        Kriteria</a></li>

                <li class="nav-item"><a class="nav-link active m-1" href="list-karyawan.php">List
                        Karyawan</a></li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  active m-1" href="#" id="dropdown01" data-bs-toggle="dropdown"
                        aria-expanded="false">Rangking</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="ranking-topsis.php">TOPSIS</a></li>
                        <li><a class="dropdown-item" href="ranking-saw.php">SAW</a></li>
                    </ul>
                </li>
                <?php if(isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link active m-1 " aria-current="page" href="logout.php">
                        Log Out</a></li>
                <?php else: ?>
                <li class="nav-item"><a class="nav-link active m-1 " aria-current="page" href="login.php">
                        Log In</a></li>
                <?php endif; ?>
            </ul>
        </header>


        <div id="main">