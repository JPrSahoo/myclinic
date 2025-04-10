<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drsatyagastro</title>
    <link rel="icon" type="image/png" href="<?= base_url("assets/images/favicon.ico") ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            /*background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('assets/images/bg.png');*/
            background-image: url('assets/images/bg.jpg');
            background-color: #193236;
            background-repeat: repeat;
            background-position: 0 0;
            background-size: contain;
        }
        .error{
            color: #ff0e0e;
            font-size: 12px;
            display: block;
            margin-top: 5px;
            font-weight: 600;
        }
        header, footer {
            width: 100%;
            background: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
        }

        header {
            top: 0;
            /* display: flex;
            align-items: center;
            justify-content: center; */
        }
        .brand {
            display: flex;
            align-items: center;
            margin-left: 60px;
        }
        header .logo{
            width: 80px;
            height: 80px;
            border: 1px solid;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #00c2ff;
        }
        header .logo-2 {
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        header img {
            height: 100%;
        }
        
        .logo-title{
            margin-left:15px;
            text-align:left;
        }
        .logo-title h1{
            font-size:20px;
        }
        .logo-title h2{
            font-size:14px;
            margin:0;
        }

        footer {
            bottom: 0;
        }

        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            width: 300px;
            text-align: center;
            /* margin-top: 60px; */
            /* overflow: hidden; */
            position: relative;
        }

        .form-container {
            width: 100%;
            position: relative;
        }

        .form-section {
            width: 100%;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        #otp-section {
            display: none;
            opacity: 0;
            transform: translateX(100%);
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .otp-btn, .login-btn, .resend-btn {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .otp-btn:hover, .login-btn:hover, .resend-btn:hover {
            background: #0056b3;
        }

        @keyframes move-right {
            0% {
            background-position: 0 0;
            background-size: 0 100%;
            }
            25% {
            background-position: 0 0;
            background-size: 25% 100%;
            }
            75% {
            background-position: 100% 0;
            background-size: 25% 100%;
            }
            100% {
            background-position: 100% 0;
            background-size: 0 100%;
            }
        }
        .progress_indicator {
            width: 100%;
            height: 2px;
            background-color: rgb(255 254 242);
            background-image: linear-gradient(90deg, #F44336 100%, transparent 100%);
            background-repeat: no-repeat;
            background-position: 100% 0;
            display: none;
            position: fixed;
            top: 100px;
            animation: move-right 2s linear infinite;
        }
        @media (max-width: 425px){
            .brand{
                margin-left: 15px;
            }
        }

    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo-2">
                <img src="<?= base_url("assets/images/logo-transparent.png") ?>" alt="Logo">
            </div>
            <!-- <div class="logo-title">
                <h1 class="pgtitle">Dr Satya's Liver & Gastro Care</h1>
            </div> -->
        </div>
        <!-- <h1>SNBNCBS, Kolkata</h1> -->
    </header>
    <div class="progress_indicator"></div>
    
    <div class="login-container">
        <div class="form-container" id="form-container">
            <form action="otp_verify.php" method="POST" class="form-section" onsubmit="return false;">
                <!-- <img src="logo.png" alt="Logo" style="height: 50px; position: absolute; top: -44px; left: 113px;"> -->
                <h2>Login</h2>
                <div id="email-section">
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                        <span id="email-error" class="error"></span>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <span id="password-error" class="error"></span>
                    </div>

                    <button type="submit" name="send_otp" class="otp-btn">Submit</button>
                </div>

            </form>
        </div>
    </div>
    <p id="otp_msg" style="color: #fff; width: 100%; text-align: center; margin-top: 8px; display:none;">An OTP has been sent to your email.</p>
    
    <footer>
        <p>&copy; 2025 Dr Satya Gastro. All rights reserved.</p>
    </footer>
</body>
</html>

