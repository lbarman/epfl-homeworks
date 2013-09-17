<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <?php echo $this->Html->script('jquery'); ?>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('dailyAgenda');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
            <div id="menu">
            	<div class="menuItem" id="menu_agenda">Agenda</div>
            	<div class="menuItem" id="menu_timeslot">Timeslots</div>
            	<div class="menuItem" id="menu_courses">Courses</div>
            	<div class="menuItem" id="menu_account">Account</div>
            </div>
			<h1>EPFL Homeworks</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
    <script type="application/javascript" language="javascript">
	<!--
	$("#menu_agenda").click(function(){window.location = '/epfl-homeworks/AgendaEntries';});
	$("#menu_timeslot").click(function(){window.location = '/epfl-homeworks/CourseSchedules';});
	$("#menu_courses").click(function(){window.location = '/epfl-homeworks/Courses';});
	$("#menu_account").click(function(){window.location = '/epfl-homeworks/Users';});
	-->
	</script>
</body>
</html>
