<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{
    /**
    * @var $dataTable UsersDataTable
    */
    private $dataTable;

    public function __construct(UsersDataTable $dataTable)
    {
        // Inject the object to controller
        $this->dataTable = $dataTable;
    }

    public function index()
    {
        // render data table within index view
        return $this->dataTable->render('users.index');
    }
}
