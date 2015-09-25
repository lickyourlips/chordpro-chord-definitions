ChordPro Chord Definitions
==========================

A basic PopClip Extension for ChordPro enthusiasts, to transform chords from a ChordPro file into a list of chord definition templates.

### Usage

A set of chordpro chords, with or without lyrics, as per this example:

	[C]lyrics l[G]yrics lyri[F]cs
	[A] lyric[Bm]s lyric[C]s ly[G]ric[A]s

will be transformed into a list of chordpro chord definition templates, like so:

	{define: C 0 x x x x x x}
	{define: G 0 x x x x x x}
	{define: F 0 x x x x x x}
	{define: A 0 x x x x x x}
	{define: Bm 0 x x x x x x}

### Testing

Using [phpunit][ref1], run the following command in Terminal from the project folder:

	phpunit --bootstrap src/autoload.php tests/ChordProDefinitionsTest.php

[ref1]: https://phpunit.de