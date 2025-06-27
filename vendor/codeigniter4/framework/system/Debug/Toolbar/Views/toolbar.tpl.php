<?php
/**
 * @var \CodeIgniter\Debug\Toolbar $this
 * @var int                        $totalTime
 * @var int                        $totalMemory
 * @var string                     $url
 * @var string                     $method
 * @var bool                       $isAJAX
 * @var int                        $startTime
 * @var int                        $totalTime
 * @var int                        $totalMemory
 * @var float                      $segmentDuration
 * @var int                        $segmentCount
 * @var string                     $CI_VERSION
 * @var array                      $collectors
 * @var array                      $vars
 * @var array                      $styles
 * @var \CodeIgniter\View\Parser   $parser
 */

?>
<style type="text/css">
	<?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . '/toolbar.css')) ?>
</style>

<script id="toolbar_js" type="text/javascript">
	<?= file_get_contents(__DIR__ . '/toolbar.js') ?>
</script>

<style type="text/css">
	<?php foreach($styles as $name => $style) : ?>
	.<?= $name ?> {
		<?= $style ?>
	}

	<?php endforeach ?>
</style>
