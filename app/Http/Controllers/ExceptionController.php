<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\ExceptionDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateExceptionRequest;
use App\Http\Requests\Admin\UpdateExceptionRequest;
use App\Models\Admin\Profile;
use App\Repositories\Admin\ExceptionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ExceptionController extends AppBaseController
{
    /** @var  ExceptionRepository */
    private $exceptionRepository;

    public function __construct(ExceptionRepository $exceptionRepo)
    {
        $this->exceptionRepository = $exceptionRepo;
    }

    /**
     * Display a listing of the Exception.
     *
     * @param ExceptionDataTable $exceptionDataTable
     * @return Response
     */
    public function index(ExceptionDataTable $exceptionDataTable)
    {
        return $exceptionDataTable->render('exceptions.index')->with('menu', []);
    }

    /**
     * Show the form for creating a new Exception.
     *
     * @return Response
     */
    public function create()
    {
        if(Profile::where('user_id', Auth::user()->id)->first()) {
            return view('exceptions.create')->with('menu', []);
        } else {
            Flash::error('Lengkapi data Anda terlebih dahulu!.');

            return redirect(url('profiles/create'));
        }
    }

    /**
     * Store a newly created Exception in storage.
     *
     * @param CreateExceptionRequest $request
     *
     * @return Response
     */
    public function store(CreateExceptionRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $exception = $this->exceptionRepository->create($input);

        Flash::success('Exception saved successfully.');

        return redirect(url('beranda'));
    }

    /**
     * Display the specified Exception.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            Flash::error('Exception not found');

            return redirect(url('beranda'));
        }

        return view('exceptions.show')->with('menu', [])->with('exception', $exception);
    }
}
