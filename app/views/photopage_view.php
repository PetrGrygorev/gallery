<html>
    <head>
        <title>Фотокарточка</title>
    </head>
    <body>
        <div class="container pt-4">
            <div class="row">
                <div class="col-auto mx-auto">
                <h2><a href="/">Вернуться на главную страницу</a></h2>
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
                    <h2>Файл <?php echo $data['imageFileName']; ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <img src="<?php echo 'images'. DIRECTORY_SEPARATOR . $data['imageFileName'] ?>" class="img-thumbnail mb-4"
                    alt="<?php echo $data['imageFileName'] ?>">
                    <h3>Комментарии</h3>
                    <?php if(!empty($data['comments'])): ?>
                        <?php foreach ($data['comments'] as $key => $comment): ?>
                            <?php if($data['cur_author']==$data ['authors'][$key]): ?>
                                <form method="post">
                                    <input type="hidden" name="delete" value="<?php echo $key ?>">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </form>                                   
                            <?php endif; ?>
                        <p class="<?php echo (($key % 2) > 0) ? 'bg-light' : ''; ?>"><?php echo $comment; ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Пока ни одного коммантария, будте первым!</p>
                        <?php endif; ?>

                    <?php if($data['auth'] == true): ?>
                    <!-- Форма добавления комментария -->
                        <form method="post">
                            <div class="form-group">
                                <label for="comment">Ваш комментарий</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </body>
</html>