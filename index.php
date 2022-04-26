<?php
// TEST
// ################################
//Task Language: PHP
//Task Description:
//Write a function that provides change directory (cd) function for an abstract file system.
//Notes:
//root path is '/'.
//path separator is '/'.
//parent directory is addressable as '..'.
//directory names consist only of English alphabet letters 
//(A-Z and a-z).
//the function will not be passed any invalid paths.
//do not use built-in path-related functions.
// ################################

//For example:
//$path = new Path('/a/b/c/d');
// ###################################

// A)
//$path->cd('x');
//should display '/a/b/c/d/x'.
// -------------------------

// B)
//$path->cd('/a');
//should display '/a'.
// -------------------------

// C)
//$path->cd('./x');
//should display '/a/b/c/d/x'.
// -------------------------

// D)
//$path->cd('../x');
//should display '/a/b/c/x'.
// -------------------------
// E)
//$path->cd('/d/e/../a');
//should display '/d/a'.
// -------------------------
///########### NOT FINISHED ##############################
// F) multiple changing of parent directories
// example input:   /a/b/c/d
//$path->cd('../../e/../f');
//should display '/a/b/f'.
// -------------------------
// g) 
//MY ADDITIONAL EXAMPLE OF POSSIBLE SITUATION
//$path->cd('/d/e/../a/../b');
//should display '/d/b'.

require 'change_directory.php';
$path01 = new Path('/a/b/c/d');
echo " Start path:".$path01->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value01='';
echo " COMMAND:".$input_command_value01;
echo "<html> <br />  </html>";
$path01->cd($input_command_value01);
echo " Final path:".$path01->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/c/d' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path02 = new Path('/a/b/c/d');
echo " Start path:".$path02->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value02='..';
echo " COMMAND:".$input_command_value02;
echo "<html> <br />  </html>";
$path02->cd($input_command_value02);
echo " Final path:".$path02->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/c' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path1 = new Path('/a/b/c/d');
echo " Start path:".$path1->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value1='x';
echo " COMMAND:".$input_command_value1;
echo "<html> <br />  </html>";
$path1->cd($input_command_value1);
echo " Final path:".$path1->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/c/d/x' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path2 = new Path('/a/b/c/d');
echo " Start path:".$path2->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value2='/a';
echo " COMMAND:".$input_command_value2;
echo "<html> <br />  </html>";
$path2->cd($input_command_value2);
echo " Final path:".$path2->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path3 = new Path('/a/b/c/d');
echo " Start path:".$path3->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value3='./x';
echo " COMMAND:".$input_command_value3;
echo "<html> <br />  </html>";
$path3->cd($input_command_value3);
echo " Final path:".$path3->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/c/d/x' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path4 = new Path('/a/b/c/d');
echo " Start path:".$path4->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value4='../x';
echo " COMMAND:".$input_command_value4;
echo "<html> <br />  </html>";
$path4->cd($input_command_value4);
echo " Final path:".$path4->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/c/x' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path5 = new Path('/a/b/c/d');
echo " Start path:".$path5->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value5='/d/e/../a';
echo " COMMAND:".$input_command_value5;
echo "<html> <br />  </html>";
$path5->cd($input_command_value5);
echo " Final path:".$path5->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/d/a' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path6 = new Path('/a/b/c/d');
echo " Start path:".$path6->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value6='../../e/../f';
echo " COMMAND:".$input_command_value6;
echo "<html> <br />  </html>";
$path6->cd($input_command_value6);
echo " Final path:".$path6->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/a/b/f' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";

$path7 = new Path('/a/b/c/d');
echo " Start path:".$path7->current_path;
echo "<html> <br />  </html>";
echo "################################";
echo "<html> <br />  </html>";
$input_command_value7='/d/e/../a/../b';
echo " COMMAND:".$input_command_value7;
echo "<html> <br />  </html>";
$path7->cd($input_command_value7);
echo " Final path:".$path7->current_path;
echo "<html> <br />  </html>";
echo "EXPECTED RESULT:  '/d/b' ";
echo "<html> <br />  </html>";
echo "---------------------";
echo "<html> <br />  </html>";





?>
