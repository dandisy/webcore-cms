<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\ProfileDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateProfileRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Repositories\Admin\ProfileRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param ProfileDataTable $profileDataTable
     * @return Response
     */
    public function index(ProfileDataTable $profileDataTable)
    {
        return $profileDataTable->render('profiles.index')->with('menu', []);
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        Session::flash('backUrl', Redirect::back()->getTargetUrl());

        return view('profiles.create')->with('menu', []);
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $profile)
    {
        $input = $profile->all();

        $input['user_id'] = Auth::user()->id;

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        $url = Session::get('backUrl');

        //return redirect(url('profiles/show'));
        return $url ? Redirect::to($url) : redirect(url('profiles/show'));
    }

    /**
     * Display the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //$profile = $this->profileRepository->findWithoutFail($id);
        $profile = $this->profileRepository->findWhere(['user_id' => $id])->first();

        if (empty($profile)) {
            Flash::error('Profile not found');

            //return redirect(url('profiles/create'));
            return back();
        }

        return view('profiles.show')->with('menu', [])->with('profile', $profile);
    }
}
