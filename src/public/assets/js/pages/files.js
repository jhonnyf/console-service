/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/files.js":
/*!*************************************!*\
  !*** ./resources/js/pages/files.js ***!
  \*************************************/
/*! exports provided: Files */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Files", function() { return Files; });
var Files = function () {
  var openUpload = function openUpload() {
    var src = $(this).data('url');
    axios.get(src).then(function (response) {
      response = response.data;
      $.fancybox.open({
        src: response.result,
        type: 'inline',
        opts: {
          modal: true,
          beforeClose: function beforeClose() {
            window.location.reload();
          }
        }
      });
      var url = $('#dropzone-form').attr('action');
      $('#dropzone-form').dropzone({
        url: url
      });
    });
  };

  var editForm = function editForm() {
    var src = $(this).data('url').split(window.location.origin);
    axios.get(src[1], {
      'baseURL': window.location.origin
    }).then(function (response) {
      response = response.data;
      $.fancybox.open({
        src: response.result,
        type: 'html',
        opts: {
          modal: true,
          closeExisting: true,
          afterLoad: function afterLoad() {
            // $(document).on('submit', '.form-ajax', saveForm);
            $('.form-ajax').submit(saveForm);
          }
        }
      });
    });
  };

  var saveForm = function saveForm() {
    var element = $(this);
    var src = element.attr('action');
    var data = element.serialize();
    axios.put(src, data).then(function (response) {
      response = response.data;
      element.prepend(response.message);
      setTimeout(function () {
        element.find('.alert').fadeOut(function () {
          $(this).remove();
        });
      }, 2000);
    });
    return false;
  };

  return {
    init: function init() {
      $(document).on("click", ".open-upload", openUpload);
      $(document).on("click", ".edit-form", editForm);
    }
  };
}();



/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/js/pages/files.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\package-development\packages\console-service\src\resources\js\pages\files.js */"./resources/js/pages/files.js");


/***/ })

/******/ });