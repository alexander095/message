-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 18 2013 г., 18:41
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `message_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `matu`
--

CREATE TABLE IF NOT EXISTS `matu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `list` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `matu`
--

INSERT INTO `matu` (`id`, `type`, `list`) VALUES
(2, 'UKR', '|сука|дибіл|придурок|');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description_small` tinytext NOT NULL,
  `description_big` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_change` datetime NOT NULL,
  `tags` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=253 ;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `title`, `description_small`, `description_big`, `date_add`, `date_change`, `tags`) VALUES
(82, 'Android и Chrome OS останутся самостоятельными операционнными системами', 'Буквально неделю назад компания Google произвела кадровые перестановки, которые заключались в том, что Энди Рубина (Andy Rubin)', 'Буквально неделю назад компания Google произвела кадровые перестановки, которые заключались в том, что Энди Рубина (Andy Rubin), «отца» и руководителя разработки Android, на посту сменил Сандар Пичай (Sundar Pichai), который, помимо прочего является руководителем проектов по Chrome и Google Apps. Некоторые пользователи начали подозревать, что Android и Chrome OS могут стать одной операционной системой, об этом говорил Сергей Брин (Sergey Brin) еще в далеком 2009 году. Но председатель совета директоров Google Эрик Шмидт (Eric Schmidt) заявил, что эти два продукта останутся самостоятельными и не будут «сливаться». Об этом было сообщено на мероприятии Google Big Tent, которое прошло в Индии. Более того, он добавил, что Android и Chrome OS останутся самостоятельными довольно долго, и в ближайшее время нет планов их объединять. Тем не менее, будет вестись работа над тем, чтобы они были совместимы и могли комфортно сосуществовать друг с другом.', '2013-03-30 18:03:45', '0000-00-00 00:00:00', ''),
(83, 'MSI выпускает свою версию Radeon HD 7790 с нереференсным кулером', 'Компания Micro-Star International не стала откладывать дело в долгий ящик и официально представила собственную версию дебютировавшей недавно бюджет', 'Компания Micro-Star International не стала откладывать дело в долгий ящик и официально представила собственную версию дебютировавшей недавно бюджетной модели AMD Radeon HD 7790, в основе которой лежит новый 28-нм чип Bonaire с архитектурой Graphics Core Next и 896 потоковыми процессорами. Новинка с модельным номером R7790-1GD5/OC несет на борту 1 ГБ памяти GDDR5 с 128-битным интерфейсом и имеет частоты 1050 и 6000 МГц для GPU и VRAM, что говорит о небольшом заводском разгоне. Кроме того, новую видеокарту MSI отличает нестандартная система охлаждения, в состав которой входит довольно большой массив радиаторных ребер и медные теплоотводные трубки, а обдувает все это вентилятор диаметром 100 мм с лопастями Propeller Blade. Такой кулер должен обеспечить достаточно тихое и эффективное охлаждение, а в систему расположенных на монтажной планке видеовыходов входит по одному разъему Dual-link DVI-I, Dual-link DVI-D, DisplayPort и HDMI. О стоимости новинки пока не сообщается.', '2013-03-30 18:06:10', '0000-00-00 00:00:00', ''),
(84, 'Мощная камера Canon PowerShot SX280 HS поддерживает Wi-Fi и GPS', 'Сердцем обеих моделей является процессор обработки изображения нового поколения Canon DIGIC 6, позволяющий даже при слабом освещении получать ', 'Сердцем обеих моделей является процессор обработки изображения нового поколения Canon DIGIC 6, позволяющий даже при слабом освещении получать хорошие результаты, а также записывать видео Full HD со скоростью до 60 кадров в секунду. Как отмечает производитель, DIGIC 6 обеспечивает низкий уровень шумов и правильную экспозицию при любых условиях съёмки, а в сочетании с 12,1-мегапиксельным CMOS-датчиком позволяет без вспышки и использования штатива зафиксировать на 30 процентов больше деталей, чем предшествующие модели. Обе модели получили широкоугольный 25-мм объектив Canon с 20-кратным оптическим зумом и системой оптической стабилизации изображения (IS), компенсирующей 4 ступени экспозиции. PowerShot SX280 HS дополнительно обладает поддержкой Wi-Fi и модулем GPS. Камера сможет передавать фотографии в социальные сети или облачное хранилище в Интернете. GPS-модуль автоматически добавляет к каждой сделанной фотографии или видеоролику координаты, функция журнала во время путешествия фиксирует местонахождение камеры с регулярными интервалами, а технология A-GPS через Wi-Fi загружает дополнительные данные Assisted GPS, что ускоряет получение спутникового сигнала. Пользователь может снимать видеоролики Full HD (1920x1080p) со стереозвуком. Отметим, что 20-кратный оптический зум доступен и в режиме видеосъемки. Свежая версия системы стабилизации изображения с усовершенствованным динамическим режимом позволяет получать четкую картинку при съемке в движении. В этом режиме используется пятиосевой стабилизатор, что дополнительно увеличивает плавность видео при съёмке без использования штатива. PowerShot SX280 HS и PowerShot SX270 HS получили ЖК-экран PureColor II G диагональю 7,5 см (3 дюйма) из закаленного стекла с разрешением приблизительно 461 тыс. пикселей. Обе камеры имеют полуавтоматические режимы Tv и Av, позволяющие контролировать выдержку и диафрагму, а также полностью ручной режим для контроля всех настроек. Начало продаж камер Canon PowerShot SX280 HS и PowerShot SX270 HS предполагается в мае 2013 года по цене 349 и 329 евро, соответственно.', '2013-03-30 18:07:50', '0000-00-00 00:00:00', ''),
(85, ' На YouTube введут каналы с платными подписками', 'Популярный видеохостинг YouTube, по всей видимости, планирует ввести новую политику и перестать быть полностью бесплатным. Речь идет о том', 'Популярный видеохостинг YouTube, по всей видимости, планирует ввести новую политику и перестать быть полностью бесплатным. Речь идет о том, что некоторые каналы будут требовать платную подписку с пользователя, чтобы тот смог их смотреть. Вице-президент YouTube Роберт Кинсл (Robert Kyncl) дал в Лос-Анджелесе интервью, в котором сказал, что введение платной подписки на каналы очень важно, так как предоставит создателям видео дополнительный источник дохода, который позволит им в конечном итоге выпускать лучший продукт. К сожалению, какие-либо детали о подобном нововведении официально не сообщаются. Согласно слухам, первые экспериментальные каналы, которые будут требовать плату за подписку, обойдутся относительно дешево – от 1 до 5 долларов в месяц. Когда будет введена платная подписка пока не ясно, будет ждать более подробных официальных заявлений от YouTube. Кстати, сайт поделился информацией о посещаемости, которая впечатляет. Каждый месяц сервис посещают больше одного миллиарда уникальных пользователей, что составляет одну седьмую населения Земли.', '2013-03-30 18:08:46', '2013-03-30 18:09:30', ''),
(88, 'Уязвимость в смартфонах Samsung позволяет обмануть экран блокировки', 'Очевидно, не только iOS и iPhone страдают от уязвимостей, позволяющих обойти защиту с помощью экрана блокировки и получать доступ', 'Очевидно, не только iOS и iPhone страдают от уязвимостей, позволяющих обойти защиту с помощью экрана блокировки и получать доступ к хранящимся в памяти устройства данным без ведома владельца. О схожей проблеме, относящейся, правда, уже к некоторым Android-смартфонам Samsung, сообщил в своем блоге разработчик Теренс Иден (Terence Eden), причем, хакерская методика, о которой рассказывается в представленных нашему вниманию видеороликах, ранее была неизвестна широкой аудитории пользователей. Подчеркнем, что с помощью указанной методики невозможно полностью разблокировать сам смартфон, однако она позволяет на короткий период получить доступ к приложениям и настройкам аппарата. Скажем, можно использовать Google Play для загрузки программы с тем, чтобы отключить экран блокировки и уже в дальнейшем полноценно работать с гаджетом. По данным Теренса Идена, эта проблема касается Galaxy Note II и Galaxy S III и потенциально затрагивает другие Android-смартфоны Samsung с интерфейсом TouchWiz. Бороться с напастью предлагается посредством отключения анимации экрана, однако мера эта половинчатая и не может полностью исключить опасность взлома. Впрочем, Теренс Иден упоминает о том, что Samsung в курсе данной проблемы и работает над решением, которое должно появиться в виде обновления программного обеспечения в обозримой перспективе. Напомним, что последнее по счету обновление iOS, выпущенное на днях Apple, также оказалось уязвимым для обхода блокировки экрана через пароль.', '2013-03-30 18:12:23', '0000-00-00 00:00:00', ''),
(87, 'Популярный видеохостинг YouTube', 'Очевидно, не только iOS и iPhone страдают от уязвимостей, позволяющих обойти защиту с помощью экрана блокировки и получать доступ', 'Очевидно, не только iOS и iPhone страдают от уязвимостей, позволяющих обойти защиту с помощью экрана блокировки и получать доступ к хранящимся в памяти устройства данным без ведома владельца. О схожей проблеме, относящейся, правда, уже к некоторым Android-смартфонам Samsung, сообщил в своем блоге разработчик Теренс Иден (Terence Eden), причем, хакерская методика, о которой рассказывается в представленных нашему вниманию видеороликах, ранее была неизвестна широкой аудитории пользователей. Подчеркнем, что с помощью указанной методики невозможно полностью разблокировать сам смартфон, однако она позволяет на короткий период получить доступ к приложениям и настройкам аппарата. Скажем, можно использовать Google Play для загрузки программы с тем, чтобы отключить экран блокировки и уже в дальнейшем полноценно работать с гаджетом. По данным Теренса Идена, эта проблема касается Galaxy Note II и Galaxy S III и потенциально затрагивает другие Android-смартфоны Samsung с интерфейсом TouchWiz. Бороться с напастью предлагается посредством отключения анимации экрана, однако мера эта половинчатая и не может полностью исключить опасность взлома. Впрочем, Теренс Иден упоминает о том, что Samsung в курсе данной проблемы и работает над решением, которое должно появиться в виде обновления программного обеспечения в обозримой перспективе. Напомним, что последнее по счету обновление iOS, выпущенное на днях Apple, также оказалось уязвимым для обхода блокировки экрана через пароль.', '2013-03-30 18:11:27', '0000-00-00 00:00:00', ''),
(89, 'Apple запретит приложения с использованием UDID', 'О важных изменениях в своей политике одобрения iOS-приложений официально объявила компания Apple.', 'О важных изменениях в своей политике одобрения iOS-приложений официально объявила компания Apple. К примеру, начиная с 1 мая, разработчикам не разрешается создавать программы, которые используют уникальный идентификатор устройства (unique device identifier, UDID). Взаимен им предлагается воспользоваться опцией Vendor or Advertising Identifiers, представленной ранее в iOS 6. Кроме того, в число новых требований входит поддержка сверхчетких экранов Retina, в том числе 4-дюймового тачскрина в iPhone 5. В общем и целом решение Apple запретить приложения с использованием UDID не стало полной неожиданностью. Еще в позапрошлом году компания объявила, что со временем перекроет разработчикам доступ к UDID и создаст вместо этого специальный маркер для использования рекламодателями. Более того, около года назад появились сообщения, что купертиновцы без лишнего шума не допускают к размещению в App Store приложения именно за использование указанной функциональности. Теперь же становится очевидным, что намерения Apple в этом направлении еще более серьезны, чем предполагалось ранее.', '2013-03-30 18:14:06', '0000-00-00 00:00:00', ''),
(194, '000 ***kkk представила', '000ggppp', '00', '2013-05-07 18:04:09', '2013-05-16 15:42:51', '9999,00001'),
(90, 'ASUS GeForce GTX 670 DirectCU Mini отличается компактными размерами', 'Судя по всему, компания ASUSTeK Computer готовится пополнить свой ассортимент еще одной версией NVIDIA GeForce GTX 670', 'Судя по всему, компания ASUSTeK Computer готовится пополнить свой ассортимент еще одной версией NVIDIA GeForce GTX 670, отличающейся очень компактными габаритами. Действительно, длина будущей новинки под названием ASUS GeForce GTX 670 DirectCU Mini, как сообщается, составляет всего 17 см, что дает возможность размещать эту высококлассную видеокарту даже в небольших по размеру компьютерных корпусах, обеспечивая тем самым отличную графическую производительность системы в целом. Таким образом, ASUS GeForce GTX 670 DirectCU Mini вполне может стать частью мини-ПК для геймеров и профессионалов от Shuttle и других производителей. Также на опубликованном источником изображении обращает на себя внимание нестандартная система охлаждения, в состав которой входит алюминиевая пластина, покрывающая чипы памяти и микросхемы подсистемы питания, медная плата испарительной камеры над GPU и массив алюминиевых радиаторных ребер, расположенных в радиальной проекции. Вся эта конструкция обдувается оригинальным по исполнению вентилятором, который представляет собой некое сочетание стандартного лопастного и цилиндрического решений. Что касается тактовых частот ASUS GeForce GTX 670 DirectCU Mini, то память у нее работает на стандартных 6 ГГц, а частота GPU, как утверждается, повышена на 26 МГц от референсных показателей. На монтажную планку выведены два порта DVI и разъемы HDMI и DisplayPort, а дебют данной графической карты ожидается в апреле.', '2013-03-30 18:14:57', '2013-04-27 17:38:09', 'ASUS,Mini,NVIDIA,GeForce,Apple'),
(81, 'Huawei готовит 5-дюймовый четырехъядерный G700 за 320 долларов', 'В Twitter и Weibo всплыли фотографии и характеристики не анонсированного пока официально смартфона G700 от компании Huawei.', 'В Twitter и Weibo всплыли фотографии и характеристики не анонсированного пока официально смартфона G700 от компании Huawei. Аппарат напоминает по параметрам, хотя и не один-в-один, G710, о котором мы писали в конце прошлого месяца. Корпус G700, судя по снимкам, сделан из пластика, а у G710, скорее всего, металлический. Уже известный информатор @evleaks, а также пользователь Weibo сообщают следующие характеристики предположительной новинки: четырехъядерный процессор MediaTek MT6589 с тактовой частотой 1,2 ГГц, 2 ГБ оперативной памяти, и операционная система Android 4.2 Jelly Bean. Диагональ экрана составит 5 дюймов, а разрешение – HD. Точно не ясно, какое именно HD имеется ввиду, но, скорее всего, 1280х720 пикселей. Кроме этого, есть информация, что G710 сможет работать в сетях WCDMA и TD-SCDMA. Что касается даты анонса этого аппарата, то она пока неизвестна. Точная цена тоже не сообщена, но источники предполагают, что она не должна подняться выше 2000 юаней (320 долларов). Это обосновывается тем, что серия G всегда была дешевой и цена на эти устройства не поднималась выше указанной суммы.', '2013-03-30 18:02:29', '0000-00-00 00:00:00', ''),
(80, ' AMD представила видеокарту Radeon HD 7790', 'Видеокарта AMD Radeon HD 7790 построена на 28-нм графическом процессоре AMD Bonaire с архитектурой GCN (Graphics Core Next).', ' Она поддерживает функцию автоматического разгона частоты с использованием технологии AMD PowerTune и предоставляет возможность играть в сверхвысоком разрешении с технологией AMD Eyefinity 2 с поддержкой 3D-формата. Видеокарта обладает полной поддержкой DirectX 11.1. AMD Radeon HD 7790 обладает частотой процессора 950 МГц (максимально 1000 МГц с ускорением), 1 ГБ памяти GDDR5 с 128-разрядном интерфейсом и частотой 6 ГГц, пропускная способность памяти составляет 96 ГБ/с. В состав входят 14 вычислительных блоков (896 потоковых процессоров), 56 текстурных блоков, 64 блока операций растеризации z-буфера или шаблонного буфера (Z/Stencil), 16 блоков растеризации цвета (Color ROP) и два ядра для обработки геометрии. Карточка использует интерфейс шины PCI Express 3.0 x16. Обеспечивается поддержка до 6 мониторов и возможность установки нескольких графических карт AMD CrossFire. Видеовыходы включают DVI и HDMI, а также пару Mini DisplayPort. Потребляемая мощность достигает 85 Вт.', '2013-03-30 18:01:17', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `messages_tags`
--

CREATE TABLE IF NOT EXISTS `messages_tags` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `message_id` int(4) NOT NULL,
  `tags_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `messages_tags`
--

INSERT INTO `messages_tags` (`id`, `message_id`, `tags_id`) VALUES
(1, 82, 1),
(2, 83, 1),
(3, 85, 3),
(4, 87, 3),
(5, 88, 2),
(6, 89, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tag` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'Apple'),
(3, 'GeForce'),
(2, 'Samsung');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `date`) VALUES
(11, 'qwerty', 'f1e6679c95e6f8fbde00075c9f89842d', 'mmm@mail.ru', '2013-04-05 19:39:53'),
(12, 'lolilop', 'ecaa7cc6554e154c491b954f638c0cf6', 'mail@mail.ru', '2013-04-05 19:45:15'),
(13, 'polo', 'b24247d1b47001973af376053fd0aec1', 'nm@mail.ru', '2013-04-05 19:45:53'),
(14, 'tora', 'ceccc90ca511d179e5b97436509ab6ab', 'tora@mail.ru', '2013-04-06 15:26:41'),
(15, 'diaz', '3560e7bfc695541d3e57f847b8817dcfefd64b01', 'op@mail.ru', '2013-04-27 11:30:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
