<?php

class PortfolioController extends Nevitech_Controller_Action
{
    public function indexAction()
	{
        $mapper = new Application_Model_ProjectMapper();

        $page = $this->_getParam('page', 1);
        $paginator = Zend_Paginator::factory($mapper->fetchAll());
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(8);

        $this->view->paginator = $paginator;
	}

    public function newAction()
    {
        $this->_helper->login();

        $request = $this->getRequest();
        $form = new Application_Form_Project();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $form->image->receive();

                $project = new Application_Model_Project($form->getValues());
                $mapper = new Application_Model_ProjectMapper();
                $mapper->save($project);

                $this->_getMessenger()->addMessage(
                    sprintf('Project "%s" is added to the portfolio.', $project->name)
                );
                $this->_redirect('/portfolio/');
            }
        }

        $this->view->form = $form;
        $this->view->title = 'Add a new project to the portfolio';
    }

    public function deleteAction()
    {
        $this->_helper->login();

        if (!($this->_validateHash($this->_request->hash))) {
            $this->_getMessenger()->addMessage('Bitch what you trynna do?');
            $this->_redirect('/portfolio/');
        }

        $mapper = new Application_Model_ProjectMapper();
        $mapper->delete($this->_getParam('id'));

        $this->_getMessenger()->addMessage('Project successfully removed from portfolio.');
        $this->_redirect('/portfolio/');
    }

    public function bycategoryAction()
    {
        // DO VALIDATION
        $mapper = new Application_Model_ProjectMapper();

        $category = $this->_getParam('category');

        if ($category) {
            $projects = $mapper->fetchAll(array('category = ?' => $category));
        } else {
            $projects = $mapper->fetchAll();
        }


        $this->_helper->json($projects);
    }
}