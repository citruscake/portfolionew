<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('Xml', 'Utility');
//App::Import('Helper', 'Xml');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class ProjectsController extends AppController {

	var $projects;

	public function index() {
		$this->layout = "ajax";
		$this->set('test_variable', "test");

		$xml = Xml::build('./xml/projects.xml');
		$xmlArray = Xml::toArray($xml);
		$projects = $xmlArray['projects']['project'];
		$this->set('projects', $projects);

	}
	
	public function action($command) {
	
		switch($command) {
			case "fetch" :
				
				$this->layout = 'ajax';
				$this->autoRender = false;
				$xml = Xml::build('./xml/projects.xml');
				$xmlArray = Xml::toArray($xml);
				$projects = $xmlArray['projects']['project'];
				echo json_encode($projects);
				break;
			default:
				echo "error";
		}
	}
	
	public function templates($command) {
	
		switch($command) {
			case "fetch" :
			
				$this->layout = 'ajax';
				$this->autoRender = false;
				$templates = array();
				$template_elements = ['thumbnail_button', 'project_container'];
				foreach ($template_elements as $element) {
					$view = new View($this, false);
					$template = $view->element($element);
					$template = "<script type=\"text/template\" id=\"".$element."_template\">".$template."</script>";
					array_push($templates, $template);
				}
				echo json_encode($templates);
				break;
			default:
				echo "error";
		
		}
	
	}

}