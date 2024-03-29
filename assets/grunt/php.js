// Important to use `grunt` as an argument in the function
module.exports = function (grunt) {
  // Configure PHPlint task
  // Validates PHP files
  grunt.config("phplint", {
    dist: {
      src: ["*.php", "**/*.php", "!node_modules/**/*.php"], // Ignore node_modules
    },
  });

  // Configure Watch task through config.merge as this task is used across multiple partials
  // Watches php files for changes and then runs tasks accordingly
  grunt.config.merge({
    watch: {
      php: {
        options: {
          event: ["changed", "added", "deleted"],
        },
        files: ["*.php", "**/*.php", "!node_modules/**/*.php"], // Ignore node_modules
        tasks: ["newer:phplint"],
      },
    },
  });
};
