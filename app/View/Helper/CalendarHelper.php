<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CalendarHelper extends Helper 
{
	private $startHour		= 7;
	private $endHour		= 21;
	private $hourInPixel	= 60;
	private $columnWidth	= 200;
	private $columnSpacing	= 20;
	private $columnOffset	= 80;
	private $lastDay		= 5; //end on friday
	
	public function printWeek($params)
	{
		$lastMonday = $params['lastMonday'];
		$agendaEntries = $params['agendaEntries'];
		$courseSchedules = $params['courseSchedules'];
		$courses = $params['courses'];
		$editable = $params['editable'];
		
		$result = '';
		
		$result .= '<div class="dailyColumn">';
    	$result .= '<div class="dailyTableContainer">';
		
		$result .= $this->getTimeGrid($params);
		$result .= $this->getCoursesTimeSlots($params);
		$result .= $this->getAgendaEntries($params);
				
		$result .= '</div>';
		$result .= '</div>';
		
		return $result;
	}
	
	public function twoDigits($number)
	{
		if($number >= -9 && $number <= 9)
			return '0'.$number;
		return $number;	
	}
	
	public function getTimeGrid($params)
	{
		$lastMonday = $params['lastMonday'];
		
		$result = '';
		
		$hour = $this->startHour;
		$min = 0;
		
		$width = $this->columnOffset + $this->lastDay*($this->columnSpacing+$this->columnWidth);
		
		while($hour <= $this->endHour)
		{
			$timeString = $this->twoDigits($hour).':'.$this->twoDigits($min);
			
			$startOffset = ($hour - $this->startHour)*$this->hourInPixel + $min;
			$height = $this->hourInPixel/2;
			
			$result .= '<div class="splitter" style="top:'.$startOffset.'px; height:'.$height.'px;width:'.$width.'px"><div>'.$timeString.'</div></div>';
								  
			$min += 30;
			if($min == 60)
			{
				$min = 0;
				$hour++;
			}
		}
		
		for($i=0; $i < $this->lastDay; $i++)
		{
			$yOffset = $this->columnOffset+($this->columnWidth+$this->columnSpacing) * $i;
			$currentDate = $lastMonday + $i*3600*24;
			$result .= '<div class="dateLabel" style="left:'.$yOffset.'px">'.date("d/m/Y", $currentDate).'</div>';
		}
		
		return $result;
	}
	
	public function lastMonday()
	{		
		return strtotime('last monday', strtotime('tomorrow'));
	}
	
	public function finalTimeStamp($dateTimeStamp, $timeString)
	{
		$parts = explode(':', $timeString);
		$val = $dateTimeStamp + $parts[2] + $parts[1] * 60 + $parts[0] * 3600;
		return $val;
	}
	
	public function getCoursesTimeSlots($params)
	{
		$lastMonday = $params['lastMonday'];
		$courseSchedules = $params['courseSchedules'];
		$courses = $params['courses'];
		$editable = $params['editable'];
		
		$result = '';
		
		foreach ($courseSchedules as $courseSchedule):
		
			$t1 = ($courseSchedule['CourseSchedule']['startTime']);
			$t2 = ($courseSchedule['CourseSchedule']['endTime']);
			list($hour1, $min1) = explode(':', $t1);
			list($hour2, $min2) = explode(':', $t2);
			
			$startOffset = ($hour1 - $this->startHour)*$this->hourInPixel + $min1;
			$endOffset = ($hour2 - $this->startHour)*$this->hourInPixel + $min2; 
			$height = $endOffset-$startOffset;
			$yOffset = $this->columnOffset+($this->columnWidth+$this->columnSpacing) * ($courseSchedule['CourseSchedule']['dayOfWeek'] - 1);
			
			$date = $lastMonday + ($courseSchedule['CourseSchedule']['dayOfWeek'] - 1) * 3600*24;
			$dateEarly = $this->finalTimeStamp($date, $courseSchedule['CourseSchedule']['startTime']);
			$dateLater = $this->finalTimeStamp($date, $courseSchedule['CourseSchedule']['endTime']);
			
			$color = 'agendaTileGrey '. $courseSchedule['ColorClass']['className'];
			$class = $editable ? 'courseSchedule '.$color.'' : 'courseSchedule clickable agendaTileGrey';
			$onclick = $editable ? '' : '';//' onClick="window.location = \'AgendaEntries/add/'.$courseSchedule['CourseSchedule']['courseId'].'/'.$dateEarly.'/'.$dateLater.'/\';"';
			
			$result .= '<div id="courseSchedule_'.$courseSchedule['CourseSchedule']['id'].'" class="'.$class.'" tag="'.$dateEarly.'_'.$dateLater.'/" style="top:'.$startOffset.'px; height:'.$height.'px;left:'.$yOffset.'px;width:'.$this->columnWidth.'px;"'.$onclick.'>';
			
			if($editable)
			{	
				$result .=	'<a class="deleteLink" href="#" onclick="if (confirm(\'Are you sure you want to delete this?\')) { window.location = \'CourseSchedules/delete/'.$courseSchedule['CourseSchedule']['id'].'\'; } event.returnValue = false; return false;"><img src="app/webroot/img/delete.png" width="16" height="16" alt="Delete" /></a>';
							
				$result .=	'<a class="editLink" href="CourseSchedules/edit/'.$courseSchedule['CourseSchedule']['id'].'"><img src="app/webroot/img/edit.gif" width="14" height="14" alt="Edit" /></a>';
			}
						
			$result .=	$courses[$courseSchedule['CourseSchedule']['courseId']].	'</div>';
			
		endforeach;	
		
		return $result;
	}
	
	public function getAgendaEntries($params)
	{
		$lastMonday = $params['lastMonday'];
		$courseSchedules = $params['courseSchedules'];
		$courses = $params['courses'];
		$editable = $params['editable'];
		$agendaEntries = $params['agendaEntries'];
		
		$result = '';
		
		foreach ($agendaEntries as $agendaEntry):
		
			$t1 = ($agendaEntry['AgendaEntry']['startTime']);
			$t2 = ($agendaEntry['AgendaEntry']['endTime']);
			list($hour1, $min1) = explode(':', $t1);
			list($hour2, $min2) = explode(':', $t2);
			
			$startOffset = ($hour1 - $this->startHour)*$this->hourInPixel + $min1;
			$endOffset = ($hour2 - $this->startHour)*$this->hourInPixel + $min2; 
			$height = $endOffset-$startOffset;
			
			$dayOfWeek = date("N", strtotime($agendaEntry['AgendaEntry']['date'])) ;
			$yOffset = $this->columnOffset+($this->columnWidth+$this->columnSpacing) * ($dayOfWeek - 1);
						
			$color = 'agendaTileGrey clickable agendaTileBlue';
			$result .= '<div id="agendaEntry_'.$agendaEntry['AgendaEntry']['id'].'" class="courseSchedule agendaEntry '.$color.'" style="top:'.$startOffset.'px; height:'.$height.'px;left:'.$yOffset.'px;width:'.$this->columnWidth.'px;">';
					
			$result .=	nl2br($agendaEntry['AgendaEntry']['label']).	'</div>';
			
		endforeach;	
		
		return $result;
	}
}
