module.exports = function (grunt) {
  'use strict';

  var config = grunt.config;

  /** =========================================
   * CSS
   ===========================================*/

  /** -----------------------------------------
   * Sass
   * ----------------------------------------*/

  config.set('sass.all', {
    files: [{
      '<%= directories.cmsBranding %>/css/main.css': '<%= directories.cmsBranding %>/scss/main.scss'
    }]
  });

  /** -----------------------------------------
   * Combine Media Queries
   * ----------------------------------------*/

  config.set('cmq.all', {
    options: {
      log: false
    },
    files: [{
      '<%= directories.cmsBranding %>/css/': ['<%= directories.cmsBranding %>/css/main.css']
    }]
  });

  /** -----------------------------------------
   * PostCSS
   * ----------------------------------------*/

  config.set('postcss.all', {
    options: {
      map: true,
      processors: [
        require('pixrem')(),
        require('autoprefixer-core')({
          browsers: 'last 3 versions'
        }),
        require('cssnano')()
      ]
    },
    dist: {
      src: '<%= directories.cmsBranding %>/css/*.css'
    }
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

  config.set('watch', {
    files: ['<%= directories.cmsBranding %>/scss/**/*.scss'],
    tasks: ['sass', 'cmq', 'postcss'],
    options: {
      spawn: false
    }
  });

};
