module.exports = function (grunt) {
  'use strict';

  var config = grunt.config;

  /** =========================================
   * Deploy
   ===========================================*/

  config.set('copy.all', {
    files: [
      {
        cwd: '<%= directories.fontAwesome %>/css',
        src: '*',
        dest: '<%= directories.cmsBranding %>/css',
        expand: true
      },
      {
        cwd: '<%= directories.fontAwesome %>/fonts',
        src: '*',
        dest: '<%= directories.cmsBranding %>/fonts',
        expand: true
      }
    ]
  });

  /** -----------------------------------------
   * Deploy
   *
   * Run all tasks
   -------------------------------------------*/

  grunt.registerTask('deploy', ['copy', 'sass', 'cmq', 'postcss']);

};
