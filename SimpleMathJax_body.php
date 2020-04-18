<?php
class SimpleMathJax
{
    private static $moduleLoaded = false;

    public static function onRegistration()
    {
        Hooks::register('ParserFirstCallInit', __CLASS__ . '::setup');
    }

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
        $wgSmjInlineMath[] = ["[math]","[/math]"];
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
        // $tex = str_replace('\>', '\;', $tex);
        // $tex = str_replace('<', '\lt ', $tex);
        // $tex = str_replace('>', '\gt ', $tex);
        return self::renderTex($tex, $parser);
    }

    public static function renderChem($tex, array $args, Parser $parser, PPFrame $frame)
    {
        $tex = '\ce{'.$tex.'}';
        return self::renderTex($tex, $parser);
    }

    private static function renderTex($tex, $parser)
    {
        return ["\\(${tex}\\)", 'markerType'=>'nowiki'];
    }
}
