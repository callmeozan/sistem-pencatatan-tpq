<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\Modelkegiatan;
use App\Models\Modelfoto;
use App\Models\Modelgallery;
use App\Models\Modelpengajar;
use App\Models\Modelsantri;
use App\Models\Modelkelas;
use App\Models\Modelkonfigurasi;
use App\Models\Modelinfaq;
use App\Models\Modeluser;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'Tgl_indo'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
		$this->pengajar = new Modelpengajar;
		$this->santri = new Modelsantri($request);
		$this->kelas = new Modelkelas;
		$this->infaq = new Modelinfaq($request);
		$this->kegiatan = new Modelkegiatan;
		$this->gallery = new Modelgallery;
		$this->foto = new Modelfoto;
		$this->konfigurasi = new Modelkonfigurasi;
		$this->user = new Modeluser;
	}
}
