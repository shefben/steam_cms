<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteamCMS Admin Login</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }
        
        .login-form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .steam-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #2c3e50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" class="login-form">
            <div class="login-header">
                <div class="steam-logo">CMS</div>
                <h1>SteamCMS Admin</h1>
                <p>Sign in to manage your Steam era content</p>
            </div>
            
            <?php if (isset($login_error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($login_error) ?>
                </div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-large" style="width: 100%;">
                    Sign In
                </button>
            </div>
            
            <div style="text-align: center; margin-top: 20px; font-size: 12px; color: #7f8c8d;">
                <p>Default credentials: admin / steamcms</p>
            </div>
        </form>
    </div>
</body>
</html>
