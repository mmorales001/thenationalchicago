module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concurrent: {
      dev: {
        tasks: ['watch'],
        options: {
          logConcurrentOutput: true
        }
      }
    },
    watch: {
      clientJS: {
         files: [
          'js/*.js', '!js/*.min.js'
         ],
         tasks: ['newer:uglify', 'newer:jshint:client']
      },
      clientLess: {
         files: [
          'css/less/*.less',
         ],
         tasks: ['newer:less']
      }
    },
    uglify: {
      options: {
        sourceMapRoot: '/',
        sourceMapPrefix: 1,
        sourceMap: function(filePath) {
          return filePath.replace(/.js/, '.js.map');
        },
        sourceMappingURL: function(filePath) {
          return path.basename(filePath) +'.map';
        }
      },
      vendor: {
        files: {
          'js/vendor.min.js': [
              'js/vendor/jquery.cycle2.js',
              'js/vendor/jquery.backstretch.min.js',
              'js/vendor/jquery.waypoints.js',
              'js/vendor/jquery.stellar.js'
          ]
        }
      }
    },
    less: {
      options: {
        compress: true
      },
      layouts: {
        files: {
          'css/style.min.css': [
              'css/less/reset.less',
              'css/less/sprite.less',
              'css/less/style.less'
 
          ]
        }
      },
      views: {
        files: [{
          expand: true,
          cwd: 'public/views/',
          src: ['**/*.less'],
          dest: 'public/views/',
          ext: '.min.css'
        }]
      }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-concurrent');
  grunt.loadNpmTasks('grunt-newer');

  grunt.registerTask('default', ['newer:uglify', 'newer:less', 'concurrent']);
  grunt.registerTask('build', ['uglify', 'less']);
  grunt.registerTask('lint', ['jshint']);
}