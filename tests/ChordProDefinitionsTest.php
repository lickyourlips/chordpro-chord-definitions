<?php

namespace lickyourlips\ChordProDefinitions\tests;

use lickyourlips\ChordProDefinitions\ChordProDefinitions;

class ChordProDefinitionsTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider chordProChordsProvider
	 */
	public function testGetProChords($chordPro, $expected)
	{
		$chordProDefs = new ChordProDefinitions($chordPro);
		$this->assertEquals($expected, $chordProDefs->getChordProChords());
	}

	public function chordProChordsProvider()
	{
		return array(
			// test general
			array('[C]lyrics l[G]yrics lyri[F]cs, [A] lyric[Bm]',
				array('[C]','[G]','[F]','[A]','[Bm]')
				),
			// test sharps, flats and inversions
			array('ly[G#]rics l[Gb]yric[D/F#]s [Ebdim7]lyrics',
				array('[G#]', '[Gb]', '[D/F#]', '[Ebdim7]')
				),
			// test extended names with symbols
			array('l[G9sus2(vi)]rics ly[Dbsus2/G]rics [Fmaj9#11(2)]lyrics',
				array('[G9sus2(vi)]', '[Dbsus2/G]', '[Fmaj9#11(2)]')
				),
			// test chords with no lyrics at all
			array('[A][Bm][G][C#dim7]',
				array('[A]','[Bm]','[G]','[C#dim7]')
				),
			// test lyrics on more than one line
			array('l[G]yrics lyri[F]cs ' . PHP_EOL . '[A] lyric[Bm]',
				array('[G]', '[F]', '[A]', '[Bm]')
				),
			// test duplicate chords are removed
			array('[Bm]ly[G]ri[A]cs [C], lyr[G]ic[A]s [Bm]',
				array('[Bm]','[G]','[A]', '[C]')
				)
		);
	}

	/**
	 * @dataProvider chordProDefsStringProvider
	 */
	public function testGetChordProDefsString($chordPro, $instrument, $expected)
	{
		$chordProDefs = new ChordProDefinitions($chordPro);
		$this->assertEquals($expected, $chordProDefs->getChordProDefsString($instrument));
	}

	public function chordProDefsStringProvider()
	{
		return array(
			array('[C]lyri[G]cs', 'guitar',
				'{define: C 0 x x x x x x}' . PHP_EOL .
				'{define: G 0 x x x x x x}'
			)
		);
	}

	/**
	 * @dataProvider chordProChordDefsProvider
	 */
	public function testGetChordProDefs($chordPro, $instrument, $expected)
	{
		$chordProDefs = new ChordProDefinitions($chordPro);
		$this->assertEquals($expected, $chordProDefs->getChordProDefs($instrument));
	}

	public function chordProChordDefsProvider()
	{
		return array(
			// test general
			array('[C]lyrics l[G]yrics lyri[F]cs, [A] lyric[Bm]', 'guitar',
				array(
					'{define: C 0 x x x x x x}',
					'{define: G 0 x x x x x x}',
					'{define: F 0 x x x x x x}',
					'{define: A 0 x x x x x x}',
					'{define: Bm 0 x x x x x x}')
			),
			// test duplicate removal
			array('[C]lyrics l[G]yr[A]ics' . PHP_EOL . ' [G]ly[A]i[Bm]c', 'guitar',
				array(
					'{define: C 0 x x x x x x}',
					'{define: G 0 x x x x x x}',
					'{define: A 0 x x x x x x}',
					'{define: Bm 0 x x x x x x}')
			),
			// test ukulele
			array('[C]lyrics l[G]yrics lyri[F]cs, [A] lyric[Bm]', 'ukulele',
				array(
					'{define: C 0 x x x x}',
					'{define: G 0 x x x x}',
					'{define: F 0 x x x x}',
					'{define: A 0 x x x x}',
					'{define: Bm 0 x x x x}')
			)
		);
	}

}
