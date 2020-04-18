The SimpleMathJax extension enables MathJax, a Javascript library, for typesetting TeX formula in MediaWiki inside math environments.

https://www.mediawiki.org/wiki/Extension:SimpleMathJax


# Installation
* git clone in extensions directory
* Using CDN is recommended. Because it's much faster than using local resources in most cases. ("the benefits of using a CDN")
```Bash
$ git clone --recurse-submodules https://github.com/dli7319/SimpleMathJax3
```

* LocalSetting.php
```PHP
wfLoadExtension( 'SimpleMathJax' );
```

# Optional Settings
| Setting name         | Default value           | Description                                   |
| -------------------- | ----------------------- | --------------------------------------------- |
| `$wgSmjScale`        | 1.0                     | font size                                     |
| `$wgSmjUseCDN`       | true                    | use CDN or local scripts                      |
| `$wgSmjUseChem`      | true                    | enable chem tag                               |
| `$wgSmjInlineMath`   | []                      | add some additional inlineMath symbols pairs  |
| `$wgSmjShowMathMenu` | true                    | enable MathJax context menu                   |

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
