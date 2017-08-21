<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\RequestDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateRequestRequest;
use App\Http\Requests\Admin\UpdateRequestRequest;
use App\Models\Admin\Profile;
use App\Repositories\Admin\RequestRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class RequestController extends AppBaseController
{
    /** @var  RequestRepository */
    private $requestRepository;

    public function __construct(RequestRepository $requestRepo)
    {
        $this->requestRepository = $requestRepo;
    }

    /**
     * Display a listing of the Request.
     *
     * @param RequestDataTable $requestDataTable
     * @return Response
     */
    public function index(RequestDataTable $requestDataTable)
    {
        return $requestDataTable->render('requests.index')->with('menu', []);
    }

    /**
     * Show the form for creating a new Request.
     *
     * @return Response
     */
    public function create()
    {
        if(Profile::where('user_id', Auth::user()->id)->first()) {
            return view('requests.create')->with('menu', []);
        } else {
            Flash::error('Lengkapi data Anda terlebih dahulu!.');

            return redirect(url('profiles/create'));
        }
    }

    /**
     * Store a newly created Request in storage.
     *
     * @param CreateRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $request = $this->requestRepository->create($input);

        Flash::success('Request saved successfully.');

        if(Auth::user()->hasRole(['administrator','superadministrator'])) {
            return redirect('requests.create');
        } else {
            return redirect(url('beranda'));
        }
    }

    /**
     * Display the specified Request.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $request = $this->requestRepository->findWithoutFail($id);

        if (empty($request)) {
            Flash::error('Request not found');

            if(Auth::user()->hasRole(['administrator','superadministrator'])) {
                return redirect(route('admin.requests.index'));
            } else {
                return redirect(url('beranda'));
            }
        }

        return view('requests.show')->with('menu', [])->with('request', $request);
    }
}
