<?php

//Language: PHP
//Description:
//Write a function that provides change directory (cd) function for an abstract file system.
//Notes:
//root path is '/'.
//path separator is '/'.
//parent directory is addressable as '..'.
//directory names consist only of English alphabet letters 
//(A-Z and a-z).
//the function will not be passed any invalid paths.
//do not use built-in path-related functions.

require 'utils.php';

class Path
{
    public $current_path;

    function __construct($path)
    {
        $this->current_path = $path;
    }

    public function cdParent($path)
    {
        $path_last_position_slash=strrpos($path,"/",0);
        $parent_path = substr($path,0, $path_last_position_slash);

        return $parent_path;
    }

    private function RemoveParentDir($in_path)
    {
        $inpath_first_position_2dots_slash=strpos($in_path,"../",0);
        if ($inpath_first_position_2dots_slash===0)
        {
            $out_path =substr($in_path,$inpath_first_position_2dots_slash+3);
        }
        else
        {
            $part_before_2dots_slash= substr($in_path,0,$inpath_first_position_2dots_slash-1);
            $part_before_last_position_slash=strrpos($part_before_2dots_slash,"/",0);
            $first_output_part=substr($part_before_2dots_slash, 0, $part_before_last_position_slash);
            $part_after_2dots_slash= substr($in_path,$inpath_first_position_2dots_slash+3);
            $out_path =$first_output_part.'/'.$part_after_2dots_slash; 
        }
        return $out_path;
    }
    private function StringCharactersValid($Eval_String)
    {
        // letters allowed: 
        // A-Z, a-z, . , / 
        $max_StringCounter = strlen($Eval_String)-1;
        $char_counter=0;
        $char_valid=TRUE;
        $string_valid=TRUE;
        if ($Eval_String=="")
        {
            $string_valid=TRUE;
        }
        else
        {
            do
            {
                $A_ZcharsValid=Utils::CharacterValid($Eval_String[$char_counter], 'A', 'Z');   //$this->CharacterValid($Eval_String[$char_counter], 'A', 'Z');
                $a_zcharsValid=Utils::CharacterValid($Eval_String[$char_counter], 'a', 'z');
                $dotValid=Utils::CharacterValid($Eval_String[$char_counter], '.', '.');
                $slashValid=Utils::CharacterValid($Eval_String[$char_counter], '/', '/');
                
                if (($A_ZcharsValid===TRUE) || ($a_zcharsValid===TRUE) || ($dotValid===TRUE)  || ($slashValid===TRUE))
                {
                    $char_valid=TRUE;
                }
                else
                {
                    $char_valid=FALSE;
                }
                $string_valid=$string_valid && $char_valid;
                $char_counter++;
            } while ($char_counter<=$max_StringCounter);
        }
        return $string_valid;
    }

    public function cd($new_path)
    {
         // INITIALIZATION
         // **************************************
        $output_path="";
        $input_path=$this->current_path;
        $input_command_value=$new_path;
        $command_case="";
        $input_command_value_length =strlen($input_command_value);

        // INPUT VALIDATION
        // **************************************
        // 1. letters validation
        // ---------------------------
        // letters allowed: 
        // A-Z, a-z, . , / 
        if ($this->StringCharactersValid($input_command_value)===TRUE)
        {
            // TO DO - 2. syntax rules validation (not needed as per task spec)
            // ---------------------------
            // allowed types of input_command:
            // 01 - blank
            // 02 - ..
            // a) only letters
            // b)  / + letters 
            // c)  ./ + letters
            // d) ../ + letters
            // e) multiple occurence od ../
        

            // COMPUTATION OF OUTPUT
            // **************************************
            
            // I. separation of command and value
            // --------------------------------------
            // first occurence of special characters
            $first_position_slash =strpos($input_command_value,"/",0);
            $first_position_dot =strpos($input_command_value,".",0);
            $first_position_2dots =strpos($input_command_value,"..",0);
            $first_position_dot_slash = strpos($input_command_value,"./",0);
            $first_position_2dots_slash =strpos($input_command_value,"../",0);

            // last occurence of special characters
            $last_position_slash =strrpos($input_command_value,"/",0);
            $last_position_dot =strrpos($input_command_value,".",0);
            $last_position_2dots =strrpos($input_command_value,"..",0);
            $last_position_dot_slash = strrpos($input_command_value,"./",0);
            $last_position_2dots_slash =strrpos($input_command_value,"../",0);

            // II. recognition of cases in $input_command_value
            // --------------------------------------
            
            // 0-1. no characters
            if ($input_command_value=="")
            {
                $command_case="no characters";
            } 

            // 0-2. only characters are ".."
            if ($input_command_value=='..')
            {
                $command_case="2dots only";
            }

            // a.  no special characters
            if (($input_command_value!=="") && ($first_position_slash===FALSE) && ($first_position_dot===FALSE))
            {
                $command_case="no special characters";
            }
            
            // b. 0 position has single occurence of  "/letters" 
            if (($first_position_slash===0) && ($last_position_slash==$first_position_slash) && ($first_position_dot===FALSE) && ($first_position_2dots===FALSE))
            {
                $command_case="single slash letters - position 0";
            }
            
            // c) 0 position has single occurence of "./letters"
            if (($first_position_dot_slash===0) && ($last_position_dot_slash==$first_position_dot_slash) && ($first_position_2dots===FALSE))
            {
                $command_case="single dotslash letters - position 0";
            } 
            // d) 0 position has single occurence of "../letters" 
            if (($first_position_2dots_slash===0) && ($last_position_2dots_slash==$first_position_2dots_slash))
            {
                $command_case="single 2dotslash letters - position 0";
            }    
            // e) not in the 0 position in $input_command_value, single occurence of  ../
            if (($first_position_2dots_slash>0) && ($last_position_2dots_slash==$first_position_2dots_slash))
            {
                $command_case="single 2dotslash letters - position more than 0";
            } 

            // f) 0 position in $input_command_value has ../, multiple occurence of  ../
            if (($first_position_2dots_slash===0) && ($last_position_2dots_slash>$first_position_2dots_slash))
            {
                   $command_case="multiple 2dotslash letters - starting with position 0";
            } 

            // g) not in the 0 position in $input_command_value, multiple occurence of  ../
            if (($first_position_2dots_slash>0) && ($last_position_2dots_slash>$first_position_2dots_slash))
            {
                   $command_case="multiple 2dotslash letters - starting with position more than 0";
            } 

            // III. application of command to a recognized case
            /// --------------------------------------
        
            switch ($command_case)
            {
                case "no characters":
                {
                    $output_path = $input_path;
                    break;
                }
                case "2dots only":
                {
                    $output_path = $this->cdParent($input_path);
                    break;
                }
                case "no special characters":
                {
                    // attach the value as a subdirectory
                    $output_path = $input_path.'/'.$input_command_value;
                    break;
                }
                case "single slash letters - position 0":
                {
                    //  replace $input_path with $input_command_value
                    $output_path = $input_command_value;
                    break;
                }
                case "single dotslash letters - position 0":
                {
                    // take substring from $input_command_value starting from 2 (without ./) and attach "/ + new value"
                    $output_path = $input_path.'/'.substr($input_command_value,2);
                    break;
                }
                case "single 2dotslash letters - position 0":
                {
                    // change to parent directory i.e. remove from the input_path from last occurence of / to the right and add "/+ new value"
                    $output_path = $this->cdParent($input_path).'/'.substr($input_command_value,3);
                    break;
                }
                case "single 2dotslash letters - position more than 0":
                {
                // removing the directory before ../ and the ../
                // working on $input_command_value as a source, following the commands from the $input_command_value
                    
                //$part_before_2dots_slash= substr($input_command_value,0,$first_position_2dots_slash-1);
                //    $part_before_last_position_slash=strrpos($part_before_2dots_slash,"/",0);
                //    $first_output_part=substr($part_before_2dots_slash, 0, $part_before_last_position_slash);
                //    $part_after_2dots_slash= substr($input_command_value,$first_position_2dots_slash+3);
                //    $output_path =$first_output_part.'/'.$part_after_2dots_slash;

                    $output_path =$this->RemoveParentDir($input_command_value); 
                    break;
                            
                }
                case "multiple 2dotslash letters - starting with position 0":
                {
                    // working on $input_path, as a source and following commands from $input_command_value
                    $source_path=$input_path;
                    $command_source=$input_command_value;

                    while ($command_source!="")
                    {
                        if (strpos($command_source,"../",0)===0)    
                        {
                            $command_source=$this->RemoveParentDir($command_source);
                            $source_path = $this->cdParent($source_path);
                        }
                        else // starts with letter/, it should be added to the end of output, i.e. source path
                        {
                            $command_source_first_position_slash =strpos($command_source,"/",0);
                            if ($command_source_first_position_slash>0)
                            {
                                $source_path =$source_path."/".substr($command_source,0,$command_source_first_position_slash);
                                $command_source =substr($command_source,$command_source_first_position_slash+1);
                            }
                            else
                            {
                                $source_path =$source_path."/".$command_source; 
                                $command_source ="";
                            }
                        }
                    };
                    
                    $output_path = $source_path;
                    break;
                }
                case "multiple 2dotslash letters - starting with position more than 0":
                {
                    // working on $input_command_value as a source, following the commands from the $input_command_value
                    $source_path=$input_command_value;
                    while ((strpos($source_path,"../",0)>0)===TRUE)
                    {
                        $source_path=$this->RemoveParentDir($source_path); 
                    } ;
                    $output_path =$source_path;
                    break;
                }
                default:
                {
                    $output_path ="not supported case"; 
                    break;
                }

            }            
        
        } // input string characters valida
        else
        {
            $output_path="invalid characters";
        }
       
        // IIV. SAVING THE COMPUTED PATH AS CURRENT, WHICH IS A BASIS FOR OUTPUT DELIVERY
        // ******************************************************
        $this->current_path =$output_path;
    }
}

?>


