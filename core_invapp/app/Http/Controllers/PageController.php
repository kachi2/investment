<?php


namespace App\Http\Controllers;


use App\Models\Page;
use App\Enums\Boolean;
use App\Enums\UserRoles;
use App\Enums\PageStatus;
use App\Services\Shortcut;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __invoke(Request $request, $slug)
    {

        $shortcut   = new Shortcut();
        $logged     = Auth::check();
        $admins     = ($logged && in_array(Auth::user()->role, [UserRoles::ADMIN, UserRoles::SUPER_ADMIN]));

        $page = Page::where('slug', $slug)->firstOrFail();

        $access = (data_get($page, 'public', 0)) ? 'public' : 'login';
        $status = data_get($page, 'status', 'inactive');

        $showContactForm = false;
        if ((sys_settings("page_contact") == $page->id) && sys_settings("page_contact_form") == "on") {
            $showContactForm = true;
        }

        $data = [
            'admins' => $admins,
            'pgtitle' => (data_get($page, 'seo.title')) ? data_get($page, 'seo.title') : data_get($page, 'name'),
            'pgdesc' => data_get($page, 'seo.description', gss('seo_description', '')),
            'pgkeyword' => data_get($page, 'seo.keyword', gss('seo_keyword', '')),
            'title' => data_get($page, 'title', data_get($page, 'name')),
            'subtitle' => data_get($page, 'subtitle'),
            'content' => $shortcut->processContent(data_get($page, 'content', '')),
            'showContactForm' => $showContactForm
        ];

        if ($access=='login' && $status==PageStatus::ACTIVE && !$logged) {
            return redirect()->route('auth.login.form');
        }

        if($admins) {
            return view('frontend.pages')->with($data);
        }

        if($status==PageStatus::ACTIVE) {
            return ($logged) ? view('user.pages')->with($data) : view('frontend.pages')->with($data);
        } else {
            App::abort(404);
        }
    }

}
