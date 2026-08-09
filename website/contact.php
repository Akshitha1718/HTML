<?php 
include 'includes/header.php'; 

$msg = "";
$msg_class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $destination = htmlspecialchars(trim($_POST['destination']));

    if (!empty($name) && !empty($email) && !empty($destination)) {
        $msg = "Thank you, $name! Our trip concierge will send an itinerary for $destination to $email shortly.";
        $msg_class = "alert-success";
    } else {
        $msg = "Please fill in all required fields.";
        $msg_class = "alert-error";
    }
}
?>

<div class="container">
    <h1 class="page-title">Plan Your Custom Trip</h1>
    <p class="page-subtitle">Let our travel specialists curate your tailored itinerary</p>

    <div class="form-card">
        <?php if (!empty($msg)): ?>
            <div class="alert <?= $msg_class; ?>">
                <?= $msg; ?>
            </div>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Jane Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="jane@example.com" required>
            </div>

            <div class="form-group">
                <label for="destination">Preferred Destination</label>
                <select id="destination" name="destination" class="form-control" required>
                    <option value="" disabled selected>Select a destination</option>
                    <option value="Bali, Indonesia">Bali, Indonesia</option>
                    <option value="Santorini, Greece">Santorini, Greece</option>
                    <option value="Kyoto, Japan">Kyoto, Japan</option>
                    <option value="Swiss Alps">Swiss Alps</option>
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Special Requirements / Trip Length</label>
                <textarea id="notes" name="notes" class="form-control" rows="4" placeholder="Mention preferred travel dates, budget, or dietary needs..."></textarea>
            </div>

            <button type="submit" class="btn" style="width: 100%;">Send Trip Request</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>