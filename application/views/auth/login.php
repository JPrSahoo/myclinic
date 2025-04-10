<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drsatyagastro</title>
    <link rel="icon" type="image/png" href="<?= base_url("assets/images/favicon.ico") ?>">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('<?= base_url() ?>assets/images/reception-bg.png') no-repeat center center fixed;
        background-size: cover;
    }


    header {
        background-color: #3f51b5;
        color: white;
        padding: 5px 40px;
        text-align: center;
        display: flex;
    }

    header .brand {
      height: 80px;
    }
    img{
        width: 100%;
        height: 100%;
    }

    .content {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 175px);
    }

    .login-box {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-box button {
      width: 100%;
      padding: 10px;
      background-color: #3f51b5;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .login-box button:hover {
      background-color: #303f9f;
    }

    footer {
      background-color: #303f9f;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #fff;
    }
    .overlay {
        background-color: rgb(57 52 52 / 85%);
        min-height: 100vh;
    }

  </style>
</head>
<body>
  <div class="overlay">
    <header>
      <div class="brand">
        <img src="<?= base_url() ?>assets/images/logo-transparent.png" alt="Clinic Logo">
      </div>
      <!-- <div style="flex-grow: 1; display: flex; align-items: center; justify-content: center;">
        <h1 style="margin: 0; color: white;">Clinic Management System</h1>
      </div> -->
    </header>

    <div class="content">
      <div class="login-box">
        <h2>Login</h2>
        <form action="<?= site_url('auth/login') ?>" method="post">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
        </form>
      </div>
    </div>

    <footer>
        <p>&copy; 2025 Dr Satya Gastro. All rights reserved.</p>
    </footer>
  </div>
</body>

</html>