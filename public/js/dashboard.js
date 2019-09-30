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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/vue/dashboard.js":
/*!***************************************!*\
  !*** ./resources/js/vue/dashboard.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

new Vue({
  el: '#app',
  data: {
    todos: [],
    task: '',
    updated_todo: {
      task: ''
    }
  },
  mounted: function mounted() {
    this.loadInitialData();
  },
  methods: {
    loadInitialData: function loadInitialData() {
      var _this = this;

      axios.get('/todo').then(function (response) {
        if (response.status === 200 && response.data.error === false) {
          _this.todos = response.data.data;
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    addTodo: function addTodo() {
      var _this2 = this;

      if (this.task.length === 0) {
        alert('Please enter task!');
        return;
      }

      axios.post('/todo', {
        task: this.task
      }).then(function (response) {
        if (response.status === 200 && response.data.error === false) {
          _this2.todos.push(response.data.data);

          _this2.task = '';
          $("#add-todo").modal('hide');
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    update: function update(id, is_complete) {
      var _this3 = this;

      axios.patch('/todo/' + id, {
        is_complete: is_complete
      }).then(function (response) {
        if (response.status === 200 && response.data.error === false) {
          var todos = _this3.todos;

          var index = _.findIndex(todos, {
            id: id
          });

          todos[index].is_complete = parseInt(!is_complete);
          _this3.todos = todos;
          alert('Your todo is successfully updated!');
        }
      });
    },
    popupUpdateModal: function popupUpdateModal(id) {
      var todo = _.find(this.todos, {
        id: id
      });

      if (typeof todo === 'undefined') {
        return;
      }

      this.updated_todo = _.cloneDeep(todo);
      $("#update-todo").modal('show');
    },
    updateTodo: function updateTodo() {
      var _this4 = this;

      axios.patch('/todo/' + this.updated_todo.id, {
        task: this.updated_todo.task
      }).then(function (response) {
        if (response.status === 200 && response.data.error === false) {
          var todos = _this4.todos;

          var index = _.findIndex(todos, {
            id: _this4.updated_todo.id
          });

          todos[index].task = _this4.updated_todo.task;
          _this4.todos = todos;
          alert('Your todo is successfully updated!');
          _this4.updated_todo = {
            task: ''
          };
          $("#update-todo").modal('hide');
        }
      })["catch"](function (error) {
        console.log(error);
      });
    },
    destroy: function destroy(id) {
      var _this5 = this;

      axios["delete"]('/todo/' + id).then(function (response) {
        if (response.status === 200 && response.data.error === false) {
          var index = _.findIndex(_this5.todos, {
            id: id
          });

          _this5.todos.splice(index, 1);

          alert('Your todo is successfully deleted!');
        }
      })["catch"](function (error) {
        console.log(error);
      });
    }
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************!*\
  !*** multi ./resources/js/vue/dashboard.js ./resources/sass/app.scss ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/laravel-demo/resources/js/vue/dashboard.js */"./resources/js/vue/dashboard.js");
module.exports = __webpack_require__(/*! /var/www/laravel-demo/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });