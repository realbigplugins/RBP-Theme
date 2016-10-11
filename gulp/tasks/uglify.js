var $             = require( 'gulp-load-plugins' )();
var config        = require( '../util/loadConfig' ).javascript;
var gulp          = require( 'gulp' );
var notify        = require( 'gulp-notify' );
var fs            = require( 'fs' );
var pkg           = JSON.parse( fs.readFileSync( './package.json' ) );
var onError       = notify.onError( {
    title:    pkg.name,
    message:  '<%= error.name %> <%= error.message %>',
    onLast: true
} );

gulp.task( 'uglify:front', function() {
    
    return gulp.src( config.front.bowerPaths.concat( config.front.src ) )
        .pipe( $.plumber( { errorHandler: onError } ) )
        .pipe( $.sourcemaps.init() )
        .pipe( $.babel( {
            presets: ['es2015'] // Gulp-uglify has no official support for ECMAScript 2015 (aka ES6, aka Harmony), so we'll transpile to EcmaScript5
        } ) )
        .pipe( $.concat( config.front.filename ) )
        .pipe( $.uglify() )
        .pipe( $.sourcemaps.write( '.' ) )
        .pipe( gulp.dest( config.front.root ) )
        .pipe( $.plumber.stop() )
        .pipe( notify( {
            title: pkg.name,
            message: 'JS Complete',
            onLast: true
        } ) );

} );

gulp.task( 'uglify:admin', function() {

    return gulp.src( config.admin.src )
        .pipe( $.plumber( { errorHandler: onError } ) )
        .pipe( $.sourcemaps.init() )
        .pipe( $.babel() )
        .pipe( $.concat( config.admin.filename ) )
        .pipe( $.uglify() )
        .pipe( $.sourcemaps.write( '.' ) )
        .pipe( gulp.dest( config.admin.root ) )
        .pipe( $.plumber.stop() )
        .pipe( notify( {
            title: pkg.name,
            message: 'Admin JS Complete',
            onLast: true
        } ) );

} );

gulp.task( 'uglify', ['uglify:front', 'uglify:admin'], function( done ) {
    done();
} );