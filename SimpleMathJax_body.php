<?php
class SimpleMathJax
{
    private static $moduleLoaded = false;

    public static function setup(Parser $parser)
    {
        global $wgOut, $wgSmjUseCDN, $wgSmjScale, $wgSmjUseChem, $wgSmjShowMathMenu,
         $wgSmjInlineMath, $wgSmjDisplayMath, $wgSmjConvertMath;

        $smjModule = 'ext.Smj3';
        $wgOut->addModules($smjModule);
        // MobileFrontend requires explicit cloned modules targeting mobile
        $wgOut->addModules($smjModule . ".mobile");
        $wgOut->addJsConfigVars('wgSmjUseCDN', $wgSmjUseCDN);
        $wgOut->addJsConfigVars('wgSmjScale', $wgSmjScale);
        $wgOut->addJsConfigVars('wgSmjUseChem', $wgSmjUseChem);
        $wgOut->addJsConfigVars('wgSmjShowMathMenu', $wgSmjShowMathMenu);
        // $wgSmjInlineMath[] = ["[math]","[/math]"];
        $wgOut->addJsConfigVars('wgSmjInlineMath', $wgSmjInlineMath);
        $wgOut->addJsConfigVars('wgSmjDisplayMath', $wgSmjDisplayMath);
        if ($wgSmjConvertMath) {
            $parser->setHook('math', __CLASS__ . '::renderMath');
        }
        if ($wgSmjUseChem) {
            $parser->setHook('chem', __CLASS__ . '::renderChem');
        }
    }

    public static function renderMath($tex, array $args, Parser $parser, PPFrame $frame)
    {
        $tex = str_replace('\>', '\;', $tex);
        $tex = str_replace('<', '\lt ', $tex);
        $tex = str_replace('>', '\gt ', $tex);
        return self::renderTex($tex, $args, $parser);
    }

    public static function renderChem($tex, array $args, Parser $parser, PPFrame $frame)
    {
        $tex = '\ce{'.$tex.'}';
        return self::renderTex($tex, $parser);
    }

    private static function renderTex($tex, array $args, $parser)
    {
        global $wgSmjConvertStyle;
        if (array_key_exists("display", $args)) {
            if ($args["display"] == "inline") {
                return ["\\(${tex}\\)", 'markerType'=>'nowiki'];
            } elseif ($args["display"] == "block") {
                return ["\\[${tex}\\]", 'markerType'=>'nowiki'];
            }
        }
        if ($wgSmjConvertStyle == "textstyle") {
            return ["\\(\\textstyle ${tex}\\)", 'markerType'=>'nowiki'];
        } else {
            return ["\\(\\displaystyle ${tex}\\)", 'markerType'=>'nowiki'];
        }
    }

    public static function onArticleViewHeader( &$article, &$outputDone, &$pcache )
    {
        $header =<<<EOF
<div style="display: none;">
\(
\\newcommand{\P}[]{\\unicode{xB6}}
\\newcommand{\AA}[]{\\unicode{x212B}}
\\newcommand{\\empty}[]{\\emptyset}
\\newcommand{\O}[]{\\emptyset}
\\newcommand{\Alpha}[]{Α}
\\newcommand{\Beta}[]{Β}
\\newcommand{\Epsilon}[]{Ε}
\\newcommand{\Iota}[]{Ι}
\\newcommand{\Kappa}[]{Κ}
\\newcommand{\Rho}[]{Ρ}
\\newcommand{\Tau}[]{Τ}
\\newcommand{\Zeta}[]{Ζ}
\\newcommand{\Mu}[]{\\unicode{x039C}}
\\newcommand{\Chi}[]{Χ}
\\newcommand{\Eta}[]{\\unicode{x0397}}
\\newcommand{\Nu}[]{\\unicode{x039D}}
\\newcommand{\Omicron}[]{\\unicode{x039F}}
\DeclareMathOperator{\sgn}{sgn}
\def\oiint{\mathop{\\vcenter{\mathchoice{\huge\unicode{x222F}\,}{\unicode{x222F}}{\unicode{x222F}}{\unicode{x222F}}}\,}\\nolimits}
\def\oiiint{\mathop{\\vcenter{\mathchoice{\huge\unicode{x2230}\,}{\unicode{x2230}}{\unicode{x2230}}{\unicode{x2230}}}\,}\\nolimits}
\)
</div>
EOF;
        $article->getContext()->getOutput()->addHTML($header);
    }
}
