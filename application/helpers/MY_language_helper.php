<?php
/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Lang override default and return text even if not translation found
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @param    string $text       The language line
 * @param    string $for        The "for" value (id of the form element)
 * @param    array  $attributes Any additional HTML attributes
 *
 * @return    string
 */
function lang($text, $for = '', $attributes = array())
{
    $ci = get_instance();

    $line = $ci->lang->line($text);
    if($for !== '') {
        $line = '<label for="'.$for.'"'._stringify_attributes($attributes).'>'.$line.'</label>';
    }

    if($line == "") {

        //test many words
        $l = explode(' ', $text);
        if(count($l) > 1) {
            //test lowercase
            $line = strtolower($text); //foo bar
            $line = $ci->lang->line($line);

            if($line == "") { //test uppercase
                $line = strtoupper($text); //FOO BAR
                $line = $ci->lang->line($line);

                if($line == "") {//test ucwords
                    $line = ucwords($text); //Foo Bar
                    $line = $ci->lang->line($line);

                    if($line == "") { //test ucfirst
                        $line = ucfirst($l[0]).' '.strtolower($l[1]); //Foo bar
                        $line = $ci->lang->line($line);
                    }
                }
            }

        } else {//return same string
            $text = str_replace('_', ' ', $text);
            $text = ucwords($text);
            return $text;
        }
    }

    return $line;
}

?>