<?php

namespace Debb\ManagementBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Localdev\AdminBundle\Controller\CRUDController;
use \Debb\ConfigBundle\Entity\Node;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 * @Route("/{_locale}/management/chassi", requirements={"_locale" = "en|de"}, defaults={"_locale" = "en"})
 */
class ChassiController extends CRUDController
{
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
		/* @var $item \Debb\ManagementBundle\Entity\Chassi */
		$item = $this->getEntity($id);

		$form = $this->createForm($this->getFormType($item), $item);
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);

			if ($form->isValid())
			{
				$item->setTypspecification($request->request->get('typspec'));
				$this->persistEntity($item);
				$this->addSuccessMsg("localdev_admin.messages.saved");
			}
		}

		return $this->render($this->resolveTemplate(__METHOD__), array(
			'form' => $form->createView(),
			'item' => $item,
			'nodetypspecs' => Node::getTypes()
		));
	}

    /**
     * Duplicate entity
     *
     * @Route("/duplicate/{id}", requirements={"id"="\d+"});
     *
     * @param int $id item id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function duplicateAction($id)
    {
        $item = $this->getEntity($id);
        $itemNew = clone $item;
        var_dump($item->getId(), $itemNew->getId());
        die();
        return $this->redirect($this->generateUrl('debb_management_chassi_form'));
    }
}
