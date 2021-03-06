<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifierCompiler
 */

/**
 * @ignore
 */
require_once( SMARTY_PLUGINS_DIR .'shared.literal_compiler_param.php' );

/**
 * Smarty escape modifier plugin
 *
 * Type:     modifier<br>
 * Name:     escape<br>
 * Purpose:  escape string for output
 *
 * @link http://www.smarty.net/docsv2/en/language.modifier.escape count_characters (Smarty online manual)
 * @author Rodney Rehm
 * @param array $params parameters
 * @return string with compiled code
 */
function smarty_modifiercompiler_escape($params, $compiler)
{
    try {
        $esc_type = smarty_literal_compiler_param($params, 1, 'html');
        $char_set = smarty_literal_compiler_param($params, 2, SMARTY_RESOURCE_CHAR_SET);
        $double_encode = smarty_literal_compiler_param($params, 3, true);

        if (!$char_set) {
            $char_set = SMARTY_RESOURCE_CHAR_SET;
        }

        switch ($esc_type) {
            case 'html':
                return 'htmlspecialchars('
                    . $params[0] .', ENT_QUOTES, '
                    . var_export($char_set, true) . ', '
                    . var_export($double_encode, true) . ')';

            case 'htmlall':
                if (SMARTY_MBSTRING /* ^phpunit */&&empty($_SERVER['SMARTY_PHPUNIT_DISABLE_MBSTRING'])/* phpunit$ */) {
                    return 'mb_convert_encoding(htmlspecialchars('
                        . $params[0] .', ENT_QUOTES, '
                        . var_export($char_set, true) . ', '
                        . var_export($double_encode, true)
                        . '), "HTML-ENTITIES", '
                        . var_export($char_set, true) . ')';
                }

                // no MBString fallback
                return 'htmlentities('
                    . $params[0] .', ENT_QUOTES, '
                    . var_export($char_set, true) . ', '
                    . var_export($double_encode, true) . ')';

            case 'url':
           `   �2Eturn�%rQwurleogo$e(70. $pa2aes[0 . '):
M
 �    !% 0�c1s&&'trlpathI~n~-j]
�� 0P (         re|�rn #str���Lace(�%2F�, h+", ���uzl�kckdi' .0$pi2asY2] ��78)':�  0   `0"%���3�17q�MveS�2m
   0h$  `  , &!// �pcmPe!u��{�a`e���a���e!quote�	��   $   b 0!0`  r�turn 'qseg^veulcw5((��!\\\]X\)d'%"( "\�Z/#-% .!%a1Ralu[0]0. %)����
$!0"  $� ( ��aSf!/javasgript':
   $ `      (0(//�eqc`pe$qeOtEs ie(babkslqWhg�,%neghiJes�`wVc.	�"(   `     �8! "2etuRn$sdr$s(' . `pas�b۲�"�0',0��~ay("\\\\" =n`f\\\�^\^\"���\'"0y~ &\\D^^g!, *L*( =n!"\^\\\"&l "X\r" 1&�"�\L\s2<��_]n" ,? #LT��"N"">/ =>`"l\O" �)';
 $ ��#H`m 4` M`#eua,�S{!rtyA8cgptiooh$u; {
  `�  �$?/ paws dltougj$to!reeu|q�Ҭucin$fAlibeCy*"! `]*͊�����- c��ld(jot(opt!li:u |Escaxm �All, 3o fah,j`ci`Tm1egueA200dugqn�� !����",$com9mlErn~aw_nocacae � %aogtylmbm.xocachc) {/J$     8 ����p�ldr%>�emPlaT%M>req�)R!d_���gilsZ'nmc@oheEO[�d7c`P%'][#odif)Ev']Y'��de'U�- SM�RUY?@L]OINS_DHR#n'k���f)r(ecccxe>ph��;+"  p  ` $g}m�yLej->um�q`Atee<puqu�red_p*ueh^c['nn'ebl�3]['es#iTu'�[�mfmi&mezgM[�tWnstooj'_` '2artMOmoDidI�R˥q��pa';%
04 1} else {-h  ��p0 �wm@9l}r=>teiplete->zey}irDd]plugi*v[gs}pI�ml/][e�BaPm'][��odlf)e07]['Bile/} ? SE��T_^PLG�OC_D�� �&motafae�d;bape.5ip'9
 �$$` (!&c�mril��->temqoa��-> tquif%fwqluga�q['koipil%f']['eQca�m/]['moDicieR']{.bunc�k/n'_�= 7vmart�OMo�if�e0�eRcapa' (  }	
 " #r�Turn 'Qmapv�_m�ĩ��d�e3ca`e*' .���y~` ', ', $@iV!-�") n '9;
|
+/>