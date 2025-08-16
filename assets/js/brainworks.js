"use strict";

var _this = void 0;

(function (w, d, $, ajax) {
    $(function () {
        // Логирование информации о разработчике сайта
        console.log("%cThe website developed by BRAIN WORKS — https://brainworks.pro/", "color: blue");
        console.log("%cСайт разработан в BRAIN WORKS — https://brainworks.pro/", "color: blue");

        // Определение основных переменных
        var $w = $(w);
        var $d = $(d);
        var html = $("html");

        // Проверка, является ли устройство мобильным
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (isMobile) {
            html.addClass("is-mobile");
        }

        // Удаление класса no-js и добавление js для определения работы JavaScript
        html.removeClass("no-js").addClass("js");

        // Инициализация различных функций
        dropdownPhone(); // Выпадающий список для телефонов
        scrollToElement(); // Прокрутка к элементу
        sidebarAccordion(); // Аккордеон для боковой панели
        updateCartTotalValue("#modal-cart"); // Обновление общей стоимости корзины
        reviews(".js-reviews"); // Инициализация отзывов
        scrollTop(".js-scroll-top"); // Кнопка прокрутки вверх
        wrapHighlightedElements(".highlighted"); // Обертка для выделенных элементов

        // Загрузка дополнительных постов через AJAX
        if (ajax) {
            ajaxLoadMorePosts(".js-load-more", ".js-ajax-posts");
        }

        // Закрепление хедера и футера
        stickHeader(".js-header");
        stickFooter(".js-footer", ".js-container");

        // Инициализация меню-гамбургера
        anotherHamburgerMenu(".js-menu", ".js-hamburger", ".js-menu-close");

        // Покупка в один клик
        buyOneClick(".one-click", '[data-field-id="field11"]', "h1");

        // Добавление ссылки при копировании текста
        $d.on("copy", addLink);

        // Удаление всех стилей меню при изменении размера окна
        $w.on("resize", function () {
            if ($w.innerWidth() >= 630) {
                removeAllStyles($(".js-menu"));
            }
        });
    });

    // Функция для выпадающего списка телефонов
    var dropdownPhone = function dropdownPhone() {
        var dropDownBtn = $(".js-dropdown");
        var dropDownList = $(".js-phone-list");

        // Открытие/закрытие списка при клике
        dropDownBtn.on("click", function () {
            $(this).toggleClass("active").siblings(".js-phone-list").fadeToggle(300);
        });

        // Закрытие списка при клике вне его области
        $(document).on("click", function (event) {
            if ($(event.target).closest(".js-dropdown, .js-phone-list").length) return;
            dropDownList.fadeOut(300);
            dropDownBtn.removeClass("active");
        });
    };

    // Функция для закрепления хедера при прокрутке страницы
    var stickHeader = function stickHeader(element) {
        var w = $(window); // Ссылка на объект окна
        var d = $(document); // Ссылка на объект документа
        var windowHeight = w.height(); // Высота окна браузера
        var documentHeight = d.height(); // Высота всего документа
        var resizeArr = []; // Массив для хранения функций, вызываемых при изменении размера окна
        var resizeTimeout = 0;

        // Функция для дебаунса событий изменения размера окна
        var _debounceResized = function _debounceResized() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function () {
                if (resizeArr.length) {
                    for (var i = 0; i < resizeArr.length; i++) {
                        resizeArr[i]();
                    }
                }
            }, 50);
        };

        _debounceResized();
        w.on("ready load resize orientationchange", _debounceResized);

        // Добавление функции в массив resizeArr или вызов события resize
        var _debounceResize = function _debounceResize(callback) {
            if (typeof callback === "function") {
                resizeArr.push(callback);
            } else {
                window.dispatchEvent(new Event("resize"));
            }
        };

        var didScroll = 0; // Флаг для отслеживания прокрутки
        var lastScrollTop = 0; // Последняя позиция прокрутки
        var hideOnScrollList = []; // Список функций, вызываемых при прокрутке

        // Отслеживание событий прокрутки
        w.on("scroll load resize orientationchange", function () {
            if (hideOnScrollList.length) didScroll = true;
        });

        // Функция для обработки событий прокрутки
        var _hasScrolled = function _hasScrolled() {
            var type = "";
            var scrollTop = w.scrollTop(); // Текущая позиция прокрутки

            if (scrollTop > lastScrollTop) {
                type = "down"; // Прокрутка вниз
            } else if (scrollTop < lastScrollTop) {
                type = "up"; // Прокрутка вверх
            } else {
                type = "none"; // Нет изменений
            }

            if (scrollTop === 0) {
                type = "start"; // Начало страницы
            } else if (scrollTop >= documentHeight - windowHeight) {
                type = "end"; // Конец страницы
            }

            // Вызов всех функций из hideOnScrollList
            hideOnScrollList.forEach(function (callback) {
                if (typeof callback === "function") {
                    callback(type, scrollTop, lastScrollTop, w);
                }
            });

            lastScrollTop = scrollTop; // Обновление последней позиции прокрутки
        };

        // Интервал для проверки прокрутки
        setInterval(function () {
            if (didScroll) {
                didScroll = false;
                window.requestAnimationFrame(_hasScrolled);
            }
        }, 250);

        // Добавление функции в список hideOnScrollList
        var _throttleScroll = function _throttleScroll(callback) {
            hideOnScrollList.push(callback);
        };

        var start = 400; // Порог для автоскрытия хедера
        var hideClass = "onscroll-hide"; // Класс для скрытия хедера
        var showClass = "onscroll-show"; // Класс для отображения хедера
        var header = $(element); // Элемент хедера
        var headerFake = $("<div>").hide(); // Фейковый элемент для сохранения высоты
        var autoHideHeader = header.filter(".is-autohide"); // Хедеры с автоскрытием
        var headerOffsetTop = header.length ? header.offset().top : 0; // Смещение хедера
        var stickyOn;

        // Функция для закрепления хедера
        var _onScroll = function _onScroll() {
            stickyOn = w.scrollTop() > headerOffsetTop;
            if (stickyOn) {
                header.addClass("is-fixed");
                headerFake.show();
            } else {
                header.removeClass("is-fixed");
                headerFake.hide();
            }
        };

        // Если хедер имеет класс is-sticky, добавляем логику закрепления
        if (header.hasClass("is-sticky")) {
            header.after(headerFake);
            headerFake.height(header.innerHeight());
            _debounceResize(function () {
                headerFake.height(header.innerHeight());
            });
            _onScroll();
            w.on("scroll resize", _onScroll);
        }

        // Логика автоскрытия хедера при прокрутке
        _throttleScroll(function (type, scroll) {
            if (type === "down" && scroll > start) {
                autoHideHeader.removeClass(showClass).addClass(hideClass);
            } else if (type === "up" || type === "start") {
                autoHideHeader.removeClass(hideClass).addClass(showClass);
            }

            // Изменение прозрачности хедера при прокрутке
            if (header.hasClass("is-transparent") && header.hasClass("is-sticky")) {
                header[(scroll > 70 ? "add" : "remove") + "Class"]("is-solid");
            }
        });
    };

    // Функция для закрепления футера и предотвращения наложения на контент
    var stickFooter = function stickFooter(element, container) {
        var previousHeight, currentHeight; // Переменные для хранения высоты футера
        var offset = 0; // Дополнительный отступ (если требуется)
        var $footer = $(element); // Элемент футера
        var $container = $(container); // Контейнер, к которому применяется отступ

        // Установка начального значения отступа для контейнера
        currentHeight = $footer.outerHeight() + offset + "px";
        previousHeight = currentHeight;
        $container.css("paddingBottom", currentHeight);

        // Обновление отступа при изменении размера окна
        $(window).on("resize", function () {
            currentHeight = $footer.outerHeight() + offset + "px";
            if (previousHeight !== currentHeight) {
                $container.css("paddingBottom", currentHeight); // Установка нового отступа
            }
        });
    };

    // Функция для инициализации слайдера отзывов
    var reviews = function reviews(container) {
        var element = $(container); // Элемент контейнера с отзывами

        // Проверяем, есть ли больше одного дочернего элемента и подключен ли плагин slick
        if (element.children().length > 1 && typeof $.fn.slick === "function") {
            element.slick({
                adaptiveHeight: false, // Отключение адаптивной высоты
                autoplay: false, // Автопрокрутка отключена
                autoplaySpeed: 3000, // Скорость автопрокрутки (если включена)
                arrows: true, // Включение стрелок навигации
                prevArrow: '<button type="button" class="slick-prev">&lsaquo;</button>', // Кастомная кнопка "Назад"
                nextArrow: '<button type="button" class="slick-next">&rsaquo;</button>', // Кастомная кнопка "Вперед"
                dots: false, // Отключение точек навигации
                dotsClass: "slick-dots", // Класс для точек навигации (если включены)
                draggable: true, // Разрешение перетаскивания слайдов
                fade: false, // Отключение эффекта затухания
                infinite: true, // Бесконечная прокрутка
                responsive: [
                    {
                        breakpoint: 1024, // Для экранов шириной до 1024px
                        settings: {
                            slidesToShow: 1 // Показывать 1 слайд
                        }
                },
                    {
                        breakpoint: 768, // Для экранов шириной до 768px
                        settings: {
                            slidesToShow: 1 // Показывать 1 слайд
                        }
                }
            ],
                slidesToShow: 1, // Количество отображаемых слайдов
                slidesToScroll: 1, // Количество слайдов для прокрутки
                speed: 300, // Скорость анимации прокрутки
                swipe: true, // Разрешение свайпа
                zIndex: 10 // Z-индекс для слайдера
            });
        }
    };

    // Функция для проверки существования якоря и блока на текущей странице
    function isAnchorAndBlockExists(link) {
        let href = link.getAttribute('href'); // Получаем значение атрибута href ссылки

        // Убираем начальный слэш, если он есть
        if (href.startsWith('/')) {
            href = href.slice(1);
        }

        // Разделяем путь и якорь (если есть) по символу #
        const [path, anchor] = href.split('#');

        // Получаем текущий путь страницы и нормализуем его (убираем начальные и конечные слэши)
        const currentPath = window.location.pathname.replace(/^\/|\/$/g, '');
        const normalizedPath = path.replace(/^\/|\/$/g, '');

        // Проверяем, совпадает ли путь ссылки с текущим путем страницы
        if (normalizedPath === currentPath) {
            if (anchor) { // Если якорь существует
                const targetElement = document.getElementById(anchor); // Ищем элемент с ID якоря

                if (targetElement) { // Если элемент найден
                    $('body').removeClass('body-overflow'); // Убираем класс, блокирующий прокрутку
                    $('.nav.js-menu').removeClass('is-active'); // Закрываем меню навигации
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    }); // Плавно прокручиваем к элементу
                    return; // Завершаем выполнение функции
                }
            }
        } else {
            // Если путь не совпадает, перенаправляем пользователя по ссылке
            window.location.href = link.getAttribute('href');
        }
    }

    // Обработчик клика по ссылкам с якорями в меню, скрытом на десктопе
    $('.nav.hide-on-desktop li.anchor-link a').on('click', function (e) {
        e.preventDefault(); // Отменяем стандартное поведение ссылки
        isAnchorAndBlockExists(this); // Проверяем существование якоря и блока, и выполняем соответствующие действия
    });

    // Функция для управления меню-гамбургером
    var anotherHamburgerMenu = function anotherHamburgerMenu(menuElement, hamburgerElement, closeTrigger) {
        var Elements = {
            menu: $(menuElement), // Элемент меню
            button: $(hamburgerElement), // Кнопка-гамбургер
            close: $(closeTrigger) // Элемент для закрытия меню
        };

        // Обработчик клика по кнопке-гамбургеру и элементу закрытия
        Elements.button.add(Elements.close).on("click", function () {
            Elements.menu.toggleClass("is-active"); // Переключение класса активности меню
        });

        // Закрытие меню при клике на пункт меню без вложенных элементов
        Elements.menu.find(".menu-item:not(.menu-item-has-children.menu-item-type-custom) a").on("click", function () {
            Elements.menu.removeClass("is-active"); // Удаление класса активности
        });

        // Функция для добавления кнопки-стрелки к пунктам с вложенными меню
        var arrowOpener = function arrowOpener(parent) {
            var activeArrowClass = "menu-item-has-children-arrow-active"; // Класс для активной стрелки
            return $("<button />")
                .addClass("menu-item-has-children-arrow") // Добавление класса стрелки
                .on("click", function () {
                    parent.children(".sub-menu").eq(0).slideToggle(300); // Показ/скрытие вложенного меню
                    if ($(this).hasClass(activeArrowClass)) {
                        $(this).removeClass(activeArrowClass); // Удаление активного класса
                    } else {
                        $(this).addClass(activeArrowClass); // Добавление активного класса
                    }
                });
        };

        // Поиск пунктов меню с вложенными элементами и добавление к ним стрелок
        var items = Elements.menu.find(".menu-item-has-children, .sub-menu-item-has-children");
        for (var i = 0; i < items.length; i++) {
            items.eq(i).append(arrowOpener(items.eq(i))); // Добавление стрелки к каждому пункту
        }
    };

    // Функция для удаления всех инлайн-стилей из подменю
    var removeAllStyles = function removeAllStyles(elementParent) {
        elementParent.find(".sub-menu").removeAttr("style"); // Удаление атрибута style у подменю
    };

    // Функция для обертки выделенных элементов в блок
    var wrapHighlightedElements = function wrapHighlightedElements(elements) {
        elements = $(elements); // Преобразование элементов в jQuery-объект
        var i, highlightedHeader;
        for (i = 0; i < elements.length; i++) {
            highlightedHeader = elements.eq(i); // Получение текущего элемента
            highlightedHeader.wrap('<div style="display: block;"></div>'); // Обертка элемента в div
        }
    };

    // Функция для реализации покупки в один клик
    var buyOneClick = function buyOneClick(button, field, headline) {
        var btn = $(button); // Кнопка для покупки
        if (btn.length) { // Проверка наличия кнопки
            btn.on("click", function () {
                $(field).prop("disabled", true).val($(headline).text()); // Отключение поля и установка значения заголовка
            });
        }
    };

    // Функция для прокрутки страницы вверх и управления видимостью кнопки "Наверх"
    var scrollTop = function scrollTop(element) {
        var el = $(element); // Элемент кнопки "Наверх"

        // Обработчик клика или касания по кнопке
        el.on("click touchend", function () {
            $("html, body").animate({
                scrollTop: 0 // Плавная прокрутка страницы к началу
            }, "slow");
            return false; // Предотвращение стандартного поведения
        });

        var scrollPosition; // Переменная для хранения текущей позиции прокрутки

        // Обработчик события прокрутки окна
        $(window).on("scroll", function () {
            scrollPosition = $(this).scrollTop(); // Получение текущей позиции прокрутки

            // Если прокрутка больше 200px, показываем кнопку
            if (scrollPosition > 200) {
                if (!el.hasClass("is-visible")) {
                    el.addClass("is-visible"); // Добавляем класс для отображения кнопки
                }
            } else {
                el.removeClass("is-visible"); // Убираем класс, скрывая кнопку
            }
        });
    };

    // Функция для добавления ссылки на источник при копировании текста
    var addLink = function addLink() {
        var body = document.body || document.getElementsByTagName("body")[0]; // Получаем элемент body
        var selection = window.getSelection(); // Получаем выделенный текст
        var page_link = "\n Source: " + document.location.href; // Формируем ссылку на источник
        var copy_text = selection + page_link; // Добавляем ссылку к выделенному тексту
        var div = document.createElement("div"); // Создаем временный div для копирования текста
        div.style.position = "absolute"; // Устанавливаем позицию вне видимой области
        div.style.left = "-9999px"; // Смещаем div за пределы экрана
        body.appendChild(div); // Добавляем div в body
        div.innerText = copy_text; // Вставляем текст с ссылкой в div
        selection.selectAllChildren(div); // Выделяем содержимое div
        window.setTimeout(function () {
            body.removeChild(div); // Удаляем div после копирования
        }, 0);
    };

    // Функция для плавной прокрутки к элементу при клике на ссылку
    var scrollToElement = function scrollToElement() {
        var animationSpeed = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 400; // Скорость анимации прокрутки
        var links = $(".menu-item:not(.menu-item-has-children.menu-item-type-custom) a"); // Ссылки, которые не содержат вложенные элементы

        // Обработка каждой ссылки
        links.each(function (index, element) {
            var $element = $(element),
                href = $element.attr("href"); // Получаем ссылку

            if (href) {
                // Проверяем, является ли ссылка якорной
                if (href[0] === "#" || (href.slice(0, 2) === "/#" && !(href.slice(1, 3) === "__"))) {
                    $element.on("click", function (e) {
                        e.preventDefault(); // Отменяем стандартное поведение ссылки

                        // Пропускаем обработку, если ссылка находится внутри WooCommerce вкладок
                        if ($element.closest(".woocommerce-tabs").length) return;

                        var target = $(href[0] === "#" ? href : href.slice(1)); // Определяем целевой элемент
                        var fixedHeader = $(".js-header"); // Фиксированный хедер
                        var fixOffset = 20; // Дополнительный отступ
                        var scrollBlockOffset;

                        // Если целевой элемент существует и ссылка не является системной
                        if (target.length && href.slice(0, 3) !== "#__") {
                            if (fixedHeader.length > 0 && $(window).width() > 1024) {
                                // Если есть фиксированный хедер на десктопе
                                scrollBlockOffset = fixedHeader.outerHeight() + fixOffset;
                            } else if (fixedHeader.length >= 0 && $(window).width() < 1024) {
                                // Если есть мобильный хедер
                                scrollBlockOffset = $(".nav-mobile-header").outerHeight() + fixOffset;
                            } else {
                                scrollBlockOffset = fixOffset; // Только отступ
                            }

                            // Плавная прокрутка к целевому элементу
                            $("html, body").animate({
                                scrollTop: target.offset().top - scrollBlockOffset
                            }, animationSpeed);
                        } else if (href[0] === "/") {
                            // Если ссылка ведет на другую страницу
                            location.href = href;
                        }
                    });
                }
            }
        });
    };

    // Функция для реализации аккордеона в боковой панели
    var sidebarAccordion = function sidebarAccordion() {
        var sidebarMenu = $(".sidebar .widget_nav_menu"); // Находим меню в боковой панели
        var items = sidebarMenu.find("li"); // Находим все элементы списка
        var subMenu = items.find(".sub-menu"); // Находим вложенные подменю

        // Если есть подменю, добавляем к ним триггер
        if (subMenu.length) {
            subMenu.each(function (index, value) {
                $(value).parent().first().append('<i class="trigger"></i>'); // Добавляем элемент-триггер
            });
        }

        var classAction = "is-opened"; // Класс для открытого элемента
        var trigger = items.find(".trigger"); // Находим все триггеры

        // Обработчик клика по триггеру
        trigger.on("click", function () {
            var el = $(this),
                parent = el.parent(); // Получаем текущий триггер и его родительский элемент
            if (parent.hasClass(classAction)) {
                parent.removeClass(classAction); // Закрываем элемент, если он открыт
            } else {
                parent.addClass(classAction); // Открываем элемент, если он закрыт
            }
        });
    };

    // Функция для загрузки дополнительных постов через AJAX
    var ajaxLoadMorePosts = function ajaxLoadMorePosts(selector, container) {
        var btn = $(selector); // Кнопка для загрузки постов
        var storage = $(container); // Контейнер для добавления новых постов
        var lastChildren = $(container).children().last(); // Последний элемент в контейнере

        // Если кнопка или контейнер отсутствуют, прекращаем выполнение
        if (!btn.length && !storage.length) return;

        var data, ajaxStart;
        data = {
            action: ajax.action, // Действие для обработки на сервере
            nonce: ajax.nonce, // Нонс для проверки безопасности
            paged: 1 // Номер текущей страницы
        };

        // Обработчик клика по кнопке
        btn.on("click", function () {
            if (ajaxStart) return; // Если запрос уже выполняется, ничего не делаем
            lastChildren = $(container).children().last(); // Обновляем последний элемент
            ajaxStart = true; // Устанавливаем флаг выполнения запроса
            btn.addClass("is-loading"); // Добавляем класс загрузки к кнопке

            // Выполняем AJAX-запрос
            $.ajax({
                url: ajax.url, // URL для отправки запроса
                method: "POST", // Метод запроса
                dataType: "json", // Ожидаемый формат ответа
                data: data // Данные для отправки
            }).done(function (response) {
                var posts = response.data; // Полученные посты
                storage.append(response.data); // Добавляем посты в контейнер
                data.paged += 1; // Увеличиваем номер страницы

                // Если посты загружены, прокручиваем страницу к последнему элементу
                if (posts !== "") {
                    $("html, body").animate({
                        scrollTop: $(lastChildren).offset().top
                    }, 1000);
                }

                ajaxStart = false; // Сбрасываем флаг выполнения запроса
                btn.removeClass("is-loading"); // Убираем класс загрузки с кнопки

                // Если больше нет постов, удаляем кнопку
                if (posts === "") {
                    btn.remove();
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                ajaxStart = false; // Сбрасываем флаг выполнения запроса
                throw new Error("Handling Ajax request loading posts has caused an ".concat(textStatus, " - ").concat(errorThrown)); // Выбрасываем ошибку
            });
        });
    };

    // Обработчик клика по кнопке-гамбургеру
    $(".js-hamburger").on("click", function () {
        $("body").addClass("body-overflow"); // Блокируем прокрутку страницы
    });

    // Обработчик клика по кнопке закрытия меню или ссылкам без вложенных элементов
    $(".js-menu-close, .menu-item:not(.menu-item-has-children.menu-item-type-custom) .menu-link").on("click", function () {
        $("body").removeClass("body-overflow"); // Убираем блокировку прокрутки
    });

    // Обработчик клика по кнопке закрытия меню или ссылкам с вложенными элементами
    $(".js-menu-close, .menu-item.menu-item-has-children .menu-link").on("click", function (e) {
        if ($(this).attr('href') == '#') { // Если ссылка ведет на якорь "#"
            e.preventDefault(); // Отменяем стандартное поведение
            $(this).closest('.menu-item').find('.menu-item-has-children-arrow').trigger('click'); // Триггерим клик на стрелке для открытия/закрытия подменю
        }
    });

    // Функция для обновления общей стоимости корзины
    var updateCartTotalValue = function updateCartTotalValue(elemId) {
        // Сохраняем текущую валюту в localStorage
        localStorage.setItem("currency", $("#cyr-value").val());
        var totalId = $(elemId); // Элемент, где отображается общая стоимость

        // Проверяем, существует ли элемент
        if ($(elemId).length > 0) {
            // Привязываем обработчик к завершению всех AJAX-запросов
            $(document).bind("ajaxStop.mine", function () {
                // Если таблица корзины существует
                if ($(".shop_table").length > 0) {
                    totalId.css("pointerEvents", "none"); // Отключаем взаимодействие с элементом
                    var checkoutTotalValue = $(".shop_table .amount").text(); // Получаем значение общей стоимости
                    totalId.find(".amount").first().text(checkoutTotalValue); // Обновляем текст общей стоимости
                }

                // Проверяем, есть ли данные в sessionStorage
                if (sessionStorage.getItem(wc_cart_fragments_params.fragment_name) !== null) {
                    var sessionHash = sessionStorage.getItem(wc_cart_fragments_params.fragment_name); // Получаем данные из sessionStorage
                    var parseValue = JSON.parse(sessionHash); // Парсим данные
                    var totalValueCart; // Общая стоимость корзины
                    var totalValueCyr; // Валюта

                    // Перебираем данные из sessionStorage
                    $.each(parseValue, function (key, value) {
                        if (key == "div.widget_shopping_cart_content") {
                            var cartModalContent = $(value).text(); // Получаем текст содержимого корзины
                            var cartContentString = cartModalContent.split(":").pop(); // Извлекаем строку с общей стоимостью
                            totalValueCart = Array.from(cartContentString.split("."))[0]; // Извлекаем значение до точки
                            totalValueCyr = localStorage.getItem("currency"); // Получаем валюту из localStorage
                        } else if ($(".cart-contents-count").text() < 1) {
                            // Если корзина пуста
                            totalId.find(".amount").first().text("0 " + totalValueCyr); // Устанавливаем 0 и валюту
                        } else {
                            // Если корзина не пуста
                            totalId.find(".amount").first().text(totalValueCart + "."); // Устанавливаем общую стоимость
                        }
                    });
                }
            });
        }
    };

    // Триггер обновления фрагментов WooCommerce при загрузке окна
    $(window).load(function () {
        $(document.body).trigger("wc_fragment_refresh"); // Обновляем фрагменты корзины WooCommerce
    });

    // Закрытие активного меню при клике вне его области
    $(document).mouseup(function (e) {
        var popup = $('.nav.js-menu.is-active'); // Активное меню
        if (e.target != popup[0] && popup.has(e.target).length === 0) {
            $('.nav.js-menu').removeClass('is-active'); // Убираем класс активности
            $('body').removeClass("body-overflow"); // Разблокируем прокрутку страницы
        }
    });

    // Обработчик клика по ссылкам с вложенными элементами в меню
    $('.menu-item-object-custom.menu-item-has-children:not(.pll-parent-menu-item) a').on('click', function (e) {
        if ($(e.target).hasClass('menu-item-has-children')) {
            e.preventDefault(); // Отменяем стандартное поведение ссылки
            e.stopPropagation(); // Останавливаем всплытие события
            $(this).closest('.menu-item-object-custom').find('button').trigger('click'); // Триггерим клик на кнопке
        }
    });

    // Обработчик клика по кнопке "Показать больше"
    $('.btn-show-more').on('click', function (e) {
        e.preventDefault(); // Отменяем стандартное поведение ссылки
        var wrapper = $(this).closest('.show-hide-text__wrapp'); // Находим обертку текста
        if (wrapper.hasClass('show')) {
            wrapper.removeClass('show'); // Убираем класс "show"
            $('.show-hide-text').css('height', '150px'); // Устанавливаем фиксированную высоту
            $(this).toggleClass('show'); // Переключаем класс кнопки
        } else {
            wrapper.addClass('show'); // Добавляем класс "show"
            $('.show-hide-text').css('height', 'auto'); // Устанавливаем автоматическую высоту
            $(this).toggleClass('show'); // Переключаем класс кнопки
        }
    });

})(window, document, jQuery, window.jpAjax);
