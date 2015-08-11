module.exports = function (grunt) {
  'use strict';
  require('time-grunt')(grunt);

  grunt.initConfig({
    directories: {
      cmsBranding: './',
      fontAwesome: './components/lib/font-awesome'
    },
    pkg: grunt.file.readJSON('./package.json')
  });

  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
  grunt.loadTasks('build_tasks');
  grunt.registerTask('default', ['watch']);
  grunt.registerTask('build', ['build']);
}
