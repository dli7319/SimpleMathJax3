The SimpleMathJax3 extension enables MathJax v3 for typesetting TeX formula in MediaWiki inside math environments.


# Installation
1. `git clone` to your `extensions` directory
```Bash
git clone git@github.com:dli7319/SimpleMathJax3.git
```
2. Load the extension by editing `LocalSettings.php`
```PHP
wfLoadExtension( 'SimpleMathJax' );
```
3. (Optional) If not using the CDN
 * Set `$wgSmjUseCDN=false` in `LocalSettings.php`
 * Run `npm ci` within `SimpleMathJax3` to download mathjax


# Settings
| Setting name         | Default value                 | Description                                   |
| -------------------- | ----------------------------- | --------------------------------------------- |
| `$wgSmjScale`        | 1.0                           | chtml font scale                              |
| `$wgSmjUseCDN`       | true                          | use CDN or local scripts                      |
| `$wgSmjUseChem`      | true                          | enable chem tag                               |
| `$wgSmjInlineMath`   | [["\\(","\\)"]]               | inline math symbols pairs                     |
| `$wgSmjDisplayMath`  | [["\\[","\\]"],["$$","$$"]]   | display math symbols pairs                    |
| `$wgSmjShowMathMenu` | true                          | enable MathJax context menu                   |
| `$wgSmjConvertMath`  | true                          | converts [<math>,</math>] to [\\(,\\)] on load  |

If you want to change font size, set `$wgSmjSize`.
```PHP
wfLoadExtension( 'SimpleMathJax' );
$wgSmjSize = 150;
```

If you want to use local module, set `$wgSmjUseCDN`.
```PHP
wfLoadExtension( 'SimpleMathJax' );
$wgSmjUseCDN = false;
```

If you want to enable some additional inlineMath symbol pairs, set `$wgSmjInlineMath`.
```PHP
wfLoadExtension( 'SimpleMathJax' );
$wgSmjInlineMath = [["$","$"],["\\(","\\)"]];
```


## TODO
* Implement a smart way to convert [\\(, \\)] to [<math>, </math>] when editing.


## Notes
* `$wgSmjConvertMath` will allow you to use your existing tex math without editing your mediawiki pages. However, this will prevent you from using the MathML syntax with MathJax.
