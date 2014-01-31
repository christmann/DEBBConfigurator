<?php
/**
 * DEBBConfigurator - A configurator for DEBB component and PLMXML files
 * Copyright (C) 2013-2014 christmann informationstechnik + medien GmbH & Co. KG
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

namespace Debb\ConfigBundle\Controller;

use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\RackToRoom;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/room", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class RoomController extends XMLController
{
	/**
	 * @var string type of debbcomponent
	 */
	public $debbType = 'Room';

	/**
	 * @var string debb entity repository
	 */
	public $debbEntity = 'DebbConfigBundle:Room';

	/**
	 * Creates a new entity
	 *
	 * @Route("/form/{id}-{duplicated}", defaults={"id"=0, "duplicated"=0}, requirements={"id"="\d+|", "duplicated"="0|1|"});
	 * @Template()
	 *
	 * @param Request                                   $request  Request object
	 * @param int                                       $id       item id
	 * @param int										$duplicated 1/0 true/false is duplicated?
	 * @return array
	 */
	public function formAction(Request $request, $id = 0, $duplicated = 0)
	{
		$GLOBALS['user_bypass'] = $this->getUser();
		$item = $this->getEntity($id);
		$racks = $this->getEntities('DebbConfigBundle:Rack');
		$flowPumps = $this->getEntities('DebbManagementBundle:FlowPump');

		$form = $this->createForm($this->getFormType($item), $item);
		if ($request->getMethod() == 'POST')
		{
			$form->submit($request);

			if ($form->isValid())
			{
				$this->persistEntity($item);
				$this->addSuccessMsg("localdev_admin.messages.saved");
				return $this->redirect($this->generateUrl(ControllerUtils::getRouteName($this->getRequest(), '_form'), array('id' => $item->getId())));
			}
		}

		return $this->render($this->resolveTemplate(__METHOD__), array(
				'form' => $form->createView(),
				'item' => $item,
				'racks' => $racks,
				'flowPumps' => $flowPumps
		));
	}

	/**
	 * Validate a xml string with a xsd string
	 * 
	 * @param string $xml the xml string
	 * @param string $xsd the xsd string
	 * @param string|null $sendTitle the document title for error-mailing
	 * @param string|null $sendTo the email address for error-mailing
	 */
	public function valide($xml, $xsd, $sendTitle = null, $sendTo = null)
	{
		libxml_use_internal_errors(true);

		$doc = new \DOMDocument();
		$doc->loadXml($xml);

		if (!@$doc->schemaValidateSource($xsd))
		{
			if($sendTitle != null && $sendTo != null)
			{
				$mailTxt = "Sehr geehrte Damen und Herren,\n\nbei der Generierung Ihres ". $sendTitle. "-Dokuments sind folgende Fehler aufgetreten.";
				$errors = libxml_get_errors();
				foreach ($errors as $error)
				{
					/* @var $error \LibXMLError */
					$mailTxt .= "\n\n["
						. ($error->level == LIBXML_ERR_WARNING ? 'Warnung' : $error->level == LIBXML_ERR_ERROR ? 'Fehler' : $error->level == LIBXML_ERR_FATAL ? 'Schwerwiegend' : '')
						. "]\n[".$error->code."] " . trim($error->message) . "\nZeile: " . $error->line ."\nXML: ".$this->stringGetLine($xml, $error->line)
						. "\nXSD: " . $this->stringGetLine($xsd, $error->line);
				}
				libxml_clear_errors();
				$mailTxt .= "\n\nMit freundlichen Grüßen\nIhr DEBB Configurator";

				$msg = \Swift_Message::newInstance()
					->setSubject('DEBBConfigurator Generierungsfehler')
					->setFrom('debb@christmann.info')
					->setTo($sendTo)
					->setBody($mailTxt)
					->attach(\Swift_Attachment::newInstance($xml, $sendTitle.'.xml'))
					->attach(\Swift_Attachment::newInstance($xsd, $sendTitle.'.xsd'))
				;
				/* @var $mailer \Swift_Mailer */
				$mailer = $this->get('mailer');
				$mailer->send($msg);
				$this->get('swiftmailer.command.spool_send')->run(new \Symfony\Component\Console\Input\ArgvInput(array()), new \Symfony\Component\Console\Output\ConsoleOutput());
			}

			return false;
		}

		return true;
	}

	/**
	 * Gets specific line
	 *
	 * @param $str
	 * @param $line
	 * @return string
	 */
	public function stringGetLine($str, $line)
	{
		$cache = explode("\n", $str);
		if($line < 0)
		{
			$line = 0;
		}
		else if($line > count($cache))
		{
			$line = count($cache);
		}
		return trim($cache[$line - 1]);
	}

}
