<html>
    <head>
        <title>Галлерея</title>
    </head>
    <body>
        <div class="row">
            <div class="col-auto mx-auto"> 
                <h2>Добро пожаловать!</h2>
            </div>
        </div>

        <?php if($data['auth'] == false): ?>
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h4> Для работы с галлереей авторизуйтесь или зарегистрируйтесь </h4>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        <div class="p-3 bg-light border"> 
                            <a href="/author">Авторизация</a> 
                        </div> 
                    </div>
                    <div class="col-md-auto">
                        <div class="p-3 bg-light border"> 
                            <a href="/register">Регистрация</a>  
                        </div>
                    </div>
                 </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h2>Вы вошли как <?php echo $_COOKIE['login']?> </h2>
                </div>
            </div>
        <?php endif; ?>

        <div class="container pt-4">
            <div class="row">
                <div class="col-auto mx-auto">
                    <h2 class="mb-4"><a href="<?php echo 'http:\\' ?>">Галерея изображений</a></h2>
                </div>
            </div>

            <!-- Вывод сообщений об успехе/ошибке -->
            <?php foreach ($data['errors'] as $error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>

            <?php foreach ($data['messages'] as $message): ?>
                <div class="alert alert-success">
                    <?php echo $message; ?>
                </div>
            <?php endforeach; ?>

            <div class="row">
                <div class="col-auto mx-auto">
                    <h2>Список файлов</h2>
                </div>
            </div>

            <!-- Вывод изображений -->
            <div class="mb-4">
                <?php if (!empty($data['files'])): ?>
                    <div class="row">
                        <?php foreach ($data['files'] as $file): ?>
                            <div class="col-12 col-sm-3 mb-4">
                                <?php if($data['auth'] == true): ?>
                                    <form method="post">
                                        <input type="hidden" name="name" value="<?php echo $file; ?>">
                                        <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                    <form action="/photopage" method="post">
                                        <a href="javascript:;" onclick="parentNode.submit();">
                                        <img src="images/<?php echo $file ?>" class="img-thumbnail" >               
                                        </a>
                                    <input type="hidden" name="name" value="<?php echo $file ?>">
                                    </form>
                            </div>
                        <?php endforeach; ?>  
                    </div><!-- /.row -->
                <?php else: ?>
                    <div class="alert alert-secondary">
                        Нет загруженных изображений
                    </div>
                <?php endif; ?>
            </div>

            <!-- Форма загрузки файлов -->
            <?php if($data['auth'] == true): ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="files[]" id="customFile" multiple required>
                        <label class="custom-file-label" for="customFile" data-browse="Выбрать">Выберите файлы</label>
                        <small class="form-text text-muted">
                            Максимальный размер файла: <?php echo UPLOAD_MAX_SIZE / 1000000; ?>Мб.
                            Допустимые форматы: <?php echo implode(', ', ALLOWED_TYPES) ?>.
                        </small>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Загрузить</button>
                </form>
        </div><!-- /.container -->

        <div class="row">
            <div class="col-auto mx-auto">    
                <div class="p-3 bg-light border"> 
                    <a href="/logout">Выход</a>  
                </div>
            </div>
        </div>
            <?php endif; ?>
    </body>
</html>