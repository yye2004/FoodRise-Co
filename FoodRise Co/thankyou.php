

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Donation</title>
    <!-- External CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Lexend+Deca:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <style>
        /* Base styling */
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thank-you-container {
            text-align: center;
            padding: 50px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 2s ease-out;
        }

        .thank-you-container h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-family: 'Lexend Deca', sans-serif;
            color: #D6CF94;
        }

        .thank-you-container p {
            font-size: 20px;
            margin-bottom: 30px;
            color: #fff;
        }

        .thank-you-container .message {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .thank-you-container .amount {
            font-size: 36px;
            font-weight: bold;
            color: #FFD700;
        }

        .thank-you-container i {
            font-size: 50px;
            margin-bottom: 30px;
            color: #FFD700;
            animation: bounce 1.5s infinite;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 40px;
            font-size: 18px;
            background-color: #D6CF94;
            color: #fff;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #4CAF50;
            color: #fff;
        }

        /* Keyframes for animations */
        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
    </style>
</head>
<body>
    <div class="thank-you-container" data-aos="fade-up">
        <i class="fas fa-heart"></i>
        <h1>Thank You !</h1>
        <p class="message">Your donation has been successfully received and pending for approval!</p>
        <p>We appreciate your support in making a difference.</p>
        <a href="index.php" class="back-button">Back to Home</a>
    </div>

    <!-- External JS for animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
