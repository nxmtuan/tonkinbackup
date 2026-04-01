// WebFont.load({
//   typekit: { id: 'sgw7tkn' },
//   custom: {
//       families: ['FontAwesome','Leitura-Roman','DidotLTStd-Italic','Optima'],
//       urls: [
//           'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css',
//       ]
//   },
//   active: function() {
//       sessionStorage.fonts = true;
//   }
// });

(function ($) {
  function orient_express_getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    outer.style.msOverflowStyle = "scrollbar"; // needed for WinJS apps
    document.body.appendChild(outer);
    var widthNoScroll = outer.offsetWidth;
    // force scrollbars
    outer.style.overflow = "scroll";
    // add innerdiv
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);
    var widthWithScroll = inner.offsetWidth;
    // remove divs
    outer.parentNode.removeChild(outer);
    return widthNoScroll - widthWithScroll;
  }

  window.orient_express_refresh_size_queries =
    window.orient_express_refresh_size_queries ||
    function () {
      var classes = [];
      var scrollbarwidth = orient_express_getScrollbarWidth();
      window_width = $(window).width() + scrollbarwidth;
      window_height = $(window).height();
      is_phone = window_width < 768;
      is_mobile = window_width < 992;
      is_small_desktop = window_width <= 1024;
      is_tablet_portrait = window_width >= 768 && window_width < 992;
      is_tablet_landscape =
        window_width >= 992 && window_width < 1200 && window_height <= 768;
      is_tablet = is_tablet_portrait || is_tablet_landscape;
      is_desktop = window_width >= 992;
      is_desktop_large = window_width >= 1200;

      if (is_phone) {
        classes.push("mq_phone");
      }
      if (is_mobile) {
        classes.push("mq_mobile");
      }
      if (is_tablet_portrait) {
        classes.push("mq_tablet_portrait");
      }
      if (is_tablet_landscape) {
        classes.push("mq_tablet_landscape");
      }
      if (is_tablet) {
        classes.push("mq_tablet");
      }
      if (is_desktop) {
        classes.push("mq_desktop");
      }
      if (is_desktop_large) {
        classes.push("mq_desktop_large");
      }

      $("html").removeClass("mq_phone");
      $("html").removeClass("mq_mobile");
      $("html").removeClass("mq_tablet_portrait");
      $("html").removeClass("mq_tablet_landscape");
      $("html").removeClass("mq_tablet");
      $("html").removeClass("mq_desktop");

      $("html").addClass(classes.join(" "));
    };

  function orient_express_caching_fonts() {
    if (sessionStorage.fonts) {
      document.documentElement.classList.add("wf-active");
    }
  }

  // function orient_express_custom_fancybox() {
  //   $("[data-fancybox]").fancybox({
  //     buttons: ["close"],
  //     btnTpl: {
  //       arrowLeft:
  //         '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' +
  //         '<span class="fas fa-chevron-left"></span>' +
  //         "</button>",

  //       arrowRight:
  //         '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' +
  //         '<span class="fas fa-chevron-right"></span>' +
  //         "</button>",
  //     },
  //     afterLoad: function (fb, item) {
  //       item.$content
  //         .remove(".fb-caption")
  //         .append('<div class="fb-caption">' + item.opts.caption + "</div>");
  //     },
  //   });
  // }

  function orient_express_open_menu_mobile() {
    var wrap = $("#menu_sidebar_wrap");

    var submenus = wrap.find(".menu-item-has-children");
    submenus.each(function () {
      $(this).append('<span class="dropdown"></span>');
    });
    submenus.find(".dropdown").click(function () {
      $(this).toggleClass("rotate");
      $(this).prev().slideToggle();
    });

    $(".open_menu_mobile").on("keypress", function () {
      wrap.find("#menu_sidebar_wrap .close").focus();
    });

    $(".open_menu_mobile").on("click", function () {
      wrap.addClass("open");
      setTimeout(function () {
        wrap.addClass("visible");
      }, 300);

      $(this).fadeOut();
      $(".close, .close_sidebar").fadeIn();
      $(".popin-mobile-menu-wrapper").fadeIn();
    });

    $(".close, .close_sidebar").on("click", function () {
      wrap.removeClass("visible");
      setTimeout(function () {
        wrap.removeClass("open");
      }, 300);

      $(this).fadeOut();
      $(".open_menu_mobile").fadeIn();
      $(".popin-mobile-menu-wrapper").fadeOut();
    });
  }

  function orient_express_language_manager_on_focus() {
    //This function is for accessibility
    document.addEventListener("keydown", function (event) {
      if (event.which === 9) {
        // $('.logo-group').focus(function () {
        //     $('.hotel-group-nav').css({
        //         'display': 'block',
        //     });
        // });
        $("#primary_menu_sidebar a").focus(function () {
          $(this).next().css({
            display: "block",
          });
        });
        $(".primary_menu_sidebar .sub-menu li:last-child a").focusout(
          function () {
            $(".sub-menu").hide();
          }
        );
        $(".other_languages li:last-child a").focusout(function () {
          $(".other_languages").removeAttr("style");
        });

        $(".popin-mobile-menu-content .menu-item-has-children a").focus(
          function () {
            $(this).next().css({
              display: "block",
            });
          }
        );
        $(".popin-mobile-menu-content .sub-menu li:last-child a").focusout(
          function () {
            $(".sub-menu").hide();
          }
        );
        $(".popin-mobile-menu-content select").focusout(function () {
          $("#menu_sidebar_wrap .close").focus();
        });
      } else if (
        event.which === 13 &&
        $(event.target).attr("class") === "open_menu_mobile"
      ) {
        setTimeout(function () {
          $("#menu_sidebar_wrap .close").focus();
        }, 500);
      } else if (
        event.which === 13 &&
        $(event.target).attr("class") === "close"
      ) {
        setTimeout(function () {
          $(".open_menu_mobile").focus();
        }, 500);
      }
    });
  }

  function orient_express_slideshow() {
    if ($(".slideshow div.slide").length > 1) {
      var prev_next_btn = true;
      var show_dots = true;
    } else {
      prev_next_btn = false;
      show_dots = false;
    }

    $(".slideshow").not(".slick-initialized").slick({
      fade: false,
      arrows: prev_next_btn,
      dots: show_dots,
      autoplay: false,
      autoplaySpeed: 3000,
      draggable: true,
      infinite: true,
      // appendArrows: $(".arrows"),
      appendDots: $(".dots-container"),
      prevArrow: '<a href="javascript:;" class="arrow prev slick-prev"></a>',
      nextArrow: '<a href="javascript:;" class="arrow next slick-next"></a>',
      accessibility: true,
    });
  }

  function orient_express_mobile_do_preview_carousel() {
    if (is_mobile) {
      if ($("html").hasClass("single-post_journeys")) {
        if ($(".itineraries-wrapper .single-itinerary").length > 1) {
          var prev_next_btn = true;
          var show_dots = true;
        } else {
          prev_next_btn = false;
          show_dots = false;
        }

        $(".itineraries-wrapper")
          .not(".slick-initialized")
          .slick({
            rows: 0,
            fade: true,
            arrows: prev_next_btn,
            dots: show_dots,
            infinite: true,
            prevArrow:
              '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
              +'"></a>',
            nextArrow:
              '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
              +'"></a>',
            accessibility: true,
          });
      }
    }
  }

  function orient_express_itineraries_carousel() {
    var $itineraries = $(".itineraries_carousel");
    if ($itineraries.length === 0) return;
    $itineraries.each(function () {
      OEBookingEngine.bindItineraryBookNow(true);
      var nSlides = 3;
      if (is_tablet) {
        nSlides = 2;
      } else if (is_phone) {
        nSlides = 1;
      }
      var $slides = $(this).find(".children-wrap");
      if ($(this).find(".single-child-wrap").length > nSlides) {
        $slides.on("init", function () {
          lazyLoadInstance.update();
        });
        $slides.not(".slick-initialized").slick({
          rows: 0,
          fade: false,
          arrows: true,
          dots: true,
          slidesToShow: nSlides,
          variableWidth: true,
          // centerMode: true,
          appendDots: $(this).find(".dots-container"),
          infinite: false,
          prevArrow:
            '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
            +'"></a>',
          nextArrow:
            '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
            +'"></a>',
          accessibility: true,
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      }
    });
  }

  function orient_express_products_carousel($rand_carousel, $type_carousel) {
    var num_items = 1;
    if (typeof $type_carousel != "undefined" && $type_carousel !== null) {
      if ($type_carousel === "one_horizontal") {
        if (is_small_desktop) {
          num_items = 1;
        } else {
          num_items = 3;
        }
      }
    }

    $(".shop_" + $rand_carousel).each(function () {
      var arrows = $(".shop_" + $rand_carousel).find(".arrows");
      var dots = $(".shop_" + $rand_carousel).find(".dots-container");
      if ($(this).find(".single_product").length === 1) {
        num_items = 1;
        if (!is_phone) {
          $(this).find(".do_carousel_here").css("height", "100%");
        }
      }
      if ($(this).find(".single_product").length === 2) {
        num_items = is_small_desktop ? 1 : 2;
        if (!is_phone) {
          $(this).find(".do_carousel_here").css("height", "100%");
        }
      }

      $(
        ".shop_" + $rand_carousel + " .do_carousel_here:not(.slick-initialized)"
      ).slick({
        slidesToShow: num_items,
        rows: 0,
        arrows: true,
        dots: true,
        infinite: true,
        appendArrows: arrows,
        appendDots: dots,
        prevArrow:
          '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
          +'"></a>',
        nextArrow:
          '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
          +'"></a>',
        accessibility: true,
      });
    });
  }

  function orient_express_homepage_carousel($rand_carousel) {
    var arrows = $(".fullwidth_shop_" + $rand_carousel).find(".arrows");
    var dots = $(".fullwidth_shop_" + $rand_carousel).find(".dots-container");
    var slider = $(
      ".fullwidth_shop_" + $rand_carousel + " .fullwidth_do_carousel_here"
    );

    slider.on("init", function (event, slick) {
      // event subscriber goes here
      var index_prev =
        slider.find(".slick-active").first().data("slick-index") - 1;
      var index_next =
        slider.find(".slick-active").last().data("slick-index") + 1;
      var next_image = $(
        '.single_product[data-slick-index="' + index_next + '"] img'
      );
      var prev_image = $(
        '.single_product[data-slick-index="' + index_prev + '"] img'
      );
      next_image
        .attr("src", next_image.data("src"))
        .attr("data-was-processed", "true");
      prev_image
        .attr("src", prev_image.data("src"))
        .attr("data-was-processed", "true");
    });

    slider.on("beforeChange", function (event, slick, currentSlide, nextSlide) {
      lazyLoadInstance.update();

      var next_preload =
        slider.find(".slick-active").last().data("slick-index") + 2;
      var next_image = $(
        '.single_product[data-slick-index="' + next_preload + '"] img'
      );
      next_image
        .attr("src", next_image.data("src"))
        .attr("data-was-processed", "true");

      var prev_preload =
        slider.find(".slick-active").last().data("slick-index") + 2;
      var prev_image = $(
        '.single_product[data-slick-index="' + prev_preload + '"] img'
      );
      prev_image
        .attr("src", prev_image.data("src"))
        .attr("data-was-processed", "true");
    });

    var num_slides = 5;
    if (is_small_desktop) {
      num_slides = 3;
    }
    if (is_phone) {
      num_slides = 1;
    }

    $(
      ".fullwidth_shop_" +
        $rand_carousel +
        " .fullwidth_do_carousel_here:not(.slick-initialized)"
    ).slick({
      slidesToShow: num_slides,
      rows: 0,
      arrows: true,
      dots: true,
      infinite: true,
      appendArrows: arrows,
      appendDots: dots,
      // variableWidth: true,
      prevArrow:
        '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
        +'"></a>',
      nextArrow:
        '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
        +'"></a>',
      accessibility: true,
      // responsive: [
      //     {
      //         breakpoint: 1366,
      //         settings: {
      //             slidesToShow: 4,
      //             variableWidth: true,
      //         }
      //     },
      //     {
      //         breakpoint: 1024,
      //         settings: {
      //             slidesToShow: 3,
      //         }
      //     },
      //     {
      //         breakpoint: 768,
      //         settings: {
      //             slidesToShow: 2,
      //             // centerMode: true,
      //         }
      //     },
      // ]
    });
  }

  function orient_express_experiences_carousel() {
    var slider = $(
      ".experiences-highlight .highlight-content-wrap:not(.slick-initialized)"
    );
    var arrows = $(".experiences-highlight").find(".arrows");
    var dots = $(".experiences-highlight").find(".dots-container");

    if (slider.find(".highlight-margin-carousel").length > 1) {
      slider.slick({
        slidesToShow: 1,
        rows: 0,
        arrows: true,
        dots: true,
        infinite: true,
        prevArrow: '<a href="javascript:;" class="arrow prev slick-prev"></a>',
        nextArrow: '<a href="javascript:;" class="arrow next slick-next"></a>',
        accessibility: true,
      });
    } else {
      slider.slick({
        slidesToShow: 1,
        rows: 0,
        arrows: false,
        dots: false,
        infinite: false,
        // variableWidth: true,
        accessibility: true,
      });
    }
  }

  function orient_express_header_fixed() {
    var header = $("#header_wrapper"),
      breakpoint = header.height();

    if ($("body").hasClass("page-template-template-search")) {
      breakpoint = $("#header_menu_container").height();
    }
    if (
      $("body").hasClass("page-template-template-funnel-1") ||
      $("body").hasClass("page-template-template-funnel-2") ||
      $("body").hasClass("page-template-template-funnel-3") ||
      $("body").hasClass("page-template-template-funnel-3b") ||
      $("body").hasClass("page-template-template-funnel-4")
    ) {
      header.addClass("fixed");
      return;
    }

    if ($(window).scrollTop() >= breakpoint) {
      header.addClass("fixed");
      if ($("body").hasClass("page-template-template-search")) {
        $(".horizontal_searchbar").addClass("sticky_bar");
      }
    } else {
      header.removeClass("fixed");
      if ($("body").hasClass("page-template-template-search")) {
        $(".horizontal_searchbar").removeClass("sticky_bar");
      }
    }
  }

  function orient_express_flexible_section() {
    var containers = $(
      ".images-section-wrap .single-image, .timeline-section .cover-image, .two-images-section-wrap .single-image"
    );
    containers.each(function () {
      var video_container = $(this).find(".video-embed"),
        index = video_container.attr("data-counter");

      // $('#play_video_' + index).on('click', function(){
      if (video_container.hasClass("vimeo")) {
        $("#vimeo-embed-" + video_container.attr("data-counter")).height(
          video_container.height()
        );
        $.getScript("//player.vimeo.com/api/player.js").done(function (
          script,
          textStatus
        ) {
          var options = {
            id: video_container.attr("data-video"),
            width: 640,
            autoplay: false,
            loop: false,
          };
          var player = new Vimeo.Player(
            "vimeo-embed-" + video_container.attr("data-counter"),
            options
          );
          // on done
          player.on("loaded", function (data) {
            player.play();
          });
          // EVENTS
          // when video ends
          player.on("ended", function (data) {
            player.unload();
            $("#video-embed-" + index).fadeOut("fast");
          });
        });
      } else if (
        video_container.hasClass("youtube") &&
        !video_container.hasClass("vimeo")
      ) {
        // Load the IFrame Player API code asynchronously.
        var tag = document.createElement("script");
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName("script")[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.onYouTubeIframeAPIReady = function () {
          containers.each(function () {
            var video_container = $(this).find(".video-embed"),
              index = video_container.attr("data-counter");

            new YT.Player(
              "youtube-embed-" + video_container.attr("data-counter"),
              {
                height: "390",
                width: "640",
                videoId: video_container.attr("data-video"),
                events: {
                  onReady: function (event) {
                    $("#play_video_" + index).on("click", function () {
                      event.target.playVideo();
                      $("#video-embed-" + index).fadeIn();
                    });
                  },
                  onStateChange: function (event) {
                    if (event.data == YT.PlayerState.ENDED) {
                      event.target.stopVideo();
                      $("#video-embed-" + index).fadeOut("fast");
                    }
                  },
                },
              }
            );
          });
        };
      }
      // });
    });
  }

  function orient_express_children_tabs() {
    if ($(".children-tabs").length > 0) {
      $(".children-tabs").tabs({
        activate: function (event, ui) {
          $(".slick-slider").slick("setPosition");
        },
      });
    }
  }

  function orient_express_filters_w_pagination() {
    var itemSelector = ".single-child-wrap";

    var $container;
    if (is_mobile) {
      $container = $(".children-wrap").isotope({
        transitionDuration: 0,
        itemSelector: itemSelector,
        layoutMode: "fitRows",
      });
    } else {
      $container = $(".children-wrap").isotope({
        itemSelector: itemSelector,
        layoutMode: "fitRows",
        fitRows: {
          equalheight: true,
        },
      });
    }

    //Ascending order
    var responsiveIsotope = [
      [480, 9],
      [720, 9],
    ];

    var itemsPerPageDefault = 10;
    if ($("html").hasClass("itineraries-page")) {
      itemsPerPageDefault = 9;
    }
    var itemsPerPage = defineItemsPerPage();
    var currentNumberPages = 1;
    var currentPage = 1;
    var currentFilter = "*";
    var filterAtribute = "data-category";
    var pageAtribute = "data-page";
    var pagerClass = "main-pagination";
    var initPageNumber = 1;

    function changeFilter(selector) {
      $container.isotope({
        filter: selector,
      });
    }

    function goToPage(n) {
      currentPage = n;
      var selector = itemSelector;
      selector +=
        currentFilter != "*"
          ? "[" + filterAtribute + '*="' + currentFilter + '"]'
          : "";
      selector += "[" + pageAtribute + '="' + currentPage + '"]';
      changeFilter(selector);
    }

    function defineItemsPerPage() {
      var pages = itemsPerPageDefault;
      for (var i = 0; i < responsiveIsotope.length; i++) {
        if ($(window).width() <= responsiveIsotope[i][0]) {
          pages = responsiveIsotope[i][1];
          break;
        }
      }
      return pages;
    }

    function setPagination() {
      var itemsLength = $container.children(itemSelector).length;
      var pages = Math.ceil(itemsLength / itemsPerPage);
      var SettingsPagesOnItems = (function () {
        // var itemsLength = $container.children(itemSelector).length;
        // var pages = Math.ceil(itemsLength / itemsPerPage);
        var item = 1;
        var page = 1;
        var selector = itemSelector;

        selector +=
          currentFilter != "*"
            ? "[" + filterAtribute + '="' + currentFilter + '"]'
            : "";
        $container.children(selector).each(function () {
          if (item > itemsPerPage) {
            page++;
            item = 1;
          }
          $(this).attr(pageAtribute, page);
          item++;
        });
        currentNumberPages = page;
      })();

      if (pages > 1) {
        var CreatePagers = (function () {
          var $isotopePager =
            $("." + pagerClass).length == 0
              ? $('<div class="' + pagerClass + '"></div>')
              : $("." + pagerClass);
          $isotopePager.html("");
          for (var i = 0; i < currentNumberPages; i++) {
            $is_first = i === 0 ? "current" : "";
            var $pager = $(
              '<a href="javascript:void(0);" class="pager page-numbers ' +
                $is_first +
                '" ' +
                pageAtribute +
                '="' +
                (i + 1) +
                '"></a>'
            );
            $pager.html(i + 1);
            $pager.click(function () {
              $(".main-pagination a").removeClass("current");
              var page = $(this).eq(0).attr(pageAtribute);
              $(this).addClass("current");
              goToPage(page);

              setTimeout(function () {
                var init_posts = 0;
                if (is_mobile) {
                  init_posts =
                    parseInt($("#news, #itineraries").offset().top) - 100;
                } else {
                  init_posts =
                    parseInt($("#news, #itineraries").offset().top) - 200;
                }

                $(window).scrollTop(init_posts, { duration: 0 });
              }, 100);
            });
            $pager.appendTo($isotopePager);
          }
          $container.after($isotopePager);
        })();
      }
    }

    setPagination();
    goToPage(1);

    $(".single-child-wrap.last_item_extend").addClass("large full");

    //Adicionando Event de Click para as categorias
    $(".filter_container").on("click", "a", function () {
      var filter = $(this).attr(filterAtribute);
      currentFilter = filter;

      if (filter === "*") {
        $(".single-child-wrap.last_item_extend").addClass("large full");
      } else {
        $(".single-child-wrap.last_item_extend").removeClass("large full");
      }

      $(".children .event-type").each(function () {
        $(this).removeClass("activeFilter");
      });
      $(".children.section")
        .find('div[related-category="' + currentFilter + '"]')
        .each(function () {
          $(this).addClass("activeFilter");
        });

      $(this).siblings().removeClass("active");
      $(this).toggleClass("active");

      setPagination();
      goToPage(1);
    });

    $(".filter-wrap-mobile select").change(function () {
      var filter = $(this).val();
      currentFilter = filter;

      $(".children .event-type").each(function () {
        $(this).removeClass("activeFilter");
      });
      $(".children.section")
        .find('div[related-category="' + currentFilter + '"]')
        .each(function () {
          $(this).addClass("activeFilter");
        });

      // $(this).siblings().removeClass('active');
      // $(this).toggleClass('active');
      setPagination();
      goToPage(1);
    });
  }

  function skipToContent() {
    $(".skip-to-content").click(function () {
      var init_posts = parseInt($("#page").offset().top) - 150;

      $(window).scrollTop(init_posts, { duration: 0 });
    });
  }

  function orient_express_filters() {
    //Rooms and restaurants page
    if (
      $("html").hasClass("rooms-page") ||
      $("html").hasClass("restaurants-page") ||
      $("html").hasClass("explorations-page")
    ) {
      var container = $(".children-wrap");
      container.isotope({
        itemSelector: ".single-child-wrap",
        masonry: {
          // use element for option
          columnWidth: ".single-child-wrap",
        },
      });
    }

    if (
      $("html").hasClass("single_train_page") &&
      $("html").hasClass("rooms-page") &&
      !is_phone
    ) {
      var container = $(".children-wrap");
      if (is_mobile) {
        container.isotope({
          transitionDuration: 0,
          itemSelector: ".single-child-wrap",
          layoutMode: "fitRows",
        });
      } else {
        container.isotope({
          itemSelector: ".single-child-wrap",
          layoutMode: "fitRows",
          fitRows: {
            equalheight: true,
          },
        });
      }
    }

    //Photogallery page
    if ($(".photo-gallery-container").length) {
      var container = $(".photo-gallery-container");
      container.isotope({
        itemSelector: ".single-image-wrap",
        percentPosition: true,
        layoutMode: "masonry",
      });
    }

    //Special Offers page
    if ($("html").hasClass("special-offers-page")) {
      var container = $(".special-offers-wrapper");
      container.isotope({
        itemSelector: ".single-offer-wrap",
        masonry: {
          // use element for option
          columnWidth: ".single-offer-wrap",
        },
      });

      container.imagesLoaded().progress(function () {
        container.isotope("layout");
      });
    }

    if ($("html").hasClass("hotels-page")) {
      var container = $(".container-hotels");
      container.isotope({
        itemSelector: ".preview-page-block",
        masonry: {
          // use element for option
          columnWidth: ".preview-page-block",
        },
      });
    }

    //filter items on selct mobile version
    $(".filter-wrap-mobile select").change(function () {
      container.isotope({ filter: this.value });
    });
  }

  jQuery(document).ready(function ($) {
    // Khởi tạo Isotope
    var $grid = $(".children-wrap").isotope({
      itemSelector: ".single-child-wrap",
      layoutMode: "fitRows",
    });

    // Khi nhấn vào các nút lọc
    $(".filter_container a").on("click", function (e) {
      e.preventDefault();

      var filterValue = $(this).attr("data-category");

      // Áp dụng bộ lọc
      $grid.isotope({ filter: filterValue });

      // Đổi class "active" cho nút được chọn
      $(".filter_container a").removeClass("active");
      $(this).addClass("active");
    });

    // Khi chọn từ dropdown trên mobile
    $(".filter-wrap-mobile select").on("change", function () {
      var filterValue = $(this).val();
      $grid.isotope({ filter: filterValue });
    });
  });

  function orient_express_carousel_gallery_items() {
    if (
      $("html").hasClass("rooms-page") ||
      $("html").hasClass("restaurants-page") ||
      $("html").hasClass("events-meetings-page") ||
      $("html").hasClass("meetings-page") ||
      $("html").hasClass("single-post_event")
    ) {
      $(".single-child .mini-gallery-wrapper").each(function () {
        var slides = $(this).find(".single-image").length;
        if (slides > 1) {
          $(this).not(".slick-initialized").slick({
            rows: 0,
            fade: true,
            arrows: true,
            dots: true,
            infinite: true,
            prevArrow:
              '<a href="javascript:;" class="arrow prev slick-prev" ></a>',
            nextArrow:
              '<a href="javascript:;" class="arrow next slick-next" ></a>',
            accessibility: true,
          });
        }
      });
    }

    if ($("html").hasClass("page-template-template-funnel-1")) {
      $(".single_card .thumb-wrap.has-carousel").each(function () {
        var slides = $(this).find(".thumb").length;
        if (slides > 1) {
          $(this)
            .not(".slick-initialized")
            .slick({
              rows: 0,
              fade: true,
              arrows: true,
              dots: false,
              infinite: true,
              prevArrow:
                '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
                +'"></a>',
              nextArrow:
                '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
                +'"></a>',
              accessibility: true,
            });
        }
      });
    }
  }

  function orient_express_minigallery() {
    var playerInfoList = [];
    var minigalleries = $(".minigallery-wrapper");
    if (minigalleries.length > 0) {
      minigalleries.each(function () {
        var minigallery = $(this);
        minigallery.find(".play_video").each(function (index) {
          var video_cont = minigallery.find(".video-embed").eq(index);
          playerInfoList.push({
            id: "youtube-embed-" + video_cont.attr("data-counter"),
            height: "390",
            width: "640",
            videoId: video_cont.attr("data-video"),
          });
        });
      });

      minigalleries.each(function () {
        var minigallery = $(this);

        var prev_next_btn = false;
        if (minigallery.find(".single-image").length > 1) {
          prev_next_btn = true;
        }
        var numSlides = minigallery.data("slides");
        numSlides = numSlides ? numSlides : 1;
        var numSlidesPhone = numSlides > 1 ? 2 : 1;

        minigallery.not(".slick-initialized").slick({
          slidesToShow: numSlides,
          rows: 0,
          fade: numSlides == 1,
          arrows: prev_next_btn,
          dots: true,
          // lazyLoad: 'progressive',
          infinite: false,
          prevArrow:
            '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
            +'"></a>',
          nextArrow:
            '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
            +'"></a>',
          accessibility: true,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: numSlidesPhone,
              },
            },
            {
              breakpoint: 569,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });

        minigallery.find(".play_video").each(function (index) {
          $(this).on("click", function () {
            var player;
            var video_container = $(".video-embed").eq(index);
            //Check if is vimeo or youtube
            if (video_container.hasClass("vimeo")) {
              minigallery
                .find("#vimeo-embed-" + video_container.attr("data-counter"))
                .height(video_container.height());
              $.getScript("//player.vimeo.com/api/player.js").done(function (
                script,
                textStatus
              ) {
                var options = {
                  id: video_container.attr("data-video"),
                  width: 640,
                  autoplay: false,
                  loop: false,
                };
                var player = new Vimeo.Player(
                  "vimeo-embed-" + video_container.attr("data-counter"),
                  options
                );

                player.on("loaded", function (data) {
                  player.play();
                });
                // EVENTS
                // when video ends
                player.on("ended", function (data) {
                  player.unload();
                  minigallery.find(".video-embed").eq(index).fadeOut("fast");
                  minigallery.find(".arrow").find(".slick-dots").fadeIn();
                });
              });
            } else if (
              video_container.hasClass("youtube") &&
              !video_container.hasClass("vimeo")
            ) {
              // if(!isScriptLoaded("https://www.youtube.com/iframe_api")){
              var tag = document.createElement("script");
              tag.src = "https://www.youtube.com/iframe_api";
              var firstScriptTag = document.getElementsByTagName("script")[0];
              firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
              // }

              window.onYouTubeIframeAPIReady = function () {
                if (typeof playerInfoList === "undefined") return;

                for (var i = 0; i < playerInfoList.length; i++) {
                  var curplayer = createPlayer(playerInfoList[i]);
                }
              };
              function createPlayer(playerInfo) {
                return new YT.Player(playerInfo.id, {
                  height: playerInfo.height,
                  width: playerInfo.width,
                  videoId: playerInfo.videoId,
                  events: {
                    onReady: onPlayerReady,
                    onStateChange: onPlayerStateChange,
                  },
                });
              }

              /* window.onYouTubeIframeAPIReady = function () {
                               console.log('player ready');
                               player = new YT.Player('youtube-embed-' + video_container.attr('data-counter'), {
                                   height: '390',
                                   width: '640',
                                   videoId: video_container.attr('data-video'),
                                   events: {
                                       'onReady': onPlayerReady,
                                       'onStateChange': onPlayerStateChange
                                   }
                               });
                           };*/

              function onPlayerReady(event) {
                minigallery.find(".arrow").find(".slick-dots").fadeOut();
                event.target.playVideo();
              }

              function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                  event.target.stopVideo();
                  minigallery.find(".video-embed").eq(index).fadeOut("fast");
                  minigallery.find(".arrow").find(".slick-dots").fadeIn();
                }
              }
            }

            minigallery.find(".video-embed").eq(index).fadeIn();
          });
        });
      });
    }
  }

  function orient_express_photogallery() {
    if ($("html").hasClass("photogallery-page")) {
      AOS.init({
        startEvent: "load",
        duration: 2000,
      });

      $(".photo-gallery-container .single-image-wrap").each(function () {
        var video_container = $(this).find(".video-embed"),
          index = video_container.attr("data-counter");

        $("#play_video_" + index).on("click", function () {
          var player;
          if (video_container.hasClass("vimeo")) {
            $("#vimeo-embed-" + video_container.attr("data-counter")).height(
              video_container.height()
            );
            $.getScript("//player.vimeo.com/api/player.js").done(function (
              script,
              textStatus
            ) {
              var options = {
                id: video_container.attr("data-video"),
                width: 640,
                autoplay: false,
                loop: false,
              };
              var player = new Vimeo.Player(
                "vimeo-embed-" + video_container.attr("data-counter"),
                options
              );
              // on done
              player.on("loaded", function (data) {
                player.play();
              });
              // EVENTS
              // when video ends
              player.on("ended", function (data) {
                player.unload();
                $("#video-embed-" + index).fadeOut("fast");
              });
            });
          } else if (
            video_container.hasClass("youtube") &&
            !video_container.hasClass("vimeo")
          ) {
            // Load the IFrame Player API code asynchronously.
            var tag = document.createElement("script");
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubeIframeAPIReady = function () {
              player = new YT.Player(
                "youtube-embed-" + video_container.attr("data-counter"),
                {
                  height: "390",
                  width: "640",
                  videoId: video_container.attr("data-video"),
                  events: {
                    onReady: onPlayerReady,
                    onStateChange: onPlayerStateChange,
                  },
                }
              );
            };

            function onPlayerReady(event) {
              event.target.playVideo();
            }

            function onPlayerStateChange(event) {
              if (event.data == YT.PlayerState.ENDED) {
                event.target.stopVideo();
                $("#video-embed-" + index).fadeOut("fast");
              }
            }
          }
          $("#video-embed-" + index).fadeIn();
        });
      });

      //animation on mobile
      if (is_mobile) {
        $(".single-image-wrap").each(function () {
          $(this).attr("data-aos-delay", 250);
        });
      }
    }
  }

  function orient_express_slideshow_scrolldown() {
    $(".scoll_down_slideshow").click(function () {
      $("html, body").animate(
        { scrollTop: $("#page").offset().top - 100 },
        1000
      );
    });
  }

  function orient_express_back_to_top() {
    var __preview_main_content = false;
    if ($("#page").length > 0) {
      var position_main = $("#page").offset().top; /* - $(window).height()*/
      $(window).on("scroll", function () {
        var scrollPosition = window.pageYOffset;
        if (!__preview_main_content && scrollPosition >= position_main) {
          __preview_main_content = true;
          $(".back-to-top").addClass("show");
        }
        if (scrollPosition < position_main) {
          __preview_main_content = false;
          $(".back-to-top").removeClass("show");
        }
      });
    }

    $(".back-to-top").click(function () {
      $("html, body").animate({ scrollTop: 0 }, 1000);
    });
  }

  function orient_express_timeline_section() {
    if (
      $("html").hasClass("single-post_itinerary") ||
      $("html").hasClass("page-template-template-history") ||
      $("html").hasClass("page-template-template-heritage")
    ) {
      //Parallax effect when you scroll
      var rellax = new Rellax(".custom-bg", {
        speed: -4,
        center: true,
      });
      var rellax_image = new Rellax(".cover-image img", {
        speed: -2.5,
        center: true,
      });

      $(".play_video").each(function (index) {
        $(this).on("click", function () {
          var player;
          var video_container = $(".video-embed").eq(index);
          //Check if is vimeo or youtube
          if (video_container.hasClass("vimeo")) {
            $("#vimeo-embed-" + video_container.attr("data-counter")).height(
              video_container.height()
            );
            $.getScript("//player.vimeo.com/api/player.js").done(function (
              script,
              textStatus
            ) {
              var options = {
                id: video_container.attr("data-video"),
                width: 640,
                autoplay: false,
                loop: false,
              };
              var player = new Vimeo.Player(
                "vimeo-embed-" + video_container.attr("data-counter"),
                options
              );
              // on done
              player.on("loaded", function (data) {
                player.play();
              });
              // EVENTS
              // when video ends
              player.on("ended", function (data) {
                player.unload();
                $(".video-embed").eq(index).fadeOut("fast");
              });
            });
          } else if (
            video_container.hasClass("youtube") &&
            !video_container.hasClass("vimeo")
          ) {
            var tag = document.createElement("script");
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubeIframeAPIReady = function () {
              player = new YT.Player(
                "youtube-embed-" + video_container.attr("data-counter"),
                {
                  height: "390",
                  width: "640",
                  videoId: video_container.attr("data-video"),
                  events: {
                    onReady: onPlayerReady,
                    onStateChange: onPlayerStateChange,
                  },
                }
              );
            };

            function onPlayerReady(event) {
              event.target.playVideo();
            }

            function onPlayerStateChange(event) {
              if (event.data == YT.PlayerState.ENDED) {
                event.target.stopVideo();
                $(".video-embed").eq(index).fadeOut("fast");
              }
            }
          }

          $(".video-embed").eq(index).fadeIn();
        });
      });
    }
  }

  function orient_express_here_map() {
    if ($("html").hasClass("single-post_exploration")) {
    }
  }

  function orient_express_mobile() {
    //Remove Class full on mobile version
    if (is_mobile) {
      if (
        $("html").hasClass("rooms-page") ||
        $("html").hasClass("restaurants-page")
      ) {
        $(".single-child-wrap.large").removeClass("full");
      }
    }
  }

  function orient_express_slideshow_select_hotel() {
    var select_hotels = $("#slideshow_select_hotel");
    if (select_hotels.length === 0) return;

    select_hotels.find("select").change(function () {
      select_hotels
        .find(".view-more")
        .attr("href", select_hotels.find("select").val());
    });
  }

  function orient_express_init_select_BF(choose_hotel) {
    $("#bookingform-check")
      .find('input[name="destination"]')
      .val(choose_hotel.children("option:selected").attr("data-hotelid"));
    orient_express_max_adults = choose_hotel
      .children("option:selected")
      .attr("data-maxadults");
    orient_express_max_childs = choose_hotel
      .children("option:selected")
      .attr("data-maxchild");
    orient_express_max_rooms = choose_hotel
      .children("option:selected")
      .attr("data-maxrooms");

    oe_update_select();
  }

  function orient_express_bookingform_hotelID() {
    var choose_hotel = $("#hotel-check");
    if (choose_hotel.length === 0) return;

    orient_express_init_select_BF(choose_hotel);

    choose_hotel.change(function () {
      orient_express_init_select_BF(choose_hotel);
    });
  }

  function oe_update_select() {
    if ($("#bookingform-check").length == 0) return;

    var select_adults = $('select[id$="_adultNumber_select"]');
    var select_child = $('select[id$="_childrenNumber_select"]');
    var max_rooms = $("#roomNumber-check");

    if (select_adults.length > 0) {
      select_adults.each(function () {
        var selected = $(this);
        selected.children().show();
        for (
          $adult = parseInt(orient_express_max_adults) + 1;
          $adult <= 6;
          $adult++
        ) {
          selected.find('option[value="' + $adult + '"]').hide();
        }
      });
    }

    if (select_child.length > 0) {
      select_child.each(function () {
        var selected_c = $(this);
        selected_c.children().show();
        for (
          $child = parseInt(orient_express_max_childs) + 1;
          $child <= 5;
          $child++
        ) {
          selected_c.find('option[value="' + $child + '"]').hide();
        }
      });
    }

    if (max_rooms.length > 0) {
      max_rooms.children().show();
      for (
        $rooms = parseInt(orient_express_max_rooms) + 1;
        $rooms <= 3;
        $rooms++
      ) {
        max_rooms.find('option[value="' + $rooms + '"]').hide();
      }
    }
  }

  function orient_express_carousel_highlighted_hotels() {
    if (
      $("html").hasClass("oe_group_site") &&
      $("body").hasClass("home") &&
      !$("html").hasClass("mq_mobile")
    ) {
      var do_slideshow = $(".slideshow_highlited");
      if (do_slideshow.length === 0) return;

      if (hotels_highlight != "undefined") {
        var arrows = false;
        var number_slide =
          hotels_highlight === 1 || hotels_highlight > 2 ? 1 : 2;

        if (
          hotels_highlight > 2 ||
          ($("html").hasClass("mq_mobile") && hotels_highlight > 1)
        ) {
          arrows = true;
        }
      }

      do_slideshow.not(".slick-initialized").slick({
        slidesToShow: number_slide,
        arrows: arrows,
        dots: false,
        infinite: true,
        prevArrow:
          '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
          +'"></a>',
        nextArrow:
          '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
          +'"></a>',
        accessibility: true,
      });
    }
  }

  function orient_express_open_booking_sidebar() {
    if (window.oe_train_has_booking_engine) {
      var linkb = $("#book_now");
      var wrapb = $("#open_bookingform_wrap");
      var closeb = wrapb.find(".close_sidebar");
      if (linkb.length > 0 && wrapb.length > 0) {
        linkb.click(function () {
          wrapb.addClass("open");
          setTimeout(function () {
            wrapb.addClass("visible");
          }, 300);
          $("html").addClass("no_scroll");

          $("#open_bookingform_wrap .close_sidebar").focus();
        });

        closeb.click(function () {
          wrapb.removeClass("visible");
          setTimeout(function () {
            wrapb.removeClass("open");
          }, 300);
          $("html").removeClass("no_scroll");
        });
      }
    } else {
      $("#book_now").on("click", function () {
        //TODO
      });
    }
  }

  function orient_express_init_highlife() {
    var linkb = $(".content_under_slider");
    if (linkb.length > 0) {
      $("#page .the-title").addClass("extra_padding");
    }
  }

  function orient_express_post_copyURI() {
    var copyTextButton = $("#copy_link_button");
    copyTextButton.click(function () {
      /* Get the text field */
      var textToCopy = $("#copy_link");

      /* Select the text field */
      textToCopy.select();

      /* Copy the text inside the text field */
      document.execCommand("copy");

      $(".label_copied").show(500).delay(2500).hide(500);
    });
  }

  function orient_express_services_contact() {
    $("#contact_hotel").slideDown({
      start: function () {
        $(this).css({ display: "flex" });
      },
    });

    var curr_url = window.location.href;
    curr_url = curr_url.split("?")[1];
    if (curr_url !== undefined) {
      $("#" + curr_url).slideDown();
      var select_change = curr_url.replace("_form_wrapper", "");
      $("#select_service").val(select_change);
    } else {
      $("#generic_form_wrapper").slideDown();
    }

    //on change
    $("#select_service").on("change", function () {
      var select_opt = $(this).find("option:selected").val();
      setTimeout(function () {
        $("#contact_" + select_opt).slideDown();
      }, 300);

      //show selected form
      $(".hide_box").slideUp();
      setTimeout(function () {
        $("#" + select_opt + "_form_wrapper").slideDown();
      }, 300);
    });
  }

  function orient_express_trains_contact() {
    // $('#contact_hotel').slideDown({
    //     start: function () {
    //         $(this).css({display: "flex"})
    //     }
    // });

    var curr_url = window.location.href;
    curr_url = curr_url.split("?")[1];
    if (curr_url !== undefined) {
      $("#" + curr_url).slideDown();
      var select_change = curr_url.replace("_form_wrapper", "");
      $("#select_service").val(select_change);
    } else {
      $("#full_generic_form_wrapper").slideDown();
    }

    //on change
    $("#select_service").on("change", function () {
      var select_opt = $(this).find("option:selected").val();
      setTimeout(function () {
        $("#contact_" + select_opt).slideDown();
      }, 300);

      //show selected form
      $(".hide_box").slideUp();
      setTimeout(function () {
        $("#" + select_opt + "_form_wrapper").slideDown();
      }, 300);
    });
  }

  function orient_express_trains_contact_forms() {
    var curr_url = window.location.href;
    curr_url = curr_url.split("?")[1];
    if (curr_url !== undefined) {
      $("#" + curr_url).slideDown();
      var select_change = curr_url.replace("_form_wrapper", "");
      $("#select_service").val(select_change);
    } else {
      $("#train_general_form_wrapper").slideDown();
    }

    //on change
    $("#select_service").on("change", function () {
      var select_opt = $(this).find("option:selected").val();

      $(document).on(
        "change countrychange",
        "#form_phone_train_callback_placeholder",
        function () {
          var iti = window.intlTelInputGlobals.getInstance(
            document.querySelector("#form_phone_train_callback_placeholder")
          );
          var dialCode =
            "+" +
            iti.getSelectedCountryData().dialCode +
            " " +
            iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
          $("#form_phone_train_callback").val(dialCode);

          $("#form_train_callback_country").val(
            iti.getSelectedCountryData().name
          );
        }
      );

      //show selected form
      $(".hide_box").slideUp();
      setTimeout(function () {
        $("#" + select_opt + "_form_wrapper").slideDown();

        setTimeout(function () {
          var input = document.querySelector(
            "#form_phone_train_callback_placeholder"
          );
          window.intlTelInput(input).setCountry("fr");
        }, 350);
      }, 300);
    });
  }

  function open_hotels_infos() {
    $(".more_options").slideUp();

    $(".open_more_options_contacts").click(function () {
      $(".more_options").slideUp();
      $("#hotels_infos .plus").css("display", "flex");
      $("#hotels_infos .minus").hide();

      var content = $(this).next();
      if (content.is(":visible")) {
        content.slideUp();
        $(this).find(".plus").css("display", "flex");
        $(this).find(".minus").hide();
      } else {
        content.slideDown();
        $(this).find(".plus").hide();
        $(this).find(".minus").css("display", "flex");
      }
    });
  }

  function orient_express_video_slideshow() {
    if ($("#play_video").length > 0) {
      var video = $("#video_slideshow");
      var stop_video = $(".stop_video");
      var volume_video = $("#volume_video");
      var play_video = $("#play_video");
      var form_search = $("#slideshow_wrapper + .form_date-search");
      video.fadeIn(100, function () {
        stop_video.fadeIn();
        volume_video.fadeIn();
        video[0].play();

        stop_video.click(function () {
          video[0].pause();
          video.fadeOut();
          stop_video.fadeOut();
          volume_video.fadeOut();
          play_video.fadeIn();
          form_search.fadeIn(100);
        });

        // var under_slideshow = parseInt($('#page').offset().top);
        $(window).on("scroll", function () {
          if ($(window).scrollTop() >= 300) {
            stop_video.fadeOut();
            volume_video.fadeOut();
            // play_video.fadeIn();
            video[0].pause();
          } else {
            if ($("#video_slideshow:visible").length !== 0) {
              stop_video.fadeIn();
              volume_video.fadeIn();
              video[0].play();
            }
          }
        });
      });

      $("#play_video").click(function () {
        video.fadeIn(1000, function () {
          form_search.fadeOut(10);
          stop_video.fadeIn();
          volume_video.fadeIn();
          video[0].play();
          stop_video.click(function () {
            video[0].pause();
            video.fadeOut();
            stop_video.fadeOut();
            volume_video.fadeOut();
            play_video.fadeIn();
            form_search.fadeIn(100);
          });
        });
      });

      $("#volume_video").click(function () {
        if ($(this).hasClass("is_muted")) {
          video.prop("muted", false);
          $(this).removeClass("is_muted");
        } else {
          video.prop("muted", true);
          $(this).addClass("is_muted");
        }
      });

      if ($("body").hasClass("page-template-template-news")) {
        if (video.length > 0) {
          new Rellax("#video_slideshow", {
            speed: -4,
            center: true,
          });

          var matrix = $("#video_slideshow").css("-webkit-transform");
          var translate_val = matrix.match(/-?[\d\.]+/g);
          // if(is_mobile){

          video.css("top", -translate_val[translate_val.length - 1]);
          // } else {
          //     video.css('top', '0');
          // }
        }
      }
    }
  }

  function orient_express_accor_brands() {
    var arrows = $("#brand-category-luxury").find(".arrows");
    $(".brand-logo-type-content:not(.slick-initialized)").slick({
      slidesToShow: 10,
      rows: 0,
      arrows: true,
      dots: false,
      infinite: true,
      appendArrows: arrows,
      prevArrow:
        '<a href="javascript:;" class="arrow prev slick-prev" aria-label="' +
        +'"></a>',
      nextArrow:
        '<a href="javascript:;" class="arrow next slick-next" aria-label="' +
        +'"></a>',
      accessibility: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 7,
          },
        },
        {
          breakpoint: 810,
          settings: {
            slidesToShow: 5,
            // centerMode: true,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 4,
            // centerMode: true,
          },
        },
        {
          breakpoint: 560,
          settings: {
            slidesToShow: 3,
            // centerMode: true,
          },
        },
        {
          breakpoint: 414,
          settings: {
            slidesToShow: 2,
            // centerMode: true,
          },
        },
      ],
    });
  }

  function orient_express_refresh_aria_links() {
    if (!is_mobile) {
      $(".footer_menu")
        .find("a.more_li")
        .each(function () {
          $(this).attr("tabindex", "-1");
          $(this).attr("aria-hidden", "true");
        });
      $(".accor-brands .brand-category-type").each(function () {
        $(this).attr("tabindex", "-1");
        // $(this).attr('aria-hidden', 'true')
      });
    }
  }

  function orient_express_instagram_feed() {
    var instagram_feed_container = $($("#sb-instragam-feed").text());
    var items = instagram_feed_container.find(".sbi_item");
    items.each(function () {
      var image_url = $(this).find(".sbi_photo").data("full-res");
      var post_url = $(this).find(".sbi_instagram_link").attr("href");
      var post_title = $(this).find(".sbi_link_area").data("title");
      var newItem =
        '<div class="single-instagram-feed"><a target="_blank" href="' +
        post_url +
        '"><img src="' +
        image_url +
        '" alt="' +
        post_title +
        '" width="200" height="200"></div>';
      $(".instagram-feed-container").append(newItem);
    });
  }

  function orient_express_handler_instagram() {
    var insta_loaded = false;
    if ($(".instagram-feed-container").length === 0) return false;

    var position_instagram = $(".instagram-feed-container").offset().top;
    $(window).on("scroll", function () {
      var scrollPosition = window.pageYOffset;
      if (!insta_loaded && scrollPosition >= 500) {
        insta_loaded = true;
        //init instagram feed pro
        orient_express_instagram_feed();
      }
    });
  }

  //Load Window
  $(window).on("load", function () {
    if ($("body").hasClass("home")) {
      setTimeout(function () {
        $("#loader_css").fadeOut(1000);
      }, 100);
    }

    // AOS.init();

    // orient_express_handler_instagram();

    setTimeout(function () {
      $("#sbi_images a").attr("tabindex", -1);
      $("#sbi_images a.sbi_link_area").attr("tabindex", 0);
    }, 1000);

    $("#sbi_lightbox").bind("display", function (e) {
      alert("display has changed to :" + $(this).attr("style"));
      $("#sbi_lightbox .sbi_lb-close").focus();
    });

    orient_express_caching_fonts();
    orient_express_refresh_size_queries();

    orient_express_open_booking_sidebar();
    orient_express_post_copyURI();

    if ($(".do_accordion_here").length) {
      $(".do_accordion_here").accordion({
        header: "> .title_to_open",
        heightStyle: "content",
        active: false,
        collapsible: true,
      });
    }
  });

  //Resize Window
  $(window).resize(function () {
    orient_express_refresh_size_queries();
    //orient_express_contact_form_position();
    //orient_express_contact_slideshow_height();
    orient_express_mobile();
    orient_express_itineraries_carousel();

    if ($(".no_slideshow").length) {
      $(".no_slideshow").css("height", $("#header").height());
    }
  });

  //Dom ready
  $(document).ready(function () {
    window.lazyLoadInstance = new LazyLoad({
      elements_selector: ".lazy",
      threshold: 50,
    });

    if ($(".no_slideshow").length) {
      $(".no_slideshow").css("height", $("#header").height());
    }

    orient_express_refresh_size_queries();
    skipToContent();
    orient_express_slideshow();

    orient_express_video_slideshow();

    orient_express_header_fixed();
    orient_express_open_menu_mobile();
    orient_express_language_manager_on_focus();
    window.onscroll = function () {
      orient_express_header_fixed();
    };
    orient_express_flexible_section();
    orient_express_carousel_gallery_items();
    orient_express_minigallery();
    orient_express_children_tabs();
    orient_express_timeline_section();
    orient_express_photogallery();
    orient_express_here_map();
    orient_express_back_to_top();
    orient_express_mobile();

    orient_express_slideshow_select_hotel();
    orient_express_bookingform_hotelID();
    orient_express_carousel_highlighted_hotels();
    orient_express_init_highlife();
    orient_express_experiences_carousel();

    orient_express_mobile_do_preview_carousel();

    orient_express_itineraries_carousel();

    if ($(".carousel_fullwidth_products").length > 0) {
      $(".carousel_fullwidth_products").each(function () {
        var rand = $(this).data("randshop");
        orient_express_homepage_carousel(rand);
      });
    }

    //Parallax effect when you scroll
    if (!is_mobile) {
      var rellax_highlight = new Rellax(".preview-page-block .thumb", {
        speed: -4,
        center: true,
      });
    } else {
      var rellax_highlight = new Rellax(".preview-page-block .thumb", {
        speed: -1,
        center: true,
      });
    }

    //contact page
    if (
      $("html").hasClass("page-template-template-contacts") ||
      $("html").hasClass("page-template-template-train-contacts")
    ) {
      $("input.datepicker")
        .datepicker({
          inline: true,
          dateFormat: "mm/dd/yy",
          minDate: new Date(),
        })
        .attr("maxlength", "10");

      $("input.datepicker").on("keyup", function (e) {
        var textSoFar = $(this).val();
        if (e.keyCode != 191) {
          if (e.keyCode != 8) {
            if (textSoFar.length == 2 || textSoFar.length == 5) {
              $(this).val(textSoFar + "/");
            }
            //to handle copy & paste of 8 digit
            else if (e.keyCode == 86 && textSoFar.length == 8) {
              $(this).val(
                textSoFar.substr(0, 2) +
                  "/" +
                  textSoFar.substr(2, 2) +
                  "/" +
                  textSoFar.substr(4, 4)
              );
            }
          } else {
            //backspace would skip the slashes and just remove the numbers
            if (textSoFar.length == 5) {
              $(this).val(textSoFar.substring(0, 4));
            } else if (textSoFar.length == 2) {
              $(this).val(textSoFar.substring(0, 1));
            }
          }
        } else {
          //remove slashes to avoid 12//01/2014
          $(this).val(textSoFar.substring(0, textSoFar.length - 1));
        }
        if (textSoFar.length == 10) {
          var GivenDate =
            textSoFar.substring(6, 10) +
            "-" +
            textSoFar.substring(3, 4) +
            "-" +
            textSoFar.substring(0, 1);
          var CurrentDate = new Date();
          GivenDate = new Date(GivenDate);

          if (GivenDate < CurrentDate) {
            var date =
              CurrentDate.getDate() < 10
                ? "0" + CurrentDate.getDate()
                : CurrentDate.getDate();
            date += "/";
            date +=
              CurrentDate.getMonth() + 1 < 10
                ? "0" + (CurrentDate.getMonth() + 1)
                : CurrentDate.getMonth() + 1;
            date += "/";
            date += CurrentDate.getFullYear();
            $(this).val(date);
          }
        }
      });
    }

    //contact page
    if ($("html").hasClass("page-template-template-contacts")) {
      open_hotels_infos();

      if ($("html").hasClass("single_train_page")) {
        orient_express_trains_contact();

        var forms = ["full_generic_form", "celebration_form"];
        for (var f = 0; f < forms.length; f++) {
          orient_express_contact_form(forms[f]);
        }
      } else if ($("html").hasClass("oe_group_site")) {
        orient_express_services_contact();

        var forms = [
          "generic_form",
          "press_form",
          "travels_form",
          "events_form",
          "filming_form",
        ];
        for (var f = 0; f < forms.length; f++) {
          orient_express_contact_form(forms[f]);
        }
      }
    }
    //train contact forms
    if ($("html").hasClass("page-template-template-train-contacts")) {
      orient_express_trains_contact_forms();

      var forms = ["train_general_form", "train_callback_form"];
      for (var f = 0; f < forms.length; f++) {
        orient_express_contact_form(forms[f]);
      }
    }

    orient_express_refresh_aria_links();

    orient_express_accor_brands();

    if (
      $("html").hasClass("page-template-template-news") ||
      $("html").hasClass("experiences-page") ||
      $("html").hasClass("itineraries-page")
    ) {
      orient_express_filters_w_pagination();
    } else {
      orient_express_filters();
    }

    if (
      $("body").hasClass("page-template-template-news") ||
      $("body").hasClass("single-post")
    ) {
      $(".change_color_box").each(function () {
        var color_box = $(this).data("bgcolor");
        $(this).css("background-color", color_box);
      });

      orient_express_slideshow_scrolldown();

      $(".do_carousel_here").each(function () {
        var n_shop = $(this).prev().data("shop");
        var open = $('.btn_open[data-shop="' + n_shop + '"]');
        var close = $('.btn_close[data-shop="' + n_shop + '"]');
        var product_counter = $(".shop_" + n_shop).find(
          ".single_product:not(.slick-cloned)"
        ).length;
        open.text(open.text() + " (" + product_counter + ")");
        close.text(close.text() + " (" + product_counter + ")");
      });

      $(".two-images-section-wrap.shop_variation .btn_open").click(function () {
        $(this).hide();
        var rand = $(this).data("shop");
        var type_carousel = $(this).data("carouseltype");
        $(".shop_" + rand + " .close_hidden_shop_carousel").show();
        $('.btn_close[data-shop="' + rand + '"]').css("display", "flex");
        $(".shop_" + rand).slideDown("slow", function () {
          // Animation complete.
          orient_express_products_carousel(rand, type_carousel);
        });
      });
      $(
        ".two-images-section-wrap.shop_variation .btn_close, .close_hidden_shop_carousel"
      ).click(function () {
        $(this).hide();
        var rand = $(this).data("shop");
        $('.btn_close[data-shop="' + rand + '"]').hide();
        $('.btn_open[data-shop="' + rand + '"]').css("display", "flex");
        $(".shop_" + rand).slideUp("slow");
      });
    }

    if ($("body").hasClass("page-template-template-news")) {
      new Rellax("#slideshow_wrapper .slide_image", {
        speed: -4,
        center: true,
      });
    }

    // orient_express_contact_form('newsletter_form');

    if (
      $("html").hasClass("single_train_page") &&
      ($(".be_phone").length > 0 ||
        $(".funnel_sidebar").length > 0 ||
        $(".mobile-bottom-bar").length > 0)
    ) {
      function displayNumberByCountry(country) {
        var phoneNumberForOthers = "";
        var theNumber = phoneNumberForOthers;
        country = country || "OTHERS";
        Object.keys(oe_callcenters_by_country).forEach(function (
          callcenterNumber
        ) {
          var countries = oe_callcenters_by_country[callcenterNumber].map(
            function (c) {
              return c.toUpperCase();
            }
          );
          if (countries.indexOf(country) !== -1) {
            theNumber = callcenterNumber;
          }
          if (countries.indexOf("OTHERS") !== -1) {
            phoneNumberForOthers = callcenterNumber;
          }
        });
        if (theNumber === "") {
          theNumber = phoneNumberForOthers;
        }
        $(".be_phone a.phone, .funnel_sidebar a.phone, .title_divided a.phone")
          .attr("href", "tel:" + theNumber.replace(/[^\d+]+/g, ""))
          .text(theNumber);
        $("a.be_phone")
          .attr("href", "tel:" + theNumber.replace(/[^\d+]+/g, ""))
          .find("span.phone")
          .text(theNumber);
        $(".mobile-bottom-bar a.contact-us").attr(
          "href",
          "tel:" + theNumber.replace(/[^\d+]+/g, "")
        );
      }
      if (window.sessionStorage) {
        var country = sessionStorage.getItem("oe_user_country");
        if (country && country != "") {
          displayNumberByCountry(country);
        } else {
          // API from Macaron
          $.get(
            "https://europe-west3-dedge-cookies.cloudfunctions.net/webReqs/country/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzY29wZXMiOiJ3d3cub3JpZW50LWV4cHJlc3MuY29tIiwiaWF0IjoxNjUyMTg5NjcxLCJqdGkiOiJlNmZiODY4OC04MzkwLTQ0ZWEtOThjOS02NWRhYmJmOTQzYWMifQ.DXtQvOQ0VwBTKY8aOTCsJ9_aD434g0Rh1g41f58sZ74",
            function (data) {
              displayNumberByCountry(data.country);
              window.sessionStorage &&
                sessionStorage.setItem("oe_user_country", data.country);
            }
          ).fail(function () {
            displayNumberByCountry("OTHERS");
          });
        }
      }
    }

    if ($("body").hasClass("page-template-template-train-contacts")) {
      if (window.sessionStorage) {
        var country = sessionStorage.getItem("oe_user_country");
        if (country && country != "") {
          $("select#form_train_country").val(country).change();
          $(
            'select#form_prefix_phone_train option[data-country="' +
              country +
              '"]'
          )
            .attr("selected", true)
            .change();
        } else {
          $("select#form_train_country").val("FR").change();
          $("select#form_prefix_phone_train").val("+33").change();
        }
      }

      $("input[type=radio][name=train_contact_mode]").change(function () {
        var selectedMode = this.value.toLowerCase();

        if (selectedMode == "phone") {
          $(".only_if_train_contact_mode_phone").each(function () {
            $(this).show();
            if ($(this).hasClass("make_mandatory")) {
              $(this).addClass("required");
            }
          });
        } else if (selectedMode == "email") {
          $(".only_if_train_contact_mode_phone").each(function () {
            $(this).removeClass("required");
            $(this).hide();
          });
        }
      });
    }
  });

  $(document).ready(function () {
    var checkIn = $(".checkInInput");
    var checkOut = $(".checkOutInput");

    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);

    checkIn.datepicker({
      dateFormat: "dd/mm/yy",
      minDate: 0,
      onClose: function (selectedDate) {
        var minDate = checkIn.datepicker("getDate");
        minDate.setDate(minDate.getDate() + 1);

        checkOut.datepicker("option", "minDate", minDate);
        checkOut.datepicker("setDate", minDate);
      },
    });

    checkOut.datepicker({
      dateFormat: "dd/mm/yy",
      minDate: 1,
    });

    checkIn.datepicker("setDate", today);
    checkOut.datepicker("setDate", tomorrow);
  });
  $(document).ready(function () {
    $(".modal-next").click(function (e) {
      e.preventDefault();
      var $modal = $(this).parents(".modal");
      $modal.modal("hide");
      if ($modal.nextAll(".modal").first().length > 0) {
        $modal.nextAll(".modal").first().modal("show");
      } else {
        $modal.prevAll(".modal").last().modal("show");
      }
    });
    $(".modal-prev").click(function (e) {
      e.preventDefault();
      var $modal = $(this).parents(".modal");
      $modal.modal("hide");
      if ($modal.prevAll(".modal").first().length > 0) {
        $modal.prevAll(".modal").first().modal("show");
      } else {
        $modal.nextAll(".modal").last().modal("show");
      }
    });
  });

  function adminbarHeight() {
    var adminbarHeight =
      $("#wpadminbar").length > 0 ? $("#wpadminbar").height() : 0;
    var siteheaderHeight =
      $(".site-header").length > 0 ? $(".site-header").outerHeight() : 0;
    $(window).resize(function () {
      adminbarHeight =
        $("#wpadminbar").length > 0 ? $("#wpadminbar").height() : 0;
      siteheaderHeight =
        $(".site-header").length > 0 ? $(".site-header").outerHeight() : 0;
    });
  }
  adminbarHeight();

  /**
   * Swiper Reviews
   */
  function slide() {
    $(".modal").on("show.bs.modal", function (e) {
      if (typeof e.relatedTarget != "undefined") {
        window.location.hash = $(e.relatedTarget).attr("href");
      }
    });
    $(".modal").on("hide.bs.modal", function (e) {
      history.pushState(
        "",
        document.title,
        window.location.pathname + window.location.search
      );
    });
    if (window.location.hash.indexOf("#modal-") !== -1) {
      $modal = $(window.location.hash);
      $modal.modal("show");
    }
    $('[href^="#modal-"]:not([data-toggle="modal"])').on("click", function () {
      $modal = $($(this).attr("href"));
      $modal.modal("show");
    });

    $('[data-toggle="tab"]').on("hide.bs.tab", function (e) {
      if (typeof e.relatedTarget != "undefined") {
        window.location.hash = $(e.relatedTarget).attr("href");
      }
    });
    if (window.location.hash.indexOf("#tab-") !== -1) {
      $('[data-toggle="tab"][href="' + window.location.hash + '"]').trigger(
        "click"
      );
      if (
        $('.modal [data-toggle="tab"][href="' + window.location.hash + '"]')
          .length > 0
      ) {
        $('[data-toggle="tab"][href="' + window.location.hash + '"]')
          .parents(".modal")
          .modal("show");
      }
    }

    var swiper = new Swiper(".swiper-reviews", {
      spaceBetween: 15,
      slidesPerView: 2,
      slidesPerGroup: 2,
      loop: false,
      loopFillGroupWithBlank: true,
      speed: 500,
      grid: {
        fill: "row",
        rows: 3,
      },
      navigation: {
        nextEl: ".swiper-reviews ~ .swiper-button-next",
        prevEl: ".swiper-reviews ~ .swiper-button-prev",
      },
      pagination: {
        el: ".swiper-reviews .swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        992: {
          spaceBetween: 30,
          slidesPerView: 4,
          slidesPerGroup: 4,
          loop: true,
          grid: {
            rows: 1,
          },
        },
      },
    });
  }
  slide();
})(jQuery);
