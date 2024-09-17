<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;

use App\Models\UnitIndukmodel;
use App\Models\Unitmodel;
use App\Models\UnitFiturmodel;
use App\Models\Fiturmodel;
use App\Models\UUsermodel;
use App\Models\UserAksesmodel;
use App\Models\Posmodel;
use App\Models\Suppliermodel;
use App\Models\Katmenumodel;
use App\Models\Kartumodel;
use App\Models\Shiftmodel;
use App\Models\Katitemmodel;
use App\Models\Tiptransmodel;
use App\Models\Itemmodel;
use App\Models\Menumodel;
use App\Models\ItemMenumodel;
use App\Models\Mejamodel;
use App\Models\Konversimodel;
use App\Models\Stockoutmodel;
use App\Models\Somodel;
use App\Models\SoItemmodel;
use App\Models\POmodel;
use App\Models\POItemmodel;
use App\Models\Receivemodel;
use App\Models\Returmodel;
use App\Models\Initialmodel;
use App\Models\Paymodel;
use App\Models\Transmodel;
use App\Models\TransMenumodel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
        public $unitmodel;
    public $unitfiturmodel;
    public $fiturmodel;
    public $indukmodel;
    public $usermodel;
    public $useraksesmodel;
    public $posmodel;
    public $supliermodel;
    public $katmenumodel;
    public $kartumodel;
    public $shiftmodel;
    public $katitemmodel;
    public $tiptransmodel;
    public $itemmodel;
    public $menumodel;
    public $itemmenumodel;
    public $mejamodel;
    public $konversimodel;
    public $stockoutmodel;
    public $somodel;
    public $soitemmodel;
    public $pomodel;
    public $poitemmodel;
    public $receivemodel;
    public $returmodel;
    public $initialmodel;
    public $paymodel;
    public $transmodel;
    public $transmenumodel;
    public function __construct()
    {

        $this->request = \Config\Services::request();
        $this->unitmodel        = new UnitModel();
        $this->unitfiturmodel   = new UnitFiturModel();
        $this->fiturmodel       = new FiturModel();
        $this->indukmodel       = new UnitIndukModel();
        $this->usermodel        = new UUserModel();
        $this->useraksesmodel   = new UserAksesModel();
        $this->posmodel         = new PosModel();
        $this->suppliermodel    = new SupplierModel();
        $this->katmenumodel     = new KatmenuModel();
        $this->kartumodel       = new KartuModel();
        $this->shiftmodel       = new ShiftModel();
        $this->katitemmodel     = new KatitemModel();
        $this->tiptransmodel    = new TiptransModel();
        $this->itemmodel        = new ItemModel();
        $this->menumodel        = new MenuModel();
        $this->itemmenumodel    = new ItemMenuModel();
        $this->mejamodel        = new MejaModel();
        $this->konversimodel    = new KonversiModel();
        $this->stockoutmodel    = new StockoutModel();
        $this->somodel          = new SoModel();
        $this->soitemmodel      = new SoItemModel();
        $this->pomodel          = new POModel();
        $this->poitemmodel      = new POItemModel();
        $this->receivemodel     = new ReceiveModel();
        $this->returmodel       = new ReturModel();
        $this->initialmodel     = new InitialModel();
        $this->paymodel         = new PayModel();
        $this->transmodel       = new TransModel();
        $this->transmenumodel       = new TransMenuModel();
    }
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
}