-- Схема

DROP TABLE IF EXISTS phone_numbers, users;

-- Поменял поля (сделал UNSIGNED, для пола - TINYINT)

CREATE TABLE `users`
(
    `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'поменял на UNSIGNED',
    `name`       VARCHAR(255) DEFAULT NULL,
    `gender`     TINYINT UNSIGNED NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина. (поменял на TINYINT UNSIGNED)',
    `birth_date` INT(11) UNSIGNED NOT NULL COMMENT 'Дата в unixtime. (поменял на UNSIGNED)',
    PRIMARY KEY (`id`)
);

-- Добавил индекс

ALTER TABLE users
    ADD KEY idx_age_1 (birth_date, gender);

-- Поменял поля, добавил внешний ключ

CREATE TABLE `phone_numbers`
(
    `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '(поменял на UNSIGNED)',
    `user_id` INT(11) UNSIGNED NOT NULL,
    `phone`   VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Данные

INSERT INTO users
values (DEFAULT, "Маша", 2, 1009888200),
       (DEFAULT, "Лена", 2, 1009917000),
       (DEFAULT, "Даша", 2, 473459400),
       (DEFAULT, "Паша", 1, 1009888200),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000)),
       (DEFAULT, "???", round(rand() * 2), round(rand() * 2009917000))
;

INSERT INTO phone_numbers
VALUES (DEFAULT, 1, "111111"),
       (DEFAULT, 1, "2222"),
       (DEFAULT, 1, "333"),
       (DEFAULT, 2, "+111111"),
       (DEFAULT, 2, "+111111"),
       (DEFAULT, 3, "++111111"),
       (DEFAULT, 4, "++111111");

-- Запрос, возвращающий имя и число указанных телефонных номеров девушек в возрасте от 18 до 22 лет

SELECT users.name, COUNT(*)
FROM phone_numbers
         JOIN users ON (users.id = phone_numbers.user_id)
WHERE users.gender = 2
  AND users.birth_date BETWEEN
    UNIX_TIMESTAMP(ADDDATE(DATE_FORMAT(NOW(), "%Y-%m-%d 00:00:00"), INTERVAL -22 YEAR))
    AND
    UNIX_TIMESTAMP(ADDDATE(DATE_FORMAT(NOW(), "%Y-%m-%d 23:59:59"), INTERVAL -18 YEAR))
GROUP BY users.id;
