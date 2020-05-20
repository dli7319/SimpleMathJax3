The SimpleMathJax3 extension enables MathJax v3 for typesetting TeX formula in MediaWiki inside math environments.

# Features
* Displays `<math>` and `</math>` symbols
  * Supports `display="block"`, `display="inline"`, and unspecified modes.

# Installation
1. `git clone` to your `extensions` directory
```Bash
git clone git@github.com:dli7319/SimpleMathJax3.git
```
2. Load the extension by editing `LocalSettings.php`
```PHP
wfLoadExtension( 'SimpleMathJax3' );
```
3. (Optional) If not using the CDN
 * Set `$wgSmjUseCDN=false` in `LocalSettings.php`
 * Run `npm ci` within `SimpleMathJax3` to download mathjax


# Settings
| Setting name         | Default value                 | Description                                   |
| -------------------- | ----------------------------- | --------------------------------------------- |
| `$wgSmjScale`        | `1.0`                           | Use chtml font scale                              |
| `$wgSmjUseCDN`       | `true`                          | Use CDN or local scripts                      |
| `$wgSmjUseChem`      | `true`                          | Enable chem tag                               |
| `$wgSmjInlineMath`   | `[["\\(","\\)"]]`               | Inline math symbols pairs                     |
| `$wgSmjDisplayMath`  | `[["\\[","\\]"],["$$","$$"]]`   | Display math symbols pairs                    |
| `$wgSmjShowMathMenu` | `true`                          | Enable MathJax context menu                   |
| `$wgSmjConvertMath`  | `true`                          | Converts [`<math>`,`</math>`] to [`\(`,`\)`] on load  |
| `$wgSmjConvertStyle`  | `"displaystyle"`                 | Default style for unspecified `<math>` conversion. Options: [`"displaystyle"`, `"textstyle"`]  |


## Notes
* `$wgSmjConvertMath` will allow you to use your existing LaTeX math without editing your mediawiki pages.
However, this will prevent you from using the MathML syntax with MathJax.
* Do not use `$wgSmjConvertMath` with the Visual Editor if you want to keep `<math>` elements.

# Development
* Edit `src/ext.Smj3.js`
* Run `npm build`
