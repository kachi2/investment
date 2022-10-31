<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Page;
use App\Models\Language;
use App\Models\Account;
use App\Models\UserMeta;
use App\Models\Referral;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UserPanel
{
    /**
     * Display balance in cards
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
	public static function balance($type='', $prams=[])
    {
        if(empty($type)) return false;
        $user = Auth::user();
        $currency = base_currency();

        // Balances
        $balance = $user->balance(AccType('main'));
        $additional = $user->balance(AccType('invest'));
        $css_class = 'is-primary';
        $percentage=0;

        if($type=='deposit' || $type=='withdraw') {
            $balance = $user->tnx_amounts($type, 'total');
            $additional = $user->tnx_amounts($type, 'month');
            $lastMonth=$user->transactions()->completed()->whereBetween('completed_at',[
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ])->sum('amount');

            $percentage = to_dfp($additional, $lastMonth);
            $css_class  = ($type=='deposit') ? 'is-base' : 'is-warning';
        }

        $amount = [ 'main' => $balance, 'sub' => $additional ];

        // Attribute arguments
        $default = array('id' => '', 'class' => $css_class);
        $attr = parse_args($prams, $default);

        return view('misc.panel.card-balance', compact('type', 'amount', 'attr','percentage'))->render();
    }


    /**
     * Display additional cards
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function cards($type='', $prams=[])
    {
        if(empty($type)) return false;

        $default = array('id' => '', 'class' => '');
        $attr = parse_args($prams, $default);

        if(in_array($type, ['support'])) {
            return view('misc.panel.card-'.$type, compact('type', 'attr'))->render();
        }

        return false;
    }


    /**
     * Display alerts on profile
     * @param $alert
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function profile_alerts($alert='', $prams=[])
    {
        if(empty($alert)) $alert = 'any';

        // Attribute arguments
        $default = array('class' => 'alert-plain');
        $attr = parse_args($prams, $default);

        return view('misc.panel.alerts', compact('alert', 'attr'))->render();
    }


    /**
     * Display alerts on profile
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function navigation($type='', $prams=[])
    {
        if(in_array($type, ['main', 'mainnav', 'footer'])) {

            $alone = ($type=='footer') ? true : false;
            $option = ($type=='main') ? 'main_menu' : (($type=='mainnav') ? 'main_nav' : 'footer_menu');
            $items = Page::whereIn('id', sys_settings($option, []))->active()->get();
            // Attribute arguments
            $default = array('class' => '', 'alone' => $alone);
            $attr = parse_args($prams, $default);
            return view('misc.panel.nav-'.$type, compact('type', 'items', 'attr'))->render();
        }

        return false;
    }


    /**
     * Display socials links on website
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function socials($type='', $prams=[])
    {
        $socials = social_links('all');

        // Attribute arguments
        $default = array('class' => '');
        $attr = parse_args($prams, $default);

        return view('misc.panel.socials', compact('type', 'socials', 'attr'))->render();
    }



    /**
     * Display socials links on website
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function news($type='', $prams=[])
    {
        // Attribute arguments
        $default = array('class' => '');
        $attr = parse_args($prams, $default);

        return view('misc.panel.news', compact('type', 'attr'))->render();
    }



    /**
     * Display socials links on website
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function referral($type='', $prams=[])
    {
        if(!referral_system()) return false;

        // Attribute arguments
        $default = array('class' => '');
        $attr = parse_args($prams, $default);

        $user = Auth::user();
        $total = User::where('refer', $user->id)->count();
        $chart = [];

        $referrals = [
            'total' => $total,
            'chart' => $chart,
        ];

        return view('misc.panel.card-referral', compact('type', 'attr', 'referrals'))->render();
    }



    /**
     * Display language swticher on website
     * @param $type
     * @param $attr | additional argument pass into blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @version 1.0.0
     * @since 1.0
     */
    public static function lang_switcher($type='', $prams=[])
    {
         // Attribute arguments
        $default = array('class' => '');
        $attr = parse_args($prams, $default);
        $english = (sys_settings('language_show_as', 'default') == 'short') ? 'Eng' : 'English';

        $selected = [
            'code' => 'en',
            'label' => $english,
        ];

        $langs = [];
        if (Schema::hasTable('languages')) {
            $languages = Language::select(['name', 'label', 'short', 'code'])->active()->get();

            if(!empty($languages)) {
                foreach ($languages as $language) {
                    $langs[$language->code] = (sys_settings('language_show_as', 'default') == 'short') ? $language->short : $language->label;
                    if (App::currentLocale() == $language->code) {
                        $selected['code'] = $language->code;
                        if (sys_settings('language_show_as', 'default') == 'default') {
                            $selected['label'] = $language->name;
                        } else {
                            $selected['label'] = (sys_settings('language_show_as', 'default') == 'short') ? $language->short : $language->label;
                        }
                    }
                }
            }
        }

        // Set fallback if no language found.
        if (empty($langs)) {
            $langs['en'] = $english;
        }

        $default = 'en';

        return view('misc.panel.lang-switcher', compact('langs', 'default', 'type', 'attr', 'selected'))->render();
    }

}
