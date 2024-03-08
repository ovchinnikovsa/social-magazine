CREATE TABLE `conf` (
    `id` INT(16) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `value` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `products` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(64) NOT NULL,
    `characteristics` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `text` TEXT NOT NULL,
    `seo` TEXT NOT NULL,
    `image` VARCHAR(256) NOT NULL,
    `price` decimal(18, 8) UNSIGNED NOT NULL,
    `status` INT NOT NULL,
    `delete` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO
    `products` (
        `id`,
        `title`,
        `characteristics`,
        `description`,
        `text`,
        `seo`,
        `image`,
        `price`,
        `status`,
        `delete`
    )
VALUES
    (
        NULL,
        'Кофеварка',
        '{\"one\":\"two\"}',
        'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.',
        'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).',
        '{\"one\",\"two\"}',
        '',
        '123',
        '1',
        '1'
    );
-- 
CREATE TABLE `categories` (
    `id` INT(16) NOT NULL AUTO_INCREMENT,
    `precategory_ru` VARCHAR(16) NOT NULL,
    `category_ru` VARCHAR(16) NOT NULL,
    `subcategory_ru` VARCHAR(16) NOT NULL,
    `delete` INT(1) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE
    `products`
ADD
    `category_id` INT(16) NOT NULL
AFTER
    `delete`;