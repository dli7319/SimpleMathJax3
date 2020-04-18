var mathjaxScriptPath = 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js';
var polyfillScript = 'https://polyfill.io/v3/polyfill.min.js?features=es6';
var useCDN = mw.config.get('wgSmjUseCDN');
if (useCDN === false) {
  mathjaxScriptPath = mw.config.get('wgExtensionAssetsPath') + '/SimpleMathJax3/node_modules/MathJax/es5/tex-mml-chtml.js';
}

var MathJax = {
  options: {
    renderActions: {}
  },
  chtml: {
    scale: mw.config.get('wgSmjScale')
  },
  tex: {
    inlineMath: mw.config.get('wgSmjInlineMath'),
    displayMath: mw.config.get('wgSmjDisplayMath'),
    packages: ["base", "ams", "autoload"]
  },
  loader: {
    load: []
  }
};
if (mw.config.get('wgSmjUseChem')) {
  MathJax.tex.packages.push("mhchem");
  MathJax.loader.load.push('[tex]/mhchem');
}
if (mw.config.get('wgSmjShowMathMenu') === false) {
  MathJax.options.renderActions.addMenu = [];
  MathJax.options.renderActions.checkLoader = [];
}
window.MathJax = MathJax;

if (useCDN === false) {
  loadScript(mathjaxScriptPath, {
    id: "MathJax-script"
  });
} else {
  loadScript(polyfillScript, {
    done: function() {
    loadScript(mathjaxScriptPath, {
        id: "MathJax-script",
    });
  }});
}

function loadScript(src, options) {
  options = options || {};
  var done = options.done;
  var js = document.createElement('script');
  js.src = src;
  js.onload = function() {
    if (done != null) {
      done();
    }
  };
  js.onerror = function() {
    if (done != null) {
      done(new Error('Failed to load script ' + src));
    }
  };
  if (options.id != null) {
    js.id = options.id;
  }
  document.head.appendChild(js);
}
