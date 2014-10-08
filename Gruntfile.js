/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      dist: {
        src: [
          'js/skip-link-focus-fix.js',
          'js/navigation.js',
          'js/videos.js',
          'js/objsort.js',
          'js/discography.js'
        ],
        dest: 'js/looptroop-rockers.js'
      }
    },
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        globals: {}
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
    },
    sass: {
      dist: {
        options: {
          style: 'expanded',
          require: 'susy'
        },
        files: {
          'style.css': 'sass/style.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        src: 'style.css'
      },
    },
    coffee: {
      dist: {
        files: {
          'js/discography.js': 'coffee/disography.coffee'
        }
      }
    },
    yaml: {
      dist: {
        // options: {
        //   ignored: /^_/,
        //   space: 4,
        //   customTypes: {
        //     '!include scalar': function(value, yamlLoader) {
        //       return yamlLoader(value);
        //     },
        //     '!max sequence': function(values) {
        //       return Math.max.apply(null, values);
        //     },
        //     '!extend mapping': function(value, yamlLoader) {
        //       return _.extend(yamlLoader(value.basePath), value.partial);
        //     }
        //   }
        // },
        files: [
          {
            src: './discography.yml',
            dest: 'js/discography.json'
          }
        ]
      },
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: [
          'jshint:gruntfile'
        ]
      },
      coffee: {
        files: [
          'coffee/**/*.coffee'
        ],
        tasks: [
          'coffee',
          'jshint',
          'concat'
        ],
      },
      js: {
        files: [
          'js/*.js',
          '!js/looptroop-rockers.js'
        ],
        tasks: [
          'jshint',
          'concat'
        ],
        options: {
          livereload: true,
        }
      },
      yaml: {
        files: '*.yml',
        tasks: [
          'yaml'
        ],
      },
      sass: {
        files: 'sass/**/*.scss',
        tasks: [
          'sass',
          'autoprefixer'
        ],
        options: {
          livereload: true,
        }
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-yaml');

  // Default task.
  grunt.registerTask('default', ['jshint', 'concat']);

};
