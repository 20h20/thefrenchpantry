module.exports = function (grunt) {
  require("time-grunt")(grunt);
  require("jit-grunt")(grunt);

  grunt.initConfig({
    site_url: "http://localhost:8888/scenofonia/",
    theme_name: "medisafe",

    /* Chemin pour les blocks */
    path_src_blocks: "templates/blocks/",
    path_dist_blocks: "library/css/blocks/",

    /* Chemin pour les styles globaux */
    path_src_styles: "src/scss/",
    path_dist_styles: "library/css/",

    /* Chemin pour les js et icons */
    path_src: "src/",
    path_dist: "library/",
    pkg: grunt.file.readJSON("package.json"),

    /* Sass pour les Blocks */
    sass: {
      blocks: {
        expand: true,
        cwd: "<%= path_src_blocks %>",
        src: ["**/style.scss", "!style.scss"],
        dest: "<%= path_dist_blocks %>",
        rename: function (dest, src) {
          var blockName = src.split("/")[src.split("/").length - 2];
          return dest + blockName + ".min.css";
        },
        options: {
          implementation: require('node-sass'),
          sourceMap: false
        }
      },

      global: {
        src: "<%= path_src_styles %>style.scss",
        dest: "<%= path_dist_styles %>style.min.css",
        options: {
          sourceMap: false,
        }
      },

      /* Styles du BO (dashboard, admin bar) sans les styles du site */
      admin: {
        src: "<%= path_src_styles %>admin.scss",
        dest: "<%= path_dist_styles %>admin.min.css",
        options: {
          sourceMap: false,
        }
      }
    },

    /* Minification des fichiers CSS */
    postcss: {
      options: {
        map: false,
        processors: [
          require("autoprefixer")({ overrideBrowserslist: "last 3 versions" }),
          // reduceIdents: false -> garde les noms des @keyframes (évite les collisions entre fichiers CSS)
          require("cssnano")({ reduceIdents: false })
        ]
      },
      blocks: {
        src: "<%= path_dist_blocks %>*.css",
        options: {
          map: false,
        }
      },
      global: {
        src: "<%= path_dist_styles %>style.min.css",
        dest: "<%= path_dist_styles %>style.min.css",
        options: {
          map: false,
        }
      },
      admin: {
        src: "<%= path_dist_styles %>admin.min.css",
        dest: "<%= path_dist_styles %>admin.min.css",
        options: {
          map: false,
        }
      }
    },

    concat: {
      options: {
        separator: ";"
      },
      /* Concatene tous les fichiers CSS des blocs dans un seul fichier pour le bo */
      gutenberg: {
        // Retour à la ligne (et non ";") : un ";" entre deux fichiers CSS invalide la 1re règle de chaque bloc
        options: {
          separator: "\n"
        },
        src: ["<%= path_dist_blocks %>*.css"],
        // Même profondeur que library/css/blocks/ : les url(../../../library/img/...) des blocs restent valides
        dest: "<%= path_dist_styles %>editor/gutenberg.min.css",
      },
      dist: {
        src: ["<%= path_src %>js/**/*.js"],
        dest: "<%= path_dist %>js/scripts.js"
      }
    },

    /* Icons font */
    webfont: {
      icons: {
        src: "<%= path_src %>icons/*.svg",
        dest: "<%= path_dist %>iconfont",
        destCss: "<%= path_src %>scss/partials/",
        options: {
          stylesheet: "scss",
          relativeFontPath: "../iconfont",
          template: "<%= path_src %>scss/partials/_icons-template.scss",
          types: "eot,woff,ttf,svg",
          htmlDemo: false,
          optimize: false,
          engine: "node",
          autoHint: false
        }
      }
    },
  
    /* Javascript Inclusions */
    include_file: {
      default_options: {
        cwd: "<%= path_src %>js/",
        src: ["scripts.js"],
        dest: "<%= path_dist %>js/"
      }
    },

    /* Javascript Uglify */
    uglify: {
      app: {
        files: {
          "<%= path_dist %>js/scripts.js": ["<%= path_dist %>js/scripts.js"]
        }
      }
    },

    /* --------- Default Watch -------- */
    watch: {
      options: {
        spawn: false
      },
      iconfont: {
        files: "<%= path_src %>icons/*.svg",
        tasks: ["webfont"]
      },
      blocks: {
        files: ["<%= path_src_blocks %>**/*.scss"],
        tasks: ["sass:blocks", "postcss:blocks", "concat:gutenberg"]
      },
      global: {
        files: ["<%= path_src %>**/*.scss", "templates/parts/**/*.scss"],
        tasks: ["sass:global", "postcss:global", "sass:admin", "postcss:admin"]
      },
      js: {
        files: "<%= path_src %>js/**/*.js",
        tasks: ["include_file", "uglify"]
      }
    }
  });

  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks("grunt-postcss");

  grunt.registerTask("default", [
    "sass:blocks", "sass:global", "sass:admin",
    "postcss:blocks", "postcss:global", "postcss:admin", "concat:gutenberg",
    "webfont",
    "sass",
    "postcss",
    "include_file",
    "uglify",
    "watch"
  ]);

  grunt.registerTask("build", [
    "sass:blocks", "sass:global", "sass:admin",
    "postcss:blocks", "postcss:global", "postcss:admin", "concat:gutenberg",
    "webfont",
    "sass",
    "postcss",
    "uglify"
  ]);
};