module.exports = function (grunt) {
  'use strict';

  var config = grunt.config;

  /** =========================================
   * CSS
   ===========================================*/

  /** -----------------------------------------
   * Sass
   * ----------------------------------------*/

  config.set('sass.cms', {
    files: [{
      '<%= directories.cmsBranding %>/css/main.css': '<%= directories.cmsBranding %>/scss/main.scss'
    }]
  });

  /** -----------------------------------------
   * Auto Pre-fixer
   * ----------------------------------------*/

  config.set('autoprefixer.cms', {
    options: {
      browsers: ['last 3 versions']
    },
    files: [{
      '<%= directories.cmsBranding %>/css/main.css': '<%= directories.cmsBranding %>/css/main.css'
    }]
  });

  /** -----------------------------------------
   * Combine Media Queries
   * ----------------------------------------*/

  config.set('cmq.cms', {
    options: {
      log: false
    },
    files: [{
      '<%= directories.cmsBranding %>/css/': ['<%= directories.cmsBranding %>/css/main.css']
    }]
  });

  /** -----------------------------------------
   * CSS Minification
   * ----------------------------------------*/

  config.set('cssmin.cms', {
    options: {
      rebase: false
    },
    expand: true,
    cwd: '<%= directories.cmsBranding %>/css/',
    src: ['main.css'],
    dest: '<%= directories.cmsBranding %>/css/',
    ext: '.min.css'
  });

  /** -----------------------------------------
   * CSS Lint
   * ----------------------------------------*/

  config.set('csslint.strict', {
    options: {
      import: 2
    },
    src: ['<%= directories.cmsBranding %>/css/main.min.css']
  });

  config.set('csslint.lax', {
    options: {
      import: false
    },
    src: ['<%= directories.cmsBranding %>/css/main.min.css']
  });

  /** =========================================
   * Watch
   ===========================================*/

  config.set('watch.cms', {
    files: ['<%= directories.cmsBranding %>/scss/**/*.scss'],
    tasks: ['sass:cms', 'autoprefixer:cms', 'cmq:cms', 'cssmin:cms'],
    options: {
      spawn: false
    }
  });

};
