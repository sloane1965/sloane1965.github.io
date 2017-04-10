'use strict';
module.exports = function (grunt) {

  // load all grunt tasks matching the `grunt-*` pattern
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    // watch
    watch: {
      sass: {
        files: ['**/*.scss'],
        tasks: ['sass']
      },
      images: {
        files: ['public_html/assets/images/**/*.{png,jpg,gif}'],
        tasks: ['imagemin']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'public_html/*.php',
          'public_html/index.html',
          'public_html/assets/css/style.css',
          'public_html/assets/js/scripts.min.js',
          'templates/*',
          '*.php'
        ]
      }
    },

    // sass
    sass: {                              // Task
      dist: {                            // Target
        options: {                       // Target options
          style: 'expanded'
        },
        files: {                         // Dictionary of files
          'public_html/assets/css/style.css': 'public_html/assets/css/style.scss',       // 'destination': 'source'
        }
      }
    },

    // autoprefixer
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
        map: true
      },
      files: {
        expand: true,
        flatten: true,
        src: 'public_html/assets/css/*.css',
        dest: 'public_html/assets/css'
      }
    },

    // image optimization
    imagemin: {
      dynamic: {
        files: [{
          // Enable dynamic expansion
          expand: true,
          // Src matches are relative to this path
          cwd: 'public_html/assets/images/',
          // Actual patterns to match
          src: ['**/*.{png,jpg,gif}'],
          // Destination path prefix
          dest: 'public_html/assets/images/'
        }]
      }
    },

    // combine media queries
    cmq: {
      options: {
        log: true
      },
      your_target: {
        files: {
          'public_html/assets/css/': ['public_html/assets/css/style.css']
        }
      }
    },

    // deploy via rsync
    deploy: {
      options: {
        src: "./",
        args: ["--verbose"],
        exclude: ['.git*', 'node_modules', '.sass-cache', 'Gruntfile.js', 'package.json', '.DS_Store', 'README.md', 'config.rb', '.jshintrc'],
        recursive: true,
        syncDestIgnoreExcl: true
      },
      staging: {
        options: {
          dest: "/var/www/cca",
          host: "root@207.210.202.229"
        }
      },
      production: {
        options: {
          dest: "/var/www/cca",
          host: "root@207.210.202.229"
        }
      }
    }

  });

  // rename tasks
  grunt.renameTask('rsync', 'deploy');

  grunt.registerTask('default', ['sass', 'autoprefixer', 'imagemin', 'cmq', 'watch']);
  // grunt.registerTask('default', ['sass', 'imagemin', 'browserSync', 'watch']);
};
