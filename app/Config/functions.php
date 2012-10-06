<?php 
/**
 * Wraps ternary operations. If $condition is a non-empty value, $val1 is returned, otherwise $val2.
 * Don't use for isset() conditions, or wrap your variable with @ operator:
 * Example:
 *
 * `ife(isset($variable), @$variable, 'default');`
 *
 * @param mixed $condition Conditional expression
 * @param mixed $val1 Value to return in case condition matches
 * @param mixed $val2 Value to return if condition doesn't match
 * @return mixed $val1 or $val2, depending on whether $condition evaluates to a non-empty expression.
 * @link http://book.cakephp.org/view/1133/ife
 * @deprecated Will be removed in 2.0
 */
    function ife($condition, $val1 = null, $val2 = null) {
        if (!empty($condition)) {
            return $val1;
        }
        return $val2;
    }

/**
 * Function to get the first element of the array:
 * Example:
 *
 * `array_first_key(@$variable);`
 *
 * @param 	array $array Input array
 * @return 	string returns the array key of the first element
 */

    function array_first_key($array, $last = false) 
    {
        if (!empty($last)) {
            end($array);
        }
		else
		{
			reset($array);
		}
        return key($array);
    }

?>