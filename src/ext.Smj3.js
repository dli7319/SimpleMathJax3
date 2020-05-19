const useCDN = mw.config.get('wgSmjUseCDN');
const mathjaxScriptPath = useCDN
  ? 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js'
  : mw.config.get('wgExtensionAssetsPath') +
    '/SimpleMathJax3/node_modules/mathjax/es5/tex-mml-chtml.js';
const polyfillScript = 'https://polyfill.io/v3/polyfill.min.js?features=es6';

const MathJax = {
  options: {
    renderActions: {},
  },
  chtml: {
    scale: mw.config.get('wgSmjScale'),
  },
  tex: {
    inlineMath: mw.config.get('wgSmjInlineMath'),
    displayMath: mw.config.get('wgSmjDisplayMath'),
    packages: ['base', 'ams', 'autoload'],
  },
  loader: {
    load: [],
  },
};
if (mw.config.get('wgSmjUseChem')) {
  MathJax.tex.packages.push('mhchem');
  MathJax.loader.load.push('[tex]/mhchem');
}
if (mw.config.get('wgSmjShowMathMenu') === false) {
  MathJax.options.renderActions.addMenu = [];
  MathJax.options.renderActions.checkLoader = [];
}
window.MathJax = MathJax;

if (useCDN === false) {
  loadMathJax();
} else {
  loadScript(polyfillScript, {
    done: loadMathJax,
  });
}

function loadMathJax() {
  loadScript(mathjaxScriptPath, {
    id: 'MathJax-script',
  });
  mw.hook('wikipage.content').add((content) => {
    if ("typeset" in window.MathJax && content != null) {
      window.MathJax.typeset(content);
    }
  });
}

function loadScript(src, options) {
  options = options || {};
  const done = options.done;
  const js = document.createElement('script');
  js.src = src;
  js.onload = () => {
    if (done != null) {
      done();
    }
  };
  js.onerror = () => {
    if (done != null) {
      done(new Error('Failed to load script ' + src));
    }
  };
  if (options.id != null) {
    js.id = options.id;
  }
  document.head.appendChild(js);
}
