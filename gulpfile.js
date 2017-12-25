var gulp = require('gulp'),
  	pug = require('gulp-pug'), // compile jade
  	plumber = require('gulp-plumber'), // catch error
    ext_replace = require('gulp-ext-replace'), // change extension
    sass = require('gulp-sass'), // compile sass
    concat = require('gulp-concat'), // concat files
    changed = require('gulp-changed'), // only changed files
    minifyJs = require('gulp-minify'), // minify js
    postcss = require('gulp-postcss'), // postcss
    gcmq = require('gulp-group-css-media-queries'),
    browserSync = require('browser-sync').create(), // autoreload
    replace = require('gulp-replace'), // compile php
    cssnano = require('gulp-cssnano'); // minify css

// POSTCSS PLUGINS
  var processors = [
      require('postcss-position'),
      require('postcss-font-awesome'),
      require('autoprefixer'),
      require('postcss-flexibility')
  ];

// BROWSERSYNC 
  gulp.task('serve', ['html','sass','js'], function() {

    browserSync.init({
        server: "./build/html/"
    });

    gulp.watch('./build/pug/doing/**/*.pug', ['html']);
    gulp.watch('./build/sass/**/*.sass', ['sass']);
    gulp.watch('./build/js/**/*.js', ['js']);
    gulp.watch("./build/html/*.html").on('change', browserSync.reload);
  });

// COPY FILES

  gulp.task('copy-files', ['copy-css', 'copy-js']); 
  
  // CSS
    // COPY CSS FILE MEDIA-QUERIES
    gulp.task('copy-mediaqueries-css', function(){
      gulp.src('bower_components/sass-mediaqueries/_media-queries.sass')
      .pipe(gulp.dest('build/sass/extra/sass-mediaqueries/'))
    });


    // COPY CSS FILE FAMILY
    gulp.task('copy-family-css', function(){
      gulp.src('bower_components/family.sass/source/src/_family.sass')
      .pipe(gulp.dest('build/sass/extra/_family.sass/'))
    });

    // COPY CSS
    gulp.task('copy-css', ['copy-family-css',
                           'copy-mediaqueries-css'], 
                           function(){
      gulp.dest('build/sass/extra/')
    });

  // JS
    // COPY JS JQUERY 
    gulp.task('copy-jquery-js', function(){
      gulp.src('bower_components/jquery/dist/jquery.min.js')
      .pipe(gulp.dest('build/js/jquery/'))
    });

    // COPY CSS
    gulp.task('copy-js', ['copy-jquery-js'], 
                           function(){
      gulp.dest('build/js/')
    });    

// OTHER TASKS

  // HTML
    // HTML CONCAT JS
      gulp.task('js', function() {
        gulp.src(['./build/js/jquery/jquery.min.js',
                  './build/js/flexibility.js',
                  './build/js/my.js'])
          .pipe(changed('./build/html/frontend/web/js/'))
          .pipe(plumber())
          .pipe(concat("all.js"))
          .pipe(minifyJs())
          .pipe(gulp.dest('./build/html/frontend/web/js/'))
          .pipe(browserSync.stream());
      });

    // HTML SCSS => CSS
      gulp.task('sass', function () {
        gulp.src(['./build/sass/**/*.sass',
                '!./build/sass/extra/'])
          .pipe(changed('./build/html/frontend/web/css/'))
          .pipe(sass().on('error', sass.logError))
          .pipe(gcmq())
          .pipe(postcss(processors))
          .pipe(concat('all.css'))
          .pipe(cssnano({ zindex: false }))
          .pipe(gulp.dest('./build/html/frontend/web/css/'))
          .pipe(browserSync.stream());
      });

    // PUG => html 
      gulp.task('html', function() {
          gulp.src(['./build/pug/doing/**/*.pug'])
          .pipe(changed('./build/html/'))
          .pipe(plumber())
          .pipe(pug({
              pretty: true
            })) 
          .pipe(gulp.dest('./build/html/'))
      });

    // Generate structure
      gulp.task('structure', function(){

        gulp.src('./build/html/frontend/web/**')
        .pipe(gulp.dest('./output/frontend/web/'))
        
         gulp.src(['./build/pug/structure/**/*.pug',
                '!./build/pug/structure/**/files/'])
          .pipe(plumber())
          .pipe(pug({
              pretty: true
            })) 
          .pipe(gulp.dest('./output/'))
      });
    
    // Start
      gulp.task('start', function() {

        browserSync.init({
            server: "./output/"
        });

      });

gulp.task('default', ['serve']);