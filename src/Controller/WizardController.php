<?php
/**
 * WizardController.php - Main Controller
 *
 * Wizard Controller AndroidBuilder Module
 *
 * @category Controller
 * @package AndroidBuilder
 * @author Verein onePlace
 * @copyright (C) 2021  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Android\Builder\Controller;

use Application\Controller\CoreController;
use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;


class WizardController extends CoreEntityController
{
    /**
     * Weos Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * Tables from other Modules
     *
     * @var $aPluginTbls
     * @since 1.0.'
     */
    protected $aPluginTbls;

    /**
     * WizardController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param WeosTable $oTableGateway
     * @param array $aPluginTbls
     * @param $oServiceManager
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter, $oTableGateway, $aPluginTbls, $oServiceManager)
    {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'wizard-single';
        $this->aPluginTbls = $aPluginTbls;
        parent::__construct($oDbAdapter, $oTableGateway, $oServiceManager);
    }

    public function indexAction()
    {
        $this->setThemeBasedLayout('androidbuilder');

        $aXmlFiles = [];
        foreach(glob($_SERVER['DOCUMENT_ROOT'].'/../vendor/oneplace/oneplace-android-builder/build/template/app/src/main/res/values/*.xml') as $sFile) {
            $aXmlFiles[] = $sFile;
        }

        $oColorTemplate = '';
        foreach($aXmlFiles as $sFile) {
            if(basename($sFile) == 'colors.xml') {
                $oColorTemplate = new \SimpleXMLElement(file_get_contents($sFile));
            }
        }


        return new ViewModel([
            'oColorTemplate' => $oColorTemplate,
        ]);
    }
}