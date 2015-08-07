module.exports = function (grunt) {
  'use strict';

  var config = grunt.config;

  /** =========================================
   * Deploy
   ===========================================*/

  /** -----------------------------------------
   * Deploy
   *
   * Run all tasks
   -------------------------------------------*/

  grunt.registerTask('deploy', ['sass', 'cmq', 'postcss']);

};
