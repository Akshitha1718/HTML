<?php
// Initialize notification variables
$message = "";
$status = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $role     = htmlspecialchars($_POST['role']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Server-side Validation
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        $message = "All fields are required!";
        $status = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $status = "error";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match!";
        $status = "error";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters long.";
        $status = "error";
    } else {
        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        /* 
           DATABASE INSERTION PLACEHOLDER
           Here you can execute your PDO / MySQLi query to save $username, $email, $role, $hashed_password
        */

        $message = "Registration successful! Welcome, " . $username . ".";
        $status = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Glassmorphism Registration Form</title>
    <style>
        :root {
            --primary: #6c5ce7;
            --primary-hover: #5b4bc4;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.18);
            --text-light: #ffffff;
            --text-muted: #b3b3b3;
            --error-color: #ff7675;
            --success-color: #55efc4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f0c20;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient background glow elements */
        .ambient-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: #6c5ce7;
            top: 10%;
            left: 15%;
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            background: #fd79a8;
            bottom: 10%;
            right: 15%;
        }

        /* Glassmorphism Wrapper */
        .registration-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
            padding: 40px 30px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            color: var(--text-light);
        }

        .card-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .card-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Server Alert Messages */
        .alert {
            padding: 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert.error {
            background: rgba(255, 118, 117, 0.2);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        .alert.success {
            background: rgba(85, 239, 196, 0.2);
            border: 1px solid var(--success-color);
            color: var(--success-color);
        }

        /* Input Controls */
        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            color: var(--text-light);
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group select option {
            background: #1e1b38;
            color: var(--text-light);
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(108, 92, 231, 0.4);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Password Strength Meter */
        .strength-meter {
            height: 4px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            margin-top: 6px;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        /* Toggle Password Button */
        .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 0.8rem;
            color: var(--text-muted);
            user-select: none;
        }

        .toggle-btn:hover {
            color: var(--text-light);
        }

        /* Checkbox Styling */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 22px;
        }

        .checkbox-group input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Footer Link */
        .card-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .card-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Ambient background light circles -->
    <div class="ambient-circle circle-1"></div>
    <div class="ambient-circle circle-2"></div>

    <div class="registration-card">
        <div class="card-header">
            <h2>Create Account</h2>
            <p>Join our platform today</p>
        </div>

        <!-- PHP Alert Output -->
        <?php if (!empty($message)): ?>
            <div class="alert <?php echo $status; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" id="username" name="username" placeholder="Alex Morgan" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="alex@example.com" required>
            </div>

            <!-- Role Dropdown -->
            <div class="form-group">
                <label for="role">Account Type</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="Developer">Developer</option>
                    <option value="Designer">Designer</option>
                    <option value="Manager">Manager</option>
                </select>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="••••••••" required oninput="checkStrength(this.value)">
                    <span class="toggle-btn" onclick="togglePassword('password', this)">Show</span>
                </div>
                <div class="strength-meter">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                    <span class="toggle-btn" onclick="togglePassword('confirm_password', this)">Show</span>
                </div>
            </div>

            <!-- Terms & Conditions -->
            <div class="checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the Terms of Service & Privacy Policy</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">Register Account</button>
        </form>

        <div class="card-footer">
            Already have an account? <a href="#">Sign In</a>
        </div>
    </div>

    <!-- Client-side Interactive Script -->
    <script>
        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'Hide';
            } else {
                input.type = 'password';
                btn.textContent = 'Show';
            }
        }

        // Live Password Strength Indicator
        function checkStrength(val) {
            const bar = document.getElementById('strengthBar');
            let score = 0;

            if (val.length >= 8) score++;
            if (val.match(/[a-z]/) && val.match(/[A-Z]/)) score++;
            if (val.match(/[0-9]/)) score++;
            if (val.match(/[^a-zA-Z0-9]/)) score++;

            switch (score) {
                case 0:
                    bar.style.width = '0%';
                    bar.style.backgroundColor = 'transparent';
                    break;
                case 1:
                    bar.style.width = '25%';
                    bar.style.backgroundColor = '#ff7675';
                    break;
                case 2:
                    bar.style.width = '50%';
                    bar.style.backgroundColor = '#ffeaa7';
                    break;
                case 3:
                    bar.style.width = '75%';
                    bar.style.backgroundColor = '#74b9ff';
                    break;
                case 4:
                    bar.style.width = '100%';
                    bar.style.backgroundColor = '#55efc4';
                    break;
            }
        }
    </script>
</body>
</html>