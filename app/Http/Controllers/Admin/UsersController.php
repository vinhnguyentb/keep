<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class UsersController extends Controller
{
    protected $userRepo;

    /**
     * Create new users controller instance.
     *
     * @param UserRepo $userRepo
     */
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get active accounts.
     *
     * @return \Illuminate\View\View
     */
    public function activeAccounts()
    {
        $request = app('request');
        $sortBy = $request->get('sortBy');
        $direction = $request->get('direction');
        $activeAccounts = $this->userRepo->fetchPaginatedUsers(compact('sortBy', 'direction'), 100);

        return view('admin.accounts.active_accounts', compact('activeAccounts'));
    }

    /**
     * Get disabled accounts.
     *
     * @return \Illuminate\View\View
     */
    public function disabledAccounts()
    {
        $disabledAccounts = $this->userRepo->fetchDisabledUsers(25);

        return view('admin.accounts.disabled_accounts', compact('disabledAccounts'));
    }

    /**
     * Get account profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function profile($slug)
    {
        $user = $this->userRepo->findBySlugEagerLoadTasks($slug);

        return view('admin.accounts.profile', compact('user'));
    }

    /**
     * Disable an account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableAccount($slug)
    {
        $this->userRepo->softDelete($slug);
        flash()->info(trans('administrator.account_disabled'));

        return redirect()->route('admin::members.active');
    }

    /**
     * Restore a disabled account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAccount($slug)
    {
        $this->userRepo->restore($slug);
        flash()->info(trans('administrator.account_restored'));

        return back();
    }

    /**
     * Permanently delete an account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteAccount($slug)
    {
        $this->userRepo->forceDelete($slug);
        flash()->info(trans('administrator.account_destroyed'));

        return back();
    }
}
