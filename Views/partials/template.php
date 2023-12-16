<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <?php if(!empty($page_css)): ?>
        <?php foreach($page_css as $file_css): ?>
            <link rel="stylesheet" href="<?= URL ?>assets/css/<?= $file_css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <main>
        <?php require_once("Views/partials/header.php") ?>
        <?php
            if(!empty($_SESSION['alert'])) {
                foreach($_SESSION['alert'] as $alert){
                    echo "<div class='alert ". $alert['type'] ."' role='alert'>
                                ".$alert['message']."
                            </div>";
                }
                unset($_SESSION['alert']);
            }
        ?>
        <?= $page_content; ?>
    </main>
    <?php require_once("Views/partials/footer.php") ?>
    <?php if(!empty($page_javascript)) : ?>
        <?php foreach($page_javascript as $file_js) : ?>
            <script src="<?= URL ?>assets/js/<?= $file_js ?>"></script>
        <?php endforeach ?>
    <?php endif; ?>
</body>
</html>