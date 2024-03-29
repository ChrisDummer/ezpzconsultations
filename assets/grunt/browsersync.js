// Important to use `grunt` as an argument in the function
module.exports = function (grunt) {

  // Configure Browsersync task
  // browserSync watches files defined in src, and on change reloads the browser
  grunt.config('browserSync', {
    bsFiles: {
      src: [
        '<%= opts.dist_dir %>/js/site.js',
        '<%= opts.dist_dir %>/img/*',
        '<%= opts.dist_dir %>/icons/*',
        'lib/**/*.js',
        'lib/**/*.js.min',
        '<%= opts.dist_dir %>/css/woocommerce.min.css',
        'style.css',
        '**/*.php',
        '**/*.html',
      ]
    },
    options: {
      watchTask: true,
      proxy: "<%= opts.dev_url %>",
      hostname: "<%= opts.dev_url %>",
      //injectChanges: true
    }
  });

};
