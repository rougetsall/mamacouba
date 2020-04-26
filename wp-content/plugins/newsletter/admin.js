jQuery.cookie = function(name, value, options) {
  if (typeof value != 'undefined') { // name and value given, set cookie
    options = options || {};
    if (value === null) {
      value = '';
      options.expires = -1;
    }
    var expires = '';
    if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
      var date;
      if (typeof options.expires == 'number') {
        date = new Date();
        date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
      } else {
        date = options.expires;
      }
      expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
    }
    // CAUTION: Needed to parenthesize options.path and options.domain
    // in the following expressions, otherwise they evaluate to undefined
    // in the packed version for some reason...
    var path = options.path ? '; path=' + (options.path) : '';
    var domain = options.domain ? '; domain=' + (options.domain) : '';
    var secure = options.secure ? '; secure' : '';
    document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
  } else { // only name given, get cookie
    var cookieValue = null;
    if (document.cookie && document.cookie != '') {
      var cookies = document.cookie.split(';');
      for (var i = 0; i < cookies.length; i++) {
        var cookie = jQuery.trim(cookies[i]);
        // Does this cookie string begin with the name we want?
        if (cookie.substring(0, name.length + 1) == (name + '=')) {
          cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
          break;
        }
      }
    }
    return cookieValue;
  }
};

function tnp_toggle_schedule() {
  jQuery("#tnp-schedule-button").toggle();
  jQuery("#tnp-schedule").toggle();
}

window.onload = function () {
  jQuery('.tnp-counter-animation').each(function () {
    var _this = jQuery(this);

    var val = null;
    if (!isFloat(_this.text())) {
      val = {
        parsed: parseInt(_this.text()),
        rounded: function (value) {
          return Math.ceil(value);
        }
      };

      if (_this.hasClass('percentage')) {
        _this.css('min-width', '60px');
      }
    } else {
      val = {
        parsed: parseFloat(_this.text()),
        rounded: function (value) {
          return value.toFixed(1);
        }
      };
    }

    jQuery({counter: 0}).animate({counter: val.parsed}, {
      duration: 1000,
      easing: 'swing',
      step: function () {
        _this.text(val.rounded(this.counter));
      }
    });

    function isFloat(value) {
      return !isNaN(Number(value)) && Number(value).toString().indexOf('.') !== -1;
    }

  });
};
