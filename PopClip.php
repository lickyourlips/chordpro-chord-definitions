<?php
require 'src/autoload.php';

use lickyourlips\ChordProDefinitions\ChordProDefinitions;

$chordPro = getenv('POPCLIP_TEXT');
$chordProDefs = new ChordProDefinitions($chordPro);
echo $chordProDefs->getChordProDefsString('guitar');