<?php
function sanitize_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// ආරක්ෂාව සඳහා: URL එකෙන් එන ID එක අනිවාර්යයෙන්ම ඉලක්කමක්ද (Integer) කියා පරීක්ෂා කිරීම (Anti-SQL Injection)
$movie_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// දත්ත පද්ධතියකින් තොරව උදාහරණයක් ලෙස චිත්‍රපටය තෝරා ගැනීම
if ($movie_id === 1) {
    $movie = ['title' => 'Squid Game - Season 3', 'desc' => 'The deadly game returns with new players and higher stakes. Hundreds of cash-strapped players accept a strange invitation to compete in children\'s games.', 'year' => '2026', 'genre' => 'Thriller', 'video_url' => 'https://example.com/embed/squid3'];
} else {
    // චිත්‍රපටය සොයාගත නොහැකි නම් මූලික පිටුවට හරවා යැවීම
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo sanitize_output($movie['title']); ?> - Cine World</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #111; color: #fff; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 7%; background: #000; }
        .logo { color: #e50914; font-size: 28px; font-weight: bold; text-decoration: none; }
        .container { padding: 40px 7%; display: flex; flex-direction: column; gap: 30px; }
        .player-container { width: 100%; aspect-ratio: 16/9; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.6); }
        .player-container iframe { width: 100%; height: 100%; border: none; }
        .movie-details h1 { font-size: 36px; margin-bottom: 10px; color: #e50914; }
        .meta-info { margin-bottom: 20px; color: #aaa; font-size: 16px; }
        .description { font-size: 18px; line-height: 1.6; color: #ddd; max-width: 800px; }
        .back-btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 5px; transition: 0.3s; }
        .back-btn:hover { background: #e50914; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Cine World</a>
    </header>

    <div class="container">
        <div class="player-container">
            <iframe src="<?php echo sanitize_output($movie['video_url']); ?>" allowfullscreen></iframe>
        </div>

        <div class="movie-details">
            <h1><?php echo sanitize_output($movie['title']); ?></h1>
            <div class="meta-info">
                <span>Year: <?php echo sanitize_output($movie['year']); ?></span> | 
                <span>Genre: <?php echo sanitize_output($movie['genre']); ?></span>
            </div>
            <p class="description"><?php echo sanitize_output($movie['desc']); ?></p>
            
            <a href="index.php" class="back-btn">← Back to Home</a>
        </div>
    </div>

</body>
</html>
