<?php
/**
 * Allows user to manage the flags
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright Company
 */

class FlagsController extends App_Backoffice_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init(){
        // init the parent
        parent::init();
    }
    
    /**
     * Allows the user to view all the flags registered in the application
     *
     * @access public
     * @return void
     */
    public function indexAction(){
        $this->title = '';
        
        $flagModel = new Flag();
        $this->view->paginator = $flagModel->findAll($this->_getPage());
    }
    
    /**
     * Change the active status of a flag on production
     *
     * @access public
     * @return void
     */
    public function toogleprodAction(){
        $id = $this->getRequest()->getParam('id');
        
        $flagModel = new Flag();
        $flagModel->toogleFlag($id, APP_STATE_PRODUCTION);
        
        App_FlagFlippers_Manager::save();
        
        $this->_redirect('/flags/');
    }
    
    /**
     * Change the active status of a flag on development
     *
     * @access public
     * @return void
     */
    public function toogledevAction(){
        $id = $this->getRequest()->getParam('id');
        
        $flagModel = new Flag();
        $flagModel->toogleFlag($id, APP_STATE_DEVELOPMENT);
        
        App_FlagFlippers_Manager::save();
        
        $this->_redirect('/flags/');
    }
}