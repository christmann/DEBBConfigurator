<?php

namespace Debb\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Debb\ManagementBundle\Entity\NodeToNodegroup;
use Debb\ManagementBundle\Entity\NodegroupToRack;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/rack", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class RackController extends XMLController
{
	/**
	 * @var string type of debbcomponent
	 */
	public $debbType = 'ComputeBox1';

	/**
	 * @var string debb entity repository
	 */
	public $debbEntity = 'DebbConfigBundle:Rack';

	/**
	 * Creates a new entity
	 *
	 * @Route("/form/{id}", defaults={"id"=0}, requirements={"id"="\d+|"});
	 * @Template()
	 *
	 * @param Request                                   $request  Request object
	 * @param int                                       $id       item id
	 *
	 * @return array
	 */
	public function formAction(Request $request, $id = 0)
	{
		/* @var $item \Debb\ConfigBundle\Entity\Rack */
		$item = $this->getEntity($id);
		$nodegroups = $this->getEntities('DebbConfigBundle:NodeGroup');

//		if ($request->getMethod() != 'POST' && count($item->getNodeGroups()) < 1)
//		{
//			while (count($item->getNodeGroups()) < $item->getNodeGroupSize())
//			{
//				/* create required node groups */
//				$nodeGroup = new NodegroupToRack();
//				$nodeGroup->setField($item->getFreeNodeGroup());
//				$item->addNodeGroup($nodeGroup);
//			}
//
//			$this->getManager()->persist($item);
//		}

		$form = $this->createForm($this->getFormType($item), $item);
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);

			if ($form->isValid())
			{
				$this->persistEntity($item);
				$this->addSuccessMsg("localdev_admin.messages.saved");
			}
		}

		return $this->render($this->resolveTemplate(__METHOD__), array(
				'form' => $form->createView(),
				'item' => $item,
				'nodegroups' => $nodegroups
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
