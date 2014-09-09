<?php

namespace Reflectionist;

/**
 * Class Analyzer
 * @package Reflectionist
 */
class Analyzer {

}

$tables = [
	['data'   => [
		['id' => 1, 'content' => 'sample content'],
		['id' => 2, 'content' => 'sample content jabadabaduuu...'],
		['id' => 3, 'content' => 'test 1123123123'],
		['id' => 4, 'content' => 'sample content']
	],
	 'status' => 'F'
	],
	['data'   => [
		['id' => 1, 'content' => 'sample content'],
		['id' => 2, 'content' => 'sample content jabadabaduuu...'],
		['id' => 3, 'content' => 'test 1123123123'],
		['id' => 4, 'content' => 'sample content']
	],
	 'status' => 'S'
	],
	['data'   => [
		['id' => 1, 'content' => 'sample content'],
		['id' => 2, 'content' => 'sample content jabadabaduuu...'],
		['id' => 3, 'content' => 'test 1123123123'],
		['id' => 4, 'content' => 'sample content']
	],
	 'status' => 'F'
	]
];


foreach ($tables as $table) {
	?>
	<table id="<?= myUniqueTableIdGeneratorFunction() ?>"
		   class="<?= ($table['status']) == 'F' ? 'class-with-border' : null ?>" ><?php
	foreach ($table['data'] as $row) {
		?>
		<tr>
			<td><?= $row['id'] ?></td>
			<td><?= $row['content'] ?></td>
		</tr>
	<?php
	}
	?></table><?php
}