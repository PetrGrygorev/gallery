<html>
    <head>
        <title>Авторизация</title>
    </head>
    <body>
        <div class="container pt-4">
            <div class="row">
                <div class="col-auto mx-auto">
                    <h2 class="mb-4"><a href="<?php echo 'http:\\' ?>">Вернуться на главную страницу</a></h2>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                     <div class="col-4">
                        <form method="POST">
                            <div class="form-group">
                                <label for="name">Логин</label>
                                <input type="text" class="form-control" name="login" placeholder="Логин" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary">Войти</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach ($data['errors'] as $error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

            <small class="form-text text-muted">
                <div class="row">
                    <div class="col-auto mx-auto"> 
                            Если БД импортирована из проекта:
                           <br> Login: admin    password: admin 
                           <br> Login: igor     password: igor  
                    </div>
                </div>
            </small>
    </body>
</html>