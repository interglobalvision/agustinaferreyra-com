/* jshint esversion: 6, browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

// Import dependencies
import lazySizes from 'lazysizes';

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
    this.postitDot();
  }

  onReady() {
    lazySizes.init();

    this.windowHeight = $(window).height();
    this.windowWidth = $(window).width();
    this.dotDiameter = 15;

    this.$postit = $('#postit');

    this.dotSize();
    this.positionPostit();
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
      var imageHeight = _this.$postit.outerHeight();
      var imageWidth = _this.$postit.outerWidth();

      var maxTop = 100 - ((imageHeight / _this.windowHeight) * 100);
      var maxLeft = 100 - ((imageWidth / _this.windowWidth) * 100);

      var randomTop = _this.randomInt(maxTop);
      var randomLeft = _this.randomInt(maxLeft);

      var randomRotate = _this.randomInt(10, -10);

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

  randomInt(max, min = 0) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
}

new Site();
