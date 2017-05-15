<?php

namespace AlbumRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use Album\Model\Album;
use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Zend\View\Model\JsonModel;

class AlbumRestController extends AbstractRestfulController
{

    private $table;

    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }

    public function getList()
    {
        $results = [];
        $resultSet = $this->table->fetchAll();
        foreach( $resultSet as $r )
            $results[] = $r;
        return new JsonModel([
            'albums' => $results,
        ]);
    }

    public function get($id)
    {
        return new JsonModel([]);
    }

    public function create($data)
    {
        return new JsonModel([]);
    }

    public function update($id, $data)
    {
        return new JsonModel([]);
    }

    public function delete($id)
    {
        return new JsonModel([]);
    }
}