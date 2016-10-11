var $             = require( 'gulp-load-plugins' )();
var autoprefixer  = require( 'gulp-autoprefixer' );
var config        = require( '../util/loadConfig' ).sass;
var gulp          = require( 'gulp' );
var sass          = require( 'gulp-sass' );
var concat        = require( 'gulp-concat' );
var notify        = require( 'gulp-notify' );
var fs            = require( 'fs' );
var pkg           = JSON.parse( fs.readFileSync( './package.json' ) );

gulp.task( 'sass:front', function() {

    return gulp.src( config.front.src )
        .pipe( $.sourcemaps.init() )
        .pipe( $.sass( {
                includePaths: config.front.bowerPaths
            } )
            .on( 'error', notify.onError( {
                    title: pkg.name,
                    message: "<%= error.message %>",
                    onLast: true
                } )
            ) 
         )
        .pipe( concat( 'style.css' ) )
        .pipe( autoprefixer( config.compatibility ) )
        .pipe( $.cssnano() )
        .pipe( $.sourcemaps.write( '.' ) )
        .pipe( gulp.dest( config.front.root ) )
        .pipe( notify( {
            title: pkg.name,
            message: 'SASS Complete',
            onLast: true
        } ) );

} );

gulp.task( 'sass:admin', function() {

    return gulp.src( config.admin.src )
        .pipe( $.sourcemaps.init() )
        .pipe( $.sass()
              .on( 'error', notify.onError( {
                    title: pkg.name,
                    message: "<%= error.message %>",
                    onLast: true
                } )
             ) 
         )
        .pipe( concat( 'admin.css' ) )
        .pipe( autoprefixer( config.compatibility ) )
        .pipe( $.cssnano() )
        .pipe( $.sourcemaps.write( '.' ) )
        .pipe( gulp.dest( config.admin.root ) )
        .pipe(notify( {
            title: pkg.name,
            message: 'Admin SASS Complete',
            onLast: true
        } ) );

} );

gulp.task( 'sass:login', function() {

    return gulp.src( config.login.src )
        .pipe( $.sourcemaps.init() )
        .pipe( $.sass()
              .on( 'error', notify.onError( {
                    title: pkg.name,
                    message: "<%= error.message %>",
                    onLast: true
                } )
             ) 
         )
        .pipe( concat( 'login.css' ) )
        .pipe( autoprefixer( config.compatibility ) )
        .pipe( $.cssnano() )
        .pipe( $.sourcemaps.write( '.' ) )
        .pipe( gulp.dest( config.login.root ) )
        .pipe(notify( {
            title: pkg.name,
            message: 'Login SASS Complete',
            onLast: true
        } ) );

} );

gulp.task( 'sass', ['sass:front', 'sass:admin', 'sass:login'], function(done) {
    done();
} );