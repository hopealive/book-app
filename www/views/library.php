<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Greg Zorb <websitegdp@gmail.com>">
    <title>Library</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-2">
            <div class="inner">
                <h3 class="masthead-brand">Book Cafe</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="/">Home</a>
                    <a class="nav-link" href="/library">Library</a>
                    <a class="nav-link" href="#upload">Upload Book</a>
                </nav>
            </div>
        </header>

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger"><?= $errors ?></div>
        <?php endif; ?>

        <section id="library" name="library" class="mb-4">
            <h2>Library</h2>
            <?php if (!$books->count()) : ?>
                <div class="alert alert-warning" role="alert">
                    There is no any book in your library. You can <a href="#upload">upload</a> book.
                </div>
            <?php endif; ?>

            <?php if ($books->count()) : ?>
                <div class="list-group col-md-9">
                    <?php foreach ($books as $item) : ?>
                        <div class="list-group-item list-group-item-action">
                            <a href="/read?id=<?= (int)$item->id ?>">
                                <?= $item->name ?>
                            </a>
                            <span class="alert alert-warning float-right"><?= $item->status ?></span>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <?php if(!empty($book)): ?>
        <section id="reader" name="reader" class="mb-4 bg-light">
            <h2><?= $book->name ?></h2>
        </section>
        <?php endif; ?>

        <section id="upload" name="upload" class="mb-4">
            <h2>Upload Book</h2>
            <h4>(foramts: txt)</h4>
            <form action="/upload" method="POST" enctype="multipart/form-data">
                <input type="file" name="book" class="col-md-6">
                <input class="form-control btn btn-primary col-md-2" type="submit">
            </form>
        </section>

        <footer class="mastfoot mt-auto">
            <div class="inner text-center">
                &copy;<?= date("Y"); ?> Book Cafe
            </div>
        </footer>
    </div>
</body>

</html>