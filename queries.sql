-- список категорий
INSERT IGNORE INTO categories (name, code) VALUES 
('Доски и лыжи', 'boards'),
('Крепления', 'bindings'),
('Ботинки', 'boots'),
('Одежда', 'clothing'),
('Инструменты', 'tools'),
('Разное', 'other');

-- список пользователей
INSERT IGNORE INTO users (email, name, password_hash, contacts) VALUES 
(
    'ivan@example.com',
    'Иван Петров',
    'hashed_password_ivan',
    'Телефон: +7 (999) 111-22-33, Telegram: @ivan_ski'
),
(
    'anna@example.com',
    'Анна Сидорова',
    'hashed_password_anna',
    'Email: anna@example.com, г. Томск, ул. Ленина, д. 10'
);

-- список объявлений
INSERT INTO lots (title, description, image_url, start_price, bid_step, end_date, category_id, seller_id) VALUES 
(
    '2014 Rossignol District Snowboard',
    'Отличный сноуборд для начинающих и прогрессирующих райдеров.',
    'img/lot-1.jpg',
    10999,
    500,
    '2026-12-26 06:38:00',
    1,
    1
),
(
    'DC Ply Mens 2016/2017 Snowboard',
    'Профессиональный мужской сноуборд для фристайла.',
    'img/lot-2.jpg',
    159999,
    1000,
    '2026-12-29 00:00:00',
    1,
    1
),
(
    'Крепления Union Contact Pro 2015 года размер L/XL',
    'Надежные и легкие крепления в хорошем состоянии.',
    'img/lot-3.jpg',
    8000,
    200, '2026-12-30 00:00:00',
    2,
    1
),
(
    'Ботинки для сноуборда DC Mutiny Charcoal',
    'Удобные ботинки с быстрой шнуровкой, жесткость средняя.',
    'img/lot-4.jpg',
    10999,
    500,
    '2026-12-31 00:00:00',
    3,
    2
),
(
    'Куртка для сноуборда DC Mutiny Charcoal',
    'Влагозащитная мембранная куртка, теплая и стильная.',
    'img/lot-5.jpg',
    7500,
    300,
    '2027-01-01 00:00:00',
    4,
    2
),
(
    'Маска Oakley Canopy',
    'Маска с широким углом обзора и защитой от запотевания.',
    'img/lot-6.jpg',
    5400,
    100,
    '2027-01-02 00:00:00',
    6,
    2
);

-- ставки для объявлений
INSERT INTO bids (created_at, amount, user_id, lot_id) VALUES 
('2026-10-30 09:00:00', 8300, 2, 3),
('2026-10-30 11:30:00', 8600, 1, 3),
('2026-10-30 14:15:00', 9000, 2, 3),
('2026-10-30 15:00:00', 11500, 1, 4),
('2026-10-30 16:45:00', 7800, 1, 5);

-- получить все категории
SELECT name FROM categories;

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории
SELECT 
    title,
    start_price,
    image_url,
    IFNULL(MAX(amount), start_price) AS price,
    categories.name
FROM lots
JOIN categories ON category_id = categories.id
LEFT JOIN bids ON lots.id = lot_id
WHERE end_date > NOW() AND buyer_id IS NULL
GROUP BY lots.id
ORDER BY lots.created_at DESC;

-- показать лот по его ID. Получите также название категории, к которой принадлежит лот
SELECT
    title AS lot,
    name AS category_name
FROM lots
JOIN categories ON category_id = categories.id
WHERE lots.id = 1;

-- обновить название лота по его идентификатору
UPDATE lots
SET title = 'Санки ледянки'
WHERE id = 1;

-- получить список ставок для лота по его идентификатору с сортировкой по дате
SELECT 
    amount,
    bids.created_at, 
    users.name
FROM bids
JOIN users ON user_id = users.id
WHERE lot_id = 3
ORDER BY bids.created_at DESC;