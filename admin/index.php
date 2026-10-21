
<?php


require_once __DIR__ . "/../config/database.php";


$stmt = $pdo->prepare("
    SELECT
        publication_id,
        title,
        authors,
        abstract,
        department,
        publication_year
    FROM publications
    WHERE status = 'published'
    ORDER BY created_at DESC, publication_id DESC
");

$stmt->execute();

$publications = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>TU-Pub | Research Repository</title>

    <link rel="stylesheet" href="/TU-Pub/assets/css/style.css">
    <script src="/TU-Pub/assets/js/script.js" defer></script>
</head>
<body>

    <!-- NAVIGATION -->
    <header class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo">
                <span class="logo-icon">🎓</span>
                TU-Pub
            </a>

            <nav class="nav-links">
                <a href="index.php" class="active">Home</a>
                <a href="#publications">Browse Research</a>
                <a href="#about">About</a>
                <a href="admin/login.php" class="admin-link">
                    Admin Login
                </a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="container hero-content">
            <p class="eyebrow">TUP Research Repository</p>

            <h1>Discover Academic Research</h1>

            <p class="hero-description">
                Explore thesis and research publications
                from the Technological University
                of the Philippines.
            </p>

            <div class="search-box">
                <input
                    type="search"
                    id="searchInput"
                    placeholder="Search by title, author, or keyword..."
                    aria-label="Search research publications"
                >

                <button type="button" id="searchBtn">
                    Search
                </button>
            </div>
        </div>
    </section>

    <!-- PUBLICATIONS -->
    <main>
        <section class="publications container"
                 id="publications">

            <div class="section-heading">
                <div>
                    <p class="eyebrow dark">Research Library</p>
                    <h2>Browse Publications</h2>
                    <p>Discover research across departments.</p>
                </div>

                <span id="resultCount"></span>
            </div>

            <div class="filters">
                <button class="filter-btn active"
                        data-filter="all">All</button>

                <button class="filter-btn"
                        data-filter="Information Technology">
                    Information Technology
                </button>

                <button class="filter-btn"
                        data-filter="Computer Engineering">
                    Computer Engineering
                </button>

                <button class="filter-btn"
                        data-filter="Mechanical Engineering">
                    Mechanical Engineering
                </button>
            </div>

            
<div class="research-grid" id="researchGrid">

    <?php foreach ($publications as $publication): ?>

        <article
            class="research-card"
            data-department="<?= htmlspecialchars(
                $publication['department'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

            <span class="card-tag">
                <?= htmlspecialchars(
                    $publication['department']
                ) ?>
            </span>

            <h3>
                <?= htmlspecialchars(
                    $publication['title']
                ) ?>
            </h3>

            <p class="description">
                <?= htmlspecialchars(
                    mb_strimwidth(
                        $publication['abstract'],
                        0,
                        150,
                        "..."
                    )
                ) ?>
            </p>

            <div class="card-meta">
                <span>
                    Author:
                    <?= htmlspecialchars(
                        $publication['authors']
                    ) ?>
                </span>

                <span>
                    Year:
                    <?= htmlspecialchars(
                        (string) $publication['publication_year']
                    ) ?>
                </span>
            </div>

            <span class="card-footer">
                Published Research
            </span>

        </article>

    <?php endforeach; ?>

</div>


            <p id="noResults" class="no-results" hidden>
                No publications found. Try another search.
            </p>

        </section>

        <section class="about-section" id="about">
            <div class="container">
                <h2>About TU-Pub</h2>
                <p>
                    TU-Pub is a prototype academic research
                    repository designed to organize and
                    improve access to thesis and research
                    publication records.
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>© 2026 TU-Pub | Academic Repository Prototype</p>
        </div>
    </footer>

</body>
</html>
