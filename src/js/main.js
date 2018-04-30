/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

// Import dependencies
import lazySizes from 'lazysizes';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import slick from 'slick-carousel';

// Import style
import '../styl/site.styl';

class Site {
  constructor() {
    this.mobileThreshold = 601;

    $(window).resize(this.onResize.bind(this));

    $(document).ready(this.onReady.bind(this));

  }

  onResize() {
    this.$windowHeight = $(window).height();
    this.$windowWidth = $(window).width();

    this.dotSize();
    this.positionPostit();
    this.layoutMasonry();
  }

  onReady() {
    lazySizes.init();

    this.windowHeight = $(window).height();
    this.windowWidth = $(window).width();
    this.dotDiameter = 15;
    this.masonryImagesLoaded = false;

    this.$window = $(window);
    this.$body = $('body');
    this.$mainContainer = $('#main-container');
    this.$postit = $('#postit');
    this.$masonryHolder = $('.masonry-holder');
    this.$slickCarousel = $('.slick-carousel');

    this.dotSize();
    this.positionPostit();
    this.initMasonry();
    this.bindCarouselToggles();
    this.initCarousel();
  }

  fixWidows() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  }

  dotSize() {
    var $dot = $('svg path.logo-dot');
    var _this = this;

    if ($dot.length) {
      _this.dotDiameter = $dot.first().width();
    }

    $('.dot').css({
      'height': _this.dotDiameter,
      'width': _this.dotDiameter,
      'border-radius': _this.dotDiameter,
    });

    this.stylePostitDot();
  }

  positionPostit() {
    var _this = this;

    if (_this.$postit.length) {
      var imageHeight = _this.$postit.outerHeight() * 1.2; // 1.2 to account for rotation
      var imageWidth = _this.$postit.outerWidth() * 1.2;

      var maxTop = 100 - ((imageHeight / _this.windowHeight) * 100); // image size percentage of window
      var maxLeft = 100 - ((imageWidth / _this.windowWidth) * 100);

      var randomTop = _this.randomInt(maxTop - 5, 5); // min 5% from any edge
      var randomLeft = _this.randomInt(maxLeft - 5, 5);

      var randomRotate = _this.randomInt(10, -10); // random rotation -10 to 10deg

      _this.$postit.css({
        'top': randomTop + 'vh',
        'left': randomLeft + 'vw',
        'transform': 'rotate(' + randomRotate + 'deg)',
      });
    }
  }

  stylePostitDot() {
    var _this = this;

    if (_this.$postit.length) {
      $('#postit-dot').css({
        'top': '-' + (_this.dotDiameter / 2) + 'px',
      });
    }
  }

  initMasonry() {
    var _this = this;

    if (_this.$masonryHolder.length) {
      imagesLoaded( '.masonry-holder', function() {
        _this.masonryImagesLoaded = true;

        _this.masonryInstance = new Masonry( '.masonry-holder', {
          itemSelector: '.masonry-item',
          transitionDuration: 0,
          initLayout: false,
          percentPosition: true
        });

        _this.masonryInstance.on('layoutComplete', function() {
          _this.$masonryHolder.removeClass('hidden');
        });

        _this.layoutMasonry();
      });
    }
  }

  layoutMasonry() {
    var _this = this;

    if (_this.masonryImagesLoaded) {
      _this.$masonryHolder.addClass('hidden');
      _this.masonryInstance.layout();
    }
  }

  randomInt(max, min = 0) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  bindCarouselToggles() {
    var _this = this;

    if ($('.carousel-trigger').length) {
      $('.carousel-trigger').on('click', function() {
        _this.scrollOffset = _this.$window.scrollTop();

        _this.$mainContainer.css('top', '-' + _this.scrollOffset + 'px');

        _this.$body.addClass('carousel-active');
      });

      $('.carousel-overlay').on('click', function(e) {
        if (!$(e.target).hasClass('slick-arrow')) {
          _this.$body.removeClass('carousel-active');

          _this.$window.scrollTop(_this.scrollOffset);
        }
      });
    }
  }

  initCarousel() {
    var _this = this;

    if (_this.$slickCarousel.length) {
      _this.$slickCarousel.slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        dots: false,
        arrows: true,
        focusOnSelect: false,
        rows: 0
      });
    }
  }
}

new Site();
