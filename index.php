<?php
// ආරක්ෂාව සඳහා: XSS ප්‍රහාර වැළැක්වීමට දත්ත පිරිසිදු කිරීමේ ශ්‍රිතයක් (Security Function)
function sanitize_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// උදාහරණ චිත්‍රපට දත්ත (පසුව මෙය Database එකකට සම්බන්ධ කළ හැක)
$movies = [
    ['id' => 1, 'title' => 'Squid Game - Season 3', 'image' => 'squid_game.jpg', 'year' => '2026', 'genre' => 'Thriller'],
    ['id' => 2, 'title' => 'Avatar 3', 'image' => 'avatar3.jpg', 'year' => '2025', 'genre' => 'Sci-Fi'],
    ['id' => 3, 'title' => 'The Dark Knight', 'image' => 'dark_knight.jpg', 'year' => '2008', 'genre' => 'Action']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src https://fonts.gstatic.com;">
    <title>Cine World - Stream Your Favorite Movies</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #111; color: #fff; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 7%; background: rgba(0,0,0,0.8); position: sticky; top: 0; z-index: 100; }
        .logo { color: #e50914; font-size: 28px; font-weight: bold; text-decoration: none; }
        .search-box input { padding: 8px 15px; border-radius: 20px; border: none; background: #333; color: #fff; outline: none; }
        .hero { height: 60vh; background: linear-gradient(rgba(0,0,0,0.5), #111), url('hero-bg.jpg') center/cover; display: flex; flex-direction: column; justify-content: center; padding-left: 7%; }
        .hero h1 { font-size: 48px; margin-bottom: 10px; color: #fff; }
        .main-container { padding: 40px 7%; }
        .section-title { font-size: 24px; margin-bottom: 20px; border-left: 4px solid #e50914; padding-left: 10px; }
        .movie-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 25px; }
        .movie-card { background: #222; border-radius: 8px; overflow: hidden; transition: transform 0.3s; cursor: pointer; text-decoration: none; color: white; }
        .movie-card:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(229,9,20,0.2); }
        .movie-img { width: 100%; height: 280px; background: #333; object-fit: cover; }
        .movie-info { padding: 15px; }
        .movie-title { font-size: 16px; font-weight: bold; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .movie-meta { font-size: 13px; color: #aaa; }
        footer { text-align: center; padding: 30px; background: #000; font-size: 14px; color: #666; margin-top: 5px; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Cine World</a>
        <div class="search-box">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search movies..." required>
            </form>
        </div>
    </header>

    <div class="hero">
        <h1>Unlimited Movies & TV Shows</h1>
        <p>Watch anywhere. Cancel anytime.</p>
    </div>

    <div class="main-container">
        <h2 class="section-title">Trending Now</h2>
        <div class="movie-grid">
            <?php foreach ($movies as $movie): ?>
                <a href="movie.php?id=<?php echo urlencode($movie['id']); ?>" class="movie-card">
                    <div class="movie-img" style="background: url('<?php echo sanitize_output($movie['image']); ?>') center/cover;#333;"></div>
                    <div class="movie-info">
                        <div class="movie-title"><?php echo sanitize_output($movie['title']); ?></div>
                        <div class="movie-meta"><?php echo sanitize_output($movie['year']); ?> • <?php echo sanitize_output($movie['genre']); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        &copy; 2026 Cine World. All Rights Reserved.
    </footer>

</body>
</html>
