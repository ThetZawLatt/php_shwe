<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <style>
        body {
            text-align: center;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .button {
            margin: 20px;
            display: inline-block;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from links */
            color: #333; /* Button text color */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }
        .button:hover {
            background-color: #4CAF50; /* Green color on hover */
        }
        .button img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            display: block; /* Center image within button */
            margin: 0 auto; /* Center image horizontally */
        }
        .button span {
            display: block;
            margin-top: 10px; /* Space between image and label */
        }
    </style>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    
    <a href="user_page.php" class="button">
        <img src="user.gif" alt="User">
        <span>User</span>
    </a>
    
    <a href="balance_list_page.php" class="button">
        <img src="balance.gif" alt="Balance">
        <span>Balance</span>
    </a>
    
    <a href="user_balance_topup.php" class="button">
        <img src="topup.gif" alt="Top-up">
        <span>Top-up</span>
    </a>
</body>
</html>
