<?php

// Language: PHP
// Description:
// utility functions

class Utils
{

    static public function CharacterValid($Eval_Character, $Lower_LimitChar, $Upper_LimitChar)
    {
        if ((ord($Eval_Character)>=ord($Lower_LimitChar)) && (ord($Eval_Character)<=ord($Upper_LimitChar)))
        {
            $ValidChar=true;
        }
        else
        {
            $ValidChar=false;
        }

        return $ValidChar;

    }


}

?>


