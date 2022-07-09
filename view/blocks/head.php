<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
        $item_id = (int) get('item');
        if ($item_id) { 
        $item = get_item_info(get('item'), true);
        echo escape($item['title']);
     } else {
        echo 'ЭлектроСтрой';
     }?>
    </title>
    <link rel="stylesheet" href="/view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/view/assets/css/style.css">
    <link rel="stylesheet" href="/vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css">
    <link rel="icon" href="/view/assets/images/ligtning.ico" type="image/x-icon">
    <?php if ($item_id) {
        $seo_tags = json_decode($item['seo'], true);
        foreach($seo_tags as $name => $value){ ?>
    <meta name="<?php echo escape($name); ?>" content="<?php echo escape($value); ?>">
    <?php }
    } else { ?>

    <?php } ?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function(m, e, t, r, i, k, a) {
        m[i] = m[i]

        function() {
            (m[i].a = m[i].a[]).push(arguments)
        };

        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
            k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    ym(88776791, "init", {

        clickmap: true,

        trackLinks: true,

        accurateTrackBounce: true,

        webvisor: true

    });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/88776791" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>