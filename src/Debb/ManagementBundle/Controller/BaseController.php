<?php
namespace Debb\ManagementBundle\Controller;

use Debb\ManagementBundle\Entity\Base;
use Localdev\AdminBundle\Controller\CRUDController;
use Localdev\AdminBundle\Util\ControllerUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Used for user specific entities
 *
 * @author Patrick Bußmann <patrick.bussmann@christmann.info>
 */
class BaseController extends CRUDController
{
	/**
	 * @inheritdoc
	 */
	protected function getEntities($repository = '')
	{
		return $this->getRepository($repository)->findAllFromUser($this->getUser());
	}

	/**
	 * @inheritdoc
	 */
	public function createForm($type, $data = null, array $options = array())
	{
		if($data instanceof Base && method_exists($data, 'setUser') && method_exists($data, 'getUser') && $data->getUser() === null)
		{
			$data->setUser($this->getUser());
		}
		return $this->container->get('form.factory')->create($type, $data, $options);
	}

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
		$item = $this->getEntity($id);

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
			'item' => $item
		));
	}
}
