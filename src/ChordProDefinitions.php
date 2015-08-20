<?php

namespace lickyourlips\ChordProDefinitions;

class ChordProDefinitions
{
	private $chordPro;

	private $chordsRegX = '/\[[^\]]+\]/';

	private $bracketsRegX = '/\[|\]/';

	private $chordProChords = [];

	private $defSuffix = array('guitar' => ' 0 x x x x x x}',
							  'ukulele' => ' 0 x x x x}');

	public function __construct($chordPro)
	{
		$this->setChordPro($chordPro);
		$this->setChordProChords($this->harvestChords());
	}

	private function setChordPro($chordPro)
	{
		$this->chordPro = $chordPro;
	}

	private function setChordProChords($chordProChords)
	{
		$this->chordProChords = $chordProChords;
	}

	private function harvestChords()
	{
		preg_match_all($this->chordsRegX, $this->chordPro, $matches);
		return $this->removeDuplicateChords($matches[0]);
	}

	private function removeDuplicateChords($chords)
	{
		return array_keys(array_flip($chords));
	}
	
	### Public Methods ###
	
	public function getChordProChords()
	{
		return $this->chordProChords;
	}

	public function printChordProChords()
	{
		$chordProChords = $this->chordProChords;
		foreach ($chordProChords as $chordProChord) {
			print $chordProChord . PHP_EOL;
		}
	}

	public function getChordProDefs($instrument)
	{
		return $this->buildChordProDefs($instrument);
	}

	public function getChordProDefsString($instrument)
	{
		$chordProDefs = $this->buildChordProDefs($instrument);
		$chordProDefsString = '';

		foreach ($chordProDefs as $chordProDef) {
			$chordProDefsString .= $chordProDef . PHP_EOL;
		}

		return trim($chordProDefsString);
	}

	public function printChordProDefs($instrument)
	{
		$chordProDefs = $this->buildChordProDefs($instrument);
		foreach ($chordProDefs as $chordProDef) {
			print $chordProDef . PHP_EOL;
		}
	}

	### Private Methods ###

	private function buildChordProDefs($instrument)
	{
		$defPrefix = '{define: ';
		$defSuffix = $this->defSuffix[strtolower($instrument)];
		$chordProChords = $this->stripBrackets($this->chordProChords);
		$chordProDefs = [];

		foreach ($chordProChords as $chordProChord) {
			array_push($chordProDefs, $defPrefix . $chordProChord . $defSuffix);
		}
		
		return $chordProDefs;
	}

	private function stripBrackets($chordProChords)
	{
		return preg_filter($this->bracketsRegX, '', $chordProChords);
	}

}