/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/tag-filter.js ***!
  \************************************/
var tags = document.querySelectorAll('.tags');
console.log(tags);
tags.forEach(function (tag) {
  tag.addEventListener('click', function (e) {
    e.target.classList.toggle('active-tag');
    e.target.classList.toggle('inactive-tag');
  });
}); //
/******/ })()
;