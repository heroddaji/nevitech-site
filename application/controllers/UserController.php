<?php

class UserController extends Nevitech_Controller_Action
{
    public function loginAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/');
        }

        $loginForm = new Application_Form_Login();
        $loginForm->setCallback($this->_request->callback);

        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($loginForm->isValid($request->getPost())) {
                $username = $loginForm->getValue('username');
                $password = $loginForm->getValue('password');

                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

                $authAdapter->setTableName('nv_users')
                            ->setIdentityColumn('username')
                            ->setCredentialColumn('password')
                            ->setCredentialTreatment('MD5(?)');

                $authAdapter->setIdentity($username)
                            ->setCredential($password);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $userInfo = $authAdapter->getResultRowObject(null, 'password');

                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);

                    $this->_getMessenger()->addMessage('Login successful');
                    $url = $this->_request->callback ? $this->_request->callback : '/';
                    $this->_redirect($url);
                } else {
                    $loginForm->password->addError('Could not login. Please try again.');
                }
            }
        }

        $this->view->form = $loginForm;
    }

    protected function _uploadUserImage($form)
    {
        $targetDir = APPLICATION_PATH . '../uploads/users/' . uniqid() . '/';
        if (!file_exists($targetDir)) {

        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }

    public function registerAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_getMessenger()->addMessage('You are already logged in.');
            $this->_redirect('/');
        }

        $request = $this->getRequest();
        $registrationForm = new Application_Form_Registration();
        $this->view->form = $registrationForm;

        if ($request->isPost()) {
            if ($registrationForm->isValid($request->getPost())) {
                if ($registrationForm->image->isUploaded()) {
                    $uploadedImage = $registrationForm->image->getFileName();
                    $extension = substr($uploadedImage, strrpos($uploadedImage, '.'));
                    $renamedImage = dirname($uploadedImage) . '/' . $registrationForm->getValue('username') . $extension;

                    $registrationForm->image->addFilter('Rename', array('target' => $renamedImage, 'overwrite' => true));
                    if ($registrationForm->image->receive()) {
                        $image = $registrationForm->image->getFileName(null, false);
                    }
                }

                $data = $registrationForm->getValues();
                if (isset($image)) {
                    $data['image'] = $image;
                }

                if ($data['password'] !== $data['confirmPassword']) {
                    $registrationForm->password->addError(
                        'Password and Confirm password do not match.'
                    );
                    return;
                }

                $user = new Application_Model_User($data);
                $userMapper = new Application_Model_UserMapper();

                if ($userMapper->userExists($user)) {
                    $registrationForm->username->addError(
                        'Username already exists. Please choose another one.'
                    );
                    return;
                }

                $userMapper->save($user);

                $this->_getMessenger()->addMessage('Sign up successful. Login like a boss now!');
                $this->_redirect('/user/login/');
            }
        }
    }

    public function profileAction()
    {
        $user = new Application_Model_User();
        $userMapper = new Application_Model_UserMapper();

        $userMapper->find($this->_request->id, $user);

        $this->view->user = $user;
    }
}