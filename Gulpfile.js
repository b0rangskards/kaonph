var gulp = require('gulp'),
    del = require('del'),
    es = require('event-stream'),
    notify = require('gulp-notify'),
    gutil = require('gulp-util'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifyCss = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint'),
    copy = require('gulp-copy'),
    rename = require('gulp-rename'),
    livereload = require('gulp-livereload');

var dirs = {
    'views': './app/views/',
    'assets': './app/assets/',
    'assetsSass': './app/assets/sass/',
    'assetsCss': './app/assets/css/',
    'assetsJs': './app/assets/js/',
    'assetsFonts': './app/assets/fonts/',
    'assetsImages': './app/assets/images/',
    'tempCss': './app/assets/.tmp/css/',
    'vendor': './app/assets/vendor/',
    'publicCss': './public/css/',
    'publicJs': './public/js/',
    'publicFonts': './public/fonts/',
    'publicImages': './public/images/'
};

// Delete public/style.min.css
gulp.task('cleanCss', function () {
    return del(dirs.publicCss + 'admin.min.css', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

/* Custom Sass & Css
 * Convert sass file to css
 * Move it in .tmp/css/ directory
 */
gulp.task('css', ['cleanCss'], function () {
    var appCss = gulp.src([
        dirs.assetsCss + 'main.css',
        dirs.assetsCss + 'adaptive.css'
    ]);

    var appSass = gulp.src(dirs.assetsSass + '*.scss')
        .pipe(sass());

    return es.concat(appCss, appSass)
        .pipe(concat('style.min.css'))
        .pipe(autoprefixer('last 10 version'))
        .pipe(minifyCss())
        .pipe(gulp.dest(dirs.publicCss))
        .pipe(livereload());
});

// Delete public/vendor.min.css
gulp.task('cleanVendorCss', function () {
    return del(dirs.publicCss + 'vendor.min.css', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

/*
 * Concat and Minify vendor css files
 */
gulp.task('vendor-css', ['cleanVendorCss'], function () {
    return gulp.src([
        dirs.vendor     + 'bootstrap/dist/css/bootstrap.css',
        dirs.vendor     + 'fontawesome/css/font-awesome.css',
        dirs.vendor     + 'sweetalert/dist/sweetalert.css',
        dirs.vendor     + 'semantic-ui-loader/loader.css',
        dirs.assetsCss  + 'jasny-bootstrap.min.css',
        dirs.assetsCss  + 'pushy.css',
        dirs.vendor     + 'animate.css/animate.css',
        dirs.vendor     + 'semantic-ui-loader/loader.css',
        dirs.vendor     + 'loading-indicator/dist/loading.min.css',
        dirs.vendor     + 'growl/stylesheets/jquery.growl.css'
    ])
        .pipe(concat('vendor.min.css'))
        .pipe(minifyCss({processImport: false}))
        .pipe(gulp.dest(dirs.publicCss));

});

// Custom JS
gulp.task('cleanJs', function () {
    return del(dirs.publicJs + 'script.min.js', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

/*
 * Concat and uglify custom js files
 */
gulp.task('js', ['cleanJs'], function () {
    return gulp.src([
        dirs.assetsJs + 'constants.js',
        dirs.assetsJs + 'functions.js',
        dirs.assetsJs + 'all_scr.js',
        dirs.assetsJs + 'sidemenu.js',
        dirs.assetsJs + 'map-functions.js',
        dirs.assetsJs + 'map.js',
        dirs.assetsJs + 'map-directions.js',
        dirs.assetsJs + 'map_place.js',
        dirs.assetsJs + 'map-modal.js',
        dirs.assetsJs + 'map-checkins.js',
        dirs.assetsJs + 'select2-init.js',
        dirs.assetsJs + 'script.js'
    ])
        .pipe(concat('script.min.js'))
        .pipe(uglify({mangle: false}))
        .pipe(gulp.dest(dirs.publicJs))
        .pipe(livereload())
        .on('error', gutil.log);
});

gulp.task('cleanVendorJs', function () {
    return del(dirs.publicJs + 'vendor.min.js', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

/*
 * Concat and uglify vendor js files
 */
gulp.task('vendor-js', ['cleanVendorJs'], function () {
    return gulp.src([
        dirs.vendor     + 'jquery/dist/jquery.js',
        dirs.vendor     + 'bootstrap/dist/js/bootstrap.js',
        dirs.vendor     + 'sweetalert/dist/sweetalert.min.js',
        dirs.assetsJs   + 'jasny-bootstrap.min.js',
        dirs.assetsJs   + 'infobox.js',
        dirs.vendor     + 'gmap3/dist/gmap3.js',
        dirs.vendor     + 'loading-indicator/dist/loading.js',
        dirs.vendor     + 'bootstrap3-typeahead/bootstrap3-typeahead.js',
        dirs.vendor     + 'growl/javascripts/jquery.growl.js'
    ])
        .pipe(concat('vendor.min.js'))
        .pipe(uglify({mangle: false}))
        .pipe(gulp.dest(dirs.publicJs))
        .on('error', gutil.log);
});

gulp.task('cleanFonts', function () {
    return del(dirs.publicFonts + '**.*', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

/*
 * Copy fonts to public directory
 */
gulp.task('copy-fonts', ['cleanFonts'], function () {
    return gulp.src([
        dirs.vendor + 'fontawesome/fonts/**.*',
        dirs.assetsFonts + '**.*'
    ])
        .pipe(gulp.dest(dirs.publicFonts));
});

gulp.task('cleanImages', function () {
    return del(dirs.publicImages + '**.*', function (err, deletedFile) {
        gutil.log('Files deleted:', deletedFile);
    });
});

gulp.task('copy-images', ['cleanImages'], function () {
    return gulp.src([
        dirs.assetsImages + '**/*.*'
    ])
        .pipe(gulp.dest(dirs.publicImages))
        .pipe(livereload());
});

gulp.task('views', function () {
    return gulp.src([dirs.views + '**/*.*', dirs.views + '**/**/*.*'])
        .pipe(livereload());
});

gulp.task('watch', ['css', 'vendor-css', 'copy-images'], function () {

    livereload.listen();

    gulp.watch([
        dirs.assetsSass + '*.scss',
        dirs.assetsCss + 'main.css',
        dirs.assetsCss + 'adaptive.css'
    ], ['css']);

    gulp.watch([
        dirs.assetsJs + '*.js'
    ], ['js', 'vendor-js']);

    gulp.watch(dirs.assetsImages + '**/*.*', ['copy-images']);

    gulp.watch([dirs.views + '**/*.*', dirs.views + '**/**/*.*'], ['views']);
});


gulp.task('compile', ['css', 'vendor-css', 'js', 'vendor-js']);

gulp.task('copy-assets', ['copy-fonts', 'copy-images']);

gulp.task('default', ['compile', 'copy-assets', 'watch']);
