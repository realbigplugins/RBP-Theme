'use strict';
module.exports = function (grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        // Define watch tasks
        watch: {
            options: {
                livereload: true
            },
            sass: {
                files: ['assets/sass/**/*.scss', '!assets/sass/admin/**/*.scss'],
                tasks: ['sass:front', 'autoprefixer:front', 'notify:sass', 'sftp-deploy', 'notify:sftp']
            },
            sass_admin: {
                files: ['assets/sass/admin/**/*.scss'],
                tasks: ['sass:admin', 'autoprefixer:admin', 'notify:sass_admin', 'sftp-deploy', 'notify:sftp']
            },
            js: {
                files: ['assets/js/*.js'],
                tasks: ['uglify:front', 'notify:js', 'sftp-deploy', 'notify:sftp']
            },
            js_admin: {
                files: ['assets/js/admin/*.js'],
                tasks: ['uglify:admin', 'notify:js_admin', 'sftp-deploy', 'notify:sftp']
            },
            upload: {
                files: ['**/*.php'],
                tasks: ['sftp-deploy', 'notify:sftp']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', 'assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}', '!**/*ajax*.php']
            }
        },

        // SASS
        sass: {
            options: {
                sourceMap: true
            },
            front: {
                files: {
                    'style.css': 'assets/sass/main.scss'
                }
            },
            admin: {
                files: {
                    'admin.css': 'assets/sass/admin/admin.scss'
                }
            }
        },

        // Auto prefix our CSS with vendor prefixes
        autoprefixer: {
            options: {
                map: true
            },
            front: {
                src: 'style.css'
            },
            admin: {
                src: 'admin.css'
            }
        },

        // Uglify and concatenate
        uglify: {
            options: {
                sourceMap: true
            },
            front: {
                files: {
                    'script.js': [
                        // Vendor files
                        'assets/vendor/js/modernizr.js',
                        'assets/vendor/js/fastclick.js',
                        'assets/vendor/js/placeholder.js',
                        'assets/vendor/js/jquery.cookie.js',
                        'assets/vendor/js/jquery.easing.js',
                        'assets/vendor/js/foundation.js',

                        // Included dynamically in header.php
                        '!assets/vendor/js/html5.js',

                        // Theme scripts
                        'assets/js/*.js'
                    ]
                }
            },
            admin: {
                files: {
                    'admin.js': [
                        'assets/js/admin/*.js'
                    ]
                }
            }
        },

        'sftp-deploy': {
            dist: {
                auth: {
                    host: 'realbigmarketing.com',
                    port: 22,
                    authKey: 'main'
                },
                cache:  '.sftp-cache',
                src: './',
                dest: '/wp-content/themes/realbigplugins',
                exclusions: [
                    './node_modules',
                    './.idea',
                    './.sass-cache',
                    './images_bak',
                    './.ftppass',
                    './Gruntfile.js',
                    './package.json',
                    './**/.DS_Store',
                    './.gitignore',
                    './.git'
                ]
            }
        },

        notify: {
            js: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'JS Complete'
                }
            },
            js_admin: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'JS Admin Complete'
                }
            },
            sass: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'SASS Complete'
                }
            },
            sass_admin: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'SASS Admin Complete'
                }
            },
            sftp: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'Upload Complete'
                }
            }
        }

    });

    // Register our main task
    grunt.registerTask('Watch', ['watch']);
};