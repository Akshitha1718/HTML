<?php 
include 'includes/header.php'; 

// Sample PHP Array to dynamically generate destination cards
$destinations = [
    [
        "title" => "Amalfi Coast, Italy",
        "category" => "Europe",
        "image" => "https://images.unsplash.com/photo-1533105079780-92b9be482077?w=600&q=80",
        "desc" => "Pastel-colored cliffside villages overlooking dramatic Mediterranean coastline views."
    ],
    [
        "title" => "Swiss Alps, Switzerland",
        "category" => "Adventure",
        "image" => "https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?w=600&q=80",
        "desc" => "Majestic snow-capped mountain peaks perfect for skiing and scenic train journeys."
    ],
    [
        "title" => "Bora Bora, French Polynesia",
        "category" => "Luxury",
        "image" => "https://images.unsplash.com/photo-1512100356356-de1b84283e18?w=600&q=80",
        "desc" => "Overwater bungalows surrounded by brilliant azure lagoons and vibrant coral reefs."
    ],
    [
        "title" => "Marrakech, Morocco",
        "category" => "Exotic",
        "image" => "https://images.unsplash.com/photo-1597212618440-806262de4f6b?w=600&q=80",
        "desc" => "A maze of colorful spice souks, majestic palaces, and vibrant desert landscapes."
    ]
];
?>

<div class="container">
    <h1 class="page-title">Explore All Destinations</h1>
    <p class="page-subtitle">Where will your next adventure take you?</p>

    <div class="grid">
        <?php foreach ($destinations as $dest): ?>
            <article class="card">
                <img src="<?= $dest['image']; ?>" class="card-img" alt="<?= $dest['title']; ?>">
                <div class="card-body">
                    <span class="card-badge"><?= $dest['category']; ?></span>
                    <h3 class="card-title"><?= $dest['title']; ?></h3>
                    <p style="color: var(--text-muted);"><?= $dest['desc']; ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>