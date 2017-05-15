<?php
namespace AlbumRestTest\Controller;

use Album\Model\Album;
use AlbumRest\Controller\AlbumRestController;
use Prophecy\Argument;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Album\Model\AlbumTable;
use Zend\ServiceManager\ServiceManager;

class AlbumRestControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = false;
    protected $albumTable;

    public function setUp()
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
        // Grabbing the full application configuration:
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));
        parent::setUp();

        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);

        $services->setService('config', $this->updateConfig($services->get('config')));
        $services->setService(AlbumTable::class, $this->mockAlbumTable()->reveal());

        $services->setAllowOverride(false);
    }

    protected function mockAlbumTable()
    {
        $this->albumTable = $this->prophesize(AlbumTable::class);
        return $this->albumTable;
    }

    protected function updateConfig($config)
    {
        $config['db'] = [];
        return $config;
    }

    public function testGetListCanBeAccessed()
    {
        $this->dispatch('/album-rest');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('AlbumRest');
        $this->assertControllerName(AlbumRestController::class);
        $this->assertControllerClass('AlbumRestController');
        $this->assertMatchedRouteName('album-rest');
    }

    public function testGetCanBeAccessed()
    {
        $this->dispatch('/album-rest/1');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('AlbumRest');
        $this->assertControllerName(AlbumRestController::class);
        $this->assertControllerClass('AlbumRestController');
        $this->assertMatchedRouteName('album-rest');
    }

    public function testCreateCanBeAccessed()
    {
        $this->albumTable
            ->saveAlbum(Argument::type(Album::class))
            ->shouldBeCalled();

        $postData = [
            'title'  => 'Led Zeppelin III',
            'artist' => 'Led Zeppelin',
            'id'     => '',
        ];
        $this->dispatch('/album-rest', 'POST', $postData);
        $this->assertResponseStatusCode(200);
    }
}